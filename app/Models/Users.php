<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
    //
    protected $fillable=['name','created_at','shop_id','updated_at','status','email','password','remember_token'];

    public function Shops()
    {
        return $this->belongsTo(Shops::class, 'shop_id','id');
    }
}