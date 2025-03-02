<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DailyCost extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'date',
        'cost_type',
        'description',
        'amount',
        'tnx_type',
    ];
}
