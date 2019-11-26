<?php

namespace NbaNews\Http\Controllers;

use NbaNews\Model\Meni;
use NbaNews\Model\Post;
use NbaNews\Model\Users;
use Illuminate\Http\Request;

class BaseContoller extends Controller
{
    protected $data = [];

    public  function  __construct(){

        $meniObj = new Meni();
        $posts = new Post();
        $users = new Users();
        $this->data['posts'] = $posts->getAll();
        $this->data['meni'] = $meniObj->getAllMeni();
        $this->data['role'] = $users->roles();
    }

}
