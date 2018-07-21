<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admins extends Authenticatable
{
    use Notifiable;
    //
    protected $fillable = [
        'name', 'email', 'password','rememberToken','created_at','updated_at'
    ];
}
