<?php

use Illuminate\Database\Seeder;

class VideoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('video')->insert([
            [
                'title' => 'Sacramento Kings vs New York Knicks - Full Game Highlights | March 9, 2019',
                'url' => 'https://www.youtube.com/embed/GrvAeuMXm9k',

            ],
            [
                'title' => 'Dallas Mavericks vs Denver Nuggets - Full Game Highlights | March 14, 2019 ',
                'url' => 'https://www.youtube.com/embed/7mSdGw_6Bvg',

            ],
            [
                'title' => 'LA Lakers vs Toronto Raptors - Full Game Highlights | March 14, 2019',
                'url' => 'https://www.youtube.com/embed/hQW1jioFYTI',

            ],
            [
                'title' => 'SOKC Thunder vs Indiana Pacers - Full Game Highlights | March 14, 2019',
                'url' => 'https://www.youtube.com/embed/66r3PwL_33Q',

            ],
            [
                'title' => 'Memphis Grizzlies vs Washington Wizards Full Game Highlights | March 16',
                'url' => 'https://www.youtube.com/embed/0BYsBeXcPeA',

            ]
        ]);
    }
}
