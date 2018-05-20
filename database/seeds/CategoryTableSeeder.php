<?php

use Illuminate\Database\Seeder;
use App\Model\Category;
use Carbon\Carbon;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        Category::truncate();
        $data = [
                ['created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'name' => 'Development'],
                ['created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'name' => 'Design'],
                ['created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'name' => 'Bug Fix'],
                ['created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'name' => 'Testing'],
            
        ];
        Category::insert($data);
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
}
