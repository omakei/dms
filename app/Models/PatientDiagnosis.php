<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PatientDiagnosis extends Model
{
    use HasFactory;

    public function i_c_d10_code(): BelongsTo
    {
        return $this->belongsTo(ICD10Code::class);
    }
}
