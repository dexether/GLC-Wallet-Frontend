<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Exchange extends Model
{
    protected $table = "exchanges";

    // public function user()
    // {
    //     return $this->hasOne(User::class, 'id', 'user_id');
    // }

	public function userdata(){
        return $this->belongsTo('App\Models\User', 'user_id', 'id')->select(['id', 'username','email','first_name','last_name']);
    }

}
