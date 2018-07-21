<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    //
    protected $fillable=['title','created_at','content','updated_at','start_time','end_time'];
}
