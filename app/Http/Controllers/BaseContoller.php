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

        $this->data['posts'] = Post::all();
        $this->data['meni'] = Meni::all();
        $this->data['role'] = Users::all();
    }

}
