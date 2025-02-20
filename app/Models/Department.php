<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'code', 'head_id'];

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function initiatorNoteReviews()
    {
        return $this->hasMany(InitiatorNoteReview::class, 'department');
    }

    public function head()
    {
        return $this->belongsTo(User::class, 'head_id');
    }
}
