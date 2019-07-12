<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::pattern('id', '[0-9]+');
Route::pattern('user_id', '[0-9]+');
//FRONTEND
Route::get('/', "FrontEnd@index");
Route::get('/post/{id}/{user_id?}',"FrontEnd@single")->name('single_post');

//COMMENTS
Route::post('/post/{id}/comment','Comment@store')->name('sub_comment');
Route::get('/comment/{id}','Comment@destroy')->name('del_comment');
Route::put('/comment/{id}','Comment@update')->name('update_comment');

//REPLY
Route::post('/comment/{id}/reply','Comment@reply')->name('reply_comment');
Route::get('/reply/{id}','Comment@deleteReply')->name('reply_del');
Route::put('/reply/{id}','Comment@updateReply');

Route::get('/about', "FrontEnd@about");
Route::get('/search','FrontEnd@search');

//GALLERY
//gallery/create - pristup formi za unos
Route::resource('gallery','Gallery');

//CONTACT
Route::get('/contact', "Contact@index");
Route::post('/contact','Contact@send');

//REGISTRATION
Route::get('/registration', "Registration@index");
Route::post('/registration',"Registration@store");

//LOGIN
Route::get('/login', "Login@create");
Route::post('/login','Login@log');
Route::get('/logout','Login@logout');

//PROFILE
Route::get('/profile/{username}','Profile@index')->name('profile')->middleware('profile')->where('username','[A-Za-z0-9][A-Za-z0-9: _-]{1,19}');
Route::post('/profile/{id}','Profile@editPic')->name('edit_pic');
Route::post('/profile/{id}/edit','Profile@editProfile')->name('edit_profile');

//BACKEND

//admin/posts/create - pristup formi za unos

Route::group(['middleware' => ['admin']], function () {

    Route::resource('users','Admin\Users');
    Route::get("/users/{id}/delete",'Admin\Users@destroy');
    Route::resource('admin_gallery','Admin\Gallery');
    Route::get("/admin_gallery/{id}/delete",'Admin\Gallery@destroy');
    Route::resource('admin_news','Admin\Post');
    Route::get("/admin_news/{id}/delete",'Admin\Post@destroy');
    Route::resource('admin_category','Admin\Category');
    Route::get("/admin_category/{id}/delete",'Admin\Category@destroy');
    Route::resource('admin_video','Admin\Video');
    Route::get("/admin_video/{id}/delete",'Admin\Video@destroy');
    Route::get('/activities','Admin\Activities@index');
    Route::get('/activities/sort','Admin\Activities@sortByDate');



});








