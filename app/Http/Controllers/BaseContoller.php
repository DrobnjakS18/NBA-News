<?php

namespace NbaNews\Http\Controllers;

use NbaNews\Model\Meni;
use NbaNews\Model\Post;
use NbaNews\Model\Users;
use Illuminate\Http\Request;
use NbaNews\Model\VideoModel;

class BaseContoller extends Controller
{
    protected $data = [];

    public  function  __construct(){

        $this->data['posts'] = Post::all();
        $this->data['meni'] = Meni::all();
        $this->data['role'] = Users::all();
        $allVideos = VideoModel::all()->toArray();
        $this->data['random_video'] = \Arr::random($allVideos);
        $this->data['post_game'] = Post::where('cat_id',2)->get();
    }

}
