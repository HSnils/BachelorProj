<?php

use Illuminate\Database\Seeder;
use App\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
		User::create([
			'name' => 'John Doe',
			'email' => 'john@example.com',
			'password' => bcrypt('Testing123'),
			'role' => 'Student',
			'last_login' => now()			
		]);

		User::create([
			'name' => 'Henrik Snilsberg',
			'email' => 'snils@ntnu.no',
			'password' => bcrypt('123'),
			'role' => 'Admin',
			'last_login' => now()
		]);

		User::create([
			'name' => 'Fredrik Paulsen',
			'email' => 'fred@ntnu.no',
			'password' => bcrypt('123'),
			'role' => 'Admin',
			'last_login' => now()
		]);

		User::create([
			'name' => 'Omi',
			'email' => 'omi@ntnu.no',
			'password' => bcrypt('123'),
			'role' => 'Admin',
			'last_login' => now()
		]);

		User::create([
			'name' => 'Guestboi guesterson',
			'email' => 'guest@ntnu.no',
			'password' => bcrypt('123'),
			'role' => 'Guest',
			'last_login' => now()
		]);
    }
}