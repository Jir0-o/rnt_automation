<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequisitionSignature extends Model
{
    use HasFactory;

    protected $fillable = [
        'requisition_id',
        'signature',
        'date',
        'name',
        'designation',
        'department',
        'status',
    ];

    public function requisition()
    {
        return $this->belongsTo(Requisition::class);
    }
}
