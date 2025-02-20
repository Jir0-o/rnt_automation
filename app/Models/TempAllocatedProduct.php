<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TempAllocatedProduct extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'requisition_id',
        'contract_id',
        'rni_no',
        'from_wh',
        'to_snd',
        'product_id',
        'quantity',
        'spec',
        'unit_price',
        'total_price',
        'product_condition_id',
        'product_identification_no',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function requisition()
    {
        return $this->belongsTo(Requisition::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
