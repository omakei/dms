<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class PatientVisit extends Model
{
    use HasFactory;


    public function patient(): BelongsTo
    {
        return $this->belongsTo(Patient::class);
    }

    public function attendant(): BelongsTo
    {
        return $this->belongsTo(Attendant::class);
    }

    public function visit_type(): BelongsTo
    {
        return $this->belongsTo(VisitType::class);
    }

    public function bill(): HasOne
    {
        return $this->hasOne(Bill::class);
    }

    public function vital_signs(): HasMany
    {
        return $this->hasMany(VitalSign::class);
    }

    public function medical_histories(): HasMany
    {
        return $this->hasMany(PatientMedicalHistory::class);
    }

    public function complaint_histories(): HasMany
    {
        return $this->hasMany(PatientComplaintHistory::class);
    }

    public function birth_histories(): HasMany
    {
        return $this->hasMany(PatientBirthHistory::class);
    }

    public function social_histories(): HasMany
    {
        return $this->hasMany(PatientSocialHistory::class);
    }

    public function gynaecological_histories(): HasMany
    {
        return $this->hasMany(PatientGynaecologicalHistory::class);
    }

    public function system_review_histories(): HasMany
    {
        return $this->hasMany(PatientSystemReviewHistory::class);
    }

    public function diagnoses(): HasMany
    {
        return $this->hasMany(PatientDiagnosis::class);
    }

    public function investigations(): HasMany
    {
        return $this->hasMany(PatientInvestigation::class);
    }
}
