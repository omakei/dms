<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class VisitType extends Model
{
    use HasFactory;


    public function bill_items(): MorphMany
    {
        return $this->morphMany(BillItem::class, 'billable');
    }
}
