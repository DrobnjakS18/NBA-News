<?php
/**
 * Created by PhpStorm.
 * Users: DrobnjakS
 * Date: 3/6/2019
 * Time: 7:53 PM
 */

namespace NbaNews\Http\Controllers;
use NbaNews\Model\Comment;
use NbaNews\Model\Users;
use Illuminate\Http\Request;

class CommentController extends BaseContoller
{

//
//    public function destroy($id)
//    {
//
//        $delete = new Comment();
//
//        $delete->id = $id;
//
//            $activities = new Users();
//            $activities->user_id = session('user')->UserId;
//            $activities->text = "Users ".session('user')->username." deleted his comment ";
//
//            try{
//                $activities->insertActivities();
//            } catch (\Exception $e) {
//
//                \Log::critical('Reply activities failed error'.$e->getMessage());
//            }
//
//
//
//
//        try{
//            $delete->deleteComment();
//
//            return redirect()->back();
//        } catch (\Exception $e) {
//
//            \Log::info('Error deleting comment '.$e->getMessage());
//            return redirect()->back()->with('delete_error','Application is not working, please come back later');
//        }
//    }

    public function update(Request $request,$id)
    {

        $request->validate([
            'text' => 'required|max:255'
        ]);

        $update = new Comment();

        $update->com = $request->text;

        try{

            $update->updateComment($id);

            $data['msg'] = 'Successfull update';
            return $data;

        } catch (\Exception $e) {
            \Log::critical('Error updating comment '.$e->getMessage());

        }


    }


    public function reply(Request $request,$id)
    {

       $request->validate([

           'text_rep' => 'required|max:255'
       ]);

        $replay = new Comment();

        $replay->com = $request->text_rep;
        $replay->user_id = $request->user_id;


        if(session('user')){
            $activities = new Users();
            $activities->user_id = session('user')->UserId;
            $activities->text = "Users ".session('user')->username." reply ".$request->text_rep;
            try{
                $activities->insertActivities();
            } catch (\Exception $e) {

                \Log::critical('Reply activities failed error'.$e->getMessage());
            }
        }



        try{
            $replay->subReplayComment($id);
            return redirect()->back();
        } catch (\Exception $e) {
            \Log::critical('CommentController inser failed error'.$e->getMessage());
            return redirect()->back()->with('show_error','Application is not working, please come back later');
        }
    }

    public function deleteReply($id)
    {
        $del = new Comment();

        try{
            $del->delReply($id);

            return redirect()->back();
        } catch (\Exception $e) {

            \Log::critical('Error deleting comment '.$e->getMessage());
            return redirect()->back()->with('show_error','Application is not working, please come back later');
        }
    }

    public function updateReply(Request $request,$id)
    {
        $request->validate([
            'text' => 'required|max:255'
        ]);

        $updReply = new Comment();

        $updReply->com = $request->text;

        try{

            $updReply->updateReply($id);
            $data['msg'] = 'Successfull update';
            return $data;

        } catch (\Exception $e) {

            \Log::critical('Error updating comment '.$e->getMessage());
            return redirect()->back()->with('delete_error','Application is not working, please come back later');
        }

    }

}
