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
			'room_number' => 'A008',
			'type' => 'Photo studio',
			'building' => 'A'
		]);
		
		Rooms::create([
			'room_number' => 'A009',
			'type' => 'Projection Systems',
			'building' => 'A'
		]);

		Rooms::create([
			'room_number' => 'A010',
			'type' => 'Multispectral acquisition and reproduction',
			'building' => 'A'
		]);
		
		Rooms::create([
			'room_number' => 'A011',
			'type' => 'Psychometrics',
			'building' => 'A'
		]);

		Rooms::create([
			'room_number' => 'A012',
			'type' => 'Colour management and measurement ',
			'building' => 'A'
		]);

		Rooms::create([
			'room_number' => 'A013',
			'type' => 'Meeting room',
			'building' => 'A'
		]);
		
		Rooms::create([
			'room_number' => 'A014',
			'type' => 'Eye tracking',
			'building' => 'A'
		]);
		
		Rooms::create([
			'room_number' => 'A043',
			'type' => 'Image Acquisition',
			'building' => 'A'
		]);

		Rooms::create([
			'room_number' => 'A257',
			'type' => 'Video Analytics',
			'building' => 'A'
		]);
		
    }
}