<?php

namespace App\Models;

use App\Models\Product;
use App\Models\UnitType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LeisureAccept extends Model
{
    use HasFactory;

    protected $table = 'leisure_accept';

    protected $fillable = [
        'date',
        'bill_no',
        'purchase_from',
        'store_id',
        'requisition_no',
        'details',
        'product_id',
        'quantity',
        'unit',
        'price',
        'amount',
        'discussion',
        'status',
        'isActive',
    ];


    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
    public function unitType()
{
    return $this->belongsTo(UnitType::class, 'unit');
}
}
