<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'address',
        'buyer_name',
        'description',
        'sr_no',
    ];

    public function requisitions()
    {
        return $this->hasMany(Requisition::class);
    }

    public function order()
    {
        return $this->hasMany(Order::class);
    }

}
