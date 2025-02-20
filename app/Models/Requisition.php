<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Requisition extends Model
{
    use HasFactory;

    protected $fillable = [
        'requisition_snd',
        'requisition_type_id',
        'requisition_date',
        'requisition_no',
        'buyer_name',
        'address',
        'sr_no',
        'requisition_type',
        'company_id',
        'invoice_no',
        'order_no',
        'invoice_date',
        'user_id',
        'status',
        'auth',
        'alloc',
        'remarks',
        'cc',
        'is_active',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function requisitionProducts()
    {
        return $this->hasMany(RequisitionProduct::class);
    }

    public function allocations()
    {
        return $this->hasMany(Allocation::class);
    }

    public function issueVouchers()
    {
        return $this->hasMany(IssueVoucher::class);
    }

    public function requisitionAttachments()
    {
        return $this->hasMany(RequisitionAttachment::class);
    }

    public function requisitionTypes()
    {
        return $this->belongsTo(RequisitionType::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }

    public function importantPurchases()
    {
        return $this->hasMany(ImportantPurchase::class);
    }

    public function requisitionSignatures()
    {
        return $this->hasMany(RequisitionSignature::class);
    }

    public function missingRequisitions()
    {
        return $this->hasMany(MissingRequisition::class);
    }
}
