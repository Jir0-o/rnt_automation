<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StoreProductFinal extends Model
{
    use HasFactory;

    protected $fillable = [
        'contract_id',
        'rni_no',
        'store_id',
        'product_id',
        'final_qty',
        'temp_qty',
        'unit_price',
        'total_price',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
