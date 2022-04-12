<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class VitalSign extends Model
{
    use HasFactory;

    public function patient_visit(): BelongsTo
    {
        return $this->belongsTo(PatientVisit::class);
    }

    public function patient(): BelongsTo
    {
        return $this->belongsTo(Patient::class);
    }
}
