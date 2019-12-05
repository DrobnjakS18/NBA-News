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

//FRONTEND
Route::get('/', "HomeController@index");
Route::get('/post/{id}/{userID?}',"HomeController@single")->name('single_post');
Route::get('/about', "HomeController@about");
Route::get('/search','HomeController@search');

Route::resource('comments','CommentController');

//COMMENTS
Route::post('/comment/{id}/reply','CommentCon@reply')->name('reply_comment');
Route::get('/reply/{id}','CommentCon@deleteReply')->name('reply_del');
Route::put('/reply/{id}','CommentCon@updateReply');

//GALLERY
Route::resource('gallery','GalleryController')->only(['index']);

//CONTACT
Route::get('/contact', "ContactController@index");
Route::post('/contact','ContactController@send');

//REGISTRATION
Route::get('/registration', "RegistrationController@index");
Route::post('/registration',"RegistrationController@store");

//LOGIN
Route::get('/login', "LoginController@create")->name('login.create');
Route::post('/login','LoginController@store')->name('login.store');
Route::get('/logout','LoginController@destroy')->name('login.destroy');

//PROFILE
Route::get('/profile/{username}','ProfileController@index')->name('profile')->middleware('profile')->where('username','[A-Za-z0-9][A-Za-z0-9: _-]{1,19}');
Route::post('/profile/{id}','ProfileController@editPic')->name('edit_pic');
Route::post('/profile/{id}/edit','ProfileController@editProfile')->name('edit_profile');

//BACKEND

//admin/posts/create - pristup formi za unos

Route::group(['middleware' => ['admin']], function () {

    Route::resource('users','Admin\UserController');
    Route::get("/users/{id}/delete",'Admin\UserController@destroy');

    Route::get('gallery/admin_gallery','GalleryController@admin_gallery')->name('admin_gallery');
    Route::resource('gallery','GalleryController')->except(['index']);

    Route::resource('admin_news','Admin\PostController');
    Route::get("/admin_news/{id}/delete",'Admin\PostController@destroy');

    Route::resource('admin_category','Admin\CategoryController');

    Route::resource('admin_video','Admin\VideoController');
    Route::get("/admin_video/{id}/delete",'Admin\VideoController@destroy');


    Route::get('/activities','Admin\ActivityController@index');
    Route::get('/activities/sort','Admin\ActivityController@sortByDate');
});








