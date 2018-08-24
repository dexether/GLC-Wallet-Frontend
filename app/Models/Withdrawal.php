<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Withdrawal extends Model
{
    protected $table = "withdrawals";

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function withdrawal_method()
    {
        return $this->hasOne(WithdrawalMethod::class, 'id', 'withdrawal_method_id');
    }
    public function bank_account()
    {
        return $this->hasOne(UserBankAccount::class, 'id', 'user_bank_account_id');
    }
    public function trade_currency()
    {
        return $this->hasOne(TradeCurrency::class, 'id', 'trade_currency_id');
    }


}
