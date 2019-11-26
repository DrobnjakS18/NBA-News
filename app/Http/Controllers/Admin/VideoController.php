<?php

namespace NbaNews\Http\Controllers\Admin;

use NbaNews\Http\Controllers\BaseContoller;
use NbaNews\Model\VideoModel;
use Illuminate\Http\Request;
use NbaNews\Http\Controllers\Controller;

class VideoController extends BaseContoller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $video = new VideoModel();

        $this->data['video'] = $video->getAllVideos();


        return view('admin.pages.video',$this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.create_video');
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
            'title' =>'required|min:3|max:255',
            'video_url' => 'required|url|max:255'
        ]);

         $replaced = \Str::replaceArray('watch?v=',['embed/'],$request->video_url);


         $video = new VideoModel();

         $video->title = $request->title;
         $video->url = $replaced;

         try{
             $video->insertVideo();

             return redirect()->back()->with('insert_video_success','You have successfully inserted a new video');

         }catch(\Exception $e){

             \Log::critical('Insert VideoController error '.$e->getMessage());
             return redirect()->back()->with('insert_video_error','Application is not working, please come back later');
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
        $one_video = new VideoModel();

        $this->data['one_video'] = $one_video->getOne($id);

        return view('admin.update.update_video',$this->data);
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
            'title' =>'required|min:3|max:255',
            'video_url' => 'required|url|max:255'
        ]);


        $update_video = new VideoModel();

        $update_video->title = $request->title;
        $update_video->url = $request->video_url;

        try{
            $update_video->updateVideo($id);

            return redirect('/admin_video')->with('update_video_success','You have successfully update a new video');

        }catch(\Exception $e){

            \Log::critical('Insert VideoController error '.$e->getMessage());
            return redirect('/admin_video')->with('update_video_error','Application is not working, please come back later');
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
        $delete_video = new VideoModel();

        try{
            $delete_video->id = $id;

            $delete_video->deleteVideo();


        }catch(\Exception $e){

            \Log::critical('Delete user failed'.$e->getMessage());
        }
    }
}
