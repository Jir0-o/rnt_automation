<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_name',
        'final_quantity',
        'temp_quantity',
        'unit_price',
        'total_price',
        'spec',
        'bar_code',
        'unit_type_id',
        'product_sub_categorie_id',
        'manufacturing_date',
        'unit_package_size',
        'expiry_date',
        'is_frac',
        'is_active',
        'purchase_from',
        'purchase_date',
        'bill_no',
        'requisition_no'
    ];

    public function unitType()
    {
        return $this->belongsTo(UnitType::class);
    }

    public function tempRequestedProducts()
    {
        return $this->hasMany(TempRequisitionProduct::class);
    }

    public function tempReceivedProducts()
    {
        return $this->hasMany(TempReceivedProduct::class);
    }

    public function allocatedProducts()
    {
        return $this->hasMany(AllocatedProduct::class);
    }

    public function tempAllocatedProducts()
    {
        return $this->hasMany(TempAllocatedProduct::class);
    }

    public function productSubCategory()
    {
        return $this->belongsTo(ProductSubCategory::class,'product_sub_categorie_id');
    }

    public function importantPurchases()
    {
        return $this->hasMany(ImportantPurchase::class);
    }

    public function order()
    {
        return $this->hasMany(Order::class);
    }
}
