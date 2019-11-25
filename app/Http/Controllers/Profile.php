<?php

namespace NbaNews\Http\Controllers;

use NbaNews\Model\Posts;
use NbaNews\Model\Profile_Edit;
use Illuminate\Http\Request;

class Profile extends BaseContoller
{


    public function index($username)
    {
        $commented_posts = new Posts();

        $this->data['commmented_views'] = $commented_posts->AllPostByComments($username);

        return view('pages.profile', $this->data);
    }

    public function editPic(Request $request, $id)
    {

         $request->validate([
            'edit_picture' => 'required|file|mimes:jpg,jpeg,png|max:2000'
         ]);

         $pic = $request->file('edit_picture');

         $picName = $pic->getClientOriginalName();
         $picName = time().$picName;


         try{
          $pic->move(public_path('images/profile_pic'),$picName);

             $pic_name = 'images/profile_pic/'.$picName;
             $user = new Profile_Edit();

             $user->id = $id;
             $user->picture = $pic_name;
             $user->EditPicture();

             return redirect()->back()->with('success_edit','Successfully edit profile picture');
         } catch (\Exception $e) {
             \Log::critical('Failed to edit picture error '.$e->getMessage());
             return redirect()->back()->with('failed_edit','Application is not working, please come back later');
         }

    }
    public function editProfile(Request $request, $id) {

        $request->validate([

            'first_name' => 'required|regex:/^[A-ZČĆŠĐŽ][a-zčćšđž]{2,19}$/',
            'last_name' => 'required|regex:/^[A-ZČĆŠĐŽ][a-zčćšđž]{2,19}$/',
            'email' => 'required|email',
            'username' => 'required|regex:/^[A-Za-z0-9][A-Za-z0-9: _-]{1,19}$/',
        ]);

        $update = new Profile_Edit();

        $update->id = $id;
        $update->first = $request->first_name;
        $update->last = $request->last_name;
        $update->email = $request->email;
        $update->username = $request->username;


          try{
              $update->EditProfile();

              $date['msg'] = 'Successfull update';
              return $date;

//              return redirect()->back()->with('success_edit','Successfully edit profile info');
          } catch (\Exception $e) {
                \Log::critical('Failed to edit account settings error'.$e->getMessage());
          }

    }







}
