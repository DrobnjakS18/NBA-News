<?php

namespace NbaNews\Http\Controllers\Admin;

use NbaNews\Http\Controllers\BaseContoller;
use NbaNews\Http\Requests\PostRequest;
use NbaNews\Model\Category;
use NbaNews\Model\Post;
use NbaNews\Resize_picture;
use Illuminate\Http\Request;
use NbaNews\Http\Controllers\Controller;

class PostController extends BaseContoller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = new Post();

        $this->data['news'] = Post::all();

        $this->data['category'] = Category::all();

        return view('admin.pages.news',$this->data);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->data['category'] = Category::all();
        return view('admin.create_post',$this->data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {

        $file = $request->file('picture');

        $fileName = $file->getClientOriginalName();
        $alt = $fileName;
        $fileName = time().$fileName;

        $picture = 'images/'.$fileName;


        $headline = $request->title;

        $text = $request->text;

        $cat = $request->catId;

        try{
            $file->move(public_path('images'),$fileName);

            $resize = new Resize_picture();

            //
            $resize->malaSlika(public_path('images').'\\'.$fileName,public_path('images\small_images').'\\small_'.$fileName,100,70);

            $small_picture = 'images/small_images/small_'.$fileName;

            $insert = new Post();

            $insert->picture = $picture;
            $insert->small_picture = $small_picture;
            $insert->alt = $alt;
            $insert->headline = $headline;
            $insert->text = $text;
            $insert->catId = $cat;



            $insert->insertPost();

            return redirect()->back()->with('insert_post_success','You successfully inserted a post');

        }catch(\Exception $e){

            \Log::critical('Failed to insert gallery picture error: '.$e->getMessage());
            return redirect()->back()->with('insert_post_error','Application is not working, please come back later');
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
        $this->data['one_post'] = Post::find($id);
        $this->data['category'] = Category::all();

        return view('admin.update.update_news',$this->data);
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

        if($request->picture == null){

            $request->validate([
                'title' => 'required|max:140|min:3',
                'text' => 'required|min:3',
                'catId' => 'required'
            ]);


            $update_news = new Post();


            $update_news->headline = $request->title;

            $update_news->text = $request->text;

            $update_news->catId = $request->catId;


            try{

                $update_news->updatePostNoPic($id);
                return redirect('/admin_news')->with('update_news_success',"You successfully update news ");

            }catch(\Exception $e){

                \Log::critical('Update user failed'.$e->getMessage());
                return redirect('/admin_gallery')->with('update_news_error',"Application is not working, please come back later");
            }




        }else{

            $request->validate([
                'title' => 'required|max:140|min:3',
                'picture' => 'required|file|mimes:jpg,jpeg,png|max:2000',
                'text' => 'required|min:3',
                'catId' => 'required'
            ]);


            $update_all = new Post();
            $file = $request->file('picture');

            $fileName = $file->getClientOriginalName();
            $alt = $fileName;
            $fileName = time().$fileName;


            $picture = 'images/'.$fileName;


            $headline = $request->title;

            $text = $request->text;

            $cat = $request->catId;



            try{
                $file->move(public_path('images'),$fileName);

                $resize = new Resize_picture();

                //
                $resize->malaSlika(public_path('images').'\\'.$fileName,public_path('images\small_images').'\\small_'.$fileName,100,70);

                $small_picture = 'images/small_images/small_'.$fileName;



                $update_all->picture = $picture;
                $update_all->small_picture = $small_picture;
                $update_all->alt = $alt;
                $update_all->headline = $headline;
                $update_all->text = $text;
                $update_all->catId = $cat;

                $update_all->updatePostAll($id);

                return redirect('/admin_news')->with('update_news_success',"You successfully update news");

            }catch(\Exception $e){

                \Log::critical('Failed to insert gallery picture error: '.$e->getMessage());
                return redirect('/admin_news')->with('update_news_error',"Application is not working, please come back later");
            }



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
            Post::destroy($id);

            return response()->json([
                'success' => 'Record has been deleted successfully via ajax! Please refresh the page'
            ]);
        }catch(\Exception $e){

            \Log::critical('Delete post failed'.$e->getMessage());
        }
    }
}
