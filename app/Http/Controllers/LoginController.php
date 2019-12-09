<?php

namespace NbaNews\Http\Controllers;

use NbaNews\Model\Activity;
use NbaNews\Model\Users;
use NbaNews\User;
use Illuminate\Http\Request;

class LoginController extends BaseContoller
{

    public function create()
    {
        return view('pages.login',$this->data);
    }

    public function store(Request $request)
    {
        $username = $request->username;
        $pass = $request->pass;
        $logObj = new Users();

        $log = $logObj->log($username,$pass);

        session(['user' => $log]);

        if(session('user')){
            $activities = new Activity;
            $activities->text = "Users ".session('user')->username." logged in";
            $activities->user_id = session('user')->UserId;
            $activities->save();
            return redirect('/')->with('login_success',"Welcome ".session('user')->username);
        }else {
            \Log::critical('Ip address '.$request->ip().', user not found');
            return redirect()->back()->with('login_error',"Users not found");
        }

    }

    public function destroy(){
            try{
                $activities = new Activity;
                $activities->text = "Users ".session('user')->username." logout.";
                $activities->user_id = session('user')->UserId;
                $activities->save();
            } catch (\Exception $e) {
                \Log::critical('Reply activities failed error'.$e->getMessage());
            }

        session()->flush();
        return redirect('/');
    }

}
