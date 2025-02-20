<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InitiatorNoteReview extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'initiator_note_id',
        'reviewer_id',
        'comment',
        'date',
        'signature',
        'designation',
        'department',
        'signature_order',
    ];

    public function initiatorNote()
    {
        return $this->belongsTo(InitiatorNote::class, 'initiator_note_id');
    }

    public function reviewer()
    {
        return $this->belongsTo(User::class, 'reviewer_id');
    }

    public function department()
    {
        return $this->belongsTo(Department::class, 'department');
    }

    public function designation()
    {
        return $this->belongsTo(Designation::class, 'designation');
    }
}
