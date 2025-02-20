<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'text',
        'from_user_id',
        'to_user_id',
        'is_active',
        'link',
    ];

    public function fromUserNotification()
    {
        return $this->belongsTo(User::class, 'from_user_id');
    }

    public function toUserNotification()
    {
        return $this->belongsTo(User::class, 'to_user_id');
    }
}