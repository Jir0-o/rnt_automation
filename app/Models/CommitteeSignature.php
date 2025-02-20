<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommitteeSignature extends Model
{
    use HasFactory;
    protected $fillable = [
        'secretary',
        'chairman',
        'requisition_id',
        'vc',
        'secretary_name',
        'secretary_designation',
        'secretary_date',
        'chairman_name',
        'chairman_designation',
        'chairman_date',
        'vc_name',
        'vc_designation',
        'vc_date',
        'committee_type',
        'is_active'
    ];
}
