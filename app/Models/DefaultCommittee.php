<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DefaultCommittee extends Model
{
    use HasFactory;
        protected $fillable = [
        'name',
        'type',
        'secretary',
        'chairman',
        'approver',
        'created_at',
        'updated_at'
    ];

    public function secretaryUser()
    {
        return $this->belongsTo(User::class, 'secretary');
    }

    public function chairmanUser()
    {
        return $this->belongsTo(User::class, 'chairman');
    }
}