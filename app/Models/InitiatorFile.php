<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InitiatorFile extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'file_name',
        'file_number',
        'file_catagory',
        'department',
        'opening_date',
        'oce_dpm',
        'approver',
        'initiator_id',
        'reviewer',
        'committee_member',
        'is_forword',
        'review_status',
        'status',
        'is_complete',
        'tracker',
        'sent_to',
        'who_sent',
        'note',
        'receiving_committee_member',
        'is_receiving_committee',
        'requisition_id'
    ];

    public function oceDpm()
    {
        return $this->belongsTo(Committee::class, 'oce_dpm');
    }
    public function users()
    {
        return $this->belongsTo(User::class, 'initiator_id');
    }

    public function fileCommittees()
    {
        return $this->hasMany(FileCommittee::class);
    }

    public function initiatorNotes()
    {
        return $this->hasMany(InitiatorNote::class, 'initiator_file_id');
    }
    public function initiator()
    {
        return $this->belongsTo(User::class, 'initiator_id');
    }

    public function fileDraft()
    {
        return $this->hasMany(Draft::class, 'file_id');
    }

    public function tracker()
    {
        return $this->hasMany(User::class, 'tracker');
    }
}
