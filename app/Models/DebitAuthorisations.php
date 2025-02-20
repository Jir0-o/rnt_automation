<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DebitAuthorisations extends Model
{
    use HasFactory;
    protected $fillable = [
        'requisition_no	',
        'date' ,
        'store_name',
        'store_address',
        'bill_no',
        'bill_date' ,
        'product_name' ,
        'amount' ,
        'in_word' ,
        'budget_year',
        'work_name',
        'work_code' ,
        'note_no' ,
        'file_id' ,
        'status',
        'approver_id',
        'decision',
        'brcode_no',
        'is_active',
        'created_at',
        'updated_at'
    ];
}
