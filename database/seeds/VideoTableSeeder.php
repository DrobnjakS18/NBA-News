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
                'title' => 'Los Angeles Lakers vs Utah Jazz Full Game Highlights | December 4, 2019-20 NBA Season   ',
                'url' => 'AYJQ6YiyzC0',

            ],
            [
                'title' => 'Portland Trail Blazers vs Sacramento Kings Full Game Highlights | December 4, 2019-20 NBA Season',
                'url' => 'qzPfhWIoJRc  ',

            ]
        ]);
    }
}
