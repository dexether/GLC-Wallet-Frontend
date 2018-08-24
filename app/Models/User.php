<?php

namespace App\Models;

use Cartalyst\Sentinel\Users\EloquentUser;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends EloquentUser
{

    protected $fillable = [
        'email',
        'password',
        'last_name',
        'first_name',
        'name',
        'permissions',
        'address',
        'notes',
        'phone',
        'gender',
        'username',
        'dob',
        'country_id',
        'zip',
        'id_type',
        'id_number',
        'id_picture',
        'proof_of_residence_type',
        'proof_of_residence_picture',
        'email_verified',
        'phone_verified',
        'documents_verified',
        'subscribed',
        'blocked',
        'referral_id',
        'status',
        'wallet_address_limit',
        'default_balance',
        'bitcoin_balance',
        'litecoin_balance',
        'dodgecoin_balance',
        'otp',
        'city',
    ];

    public function country()
    {
        return $this->hasOne(Country::class, 'id', 'country_id');
    }

    public function deposits()
    {
        return $this->hasMany(Deposit::class, 'user_id', 'id');
    }

    public function withdrawals()
    {
        return $this->hasMany(Withdrawal::class, 'user_id', 'id');
    }

    public function orders()
    {
        return $this->hasMany(OrderBook::class, 'user_id', 'id');
    }

    public function bank_accounts()
    {
        return $this->hasMany(UserBankAccount::class, 'user_id', 'id');
    }
}
