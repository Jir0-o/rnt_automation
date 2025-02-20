<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Allocation extends Model
{
    use HasFactory;
    protected $fillable = [
        'allocation_date',
        'allocation_no',
        'subject',
        'validity_date',
        'validity_days',
        'requisition_id',
        'auth_level',
        'is_issue',
        'remarks',
        'cc',
        'user_id',
        'reverted',
        'is_active',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function requisition()
    {
        return $this->belongsTo(Requisition::class);
    }

    public function allocatedProducts()
    {
        return $this->hasMany(AllocatedProduct::class);
    }

    public function issueVouchers()
    {
        return $this->hasMany(IssueVoucher::class);
    }

}
