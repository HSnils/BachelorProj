<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEquipmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('equipments', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 30);
            $table->string('location', 30);
            $table->string('type', 30);
            $table->boolean('status')->default(false);
            $table->string('desc', 155);
            $table->boolean('lockdown')->default(false);
            $table->image('image');
            $table->timestamps();

            $table->foreign('location')->references('room_number')->on('rooms')->onUpdate('cascade')->onDelete('SET NULL');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('equipments');
    }
}
