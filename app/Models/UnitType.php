<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UnitType extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'symbol',
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function missingRequisitions()
    {
        return $this->hasMany(MissingRequisition::class, 'unit_type');
    }
    public function tempRequisitionProducts()
    {
        return $this->hasMany(TempRequisitionProduct::class, 'unit_type');
    }
    public function requisitionProducts()
    {
        return $this->hasMany(RequisitionProduct::class, 'unit_type');
    }
}
