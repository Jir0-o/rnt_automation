<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InitiatorNoteAttachment extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'initiator_note_id',
        'files',
    ];

    public function initiatorNote()
    {
        return $this->belongsTo(InitiatorNote::class, 'initiator_note_id');
    }
}