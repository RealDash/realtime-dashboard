<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Model\Role::create([
            'id' => 1,
            'name' => 'super_admin'
        ]);

        \App\Model\Role::create([
            'id' => 2,
            'name' => 'admin'
        ]);

        \App\Model\Role::create([
            'id' => 3,
            'name' => 'user'
        ]);
    }
}
