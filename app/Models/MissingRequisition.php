<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MissingRequisition extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_name',
        'quantity',
        'spec',
        'note',
        'unit_type',
        'requisition_id',
    ];

    public function requisition()
    {
        return $this->belongsTo(Requisition::class);
    }

    public function unit()
    {
        return $this->belongsTo(UnitType::class, 'unit_type');
    }
}
