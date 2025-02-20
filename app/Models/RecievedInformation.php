<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecievedInformation extends Model
{
    use HasFactory;

    protected $table = 'received_informations';

    protected $fillable = [
        'contract_id',
        'rni_no',
        'recieve_date',
        'recieved_by',
        'auth',
        'receive_no',
        'status',
        'comments',
        'cc',
        'user_id',
        'is_active',
        'bill_no',
        'purchase_from',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function receivedProducts()
    {
        return $this->hasMany(ReceivedProduct::class);
    }
}
