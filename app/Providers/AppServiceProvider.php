<?php

namespace App\Providers;

use App\Models\PatientVisit;
use App\Models\VitalSign;
use Filament\Facades\Filament;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Model::unguard();
        Filament::serving(function () {
            Filament::registerTheme(mix('css/app.css'));
        });



        VitalSign::creating(function ($vital_sign) {
            $vital_sign->bmi = $vital_sign->weight/($vital_sign->height* $vital_sign->height);
            $vital_sign->patient_id = (PatientVisit::find($vital_sign->patient_visit_id))->id;
        });

    }
}
