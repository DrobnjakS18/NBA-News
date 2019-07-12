<?php

namespace App\Http\Controllers;

use App\Model\Meni;
use App\Model\Posts;
use App\Model\Users;
use Illuminate\Http\Request;

class BaseContoller extends Controller
{
    protected $data = [];

    public  function  __construct(){

        $meni_obj = new Meni();
        $posts = new Posts();
        $users = new Users();
        $this->data['posts'] = $posts->getAll();
        $this->data['meni'] = $meni_obj->getAllMeni();
        $this->data['role'] = $users->roles();
    }

}
