<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBookingsRoomsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('bookings_rooms', function (Blueprint $table) {
			$table->increments('bookings_id');
			$table->string('room_number', 30);
			$table->boolean('private')->default(1);
			
			$table->foreign('bookings_id')->references('id')->on('bookings')->onUpdate('cascade')->onDelete('cascade');
			
			$table->foreign('room_number')->references('room_number')->on('rooms')->onUpdate('cascade')->onDelete('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('bookings_rooms');
	}
}
