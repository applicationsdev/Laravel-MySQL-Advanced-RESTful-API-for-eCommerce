<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\User;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            
            $table->string('name', 50)->default('New User');
            
            $table->string('email', 100)->unique();
            $table->string('password', 100);
            
            $table->string('photo', 300)->nullable();
            $table->string('address_line1', 100)->nullable();
            $table->string('address_line2', 100)->nullable();
            $table->string('country_code', 20)->nullable();
            $table->string('postal_code', 20)->nullable();
            $table->string('tel', 20)->nullable();
            
            $table->string('verify_token')->nullable();
            $table->string('state', 50)->default(Config::get('customConstants.user.state.is_not_verified'));
            
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
