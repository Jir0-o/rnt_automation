<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InitiatorNote extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'initiator_file_id',
        'initiator_id',
        'note',
        'date',
        'is_closing_note',
        'status',
        'vc_note',
        'reviewer_note',
        'is_receiving',
    ];

    public function initiatorFile()
    {
        return $this->belongsTo(InitiatorFile::class, 'initiator_file_id');
    }

    public function initiator()
    {
        return $this->belongsTo(User::class, 'initiator_id');
    }

    public function attachments()
    {
        return $this->hasMany(InitiatorNoteAttachment::class, 'initiator_note_id');
    }

    public function reviews()
    {
        return $this->hasMany(InitiatorNoteReview::class, 'initiator_note_id');
    }
}
