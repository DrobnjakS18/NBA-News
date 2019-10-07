<?php

namespace App\Http\Controllers;


use App\Model\Comments;
use App\Model\Posts;
use App\Model\Users;
use App\Model\VideoModel;
use Illuminate\Http\Request;

class FrontEnd extends BaseContoller
{



    public function index()
    {
        $posts = new Posts();
        $res = $posts->PostsPagination();
        $this->data['most'] =$posts->PostsByVisit();

        $array_news= $posts->getAllByLatest(1);

        $this->data['latest'] = $array_news;

        $this->data['post_game'] = $posts->getAllByPost(2);
        $this->data['pagination'] = $res;

        $video = new VideoModel();

        $array_videos = $video->getAllVideos()->toArray();

        $random_video = \Arr::random($array_videos);

        $this->data['random_video'] = $random_video;

        return view("pages.home",$this->data);
    }


    public function single($id,$user_id = null){

        $visited = new Posts();


        try{
            $visited->VisitedPost($id,$user_id);
        }catch (\Exception $e){

            \Log::critical('Visiting post counter failed error'.$e->getMessage());
        }


        $this->data['count_visits'] =$visited->visitedCounter($id);

        $this->data['most'] =$visited->PostsByVisit();

        $com = new Comments();

        $this->data['count_comments'] = $com->CountCommentsForPost($id);

        $this->data['comments'] =$com->getAllByPost($id);
        $this->data['reply'] = $com->getAllReplies();

//        dd($com->getAllReplies());


        $posts = new Posts();
        $this->data['post'] = $posts->getOne($id);


        $video = new VideoModel();

        $array_videos = $video->getAllVideos()->toArray();

        $random_video = \Arr::random($array_videos);

        $this->data['random_video'] = $random_video;

        $this->data['post_game'] = $posts->getAllByPost(2);


        return view('pages.single_post',$this->data);
    }



    public function about(){

        return view('pages.about',$this->data);
    }

    public function search(Request $request){

        $request->validate([
            'search_value' => 'required|max:140'
        ]);

        $posts = new Posts();


        try{

            $search = $posts->LikePosts($request->search_value);
        } catch(\Exception $e) {

            \Log::critical('Search failed error'.$e->getMessage());
        }



        if($search->isEmpty()){
                    $this->data['search_not_found'] = "No Resaults";
                    return view('pages.search',$this->data);
        }else {

            $this->data['search_found'] = $search;
                    return view('pages.search',$this->data);
        }

    }

}
