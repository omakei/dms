<?php

namespace App\Observers;

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
        //
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
