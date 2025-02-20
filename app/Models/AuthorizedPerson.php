<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AuthorizedPerson extends Model
{
    use HasFactory;
    protected $fillable = [
        'allocation_id',
        'warehouse_id',
        'authorized_person',
        'ap_id_no',
        'ap_designation',
        'ap_date',
        'user_id',
        'is_active',
    ];
}
