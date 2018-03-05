<?php

use Illuminate\Database\Seeder;
use App\Equipments;

class EquipmentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
		Equipments::create([
			'name' => 'Canon 50D',
			'location' => 'A002',
			'type' => 'Kamera',
			'desc' => 'Dette er et smud kamera!'
		]);
    }
}
