<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupplierInformation extends Model
{
    use HasFactory;

    protected $fillable = [
        'supplier_name',
        'supplier_address',
    ];
}
