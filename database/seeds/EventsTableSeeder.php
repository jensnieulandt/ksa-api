<?php

use Illuminate\Database\Seeder;

class EventsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $event = new \App\Event([
            'event_type_id' => 1,
            'group_id' => 1,
            'user_id' => 1,
            'last_updated_by' => 1,
            'published' => true,
            'title' => 'Hele mooie titel.',
            'description' => 'Omschrijving van deze weekbrief.',
            'start' => '2017-07-13 14:00:00',
            'end' => '2017-07-13 17:00:00',
        ]);
        $event->save();

        $event = new \App\Event([
            'event_type_id' => 1,
            'group_id' => 1,
            'user_id' => 1,
            'last_updated_by' => 2,
            'published' => true,
            'title' => 'Tweede mooie titel.',
            'description' => 'Omschrijving van deze weekbrief.',
            'start' => '2017-07-13 14:00:00',
            'end' => '2017-07-13 17:00:00',
        ]);
        $event->save();

        $event = new \App\Event([
            'event_type_id' => 1,
            'group_id' => 1,
            'user_id' => 3,
            'last_updated_by' => 1,
            'published' => true,
            'title' => 'Derde mooie titel.',
            'description' => 'Omschrijving van deze weekbrief.',
            'start' => '2017-07-13 14:00:00',
            'end' => '2017-07-13 17:00:00',
        ]);
        $event->save();

        $event = new \App\Event([
            'event_type_id' => 2,
            'group_id' => 2,
            'user_id' => 3,
            'last_updated_by' => 1,
            'published' => true,
            'title' => 'Vierde mooie titel.',
            'description' => 'Omschrijving van deze weekbrief.',
            'start' => '2017-07-13 14:00:00',
            'end' => '2017-07-13 17:00:00',
        ]);
        $event->save();

        $event = new \App\Event([
            'event_type_id' => 3,
            'group_id' => 0,
            'user_id' => 3,
            'last_updated_by' => 1,
            'published' => true,
            'title' => 'Vijfde mooie titel.',
            'description' => 'Omschrijving van deze weekbrief.',
            'start' => '2017-07-13 14:00:00',
            'end' => '2017-07-13 17:00:00',
        ]);
        $event->save();

    }
}
