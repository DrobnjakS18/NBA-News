<?php
/**
 * Created by PhpStorm.
 * Users: DrobnjakS
 * Date: 3/4/2019
 * Time: 7:12 PM
 */

namespace NbaNews\Model;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public $id;
    public $name;

    public function insertCat(){

        \DB::table('categories')
            ->insert([
                'name' => $this->name
            ]);
    }

    public function getOne($id){

        return \DB::table('categories')
            ->where('id_cat',$id)
            ->first();
    }

    public function updateCat($id){

        \DB::table('categories')
            ->where("id_cat",$id)
            ->update([
                'name' => $this->name
            ]);
    }

    public function deleteCat(){

        \DB::table('categories')
            ->where('id_cat',$this->id)
            ->delete();
    }
}
