<?php

namespace NbaNews\Http\Controllers\Admin;

use NbaNews\Http\Controllers\BaseContoller;
use NbaNews\User;
use Illuminate\Http\Request;
use NbaNews\Http\Controllers\Controller;

class UserController extends BaseContoller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = new \NbaNews\Model\Users();

        $this->data['users'] = $users->getAll();

        $this->data['role'] = $users->roles();

        return view('admin.pages.home',$this->data);
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

            'firstName' => 'required|regex:/^[A-ZČĆŠĐŽ][a-zčćšđž]{2,19}$/',
            'LastName' => 'required|regex:/^[A-ZČĆŠĐŽ][a-zčćšđž]{2,19}$/',
            'email' => 'required|email|unique:users,email',
            'username' => 'required|regex:/^[A-Za-z0-9][A-Za-z0-9: _-]{1,19}$/|unique:users,username',
            'password' => 'required|regex:/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{4,}$/',
            'role' => 'required'
        ]);


        $reg = new \NbaNews\Model\Users();
        $reg->first = $request->firstName;
        $reg->last = $request->LastName;
        $reg->email = $request->email;
        $reg->username = $request->username;
        $reg->pass = $request->password;
        $reg->role_id = $request->role;

        try{

            $reg->reg();
            return redirect()->back()->with('insert_user_success',"You successfully inserted new user");

        }catch(\Exception $e){

            \Log::critical('Registratin failed'.$e->getMessage());
            return redirect()->back()->with('insert_user_error',"Application is not working, please come back later");
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


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {



        $users = new \NbaNews\Model\Users();

        $this->data['role'] = $users->roles();

        try {

            $this->data['role'] = $users->roles();

            $this->data['one_user'] =  $users->getOne($id);


            return view('admin.update.update_form',$this->data);

        } catch (\Exception $e){

            \Log::critical('Registratin failed'.$e->getMessage());
            return redirect()->back()->with('insert_user_error',"Application is not working, please come back later");
        }

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

        $update_user = new \NbaNews\Model\Users();

        if($request->password == null && $request->picture == null){

            $request->validate([

                'firstName' => 'required|regex:/^[A-ZČĆŠĐŽ][a-zčćšđž]{2,19}$/',
                'LastName' => 'required|regex:/^[A-ZČĆŠĐŽ][a-zčćšđž]{2,19}$/',
                'email' => 'required|email|',
                'username' => 'required|regex:/^[A-Za-z0-9][A-Za-z0-9: _-]{1,19}$/',
                'role' => 'required'
            ]);

            $update_user->first = $request->firstName;
            $update_user->last = $request->LastName;
            $update_user->email = $request->email;
            $update_user->username = $request->username;
            $update_user->role_id = $request->role;



            try{

                $update_user->updateUserNoPicPassword($id);
                return redirect('/users')->with('update_user_success',"You successfully update user information ");

            }catch(\Exception $e){

                \Log::critical('Update user failed'.$e->getMessage());
                return redirect('/users')->with('update_user_error',"Application is not working, please come back later");
            }


        }elseif($request->picture == null){

            $request->validate([

                'firstName' => 'required|regex:/^[A-ZČĆŠĐŽ][a-zčćšđž]{2,19}$/',
                'LastName' => 'required|regex:/^[A-ZČĆŠĐŽ][a-zčćšđž]{2,19}$/',
                'email' => 'required|email|',
                'username' => 'required|regex:/^[A-Za-z0-9][A-Za-z0-9: _-]{1,19}$/',
                'password' => 'required|regex:/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{4,}$/',
                'role' => 'required'
            ]);

            $update_user->first = $request->firstName;
            $update_user->last = $request->LastName;
            $update_user->email = $request->email;
            $update_user->username = $request->username;
            $update_user->pass = $request->password;
            $update_user->role_id = $request->role;


            try{

                $update_user->updateUserNoPic($id);
                return redirect('/users')->with('update_user_success',"You successfully update user information");

            }catch(\Exception $e){

                \Log::critical('Update user failed'.$e->getMessage());
                return redirect('/users')->with('update_user_error',"Application is not working, please come back later");
            }



        }elseif($request->password == null){

            $request->validate([

                'firstName' => 'required|regex:/^[A-ZČĆŠĐŽ][a-zčćšđž]{2,19}$/',
                'LastName' => 'required|regex:/^[A-ZČĆŠĐŽ][a-zčćšđž]{2,19}$/',
                'email' => 'required|email|',
                'username' => 'required|regex:/^[A-Za-z0-9][A-Za-z0-9: _-]{1,19}$/',
                'picture' => 'required|file|mimes:jpg,jpeg,png|max:2000',
                'role' => 'required'
            ]);

            $update_user->first = $request->firstName;
            $update_user->last = $request->LastName;
            $update_user->email = $request->email;
            $update_user->username = $request->username;
            $update_user->role_id = $request->role;

            $pic = $request->file('picture');

            $picName = $pic->getClientOriginalName();
            $picName = time().$picName;


            try{

                $pic->move(public_path('images/profile_pic'),$picName);

                $update_user->picture = 'images/profile_pic/'.$picName;

                $update_user->updateUserNoPass($id);
                return redirect('/users')->with('update_user_success',"You successfully update user information");

            }catch(\Exception $e){

                \Log::critical('Update user failed'.$e->getMessage());
                return redirect('/users')->with('update_user_error',"Application is not working, please come back later");
            }


        }else{

            $request->validate([

                'firstName' => 'required|regex:/^[A-ZČĆŠĐŽ][a-zčćšđž]{2,19}$/',
                'LastName' => 'required|regex:/^[A-ZČĆŠĐŽ][a-zčćšđž]{2,19}$/',
                'email' => 'required|email|',
                'username' => 'required|regex:/^[A-Za-z0-9][A-Za-z0-9: _-]{1,19}$/',
                'password' => 'required|regex:/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{4,}$/',
                'picture' => 'required|file|mimes:jpg,jpeg,png|max:2000',
                'role' => 'required'
            ]);

            $update_user->first = $request->firstName;
            $update_user->last = $request->LastName;
            $update_user->email = $request->email;
            $update_user->username = $request->username;
            $update_user->pass = $request->password;
            $update_user->role_id = $request->role;

            $pic = $request->file('picture');

            $picName = $pic->getClientOriginalName();
            $picName = time().$picName;

            try{

                $pic->move(public_path('images/profile_pic'),$picName);

                $update_user->picture = 'images/profile_pic/'.$picName;

                $update_user->updateUserAll($id);
                return redirect('/users')->with('update_user_success',"You successfully update user information");

            }catch(\Exception $e){

                \Log::critical('Update user failed'.$e->getMessage());
                return redirect('/users')->with('update_user_error',"Application is not working, please come back later");
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

        $delete_user = new \NbaNews\Model\Users();


        try{
            $delete_user->id = $id;

            $delete_user->deleteUser();


        }catch(\Exception $e){

            \Log::critical('Delete user failed'.$e->getMessage());
        }
    }
}
