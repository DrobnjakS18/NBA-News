<?php

namespace NbaNews\Http\Controllers;

use Illuminate\Http\Request;
use NbaNews\Model\Activity;
use NbaNews\Model\Comment;
use NbaNews\Model\Users;


class   CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'comment_area' => 'required|max:255'
        ]);

        $comment = new Comment;

        $comment->comment = $request->comment_area;
        $comment->post_id = $request->post_id;
        $comment->user_id = $request->user_id;

        if (session('user')) {
            $activities = new Users();
            $activities->user_id = session('user')->UserId;
            $activities->text = "User".session('user')->username." commented ".$request->comment_area;

            try{
                $comment->save();
                return redirect()->back()->with('sub_comment_success','Thanks for commenting');
            }
            catch(\Exception $e){
                \Log::info('CommentCon insert failed error'.$e->getMessage());
                dd($e->getMessage());
                return redirect()->back()->with('show_error','Application is not working, please come back later');
            }
        } else {
            return redirect()->back()->with('show_error','Application is not working, please come back later');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        dd($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'update_field' => 'required|max:255'
        ]);

        try{
            $update_comment = Comment::find($id);
            $update_comment->comment = $request->update_field;

            $update_comment->save();
            return redirect()->back()->with('sub_comment_success','Comment updated');

        } catch (\Exception $e) {
            \Log::critical('Error updating comment '.$e->getMessage());
            return redirect()->back()->with('show_error','Application is not working, please come back later');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        try{
            $activities = new Activity;
            $activities->user_id = session('user')->UserId;
            $activities->text = "Users ".session('user')->username." deleted his comment ";
            $activities->save();
        } catch (\Exception $e) {
            \Log::critical('Reply activities failed error'.$e->getMessage());
        }

        try{
            Comment::destroy($id);
            return redirect()->back();
        } catch (\Exception $e) {
            \Log::info('Error deleting comment '.$e->getMessage());
//            dd($e->getMessage());
            return redirect()->back()->with('delete_error','Application is not working, please come back later');
        }
    }
}
