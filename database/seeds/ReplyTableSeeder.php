<?php

use Illuminate\Database\Seeder;

class ReplyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('reply')->insert([
            [
                'reply' => 'Nice',
                'comment_id' => 1,
                'user_id' => 1
            ]
        ]);
    }
}
