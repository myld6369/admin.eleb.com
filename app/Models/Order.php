<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //
    protected $fillable = [
        'user_id', 'shop_id', 'sn','created_at','province','city','county','address','tel','name','total','status','created_at','out_trade_no'
    ];

    public function Shop()
    {
        return $this->belongsTo(Shops::class, 'shop_id','id');
    }

    public function Consumer()
    {
        return $this->belongsTo(Consumer::class, 'user_id','id');
    }

}
