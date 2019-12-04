<?php

use Illuminate\Database\Seeder;

class MeniTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('meni')->insert([
            [
                'nav' => '/',
                'name' => 'Home'
            ],
            [
                'nav' => '/about',
                'name' => 'About'
            ],
            [
                'nav' => '/gallery',
                'name' => 'Gallery'
            ],
            [
                'nav' => '/contact',
                'name' => 'Contact'
            ]
        ]);
    }
}
