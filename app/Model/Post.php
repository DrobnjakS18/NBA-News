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


    public function getAllByPost($id){

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

    public function VisitedPost($id_p,$id_u = null){

        \DB::table('visitors_post')
            ->insert([
                'id_p' => $id_p,
                'id_u' => $id_u
            ]);
    }

    public function PostsByVisit(){

        return \DB::table('visitors_post')
            ->selectRaw('posts.id,posts.small_picture ,posts.headline,posts.created_at,count(visitors_post.id) AS BrojPregreda')
            ->join('posts','visitors_post.id_p','=','posts.id')
            ->groupBy('posts.small_picture','posts.headline','posts.created_at','posts.id')
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
