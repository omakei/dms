<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class BillItem extends Model
{
    use HasFactory;

    public function billable(): MorphTo
    {
        return $this->morphTo();
    }
}
