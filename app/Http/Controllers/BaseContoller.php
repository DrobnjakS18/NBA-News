<?php

namespace NbaNews\Http\Controllers;

use NbaNews\Model\Meni;
use NbaNews\Model\Posts;
use NbaNews\Model\Users;
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
