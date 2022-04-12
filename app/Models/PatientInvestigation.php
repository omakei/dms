<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PatientInvestigation extends Model
{
    use HasFactory;

    public function laboratory_test(): BelongsTo
    {
        return $this->belongsTo(LaboratoryTest::class);
    }

    public function publisher(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
