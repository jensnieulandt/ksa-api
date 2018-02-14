<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new \App\User([
            'first_name' => 'Test',
            'last_name' => "Testmans",
            'email' => 'user@test.be',
            'password' => bcrypt('user'),
            'group_id' => 1,
            'mobile_phone' => '+32475358645',
            'profile_picture' => 'img/users/testTestmans.jpg'
        ]);
        $user->save();
        $user->duties()->attach([1]);

        $user = new \App\User([
            'first_name' => 'Dirk',
            'last_name' => "Porrez",
            'email' => 'admin@test.be',
            'password' => bcrypt('admin'),
            'group_id' => 2,
            'mobile_phone' => '+3291283644',
            'profile_picture' => 'img/users/dirkPorrez.jpg'
        ]);
        $user->save();
        $user->duties()->attach([4, 7]);

        $user = new \App\User([
            'first_name' => 'Jens',
            'last_name' => "Nieulandt",
            'email' => 'superadmin@test.be',
            'password' => bcrypt('superadmin'),
            'mobile_phone' => '+32475919328',
            'profile_picture' => 'img/users/jensNieulandt.jpg'
        ]);
        $user->save();
        $user->duties()->attach([8]);
    }
}
