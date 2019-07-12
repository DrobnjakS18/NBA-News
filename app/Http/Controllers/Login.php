<?php

namespace App\Http\Controllers;

use App\Model\Users;
use App\User;
use Illuminate\Http\Request;

class Login extends BaseContoller
{

    public function create()
    {
        return view('pages.login',$this->data);
    }

    public function log(Request $request){

        $username = $request->username;
        $pass = $request->pass;
        $log_obj = new Users();

        $log = $log_obj->log($username,$pass);

        session(['user' => $log]);

        if(session('user')){

            $activities = new Users();
            $activities->user_id = session('user')->UserId;
            $activities->text = "User ".session('user')->username." logged in";

            $activities->insertActivities();

            return redirect('/')->with('login_success',"Welcome ".session('user')->username);
        }else {
            \Log::critical('Ip address '.$request->ip().', user not found');
            return redirect()->back()->with('login_error',"User not found");
        }

    }

    public function logout(){

            $activities = new Users();
            $activities->user_id = session('user')->UserId;
            $activities->text = "User ".session('user')->username." logout.";

            try{
                $activities->insertActivities();
            }
            catch(\Exception $e){

                \Log::critical('Reply activities failed error'.$e->getMessage());
            }


        session()->flush();
        return redirect('/');
    }

}
