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

		Rooms::create([
			'room_number' => 'A003',
			'type' => 'Videolab',
			'building' => 'A'
		]);

		Rooms::create([
			'room_number' => 'A004',
			'type' => 'Videolab',
			'building' => 'A'
		]);

		Rooms::create([
			'room_number' => 'B015',
			'type' => 'Colorlab',
			'building' => 'B'
		]);

		Rooms::create([
			'room_number' => 'G00K',
			'type' => 'Kjøkkenlab',
			'building' => 'G'
		]);

		Rooms::create([
			'room_number' => 'K114',
			'type' => '3D-printer lab',
			'building' => 'K'
		]);
    }
}