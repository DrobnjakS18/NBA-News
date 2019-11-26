<?php
/**
 * Created by PhpStorm.
 * Users: DrobnjakS
 * Date: 3/3/2019
 * Time: 1:56 AM
 */

namespace NbaNews\Model;


class Meni
{

    public function getAllMeni(){

        return \DB::table('meni')->get();
    }
}
