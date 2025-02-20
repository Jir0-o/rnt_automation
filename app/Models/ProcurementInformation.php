<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProcurementInformation extends Model
{
    use HasFactory;
    protected $fillable = [
        'tender_number',
        'tender_date',
        'tender_winner',
        'supplier_address',
        'is_active',
    ];
}
