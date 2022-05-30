<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use App\Models\Patient;
use App\Models\PatientInvestigation;
use App\Models\PatientPrescription;
use App\Models\PatientReferral;
use App\Models\PatientVisit;
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

        if($patient->insurance_type == 'NSSF') {

            $pdf = PDF::loadView('templates.mtuha',
                ['data' => PatientVisit::find($bill->patient_visit_id), 'bill' => $bill, 'qrcode' => QrCode::size(400)->color(0,0,0)->generate('omakei')])
                ->setPaper('a4','landscape');

            return $pdf->stream('claim-'. Str::uuid().'.pdf');
        }

        $pdf = PDF::loadView('templates.bill',
            ['data' => PatientVisit::find($bill->patient_visit_id), 'bill' => $bill, 'qrcode' => QrCode::size(400)->color(0,0,0)->generate('omakei')])
            ->setPaper('a4','landscape');

        return $pdf->stream('bill-'. Str::uuid().'.pdf');
    }

    public  function mtuha(PatientPrescription $prescription)
    {

        $pdf = PDF::loadView('templates.bill',
            ['data' => [], 'qrcode' => QrCode::size(400)->color(0,0,0)->generate('omakei')])
            ->setPaper('a4','landscape');

        return $pdf->stream('bill-'. Str::uuid().'.pdf');
    }
}
