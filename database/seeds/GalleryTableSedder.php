<?php

use Illuminate\Database\Seeder;

class GalleryTableSedder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('gallery')->insert([
            [
                'title' => 'PIcture 1',
                'picture_path' => 'images/gallery/1552323809nash-curry-beijing-131015-600.jpg',
                'small_path' => 'images/small_images/small_1552323809nash-curry-beijing-131015-600.jpg',
                'alt' => 'nash-curry-beijing'
            ],
            [
                'title' => 'PIcture 2',
                'picture_path' => 'images/gallery/1552323989144031268_10-alltimeintl-131002-940.jpg',
                'small_path' => 'images/small_images/small_1552323989144031268_10-alltimeintl-131002-940.jpg',
                'alt' => 'alltimeintl'
            ],
            [
                'title' => 'PIcture 3',
                'picture_path' => 'images/gallery/1552324190GettyImages_540881430_xaxtz6fk_zl412bdr.jpg',
                'small_path' => 'images/small_images/small_1552324190GettyImages_540881430_xaxtz6fk_zl412bdr.jpg',
                'alt' => 'GettyImages'
            ]
        ]);
    }
}
