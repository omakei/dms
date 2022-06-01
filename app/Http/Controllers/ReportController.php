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
        $below_one_month_f = 0;
        $below_one_month_m = 0;
        $below_one_year_f = 0;
        $below_one_year_m = 0;
        $below_five_year_f = 0;
        $below_five_year_m = 0;
        $below_sixty_year_f = 0;
        $below_sixty_year_m = 0;
        $above_sixty_year_f = 0;
        $above_sixty_year_m = 0;

        $opd = PatientVisit::all();

        $opd->map(function ($item) use(
            &$below_one_month_f,
            &$below_one_month_m,
            &$below_one_year_f,
            &$below_one_year_m,
            &$below_five_year_f,
            &$below_five_year_m,
            &$below_sixty_year_f,
            &$below_sixty_year_m,
            &$above_sixty_year_f,
            &$above_sixty_year_m,
        ) {

            if($item->patient->gender == 'Female'  && $item->patient->age < 1) {
                $below_one_month_f= $below_one_month_f+1;
            }

            if($item->patient->gender == 'Male'  && $item->patient->age < 1) {
                $below_one_month_m= $below_one_month_m+1;
            }

            if($item->patient->gender == 'Female'  && $item->patient->age < 1) {
                $below_one_year_f= $below_one_year_f+1;
            }

            if($item->patient->gender == 'Male'  && $item->patient->age < 1) {
                $below_one_year_m = $below_one_year_m+1;
            }

            if($item->patient->gender == 'Female'  && ($item->patient->age > 1 && $item->patient->age < 5)) {
                $below_five_year_f= $below_five_year_f+1;
            }

            if($item->patient->gender == 'Male'  && ($item->patient->age > 1 && $item->patient->age < 5)) {
                $below_five_year_m = $below_five_year_m+1;
            }

            if($item->patient->gender == 'Female'  && ($item->patient->age > 5 && $item->patient->age < 60)) {
                $below_sixty_year_f= $below_sixty_year_f+1;

            }

            if($item->patient->gender == 'Male'  && ($item->patient->age > 5 && $item->patient->age < 60)) {
                $below_sixty_year_m = $below_sixty_year_m+1;
            }

            if($item->patient->gender == 'Female'  && $item->patient->age > 60) {
                $above_sixty_year_f= $above_sixty_year_f+1;
            }

            if($item->patient->gender == 'Male'  && $item->patient->age > 60) {
                $above_sixty_year_m = $above_sixty_year_m+1;
            }
        });

//        dd($below_sixty_year_f);
        $pdf = PDF::loadView('templates.mtuha',
            ['data' => [
                'one_month' => [
                    'ke' =>  $below_one_month_f,
                    'me' => $below_one_month_m,
                    'total' => $below_one_month_f+$below_one_month_m
                ],
                'one_year' => [
                    'ke' =>  $below_one_year_f,
                    'me' => $below_one_year_m,
                    'total' => $below_one_year_f+$below_one_year_m
                ],
                'five_year' => [
                    'ke' =>  $below_five_year_f,
                    'me' => $below_five_year_m,
                    'total' => $below_five_year_f+$below_five_year_m
                ],
                'sixty_year' => [
                    'ke' =>  $below_sixty_year_f,
                    'me' => $below_sixty_year_m,
                    'total' => $below_sixty_year_f+$below_sixty_year_m
                ],
                'above_sixty_year' => [
                    'ke' =>  $above_sixty_year_f,
                    'me' => $above_sixty_year_f,
                    'total' => $above_sixty_year_f+$above_sixty_year_f
                ],
                'total' => [
                    'ke' => $below_one_month_f+$below_one_year_f+ $below_five_year_f+$below_sixty_year_f+$above_sixty_year_f,
                    'me' => $below_one_month_m+$below_one_year_m+$below_five_year_m+$below_sixty_year_m+$above_sixty_year_m,
                    'total' =>    $below_one_month_f+
                    $below_one_month_m+$below_one_year_f+$below_one_year_m+$below_five_year_f+$below_five_year_m+$below_sixty_year_f+$below_sixty_year_m+$above_sixty_year_f+$above_sixty_year_m
                ],
                'from' => $report->from,
                'to' => $report->to,
              ]
            , 'qrcode' => QrCode::size(400)->color(0,0,0)->generate('omakei')])
            ->setPaper('a4','landscape');

        return $pdf->stream('bill-'. Str::uuid().'.pdf');
    }
}
