<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderBook extends Model
{
    protected $table = "order_book";

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function asset_type()
    {
        return $this->hasOne(AssetType::class, 'id', 'asset_type_id');
    }

    public function valuations()
    {
        return $this->hasMany(AssetValuation::class, 'asset_id', 'id')->orderBy('date', 'desc');
    }
}
