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
			'location' => 'A008',
			'type' => 'Kamera',
			'desc' => 'Dette er et smud kamera!'
		]);

		Equipments::create([
			'name' => '10mm Stativ',
			'location' => 'A008',
			'type' => 'Stativ',
			'desc' => 'Stativ for å ta bilder'
		]);

		Equipments::create([
			'name' => 'Asus Projector',
			'location' => 'A009',
			'type' => 'Projector',
			'desc' => 'Ekstremt god projector, pass på bruken!'
		]);

		Equipments::create([
			'name' => 'Linjal',
			'location' => 'A010',
			'type' => 'Verktøy',
			'desc' => 'Ganske gammel nå, men bare å bruke om du trenger!'
		]);

	}
}
