<?php

use Illuminate\Database\Seeder;

class GroupsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $groups = [
            ['title' => 'piepers', 'description' => 'Some text'],
            ['title' => 'sloebers', 'description' => 'Some text'],
            ['title' => 'jongknapen', 'description' => 'Some text'],
            ['title' => 'knapen', 'description' => 'Some text'],
            ['title' => 'jonghernieuwers', 'description' => 'Some text'],
            ['title' => 'plus16', 'description' => 'Some text'],
        ];

        foreach ($groups as $group){
            $group = new \App\Group($group);
            $group->save();
        }
    }
}
