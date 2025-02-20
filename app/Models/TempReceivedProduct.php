<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TempReceivedProduct extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'product_id',
        'unit_price',
        'total_price',
        'unit_type',
        'spec',
        'quantity',
        'recieved_store',
        'product_condition_id',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function recieveInformation()
    {
        return $this->belongsTo(RecievedInformation::class);
    }
}
