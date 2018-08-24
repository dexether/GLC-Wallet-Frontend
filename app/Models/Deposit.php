<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Deposit extends Model
{
    protected $table = "deposits";

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function deposit_method()
    {
        return $this->hasOne(PaymentGateway::class, 'id', 'deposit_method_id');
    }

    public function trade_currency()
    {
        return $this->hasOne(TradeCurrency::class, 'id', 'trade_currency_id');
    }

    public function bank_account()
    {
        return $this->hasOne(UserBankAccount::class, 'id', 'user_bank_account_id');
    }
}
