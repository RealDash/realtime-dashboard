<?php

use Illuminate\Database\Seeder;
use App\Model\Role;
class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        Role::truncate();

        Role::create([
            'id' => 1,
            'name' => 'super_admin'
        ]);

        Role::create([
            'id' => 2,
            'name' => 'admin'
        ]);

        Role::create([
            'id' => 3,
            'name' => 'user'
        ]);
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
}
