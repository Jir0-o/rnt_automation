<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCommittee extends Model
{
    use HasFactory;

    protected $fillable = [
        'quantity',
        'unit_price',
        'total_price',
        'product_id',
        'demand_committee_id',
        'tech_committee_id',
        'requisition_id',
        'committee_id',
        'sub_catagory_id',
        'status',
        'note',
        'is_active',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function committee()
    {
        return $this->belongsTo(Committee::class);
    }

    public function subCategory()
    {
        return $this->belongsTo(ProductSubCategory::class, 'sub_catagory_id');
    }

    public function techCommitteeUser()
    {
        return $this->belongsTo(User::class, 'tech_committee_id');
    }
    public function demandCommitteeUser()
    {
        return $this->belongsTo(User::class, 'demand_committee_id');
    }
    public function requisition()
    {
        return $this->belongsTo(Requisition::class, 'requisition_id');
    }
    public function committeeName()
    {
        return $this->belongsTo(Committee::class, 'demand_committee_id');
    }

    public function committeeTechName()
    {
        return $this->belongsTo(Committee::class, 'tech_committee_id');
    }
}
