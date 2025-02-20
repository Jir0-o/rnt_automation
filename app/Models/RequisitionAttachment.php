<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequisitionAttachment extends Model
{
    use HasFactory;

    protected $fillable = [
        'requisition_id',
        'filename',
        'extension',
        'file',
        'upload_date',
        'is_active',
    ];

    public function requisition()
    {
        return $this->belongsTo(Requisition::class);
    }
}
