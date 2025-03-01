<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequisitionProduct extends Model
{
    use HasFactory;

    protected $fillable = [
        'requisition_id',
        'product_id',
        'spec',
        'allocated_quantity',
        'quantity',
        'unit_type',
        'unit_price',
        'unit_package_size',
        'remarks',
    ]; 

    public function requisition()
    {
        return $this->belongsTo(Requisition::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    public function unitType()
    {
        return $this->belongsTo(UnitType::class,'unit_type');
    }
}