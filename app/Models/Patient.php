<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Carbon;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Patient extends Model
{
    use HasFactory,LogsActivity;

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logUnguarded()
            ->logOnlyDirty();
    }

    public function fullName(): Attribute
    {
        return Attribute::make(
            get: fn ($value, $attributes) => $attributes['first_name'].' '. $attributes['middle_name'].' '. $attributes['last_name']
        );
    }

    public  function Age(): Attribute
    {
        return Attribute::make(
            get: fn ($value, $attributes) => Carbon::make($attributes['dob'])->diffInYears(Carbon::now())
        );
    }


    public function bill(): HasOne
    {
        return $this->hasOne(Bill::class);
    }

    public function vital_signs(): HasManyThrough
    {
        return $this->hasManyThrough(VitalSign::class, PatientVisit::class,'patient_id', 'patient_visit_id');
    }

    public function medical_histories(): HasManyThrough
    {
        return $this->hasManyThrough(PatientMedicalHistory::class, PatientVisit::class,'patient_id', 'patient_visit_id');
    }

    public function complaint_histories(): HasManyThrough
    {
        return $this->hasManyThrough(PatientComplaintHistory::class, PatientVisit::class,'patient_id', 'patient_visit_id');
    }

    public function birth_histories(): HasManyThrough
    {
        return $this->hasManyThrough(PatientBirthHistory::class, PatientVisit::class,'patient_id', 'patient_visit_id');
    }

    public function social_histories(): HasManyThrough
    {
        return $this->hasManyThrough(PatientSocialHistory::class, PatientVisit::class,'patient_id', 'patient_visit_id');
    }

    public function gynaecological_histories(): HasManyThrough
    {
        return $this->hasManyThrough(PatientGynaecologicalHistory::class, PatientVisit::class,'patient_id', 'patient_visit_id');
    }

    public function system_review_histories(): HasManyThrough
    {
        return $this->hasManyThrough(PatientSystemReviewHistory::class, PatientVisit::class,'patient_id', 'patient_visit_id');
    }

    public function diagnoses(): HasManyThrough
    {
        return $this->hasManyThrough(PatientDiagnosis::class, PatientVisit::class,'patient_id', 'patient_visit_id');
    }

    public function investigations(): HasManyThrough
    {
        return $this->hasManyThrough(PatientInvestigation::class, PatientVisit::class,'patient_id', 'patient_visit_id');
    }

    public function prescriptions(): HasManyThrough
    {
        return $this->hasManyThrough(PatientPrescription::class, PatientVisit::class,'patient_id', 'patient_visit_id');
    }

    public function referrals(): HasManyThrough
    {
        return $this->hasManyThrough(PatientReferral::class, PatientVisit::class,'patient_id', 'patient_visit_id');
    }
}
