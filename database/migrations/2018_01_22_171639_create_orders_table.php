<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();
        
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            
            $table->decimal('value', 6, 2)->unsigned()->default(0.00);
            $table->string('status', 50)->nullable();
            
            $table->integer('client_id')->unsigned();
            $table->timestamps();
            
            $table->foreign('client_id')->references('id')->on('users');
        });
        
        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
