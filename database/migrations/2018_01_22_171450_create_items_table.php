<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();
        
        Schema::create('items', function (Blueprint $table) {
            $table->increments('id');
            
            $table->string('title', 100)->default('New Product');
            $table->string('image_thumbnail', 300)->nullable();
            $table->string('description_short', 500)->nullable();
            
            $table->integer('available_qty')->unsigned()->default(0);
            $table->decimal('catalog_price', 6, 2)->unsigned()->default(0.00);
            
            $table->string('status', 50)->default(Config::get('customConstants.item.status.is_not_available'));
            
            $table->integer('category_id')->unsigned();
            $table->integer('merchant_id')->unsigned();
            
            $table->timestamps();
            
            $table->foreign('category_id')->references('id')->on('categories');
            $table->foreign('merchant_id')->references('id')->on('users');
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
        Schema::dropIfExists('items');
    }
}
