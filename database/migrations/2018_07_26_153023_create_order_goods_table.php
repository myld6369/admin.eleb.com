<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderGoodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_goods', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('order_id');
            $table->integer('goods_id');
            $table->integer('amount');
            $table->string('goods_name');
            $table->string('goods_img');
            $table->string('goods_price');
            $table->engine='InnoDB';
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_goods');
    }
}
