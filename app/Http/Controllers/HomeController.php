<?php

namespace NbaNews\Http\Controllers;

use NbaNews\Model\Comment;
use NbaNews\Model\Post;
use NbaNews\Model\Users;
use NbaNews\Model\VideoModel;
use Illuminate\Http\Request;

class HomeController extends BaseContoller
{
    public function index()
    {
        $posts = new Post();
        $res = $posts->PostsPagination();
        $this->data['most'] =$posts->PostsByVisit();

        $arrayNews= $posts->getAllByLatest(1);

        $this->data['latest'] = $arrayNews;

        $this->data['post_game'] = $posts->getAllByPost(2);
        $this->data['pagination'] = $res;

        $video = new VideoModel();

        $arrayVideos = $video->getAllVideos()->toArray();

        $randomVideo = \Arr::random($arrayVideos);

        $this->data['random_video'] = $randomVideo;

        return view("pages.home", $this->data);
    }


    public function single($id, $userID = null)
    {
        $visited = new Post();

        try {
            $visited->VisitedPost($id, $userID);
        } catch (\Exception $e) {
            \Log::critical('Visiting post counter failed error'.$e->getMessage());
        }

        $this->data['count_visits'] =$visited->visitedCounter($id);

        $this->data['most'] =$visited->PostsByVisit();

        $com = new Comment();

        $this->data['count_comments'] = $com->CountCommentsForPost($id);
        $this->data['comments'] =$com->getAllByPost($id);

        $this->data['reply'] = $com->getAllReplies();

        $posts = new Post();
        $this->data['post'] = $posts->getOne($id);

        $video = new VideoModel();
        $arrayVideos = $video->getAllVideos()->toArray();
        $random_video = \Arr::random($arrayVideos);
        $this->data['random_video'] = $random_video;
        $this->data['post_game'] = $posts->getAllByPost(2);

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
            $search = $posts->LikePosts($request->search_value);
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
