<?php

namespace NbaNews\Http\Controllers;

use Illuminate\Http\Request;
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

        $comment->com = $request->comment_area;
        $comment->id_p = $request->post_id;
        $comment->id_u = $request->user_id;

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
        dd($id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete = new Comment();

        $delete->id = $id;

        $activities = new Users();
        $activities->user_id = session('user')->UserId;
        $activities->text = "Users ".session('user')->username." deleted his comment ";

        try{
            $activities->insertActivities();
        } catch (\Exception $e) {

            \Log::critical('Reply activities failed error'.$e->getMessage());
        }

        try{
            $delete->deleteComment();

            return redirect()->back();
        } catch (\Exception $e) {

            \Log::info('Error deleting comment '.$e->getMessage());
            return redirect()->back()->with('delete_error','Application is not working, please come back later');
        }
    }
}
