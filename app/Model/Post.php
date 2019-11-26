<?php
/**
 * Created by PhpStorm.
 * Users: DrobnjakS
 * Date: 3/3/2019
 * Time: 1:51 AM
 */

namespace NbaNews\Model;


class Post
{
    public $id;
    public $picture;
    public $small_picture;
    public $alt;
    public $headline;
    public $text;
    public $catId;


    public function getAll(){

        return \DB::table('posts')->get();

    }

    public function getAllByPost($id){

        return \DB::table('posts as p')
            ->select('*')
            ->join('categories as c','p.cat_id','=','c.id_cat')
            ->where('p.cat_id',$id)
            ->get();
    }

    public function getAllByLatest($id){

        return \DB::table('posts as p')
            ->select('*')
            ->join('categories as c','p.cat_id','=','c.id_cat')
            ->where('p.cat_id',$id)
            ->get();
    }

    public function getOne($id){

        return \DB::table('posts')
            ->select('*')
            ->where('id',$id)
            ->first();

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

    public function deletePost(){

        \DB::transaction(function (){


            \DB::table('comments')
                ->where('id_p',$this->id)
                ->delete();

            \DB::table('visitors_post')
                ->where('id_p',$this->id)
                ->delete();

            \DB::table('posts')
                ->where('id',$this->id)
                ->delete();
        });
    }





    public function LikePosts($headline){

        $posts = \DB::table('posts')
            ->select('*')
            ->where('headline','like','%'.$headline.'%')
            ->simplePaginate(3);


        return $posts;
    }

    public function PostsPagination(){

        return \DB::table('posts')->paginate(4);
    }


    public function VisitedPost($id_p,$id_u = null){

        \DB::table('visitors_post')
            ->insert([
                'id_p' => $id_p,
                'id_u' => $id_u
            ]);
    }

    public  function visitedCounter($id_p){

        return \DB::table('visitors_post')
            ->where('id_p',$id_p)
            ->count();
    }

    public function PostsByVisit(){

        return \DB::table('visitors_post')
            ->selectRaw('posts.id,posts.small_picture ,posts.headline,posts.date_published,count(visitors_post.id) AS BrojPregreda')
            ->join('posts','visitors_post.id_p','=','posts.id')
            ->groupBy('posts.small_picture','posts.headline','posts.date_published','posts.id')
            ->orderBy('BrojPregreda','desc')
            ->get();
    }

    public function AllPostByComments($username){

        return \DB::table('comments')
            ->join('posts','comments.id_p','=','posts.id')
            ->join('users','comments.id_u','=','users.id')
            ->where('username',$username)
            ->paginate(3);
    }



}