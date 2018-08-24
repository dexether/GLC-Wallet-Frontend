<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WalletAddress extends Model
{
    protected $table = "wallet_addresses";

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function trade_currency()
    {
        return $this->hasOne(TradeCurrency::class, 'id', 'trade_currency_id');
    }

    public function valuations()
    {
        return $this->hasMany(AssetValuation::class, 'asset_id', 'id')->orderBy('date', 'desc');
    }
}
