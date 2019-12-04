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
                'id_p' => 1,
                'id_u' => 1
            ],
            [
                'id_p' => 2,
                'id_u' => 1
            ]
        ]);
    }
}
