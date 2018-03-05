<?php

use Illuminate\Database\Seeder;
use App\Rooms;

class RoomsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
    	Rooms::create([
			'room_number' => 'A001',
			'type' => 'Colorlab',
			'building' => 'A'
		]);

		Rooms::create([
			'room_number' => 'A002',
			'type' => 'Videolab',
			'building' => 'A'
		]);

    }
}