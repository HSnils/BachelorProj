<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		// $this->call(UsersTableSeeder::class);
		$this->call('ClearTables');
		$this->call('CategoriesTableSeeder');
		$this->call('UserTableSeeder');
		$this->call('RoomsTableSeeder');
		$this->call('EquipmentsTableSeeder');
		$this->call('BookingsTableSeeder');
	}
}

class ClearTables extends Seeder {
	//Clears existing data in the mentioned tables.
	//Note: Foreign key check set to false so that truncate can run.
	//This is only used to clear auto increment count, so that
	//the seed foreign keys matches.
	public function run() {
		DB::statement('SET FOREIGN_KEY_CHECKS=0');
		DB::table('bookings')->truncate();
		DB::table('users')->truncate();
		DB::table('rooms')->truncate();
		DB::table('equipments')->truncate();
		DB::table('bookings_equipments')->truncate();
		DB::table('bookings_rooms')->truncate();
		DB::statement('SET FOREIGN_KEY_CHECKS=1');
		DB::table('categories')->delete();
	}
}
