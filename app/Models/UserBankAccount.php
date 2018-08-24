<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserBankAccount extends Model
{
    protected $table = "user_bank_accounts";

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function withdrawal_method()
    {
        return $this->hasOne(WithdrawalMethod::class, 'id', 'withdrawal_method_id');
    }


}
