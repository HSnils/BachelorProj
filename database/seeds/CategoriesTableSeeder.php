<?php

use Illuminate\Database\Seeder;
use App\Categories;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		Categories::create(
            ['category' => 'EU-123092',
            'type' => 'Project']
        );

        Categories::create(
            ['category' => 'Other',
            'type' => 'Other']
        );
    }
}
