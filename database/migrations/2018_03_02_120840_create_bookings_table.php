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
			  
			  	$table->string('type');
			  
			  	$table->string('category');
			  
			   $table->dateTime('from_date');
			  
            $table->dateTime('to_date');
			  
			  	$table->number('room_number');
			  
			  	$table->integer('user_id')->unsigned();
			  
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
        Schema::dropIfExists('bookings');
    }
}
