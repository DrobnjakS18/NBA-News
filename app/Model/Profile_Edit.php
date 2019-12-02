<?php
/**
 * Created by PhpStorm.
 * Users: DrobnjakS
 * Date: 3/5/2019
 * Time: 7:16 PM
 */

namespace NbaNews\Model;

use Illuminate\Database\Eloquent\Model;

class Profile_Edit
{

    public $id;
    public $picture;
    public $first;
    public $last;
    public $email;
    public $username;


    public function EditPicture(){

        \DB::table('users')
            ->where('id',$this->id)
            ->update([
                'profile_pic' => $this->picture
            ]);


    }


    public function EditProfile(){

        \DB::table('users')
            ->where('id',$this->id)
            ->update([
                'first_name' => $this->first,
                'last_name' => $this->last,
                'email' => $this->email,
                'username' => $this->username
            ]);

    }




}
