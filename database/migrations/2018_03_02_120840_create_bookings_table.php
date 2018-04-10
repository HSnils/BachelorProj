<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
			  
           	$table->increments('id');
			$table->string('type', 100);
			$table->string('category', 30)->default('Other');
			$table->dateTime('from_date');	  
            $table->dateTime('to_date');
			$table->string('status', 30)->default('Active');
			$table->integer('user_id')->unsigned();
            $table->timestamps();
			  
			  
			$table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
			  
			$table->foreign('category')->references('category')->on('categories')->onUpdate('cascade')->onDelete('cascade');
			  
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bookings');
    }
}
