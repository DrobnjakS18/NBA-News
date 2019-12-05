<?php

namespace NbaNews\Http\Controllers\Admin;

use NbaNews\Http\Controllers\BaseContoller;
use Illuminate\Http\Request;
use NbaNews\Http\Controllers\Controller;
use NbaNews\Model\Category;

class CategoryController extends BaseContoller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $this->data['category'] = Category::all();

        return view('admin.pages.categories',$this->data);

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

            'title' => 'required|min:2',
        ]);
        $insert_cat = new Category;

        try{
            $insert_cat->name = $request->title;
            $insert_cat->save();

            return redirect()->back()->with('insert_category_success','You successfully inserted a category');
        }catch(\Exception $e){
            \Log::critical('Failed to insert gallery picture error: '.$e->getMessage());

            return redirect()->back()->with('insert_category_error','Application is not working, please come back later');
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
        $this->data['single_category'] = Category::find($id);

        return view('admin.update.update_category',$this->data);
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
            'title' => 'required|min:2',
        ]);

        try{
            $update_category = Category::find($id);

            $update_category->name = $request->title;

            $update_category->save();

            return redirect('/admin_category')->with('update_category_success','You successfully update a category');
        }catch(\Exception $e){
            \Log::critical('Failed to insert gallery picture error: '.$e->getMessage());
            return redirect('/admin_category')->with('update_category_error','Application is not working, please come back later');
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
            Category::destroy($id);

            return response()->json([
                'success' => 'Record has been deleted successfully via ajax! Please refresh the page'
            ]);
        }catch(\Exception $e){

            \Log::critical('Delete user failed'.$e->getMessage());
        }
    }
}
