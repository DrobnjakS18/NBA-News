<?php
/**
 * Created by PhpStorm.
 * User: DrobnjakS
 * Date: 3/15/2019
 * Time: 2:45 PM
 */

namespace App\Model;


class VideoModel
{
    public $id;
    public $title;
    public $url;

    public function getAllVideos(){

        return \DB::table('video')->get();
    }

    public function getOne($id){

        return \DB::table('video')
            ->where('id',$id)
            ->first();
    }

    public function updateVideo($id){

        \DB::table('video')
            ->where('id',$id)
            ->update([
                'title' => $this->title,
                'url' => $this->url
            ]);
    }

    public function deleteVideo(){

        \DB::table('video')
            ->where('id',$this->id)
            ->delete();
    }

    public function insertVideo(){

        \DB::table('video')
            ->insert([
                'title' => $this->title,
                'url' => $this->url
            ]);
    }

}