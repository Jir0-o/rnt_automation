<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TempRequisitionProduct extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'quantity',
        'price',
        'spec',
        'total',
        'user_id',
        'unit_type',
        'unit_package_size',
        'unit_price',
        'remarks',
        'is_active',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function unitType()
    {
        return $this->belongsTo(UnitType::class,'unit_type' );
    }
}
