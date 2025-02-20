<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupplyOrderInformation extends Model
{
    use HasFactory;

    protected $fillable = [
        'proc_id',
        'so_no',
        'so_date',
    ];
}
