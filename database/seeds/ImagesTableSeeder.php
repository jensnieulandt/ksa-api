<?php

use Illuminate\Database\Seeder;

class ImagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $image = new \App\Image([
            'event_id' => 1,
            'caption' => 'Flamingo.',
            'alt' => 'Flamingo',
            'path' => 'http://dreamstop.com/wp-content/uploads/2016/08/flamingo-dream.jpg',
        ]);
        $image->save();

        $image = new \App\Image([
            'event_id' => 1,
            'caption' => 'Baby-flamingo ;)',
            'alt' => 'babyflamingo',
            'path' => 'http://kids.nationalgeographic.com/content/dam/kids/photos/articles/Other%20Explore%20Photos/R-Z/Wacky%20Weekend/Baby%20Animals/ww-baby-animals-flamingo.adapt.945.1.jpg',
        ]);
        $image->save();

        $image = new \App\Image([
            'event_id' => 2,
            'caption' => '007',
            'alt' => 'James Bond',
            'path' => 'http://i.dailymail.co.uk/i/pix/2015/09/21/16/2C96F60E00000578-0-image-a-126_1442848442984.jpg',
        ]);
        $image->save();

        $image = new \App\Image([
            'event_id' => 2,
            'caption' => 'Spelen!',
            'alt' => 'Flamingo',
            'path' => 'https://3.bp.blogspot.com/-BSjknEsn1yg/UJooe_jn_TI/AAAAAAAALgc/jR9w34Mzj-s/s1600/flamingo3.jpg',
        ]);
        $image->save();
    }
}
