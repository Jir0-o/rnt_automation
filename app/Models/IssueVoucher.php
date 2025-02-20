<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IssueVoucher extends Model
{
    use HasFactory;
    protected $fillable = [
        'auth_id',
        'issue_no',
        'issue_date',
        'issue_by_where',
        'vehicle',
        'allocation_id',
        'user_id',
        'status',
        'auth',
        'remarks',
        'is_active',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function allocation()
    {
        return $this->belongsTo(Allocation::class);
    }
}
