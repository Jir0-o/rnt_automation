<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'profile_photo_path',
        'designation_id',
        'department_id',
        'store_id',
        'auth_by',
        'signature',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];

    public function userhasRole()
    {
        return $this->hasMany(ModelHasRole::class, 'model_id');
    }

    public function designation()
    {
        return $this->belongsTo(Designation::class);
    }

    public function store()
    {
        return $this->belongsTo(StoreInformation::class);
    }

    public function requisitions()
    {
        return $this->hasMany(Requisition::class);
    }

    public function allocations()
    {
        return $this->hasMany(Allocation::class);
    }
    public function techCommittees()
    {
        return $this->hasMany(ProductCommittee::class, 'tech_committee_id');
    }

    public function purchaseCommittees()
    {
        return $this->hasMany(ProductCommittee::class, 'purchase_committee_id');
    }

    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id');
    }

    public function userDraft(){

        return $this->hasMany(Draft::class, 'user_id');
    }

    public function fromNotification()
    {
        return $this->hasMany(Notification::class, 'from_user_id');
    }

    public function toNotification()
    {
        return $this->hasMany(Notification::class, 'to_user_id');
    }

    public function secretaryCommittees()
    {
        return $this->hasMany(Committee::class,  'secretary', 'id');
    }

    public function chairmanCommittees()
    {
        return $this->hasMany(Committee::class, 'chairman_id', 'id');
    }

    public function headUser()
    {
        return $this->hasMany(Department::class, 'head_id', 'id');
    }

    public function secretaryFileCommittees()
    {
        return $this->hasMany(FileCommittee::class, 'secretary', 'id');
    }

    public function chairmanFileCommittees()
    {
        return $this->hasMany(FileCommittee::class, 'chairman', 'id');
    }

    public function secretaryDefaultCommittees()
    {
        return $this->hasMany(DefaultCommittee::class, 'secretary', 'id');
    }

    public function chairmanDefaultCommittees()
    {
        return $this->hasMany(DefaultCommittee::class, 'chairman', 'id');
    }

    public function order()
    {
        return $this->hasMany(Order::class);
    }
}
