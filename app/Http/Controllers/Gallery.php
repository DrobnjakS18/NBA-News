<?php

namespace App\Http\Controllers;

use App\Model\Gallery_modul;
use App\Resize_picture;
use Illuminate\Http\Request;

class Gallery extends BaseContoller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $gallery = new Gallery_modul();

        $this->data['gallery'] = $gallery->getAllGallery();
        return view('pages.gallery',$this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.create_gallery');
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

            'title' => 'required|min:2',
            'gallery_pic' => 'file|mimes:jpg,jpeg,png|max:2000|required'
        ]);

        $gallery = new Gallery_modul();

        $gallery->name = $request->title;

        $file = $request->file('gallery_pic');

        $fileName = $file->getClientOriginalName();
        $fileName = time().$fileName;

        try{

            $file->move(public_path('images/gallery'),$fileName);
            $resize = new Resize_picture();

            //
            $resize->malaSlika(public_path('images/gallery').'\\'.$fileName,public_path('images/small_images').'\\small_'.$fileName,100,70);

            $picture = 'images/gallery/'.$fileName;
            $small_picture = 'images/small_images/small_'.$fileName;

            $gallery->picture = $picture;
            $gallery->picture_small = $small_picture;
            $gallery->alt = $file->getClientOriginalName();

            $gallery->insertGalleryPic();

            return redirect()->back()->with('insert_gallery_success','You successfully inserted a picture');
        }catch (\Exception $e){

            \Log::info('Failed to insert gallery picture error: '.$e->getMessage());
            return redirect()->back()->with('insert_gallery_error','Application is not working, please come back later');
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
        //
    }
}
