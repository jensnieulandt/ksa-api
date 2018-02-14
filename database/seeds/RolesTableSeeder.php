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
        $roles = [
            ['title' => 'user'],
            ['title' => 'admin'],
            ['title' => 'superadmin'],
        ];

        foreach ($roles as $role){
            $role = new \App\Role($role);
            $role->save();
        }
    }
}
