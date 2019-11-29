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
        $mostViewed = $posts->PostsByVisit();

        $latest= Post::where('cat_id',1)->get();
        $post_game = Post::where('cat_id',2)->get();
        $pagination = Post::paginate(4);

        $arrayVideos = VideoModel::all()->toArray();
        $randomVideo = \Arr::random($arrayVideos);
        $random_video = (object)$randomVideo;

        return view("pages.home", [
            'meni' => $this->data['meni'],
            'most' => $mostViewed,
            'latest' => $latest,
            'post_game' => $post_game,
            'pagination' => $pagination,
            'random_video' => $random_video,
        ]);
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

        $arrayVideos = VideoModel::all()->toArray();
        $random_video = \Arr::random($arrayVideos);
        $this->data['random_video'] = (object)$random_video;
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
