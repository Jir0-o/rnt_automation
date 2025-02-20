<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Designation extends Model
{
    use HasFactory;
    protected $fillable = [
        'designation',
        'short',
        'priority_level',
        'allocation_auth_level',
        'iv_auth_level',
        'rni_auth_level',
        'is_active',
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function initiatorNoteReviews()
    {
        return $this->hasMany(InitiatorNoteReview::class, 'designation');
    }
}
