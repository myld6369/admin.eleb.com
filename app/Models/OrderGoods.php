<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderGoods extends Model
{
    //
    protected $fillable = [
        'order_id', 'goods_id', 'amount','created_at','goods_img','goods_price','updated_id','goods_name'
    ];
}
