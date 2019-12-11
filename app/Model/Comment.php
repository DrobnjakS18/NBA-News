<?php
/**
 * Created by PhpStorm.
 * Users: DrobnjakS
 * Date: 3/6/2019
 * Time: 11:37 PM
 */

namespace NbaNews\Model;

use Illuminate\Database\Eloquent\Model;

use mysql_xdevapi\Exception;

class Comment extends Model
{

//    public function users()
//    {
//        return $this->belongsToMany('NbaNews\Model\Users','users',);
//    }

//    public function insertCom(){
//
//        \DB::table('comments')
//            ->insert([
//                'com' => $this->com,
//                'id_p' => $this->id,
//                'id_u' => $this->user_id
//            ]);
//    }

    public function getAllByPost($id){

        return \DB::table('comments')
            ->select('*','comments.id as comment_id')
            ->join('posts','comments.post_id','=','posts.id')
            ->join('users','comments.user_id','=','users.id')
            ->where('post_id',$id)
//            ->orderBy('created_at','asc')
            ->get();
    }


    public function deleteComment(){

        try{
            \DB::transaction(function(){


                \DB::table('reply')
                    ->where('id_c',$this->id)
                    ->delete();


                \DB::table('comments')
                    ->where('com_id',$this->id)
                    ->delete();

            });

        } catch (\Throwable $e){

            \Log::critical('Failed to delete comments');
            throw new \Exception('Failed to delete comments');
        }


    }

    public function getAllReplies(){

        return \DB::table('reply')
            ->select('*', 'reply.id as reply_id')
            ->join('comments','reply.comment_id','=','comments.id')
            ->join('posts','comments.post_id','=','posts.id')
            ->join('users','reply.user_id','=','users.id')
            ->get();
    }


}
