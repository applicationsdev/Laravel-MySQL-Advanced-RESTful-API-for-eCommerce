<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_items', function (Blueprint $table) {
            $table->increments('id');
            
            $table->integer('qty')->unsigned()->default(1);
            $table->decimal('value', 6, 2)->unsigned()->default(0.00);
            
            $table->integer('item_id')->unsigned();
            $table->integer('order_id')->unsigned();
            $table->integer('sale_id')->unsigned();
            
            $table->timestamps();
            
            $table->foreign('item_id')->references('id')->on('items');
            $table->foreign('order_id')->references('id')->on('orders');
            $table->foreign('sale_id')->references('id')->on('sales');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_items');
    }
}
