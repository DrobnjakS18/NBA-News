<?php

use Illuminate\Database\Seeder;

class VisitorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('visitors_post')->insert([
            [
                'post_id' => 1,
                'user_id' => 1
            ],
            [
                'post_id' => 2,
                'user_id' => 1
            ]
        ]);
    }
}
