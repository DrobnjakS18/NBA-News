<?php

namespace NbaNews\Http\Controllers;

use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use NbaNews\Model\Users;

class Registration extends BaseContoller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.registration',$this->data);
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

            'first' => 'required|regex:/^[A-ZČĆŠĐŽ][a-zčćšđž]{2,19}$/',
            'last' => 'required|regex:/^[A-ZČĆŠĐŽ][a-zčćšđž]{2,19}$/',
            'email' => 'required|email|unique:users,email',
            'username' => 'required|regex:/^[A-Za-z0-9][A-Za-z0-9: _-]{1,19}$/|unique:users,username',
            'pass' => 'required|regex:/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{4,}$/'
        ]);

        $reg = new Users();
        $reg->first = $request->first;
        $reg->last = $request->last;
        $reg->email = $request->email;
        $reg->username = $request->username;
        $reg->pass = $request->pass;
        $reg->role_id = 2;

        try{
            $reg->reg();
            return redirect('/login')->with('reg_success',"You successfully registered. Please login");
        }
        catch(QueryException $e){

            \Log::critical('Registratin failed'.$e->getMessage());
            return redirect()->back()->with('reg_error',"Registration failed, please come back later");
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
