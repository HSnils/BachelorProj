<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->string('name', 30);		  
            $table->string('email', 100)->unique();
            $table->string('password', 255);
            $table->string('role', 30);
            $table->rememberToken();
            $table->timestamps();

            $table->foreign('role')->references('role')->on('roles')->onUpdate('cascade')->onDelete('cascade');
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
