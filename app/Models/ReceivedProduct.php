<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReceivedProduct extends Model
{
    use HasFactory;

    protected $table = 'received_products';

    protected $fillable = [
        'Received_id',
        'contract_id',
        'rni_no',
        'product_id',
        'unit_price',
        'total_price',
        'unit_type',
        'quantity',
        'recieved_store',
        'product_condition_id',
        'is_active',
    ];

    public function recieveInformation()
    {
        return $this->belongsTo(RecievedInformation::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
