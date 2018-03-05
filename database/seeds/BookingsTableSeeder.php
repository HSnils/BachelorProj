<?php

use Illuminate\Database\Seeder;
use App\Bookings;

class BookingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
		Bookings::create([
			'type' => 'Noe',
			'category' => 'Noe',
			'from_date' => now(),
			'to_date' => now(),
			'room_number' => 'A002',
			'equipment_id' => 1,
			'user_id' => 2
		]);
    }
}
