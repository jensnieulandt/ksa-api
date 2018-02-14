<?php

use Illuminate\Database\Seeder;

class DutiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $duties = [
            ['title' => 'leider', 'role_id' => 1],
            ['title' => 'bansecretaris', 'role_id' => 1],
            ['title' => 'banpr', 'role_id' => 1],
            ['title' => 'bantrekker', 'role_id' => 1],
            ['title' => 'secretaris', 'role_id' => 1],
            ['title' => 'pr', 'role_id' => 2],
            ['title' => 'bondsleider', 'role_id' => 2],
            ['title' => 'webmaster', 'role_id' => 3]
        ];

        foreach ($duties as $duty){
            $duty = new \App\Duty($duty);
            $duty->save();
        }
    }
}
