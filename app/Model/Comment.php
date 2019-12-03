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
//    public $com;
//    public $user_id;
//    public $id;

    protected $primaryKey = 'com_id';

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
            ->select('*')
            ->join('posts','comments.id_p','=','posts.id')
            ->join('users','comments.id_u','=','users.id')
            ->where('id_p',$id)
            ->orderBy('date_comment','asc')
            ->get();
    }


    public function deleteComment(){

        try{
            \DB::transaction(function(){


                \DB::table('subcommnets')
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

    public function updateComment($id){

        \DB::table('comments')
            ->where('com_id',$id)
            ->update([
                'com' => $this->com
            ]);
    }

    public function CountCommentsForPost($id){

        return \DB::table('comments')
            ->where('id_p',$id)
            ->count();
    }


    public function getAllReplies(){

        return \DB::table('subcommnets')
            ->join('comments','subcommnets.id_c','=','comments.com_id')
            ->join('posts','comments.id_p','=','posts.id')
            ->join('users','subcommnets.id_user','=','users.id')
            ->get();
    }

    public function subReplayComment($id){

        \DB::table('subcommnets')
            ->insert([
                'reply'=>$this->com,
                'id_c'=>$id,
                'id_user' => $this->user_id
            ]);
    }

    public function delReply($id){

        \DB::table('subcommnets')
            ->where('rep_id',$id)
            ->delete();
    }

    public function updateReply($id){

        \DB::table('subcommnets')
            ->where('rep_id',$id)
            ->update([
                'reply' => $this->com
            ]);
    }






}
