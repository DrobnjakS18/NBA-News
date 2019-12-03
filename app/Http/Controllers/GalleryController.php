<?php

namespace NbaNews\Http\Controllers;

use NbaNews\Model\Gallery_model;
use NbaNews\Resize_picture;
use Illuminate\Http\Request;

class GalleryController extends BaseContoller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->data['gallery'] = Gallery_model::all();

        return view('pages.gallery',$this->data);
    }

    public function admin_gallery()
    {
        $this->data['gallery'] = Gallery_model::all();

        return view('admin.pages.gallery',$this->data);
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
            'picture' => 'file|mimes:jpg,jpeg,png|max:2000|required'
        ]);

        $gallery = new Gallery_model;

        $gallery->title = $request->title;
        $file = $request->file('picture');
        $fileName = $file->getClientOriginalName();
        $fileName = time().$fileName;

            try{
                $file->move(public_path('images/gallery'),$fileName);
                $resize = new Resize_picture();

                $resize->malaSlika(public_path('images/gallery').'/'.$fileName,public_path('images/small_images').'/small_'.$fileName,100,70);

                $picture = 'images/gallery/'.$fileName;
                $smallPicture = 'images/small_images/small_'.$fileName;

                $gallery->picture_path = $picture;
                $gallery->small_path = $smallPicture;
                $gallery->alt = $file->getClientOriginalName();

                $gallery->save();
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
        $this->data['one_pic'] = Gallery_model::find($id);
        return view('admin.update.update_gallery',$this->data);
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
        $gallery = Gallery_model::find($id);

        if($request->picture == null){
            $request->validate([
                'title' => 'required|min:2',
            ]);
                try {
                    $gallery->title = $request->title;
                    $gallery->save();
                    return redirect('/gallery/admin_gallery')->with('update_gallery_success',"You successfully update picture ");

                } catch (\Exception $e) {
                    \Log::critical('Update user failed'.$e->getMessage());
                    return redirect('/gallery/admin_gallery')->with('update_gallery_error',"Application is not working, please come back later");
                }

        } else {
            $request->validate([
                'title' => 'required|min:2',
                'picture' => 'file|mimes:jpg,jpeg,png|max:2000|required'
            ]);

            $gallery->title = $request->title;

            $file = $request->file('picture');

            $fileName = $file->getClientOriginalName();

            $fileName = time().$fileName;
            try{
                $file->move(public_path('images/gallery'),$fileName);
                $resize = new Resize_picture();
                $resize->malaSlika(public_path('images/gallery').'/'.$fileName,public_path('images/small_images').'/small_'.$fileName,100,70);
                $picture = 'images/gallery/'.$fileName;
                $small_picture = 'images/small_images/small_'.$fileName;

                $gallery->picture_path = $picture;
                $gallery->small_path = $small_picture;
                $gallery->alt = $file->getClientOriginalName();

                $gallery->save();

                return redirect('/gallery/admin_gallery')->with('update_gallery_success',"You successfully update picture ");
            }catch (\Exception $e) {
                \Log::critical('Failed to insert gallery picture error: '.$e->getMessage());
                echo $e->getMessage();
                    return redirect('/gallery/admin_gallery')->with('update_gallery_error',"Application is not working, please come back later");
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
           Gallery_model::destroy($id);
        }catch(\Exception $e){
            \Log::critical('Delete user failed'.$e->getMessage());
        }
    }
}
