<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $this->call(ContactPeopleTableSeeder::class);
        $this->call(EmailAddressesTableSeeder::class);
        $this->call(EventPagesTableSeeder::class);
        $this->call(EventsTableSeeder::class);
        $this->call(EventTypesTableSeeder::class);
        $this->call(GroupsTableSeeder::class);
        $this->call(ImagesTableSeeder::class);
        $this->call(MembersTableSeeder::class);
        $this->call(MobilePhonesTableSeeder::class);
        $this->call(PhonesTableSeeder::class);
        $this->call(UserRolesTableSeeder::class);
    }
}
