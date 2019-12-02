<?php
/**
 * Created by PhpStorm.
 * Users: DrobnjakS
 * Date: 3/9/2019
 * Time: 6:17 PM
 */

namespace NbaNews\Model;

use Illuminate\Database\Eloquent\Model;

class Gallery_model extends Model
{
    protected $table = 'gallery';

    public $id;
    public $name;
    public $picture;
    public $picture_small;
    public $alt;

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
