<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         $this->call([
             RoleTableSeeder::class,
             UserTableSeeder::class,
             CategoryTableSeeder::class,
             PostTableSeeder::class,
             VisitorsTableSeeder::class,
             MeniTableSeeder::class,
             VideoTableSeeder::class,
             GalleryTableSedder::class,
             ActivitiesTableSeeder::class,
             CommentsTableSeeder::class,
             SubCommentTableSeeder::class
         ]);
    }
}
