<?php

namespace NbaNews\Http\Controllers;

use Illuminate\Http\Request;
use NbaNews\Model\Activity;
use NbaNews\Model\Comment;
use NbaNews\Model\Reply;
use NbaNews\Model\Users;

class ReplyController extends Controller
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
            'text_rep' => 'required|max:255'
        ]);

        if(session('user')){
            try{
                $activities = new Activity;
                $activities->user_id = $request->user_id;
                $activities->text = "Users ".session('user')->username." reply ".$request->text_rep;

                $activities->save();
            } catch (\Exception $e) {
                \Log::critical('Reply activities failed error'.$e->getMessage());
            }
        }

        try{
            $replay = new Reply;

            $replay->reply = $request->text_rep;
            $replay->comment_id = $request->comment_id;
            $replay->user_id = $request->user_id;
            $replay->save();
            return redirect()->back();
        } catch (\Exception $e) {
            \Log::critical('CommentCon inser failed error'.$e->getMessage());
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
        //
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
        //
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
            Reply::destroy($id);
            return redirect()->back()->with('success_reply_delete','Reply succesfully deleted');
        } catch (\Exception $e) {
            \Log::critical('Error deleting comment '.$e->getMessage());
            return redirect()->back()->with('show_error','Application is not working, please come back later');
        }
    }
}
