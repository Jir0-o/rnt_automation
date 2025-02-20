<?php

namespace App\Models;

use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LeisureDistribution extends Model
{
    use HasFactory;

    protected $table = 'leisure_distribution';

    protected $fillable = [
        'date',
        'requisition_no',
        'place',
        'product_id',
        'quantity',
        'total_quantity',
        'discussion',
        'status',
        'isActive',
        'store_signature_id',
        'officer_signature_id',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
