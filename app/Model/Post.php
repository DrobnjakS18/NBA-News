<?php
/**
 * Created by PhpStorm.
 * Users: DrobnjakS
 * Date: 3/3/2019
 * Time: 1:51 AM
 */

namespace NbaNews\Model;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public $id;
    public $picture;
    public $small_picture;
    public $alt;
    public $headline;
    public $text;
    public $catId;


    public $timestamps = false;

    public function users()
    {
        return $this->hasMany('NbaNews\Model\Users');
    }

    public function comments()
    {
        return $this->hasMany('NbaNews\Model\Reply');
    }


    public function insertPost(){

        \DB::table('posts')
            ->insert(
                [
                    'picture'=> $this->picture,
                    'small_picture' => $this->small_picture,
                    'alt' => $this->alt,
                    'headline' => $this->headline,
                    'text' => $this->text,
                    'cat_id' => $this->catId

                ]
            );
    }

    public function updatePostNoPic($id){

        \DB::table('posts')
            ->where('id',$id)
            ->update([
                'headline' => $this->headline,
                'text' => $this->text,
                'cat_id' => $this->catId
            ]);
    }

    public function updatePostAll($id){

        \DB::table('posts')
            ->where('id',$id)
            ->update([
                'picture'=> $this->picture,
                'small_picture' => $this->small_picture,
                'alt' => $this->alt,
                'headline' => $this->headline,
                'text' => $this->text,
                'cat_id' => $this->catId
            ]);
    }


//    public function VisitedPost($id_p,$id_u = null){
//
//        \DB::table('visitors_post')
//            ->insert([
//                'post_id' => $id_p,
//                'user_id' => $id_u
//            ]);
//    }

    public function PostsByVisit(){

        return \DB::table('visitors_post')
            ->selectRaw('posts.id,posts.small_picture ,posts.headline,posts.created_at,count(visitors_post.id) AS BrojPregreda')
            ->join('posts','visitors_post.post_id','=','posts.id')
            ->groupBy('posts.small_picture','posts.headline','posts.created_at','posts.id')
            ->orderBy('BrojPregreda','desc')
            ->get();
    }

    public function AllPostByComments($username){

        return \DB::table('comments')
            ->join('posts','comments.post_id','=','posts.id')
            ->join('users','comments.user_id','=','users.id')
            ->where('username',$username)
            ->paginate(3);
    }


}
