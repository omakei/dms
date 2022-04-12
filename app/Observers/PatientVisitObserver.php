<?php

namespace App\Observers;

use App\Models\Bill;
use App\Models\BillItem;
use App\Models\PatientVisit;

class PatientVisitObserver
{
    /**
     * Handle the PatientVisit "created" event.
     *
     * @param  \App\Models\PatientVisit  $patientVisit
     * @return void
     */
    public function created(PatientVisit $patientVisit)
    {
        $bill = Bill::create([
            'patient_id' => $patientVisit->patient_id,
            'patient_visit_id' => $patientVisit->id,
            'bill_number' => 'BILL-'.now()->year.'-'. $patientVisit->id.'-'. $patientVisit->patient_id.'-'. rand(111,999),
            'payment_status' => 'Pending'
        ]);

        BillItem::create([
            'bill_id' => $bill->id,
            'billable_id' => $patientVisit->visit_type_id,
            'billable_type' => get_class($patientVisit->visit_type)
        ]);
    }

    /**
     * Handle the PatientVisit "updated" event.
     *
     * @param  \App\Models\PatientVisit  $patientVisit
     * @return void
     */
    public function updated(PatientVisit $patientVisit)
    {
        //
    }

    /**
     * Handle the PatientVisit "deleted" event.
     *
     * @param  \App\Models\PatientVisit  $patientVisit
     * @return void
     */
    public function deleted(PatientVisit $patientVisit)
    {
        //
    }

    /**
     * Handle the PatientVisit "restored" event.
     *
     * @param  \App\Models\PatientVisit  $patientVisit
     * @return void
     */
    public function restored(PatientVisit $patientVisit)
    {
        //
    }

    /**
     * Handle the PatientVisit "force deleted" event.
     *
     * @param  \App\Models\PatientVisit  $patientVisit
     * @return void
     */
    public function forceDeleted(PatientVisit $patientVisit)
    {
        //
    }
}
