<?php

use Illuminate\Database\Seeder;

class CommentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('comments')->insert([
            [
                'comment' => 'LeBron has had on a first team All-NBA spot? That likely comes to an end this season as well.',
                'post_id' => 1,
                'user_id' => 1
            ],
            [
                'comment' => 'The Lakers say he is expected to make a full recovery before the start of his fourth NBA season',
                'post_id' => 2,
                'user_id' => 2
            ],
        ]);
    }
}
