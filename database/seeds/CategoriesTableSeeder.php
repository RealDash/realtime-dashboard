<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Model\Category::create([
            'name' => 'Design'
        ]);

        \App\Model\Category::create([
            'name' => 'Features'
        ]);
    }
}
