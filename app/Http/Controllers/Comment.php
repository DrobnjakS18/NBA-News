<?php
/**
 * Created by PhpStorm.
 * User: DrobnjakS
 * Date: 3/6/2019
 * Time: 7:53 PM
 */

namespace NbaNews\Http\Controllers;
use NbaNews\Model\Comments;
use NbaNews\Model\Users;
use Illuminate\Http\Request;

class Comment extends BaseContoller
{

    public function store(Request $request,$id){

        $request->validate([

            'comment_area' => 'required|max:255'
        ]);
        $com_val = $request->comment_area;
        $user_id = $request->user_id;


        $com = new Comments();

        $com->id = $id;
        $com->com = $com_val;
        $com->user_id = $user_id;

        if(session('user')){
            $activities = new Users();
            $activities->user_id = session('user')->UserId;
            $activities->text = "User ".session('user')->username." commented ".$com_val;

            try{
                $activities->insertActivities();
            }
            catch(\Exception $e){

                \Log::critical('Comment activities failed error'.$e->getMessage());
            }
        }



        try{

            $com->insertCom();
            return redirect()->back()->with('sub_comment_success','Thanks for commenting');
        }catch(\Exception $e){

            \Log::info('Comment inser failed error'.$e->getMessage());
            return redirect()->back()->with('sub_comment_error','Application is not working, please come back later');
        }


    }

    public function destroy($id){

        $delete = new Comments();

        $delete->id = $id;

            $activities = new Users();
            $activities->user_id = session('user')->UserId;
            $activities->text = "User ".session('user')->username." deleted his comment ";

            try{
                $activities->insertActivities();
            }
            catch(\Exception $e){

                \Log::critical('Reply activities failed error'.$e->getMessage());
            }




        try{
            $delete->deleteComment();

            return redirect()->back();
        }catch (\Exception $e){

            \Log::info('Error deleting comment '.$e->getMessage());
            return redirect()->back()->with('delete_error','Application is not working, please come back later');
        }
    }

    public function update(Request $request,$id){

        $request->validate([

            'text' => 'required|max:255'
        ]);

        $update = new Comments();

        $update->com = $request->text;

        try{

            $update->updateComment($id);

            $data['msg'] = 'Successfull update';
            return $data;

        }catch (\Exception $e){
            \Log::critical('Error updating comment '.$e->getMessage());

        }


    }


    public function reply(Request $request,$id){

       $request->validate([

           'text_rep' => 'required|max:255'
       ]);

        $replay = new Comments();

        $replay->com = $request->text_rep;
        $replay->user_id = $request->user_id;


        if(session('user')){
            $activities = new Users();
            $activities->user_id = session('user')->UserId;
            $activities->text = "User ".session('user')->username." reply ".$request->text_rep;

            try{
                $activities->insertActivities();
            }
            catch(\Exception $e){

                \Log::critical('Reply activities failed error'.$e->getMessage());
            }
        }



        try{

            $replay->subReplayComment($id);

            return redirect()->back();
        }catch (\Exception $e){

            \Log::critical('Comment inser failed error'.$e->getMessage());
            return redirect()->back()->with('sub_comment_error','Application is not working, please come back later');
        }
    }

    public function deleteReply($id){

        $del = new Comments();

        try{
            $del->delReply($id);

            return redirect()->back();
        }catch (\Exception $e){

            \Log::critical('Error deleting comment '.$e->getMessage());
            return redirect()->back()->with('delete_error','Application is not working, please come back later');
        }

    }

    public function updateReply(Request $request,$id){


        $request->validate([

            'text' => 'required|max:255'
        ]);


        $updReply = new Comments();

        $updReply->com = $request->text;

        try{

            $updReply->updateReply($id);
            $data['msg'] = 'Successfull update';
            return $data;

        }catch(\Exception $e){

            \Log::critical('Error updating comment '.$e->getMessage());
        }

    }



}