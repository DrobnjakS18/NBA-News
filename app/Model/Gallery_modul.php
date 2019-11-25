<?php
/**
 * Created by PhpStorm.
 * User: DrobnjakS
 * Date: 3/9/2019
 * Time: 6:17 PM
 */

namespace NbaNews\Model;


class Gallery_modul
{
    public $id;
    public $name;
    public $picture;
    public $picture_small;
    public $alt;

    public function getAllGallery(){

        return \DB::table('gallery')->paginate(9);
    }

    public function getOnePic($id){

        return \DB::table('gallery')
            ->where('id',$id)
            ->first();
    }


    public function insertGalleryPic(){

        \DB::table('gallery')
            ->insert([
                'title' => $this->name,
                'picture_path' => $this->picture,
                'small_path' => $this->picture_small,
                'alt' => $this->alt
            ]);
    }

    public function updateTitle($id){

        \DB::table('gallery')
            ->where('id',$id)
            ->update([
                'title' => $this->name
            ]);
    }

    public  function  updateAll($id){

        \DB::table('gallery')
            ->where('id',$id)
            ->update([
                'title' => $this->name,
                'picture_path' => $this->picture,
                'small_path' => $this->picture_small,
                'alt' => $this->alt
            ]);
    }

    public function deletePic(){

        \DB::table('gallery')
            ->where('id',$this->id)
            ->delete();
    }


}