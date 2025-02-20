<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Committee extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'secretary',
        'chairman_id',
        'reference_no',
        'requisition_id',
        'committee_type',
        'is_dpm',
        'status',
        'is_active',
        'chairman_note',
        'vc_note',
    ];

    public function secretaryCommittee()
    {
        return $this->belongsTo(User::class, 'secretary', 'id');
    }

    public function chairman()
    {
        return $this->belongsTo(User::class, 'chairman_id');
    }

    public function requisition()
    {
        return $this->belongsTo(Requisition::class);
    }

    public function productCommittees()
    {
        return $this->hasMany(ProductCommittee::class, 'requisition_id', 'requisition_id');
    }

    public function initiatorFiles()
    {
        return $this->hasMany(InitiatorFile::class, 'oce_dpm');
    }
            public function secretaryUser()
    {
        return $this->belongsTo(User::class, 'secretary');
    }

    public function chairmanUser()
    {
        return $this->belongsTo(User::class, 'chairman_id');
    }
}