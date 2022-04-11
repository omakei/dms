<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
}
