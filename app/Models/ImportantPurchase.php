<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImportantPurchase extends Model
{
    use HasFactory;

    protected $fillable = [
        'requisition_id',
        'product_id',
        'quantity',
        'user_id',
        'spec',
        'status',
        'isActive',
    ];

    // Define relationships if applicable

    public function requisition() {
        return $this->belongsTo(Requisition::class, 'requisition_id');
    }

    public function product() {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }
}
