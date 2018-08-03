<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EventPrize extends Model
{
    //
    protected $fillable = [
        'events_id', 'name', 'description','member_id','created_at','updated_at'
    ];

    public function Events()
    {
        return $this->belongsTo(Event::class, 'events_id');
    }

    public function Users()
    {
        return $this->belongsTo(Users::class, 'member_id');
    }
}
