<?php
/**
 * Created by PhpStorm.
 * Users: DrobnjakS
 * Date: 3/1/2019
 * Time: 12:51 AM
 */

namespace NbaNews\Model;

use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
    public $id;
    public $first;
    public $last;
    public $picture;
    public $email;
    public $username;
    public $pass;
    public $role_id;

    public $text;
    public $user_id;

//    public function comments()
//    {
//        return $this->belongsToMany('NbaNews\Model\Comment');
//    }

    public function roles()
    {
        return $this->belongsTo('NbaNews\Model\Role','role_id');
    }


    public  function reg(){
        \DB::table('users')
            ->insert(
                ['first_name' => $this->first,'last_name' => $this->last,'profile_pic' =>'images/profile_pic/Default_profile_picture.jpg','email'=>$this->email,
                    'username' => $this->username,'password'=>md5($this->pass),'role_id' => $this->role_id]
            );
    }

    public  function  deleteUser(){

        \DB::transaction(function () {

            \DB::table('comments')
                ->where('id_u',$this->id)
                ->delete();

            \DB::table('subcommnets')
                ->where('id_user',$this->id)
                ->delete();

            \DB::table('activities')
                ->where('user_id',$this->id)
                ->delete();

            \DB::table('visitors_post')
                ->where('id_u',$this->id)
                ->delete();

            \DB::table('users')
                ->where('id',$this->id)
                ->delete();

        });
    }

    public function updateUserAll($id){

        \DB::table('users')
            ->where('id',$id)
            ->update([
                'first_name' => $this->first,
                'last_name' => $this->last,
                'profile_pic' => $this->picture,
                'email' => $this->email,
                'username' => $this->username,
                'password' => md5($this->pass),
                'role_id' => $this->role_id,
            ]);
    }

    public function updateUserNoPicPassword($id){

        \DB::table('users')
            ->where('id',$id)
            ->update([
                'first_name' => $this->first,
                'last_name' => $this->last,
                'email' => $this->email,
                'username' => $this->username,
                'role_id' => $this->role_id,
            ]);
    }

    public function updateUserNoPic($id){

        \DB::table('users')
            ->where('id',$id)
            ->update([
                'first_name' => $this->first,
                'last_name' => $this->last,
                'email' => $this->email,
                'username' => $this->username,
                'password' => md5($this->pass),
                'role_id' => $this->role_id,
            ]);

    }
    public function updateUserNoPass($id){

        \DB::table('users')
            ->where('id',$id)
            ->update([
                'first_name' => $this->first,
                'last_name' => $this->last,
                'email' => $this->email,
                'username' => $this->username,
                'profile_pic' => $this->picture,
                'role_id' => $this->role_id,
            ]);
    }



    public function log($user,$pass){

        return \DB::table('users as us')
            ->select('*','us.id as UserId')
            ->join('role as r','us.role_id','=','r.id')
            ->where([
                ['username',$user],
                ['password',md5($pass)]
            ])
            ->first();


    }


    public function filterDate($date){

        return \DB::table('activities')
            ->where('day',$date)
            ->get();
    }


    public function getAll(){

        return \DB::table('users as us')
            ->select('*','us.id as UserId')
            ->join('role as r','us.role_id','=','r.id_role')
            ->get();
    }

    public  function  getOne($id){

        return \DB::table('users')
            ->select('*','users.id as UserId')
            ->join('role','users.role_id','=','role.id_role')
            ->where("users.id",$id)
            ->first();
    }


}
