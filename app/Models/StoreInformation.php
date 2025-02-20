<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StoreInformation extends Model
{
    use HasFactory;

    protected $fillable = [
        'store_name',
        'store_location',
        'store_contact',
        'store_type_id',
        'circle_id',
        'zone_id',
        'parent_office',
        'office_type',
    ];
}
