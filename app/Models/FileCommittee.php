<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FileCommittee extends Model
{
    use HasFactory;
    protected $fillable = [
        'committee_name',
        'secretary',
        'chairman',
        'initiator_file_id',
        'initiator_id',
        'is_active',
    ];

    // Relationship with User for Secretary
    public function secretaryFileCommittees()
    {
        return $this->belongsTo(User::class, 'secretary', 'id');
    }

    // Relationship with User for Chairman
    public function chairmanFileCommittees()
    {
        return $this->belongsTo(User::class, 'chairman', 'id');
    }

    public function initiatorFile()
    {
        return $this->belongsTo(InitiatorFile::class);
    }

    public function initiator()
    {
        return $this->belongsTo(User::class, 'initiator_id');
    }
}
