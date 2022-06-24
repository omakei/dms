<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use App\Models\Patient;
use App\Models\PatientInvestigation;
use App\Models\PatientPrescription;
use App\Models\PatientReferral;
use App\Models\PatientVisit;
use App\Models\Report;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class ReportController extends Controller
{
    public  function label(PatientInvestigation $investigation)
    {

       $pdf = PDF::loadView('templates.label',
            ['data' => $investigation, 'qrcode' => QrCode::size(400)->color(0,0,0)->generate($investigation)])
            ->setPaper('a8','landscape');

       return $pdf->stream('label-'.$investigation->laboratory_test->name.now()->unix().'.pdf');
    }

    public  function referral(PatientReferral $referral)
    {

        $pdf = PDF::loadView('templates.referral',
            ['data' => $referral, 'qrcode' => QrCode::size(400)->color(0,0,0)->generate($referral)])
            ->setPaper('a4','portrait');

        return $pdf->stream('referral-'.$referral->visit->visit_number.now()->unix().'.pdf');
    }

    public  function prescription(PatientPrescription $prescription)
    {

        $pdf = PDF::loadView('templates.prescription',
            ['data' => $prescription, 'qrcode' => QrCode::size(400)->color(0,0,0)->generate($prescription)])
            ->setPaper('a4','landscape');

        return $pdf->stream('prescription-'.$prescription->visit->visit_number.now()->unix().'.pdf');
    }

    public  function claim(PatientPrescription $prescription)
    {

        $pdf = PDF::loadView('templates.claim',
            ['data' => [], 'qrcode' => QrCode::size(400)->color(0,0,0)->generate('omakei')])
            ->setPaper('a4','landscape');

        return $pdf->stream('claim-'. Str::uuid().'.pdf');
    }

    public  function bill(Bill $bill)
    {
        $patient = Patient::find($bill->patient_id);

        if($patient->insurance_type == 'NHIF') {

            $pdf = PDF::loadView('templates.claim',
                ['data' => PatientVisit::find($bill->patient_visit_id), 'bill' => $bill, 'qrcode' => QrCode::size(400)->color(0,0,0)->generate('omakei')])
                ->setPaper('a4','landscape');

            return $pdf->stream('claim-'. Str::uuid().'.pdf');
        }

        $pdf = PDF::loadView('templates.bill',
            ['data' => PatientVisit::find($bill->patient_visit_id), 'bill' => $bill, 'qrcode' => QrCode::size(400)->color(0,0,0)->generate('omakei')])
            ->setPaper('a4','landscape');

        return $pdf->stream('bill-'. Str::uuid().'.pdf');
    }

    public  function mtuha(Report $report)
    {

        $mtuha_data = [
            'opd_visit' =>[
                'below_one_month_f' => 0,
                'below_one_month_m' => 0,
                'below_one_year_f' => 0,
                'below_one_year_m' => 0,
                'below_five_year_f' => 0,
                'below_five_year_m' => 0,
                'below_sixty_year_f' => 0,
                'below_sixty_year_m' => 0,
                'above_sixty_year_f' => 0,
                'above_sixty_year_m' => 0,
                'total_f' => 0,
                'total_m' => 0,
            ],
            'opd_first_visit' => [
                'below_one_month_f' => 0,
                'below_one_month_m' => 0,
                'below_one_year_f' => 0,
                'below_one_year_m' => 0,
                'below_five_year_f' => 0,
                'below_five_year_m' => 0,
                'below_sixty_year_f' => 0,
                'below_sixty_year_m' => 0,
                'above_sixty_year_f' => 0,
                'above_sixty_year_m' => 0,
                'total_f' => 0,
                'total_m' => 0,
            ],
            'opd_repeated_visit' => [
                'below_one_month_f' => 0,
                'below_one_month_m' => 0,
                'below_one_year_f' => 0,
                'below_one_year_m' => 0,
                'below_five_year_f' => 0,
                'below_five_year_m' => 0,
                'below_sixty_year_f' => 0,
                'below_sixty_year_m' => 0,
                'above_sixty_year_f' => 0,
                'above_sixty_year_m' => 0,
                'total_f' => 0,
                'total_m' => 0,
            ],
            'opd_diagnoses' => [],
            'from' => $report->from,
            'to' => $report->to,
        ];

        $opd = PatientVisit::groupBy('patient_id')
            ->with('patient')
            ->selectRaw('count(*) as total, patient_id')
            ->get();
//dd($opd->map(fn($item)=> $item->total));
        $opd->map(function ($item) use(&$mtuha_data, $report) {

            if($item->patient->gender == 'Female'  && Carbon::make($item->patient->dob)->diffInMonths(Carbon::now()) < 1) {
                $mtuha_data['opd_visit']['below_one_month_f'] = $mtuha_data['opd_visit']['below_one_month_f']+1;
                $mtuha_data['opd_visit']['total_f'] = $mtuha_data['opd_visit']['total_f']+1;

                if($item->total == 1 ){
                    $mtuha_data['opd_first_visit']['below_one_month_f'] = $mtuha_data['opd_first_visit']['below_one_month_f']+1;
                    $mtuha_data['opd_first_visit']['total_f'] = $mtuha_data['opd_first_visit']['total_f']+1;
                }

                if($item->total > 1 ){
                    $mtuha_data['opd_repeated_visit']['below_one_month_f'] = $mtuha_data['opd_repeated_visit']['below_one_month_f']+1;
                    $mtuha_data['opd_repeated_visit']['total_f'] = $mtuha_data['opd_repeated_visit']['total_f']+1;
                }

                foreach (Arr::flatten($this->getPatientDiseases($report, $item->patient_id)) as $disease){

                    $mtuha_data['opd_diagnoses'][$disease]['below_one_month_f'] = !empty($mtuha_data['opd_diagnoses'][$disease]['below_one_month_f'])
                                                                                    ?$mtuha_data['opd_diagnoses'][$disease]['below_one_month_f']+1:1;
                    $mtuha_data['opd_diagnoses'][$disease]['total_f'] = !empty($mtuha_data['opd_diagnoses'][$disease]['total_f'])
                                                                                    ?$mtuha_data['opd_diagnoses'][$disease]['total_f']+1:1;
                }

            }

            if($item->patient->gender == 'Male'  && Carbon::make($item->patient->dob)->diffInMonths(Carbon::now()) < 1) {
                $mtuha_data['opd_visit']['below_one_month_m'] = $mtuha_data['opd_visit']['below_one_month_m']+1;
                $mtuha_data['opd_visit']['total_m'] = $mtuha_data['opd_visit']['total_m']+1;

                if($item->total == 1 ){
                    $mtuha_data['opd_first_visit']['below_one_month_m'] = $mtuha_data['opd_first_visit']['below_one_month_m']+1;
                    $mtuha_data['opd_first_visit']['total_m'] = $mtuha_data['opd_first_visit']['total_m']+1;
                }

                if($item->total > 1 ){
                    $mtuha_data['opd_repeated_visit']['below_one_month_m'] = $mtuha_data['opd_repeated_visit']['below_one_month_m']+1;
                    $mtuha_data['opd_repeated_visit']['total_m'] = $mtuha_data['opd_repeated_visit']['total_m']+1;
                }

                foreach (Arr::flatten($this->getPatientDiseases($report, $item->patient_id)) as $disease){

                    $mtuha_data['opd_diagnoses'][$disease]['below_one_month_m'] = !empty($mtuha_data['opd_diagnoses'][$disease]['below_one_month_m'])
                                                                                    ?$mtuha_data['opd_diagnoses'][$disease]['below_one_month_m']+1:1;
                    $mtuha_data['opd_diagnoses'][$disease]['total_m'] = !empty($mtuha_data['opd_diagnoses'][$disease]['total_m'])
                                                                        ?$mtuha_data['opd_diagnoses'][$disease]['total_m']+1:1;
                }

            }

            if($item->patient->gender == 'Female'  && (Carbon::make($item->patient->dob)->diffInMonths(Carbon::now()) > 1 && $item->patient->age < 1)) {
                $mtuha_data['opd_visit']['below_one_year_f'] = $mtuha_data['opd_visit']['below_one_year_f']+1;
                $mtuha_data['opd_visit']['total_f'] = $mtuha_data['opd_visit']['total_f']+1;

                if($item->total == 1 ){
                    $mtuha_data['opd_first_visit']['below_one_year_f'] = $mtuha_data['opd_first_visit']['below_one_year_f']+1;
                    $mtuha_data['opd_first_visit']['total_f'] = $mtuha_data['opd_first_visit']['total_f']+1;
                }

                if($item->total > 1 ){
                    $mtuha_data['opd_repeated_visit']['below_one_year_f'] = $mtuha_data['opd_repeated_visit']['below_one_year_f']+1;
                    $mtuha_data['opd_repeated_visit']['total_f'] = $mtuha_data['opd_repeated_visit']['total_f']+1;
                }

                foreach (Arr::flatten($this->getPatientDiseases($report, $item->patient_id)) as $disease){

                    $mtuha_data['opd_diagnoses'][$disease]['below_one_year_f'] = !empty($mtuha_data['opd_diagnoses'][$disease]['below_one_year_f'])
                                                                                ?$mtuha_data['opd_diagnoses'][$disease]['below_one_year_f']+1:1;
                    $mtuha_data['opd_diagnoses'][$disease]['total_f'] = !empty($mtuha_data['opd_diagnoses'][$disease]['total_f'])
                                                                        ?$mtuha_data['opd_diagnoses'][$disease]['total_f']+1:1;
                }

            }

            if($item->patient->gender == 'Male'  && (Carbon::make($item->patient->dob)->diffInMonths(Carbon::now()) > 1 && $item->patient->age < 1)) {
                $mtuha_data['opd_visit']['below_one_year_m'] = $mtuha_data['opd_visit']['below_one_year_m']+1;
                $mtuha_data['opd_visit']['total_m'] = $mtuha_data['opd_visit']['total_m']+1;

                if($item->total == 1 ){
                    $mtuha_data['opd_first_visit']['below_one_year_m'] = $mtuha_data['opd_first_visit']['below_one_year_m']+1;
                    $mtuha_data['opd_first_visit']['total_m'] = $mtuha_data['opd_first_visit']['total_m']+1;
                }

                if($item->total > 1 ){
                    $mtuha_data['opd_repeated_visit']['below_one_year_m'] = $mtuha_data['opd_repeated_visit']['below_one_year_m']+1;
                    $mtuha_data['opd_repeated_visit']['total_m'] = $mtuha_data['opd_repeated_visit']['total_m']+1;
                }

                foreach (Arr::flatten($this->getPatientDiseases($report, $item->patient_id)) as $disease){

                    $mtuha_data['opd_diagnoses'][$disease]['below_one_year_m'] = !empty($mtuha_data['opd_diagnoses'][$disease]['below_one_year_m'])
                                                                                    ?$mtuha_data['opd_diagnoses'][$disease]['below_one_year_m']+1:1;
                    $mtuha_data['opd_diagnoses'][$disease]['total_m'] = !empty($mtuha_data['opd_diagnoses'][$disease]['total_m'])
                                                                        ?$mtuha_data['opd_diagnoses'][$disease]['total_m']+1:1;
                }
            }

            if($item->patient->gender == 'Female'  && ($item->patient->age > 1 && $item->patient->age < 5)) {
                $mtuha_data['opd_visit']['below_five_year_f'] = $mtuha_data['opd_visit']['below_five_year_f']+1;
                $mtuha_data['opd_visit']['total_f'] = $mtuha_data['opd_visit']['total_f']+1;

                if($item->total == 1 ){
                    $mtuha_data['opd_first_visit']['below_five_year_f'] = $mtuha_data['opd_first_visit']['below_five_year_f']+1;
                    $mtuha_data['opd_first_visit']['total_f'] = $mtuha_data['opd_first_visit']['total_f']+1;
                }

                if($item->total > 1 ){
                    $mtuha_data['opd_repeated_visit']['below_five_year_f'] = $mtuha_data['opd_repeated_visit']['below_five_year_f']+1;
                    $mtuha_data['opd_repeated_visit']['total_f'] = $mtuha_data['opd_repeated_visit']['total_f']+1;
                }

                foreach (Arr::flatten($this->getPatientDiseases($report, $item->patient_id)) as $disease){

                    $mtuha_data['opd_diagnoses'][$disease]['below_five_year_f'] = !empty($mtuha_data['opd_diagnoses'][$disease]['below_five_year_f'])
                                                                                    ?$mtuha_data['opd_diagnoses'][$disease]['below_five_year_f']+1:1;
                    $mtuha_data['opd_diagnoses'][$disease]['total_f'] = !empty($mtuha_data['opd_diagnoses'][$disease]['total_f'])
                                                                        ?$mtuha_data['opd_diagnoses'][$disease]['total_f']+1:1;
                }
            }

            if($item->patient->gender == 'Male'  && ($item->patient->age > 1 && $item->patient->age < 5)) {
                $mtuha_data['opd_visit']['below_five_year_m'] = $mtuha_data['opd_visit']['below_five_year_m']+1;
                $mtuha_data['opd_visit']['total_m'] = $mtuha_data['opd_visit']['total_m']+1;

                if($item->total == 1 ){
                    $mtuha_data['opd_first_visit']['below_five_year_m'] = $mtuha_data['opd_first_visit']['below_five_year_m']+1;
                    $mtuha_data['opd_first_visit']['total_m'] = $mtuha_data['opd_first_visit']['total_m']+1;
                }

                if($item->total > 1 ){
                    $mtuha_data['opd_repeated_visit']['below_five_year_m'] = $mtuha_data['opd_repeated_visit']['below_five_year_m']+1;
                    $mtuha_data['opd_repeated_visit']['total_m'] = $mtuha_data['opd_repeated_visit']['total_m']+1;
                }

                foreach (Arr::flatten($this->getPatientDiseases($report, $item->patient_id)) as $disease){

                    $mtuha_data['opd_diagnoses'][$disease]['below_five_year_m'] = !empty($mtuha_data['opd_diagnoses'][$disease]['below_five_year_m'])
                                                                                ?$mtuha_data['opd_diagnoses'][$disease]['below_five_year_m']+1:1;
                    $mtuha_data['opd_diagnoses'][$disease]['total_m'] = !empty($mtuha_data['opd_diagnoses'][$disease]['total_m'])
                                                                        ?$mtuha_data['opd_diagnoses'][$disease]['total_m']+1:1;
                }
            }

            if($item->patient->gender == 'Female'  && ($item->patient->age > 5 && $item->patient->age < 60)) {
                $mtuha_data['opd_visit']['below_sixty_year_f'] = $mtuha_data['opd_visit']['below_sixty_year_f']+1;
                $mtuha_data['opd_visit']['total_f'] = $mtuha_data['opd_visit']['total_f']+1;

                if($item->total == 1 ){
                    $mtuha_data['opd_first_visit']['below_sixty_year_f'] = $mtuha_data['opd_first_visit']['below_sixty_year_f']+1;
                    $mtuha_data['opd_first_visit']['total_f'] = $mtuha_data['opd_first_visit']['total_f']+1;
                }

                if($item->total > 1 ){
                    $mtuha_data['opd_repeated_visit']['below_sixty_year_f'] = $mtuha_data['opd_repeated_visit']['below_sixty_year_f']+1;
                    $mtuha_data['opd_repeated_visit']['total_f'] = $mtuha_data['opd_repeated_visit']['total_f']+1;
                }

                foreach (Arr::flatten($this->getPatientDiseases($report, $item->patient_id)) as $disease){

                    $mtuha_data['opd_diagnoses'][$disease]['below_sixty_year_f'] = !empty($mtuha_data['opd_diagnoses'][$disease]['below_sixty_year_f'])
                                                                                    ?$mtuha_data['opd_diagnoses'][$disease]['below_sixty_year_f']+1:1;
                    $mtuha_data['opd_diagnoses'][$disease]['total_f'] = !empty($mtuha_data['opd_diagnoses'][$disease]['total_f'])
                                                                        ?$mtuha_data['opd_diagnoses'][$disease]['total_f']+1:1;
                }

            }

            if($item->patient->gender == 'Male'  && ($item->patient->age > 5 && $item->patient->age < 60)) {
                $mtuha_data['opd_visit']['below_sixty_year_m'] = $mtuha_data['opd_visit']['below_sixty_year_m']+1;
                $mtuha_data['opd_visit']['total_m'] = $mtuha_data['opd_visit']['total_m']+1;

                if($item->total == 1 ){
                    $mtuha_data['opd_first_visit']['below_sixty_year_m'] = $mtuha_data['opd_first_visit']['below_sixty_year_m']+1;
                    $mtuha_data['opd_first_visit']['total_m'] = $mtuha_data['opd_first_visit']['total_m']+1;
                }

                if($item->total > 1 ){
                    $mtuha_data['opd_repeated_visit']['below_sixty_year_m'] = $mtuha_data['opd_repeated_visit']['below_sixty_year_m']+1;
                    $mtuha_data['opd_repeated_visit']['total_m'] = $mtuha_data['opd_repeated_visit']['total_m']+1;
                }

                foreach (Arr::flatten($this->getPatientDiseases($report, $item->patient_id)) as $disease){

                    $mtuha_data['opd_diagnoses'][$disease]['below_sixty_year_m'] = !empty($mtuha_data['opd_diagnoses'][$disease]['below_sixty_year_m'])
                                                                                    ?$mtuha_data['opd_diagnoses'][$disease]['below_sixty_year_m']+1:1;
                    $mtuha_data['opd_diagnoses'][$disease]['total_m'] = !empty($mtuha_data['opd_diagnoses'][$disease]['total_m'])
                                                                        ?$mtuha_data['opd_diagnoses'][$disease]['total_m']+1:1;
                }
            }

            if($item->patient->gender == 'Female'  && $item->patient->age > 60) {
                $mtuha_data['opd_visit']['above_sixty_year_f'] = $mtuha_data['opd_visit']['above_sixty_year_f']+1;
                $mtuha_data['opd_visit']['total_f'] = $mtuha_data['opd_visit']['total_f']+1;

                if($item->total == 1 ){
                    $mtuha_data['opd_first_visit']['above_sixty_year_f'] = $mtuha_data['opd_first_visit']['above_sixty_year_f']+1;
                    $mtuha_data['opd_first_visit']['total_f'] = $mtuha_data['opd_first_visit']['total_f']+1;
                }

                if($item->total > 1 ){
                    $mtuha_data['opd_repeated_visit']['above_sixty_year_f'] = $mtuha_data['opd_repeated_visit']['above_sixty_year_f']+1;
                    $mtuha_data['opd_repeated_visit']['total_f'] = $mtuha_data['opd_repeated_visit']['total_f']+1;
                }

                foreach (Arr::flatten($this->getPatientDiseases($report, $item->patient_id)) as $disease){

                    $mtuha_data['opd_diagnoses'][$disease]['above_sixty_year_f'] = !empty($mtuha_data['opd_diagnoses'][$disease]['above_sixty_year_f'])
                                                                                    ?$mtuha_data['opd_diagnoses'][$disease]['below_sixty_year_f']+1:1;
                    $mtuha_data['opd_diagnoses'][$disease]['total_f'] = !empty($mtuha_data['opd_diagnoses'][$disease]['total_f'])
                                                                        ?$mtuha_data['opd_diagnoses'][$disease]['total_f']+1:1;
                }
            }

            if($item->patient->gender == 'Male'  && $item->patient->age > 60) {
                $mtuha_data['opd_visit']['above_sixty_year_m'] = $mtuha_data['opd_visit']['above_sixty_year_m']+1;
                $mtuha_data['opd_visit']['total_m'] = $mtuha_data['opd_visit']['total_m']+1;

                if($item->total == 1 ){
                    $mtuha_data['opd_first_visit']['above_sixty_year_m'] = $mtuha_data['opd_first_visit']['above_sixty_year_m']+1;
                    $mtuha_data['opd_first_visit']['total_m'] = $mtuha_data['opd_first_visit']['total_m']+1;
                }

                if($item->total > 1 ){
                    $mtuha_data['opd_repeated_visit']['above_sixty_year_m'] = $mtuha_data['opd_repeated_visit']['above_sixty_year_m']+1;
                    $mtuha_data['opd_repeated_visit']['total_m'] = $mtuha_data['opd_repeated_visit']['total_m']+1;
                }

                foreach (Arr::flatten($this->getPatientDiseases($report, $item->patient_id)) as $disease){

                    $mtuha_data['opd_diagnoses'][$disease]['above_sixty_year_m'] = !empty($mtuha_data['opd_diagnoses'][$disease]['above_sixty_year_m'])
                                                                                    ?$mtuha_data['opd_diagnoses'][$disease]['above_sixty_year_m']+1:1;
                    $mtuha_data['opd_diagnoses'][$disease]['total_m'] = !empty($mtuha_data['opd_diagnoses'][$disease]['total_m'])
                                                                        ?$mtuha_data['opd_diagnoses'][$disease]['total_m']+1:1;
                }
            }
        });

//        dd($mtuha_data);
        $pdf = PDF::loadView('templates.mtuha',
            ['data' => $mtuha_data
            , 'qrcode' => QrCode::size(400)->color(0,0,0)->generate('omakei')])
            ->setPaper('a4','landscape');

        return $pdf->stream('bill-'. Str::uuid().'.pdf');
    }

    private function getPatientDiseases(Report $report, $patient_id)
    {
//        ->whereBetween('created_at', [$report->from, $report->to])
        $visits = PatientVisit::where(['patient_id' => $patient_id])->get();
        $data = [];
//            return collect(['cholera']);
        return $visits->map(function ($item){
          return $item->diagnoses->map(function ($diagnose) use(&$data){
              if($diagnose->type == 'Confirmed'){
                  $data[] = $diagnose->i_c_d10_code->description;
              }
                return $data;
              });
        })->toArray();
    }
}
