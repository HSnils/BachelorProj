<?php

use Illuminate\Database\Seeder;
use App\bookings_room;

class Bookings_RoomsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
		bookings_room::create([
			'bookings_id' => 1,
			'room_number' => 'A001'
		]);
    }
}
