<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Consumer extends Authenticatable
{
    //
    use Notifiable;
    protected $fillable = [
        'username', 'tel', 'password','created_at','updated_at','remember_token','status'
    ];
}
