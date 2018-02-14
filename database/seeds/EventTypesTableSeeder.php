<?php

use Illuminate\Database\Seeder;

class EventTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $eventTypes = [
            ['title' => 'weekbrief'],
            ['title' => 'evenement'],
            ['title' => 'nieuws'],
            ['title' => 'weetje'],
        ];

        foreach ($eventTypes as $eventType) {
            $eventType = new \App\EventType($eventType);
            $eventType->save();
        }
    }
}
