<?php

namespace NbaNews\Http\Controllers;

use NbaNews\Model\Comment;
use NbaNews\Model\Post;
use NbaNews\Model\Users;
use NbaNews\Model\VideoModel;
use Illuminate\Http\Request;
use NbaNews\Model\Visit;
use NbaNews\User;


class HomeController extends BaseContoller
{

    public function index()
    {
        $posts = new Post();
        $this->data['most'] = $posts->PostsByVisit();

        $this->data['latest']= Post::where('cat_id',1)->get();

        $this->data['pagination'] = Post::paginate(4);

        return view("pages.home", $this->data);
    }

    public function single($id, $userID = null)
    {
        $visited = new Post();

        $visited->VisitedPost($id, $userID);
        $this->data['most'] =$visited->PostsByVisit();

        $this->data['count_visits'] = Visit::where('id_p',$id)->count();
        $this->data['count_comments'] = Comment::where('id_p',$id)->count();

        $com = new Comment();

        $this->data['comments'] =$com->getAllByPost($id);

//        $commentsPost = Comment::find(30)->users;
//        dd($commentsPost);

        $this->data['reply'] = $com->getAllReplies();

        $this->data['post'] = Post::where('id',$id)->first();

        return view('pages.single_post', $this->data);
    }

    public function about()
    {
        return view('pages.about', $this->data);
    }

    public function search(Request $request)
    {

        $request->validate([
            'search_value' => 'required|max:140'
        ]);

        $posts = new Post();

        try {
            $search = Post::where('headline','like','%'.$request->search_value.'%')->get();
        } catch (\Exception $e) {
            \Log::critical('Search failed error'.$e->getMessage());
        }

        if ($search->isEmpty()) {
                    $this->data['search_not_found'] = "No Resaults";
                    return view('pages.search', $this->data);
        } else {
                    $this->data['search_found'] = $search;
                    return view('pages.search', $this->data);
        }
    }
}
