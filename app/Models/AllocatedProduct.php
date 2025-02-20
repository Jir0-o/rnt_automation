<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AllocatedProduct extends Model
{
    use HasFactory;
    protected $fillable = [
        'allocation_id',
        'requisition_id',
        'contract_id',
        'rni_no',
        'from_where',
        'to_send',
        'product_id',
        'quantity',
        'unit_price',
        'total_price',
        'product_condition_id',
        'product_identification_no',
        'reverted',
        'is_active',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function allocation()
    {
        return $this->belongsTo(Allocation::class);
    }

    public function requisition()
    {
        return $this->belongsTo(Requisition::class);
    }




}
