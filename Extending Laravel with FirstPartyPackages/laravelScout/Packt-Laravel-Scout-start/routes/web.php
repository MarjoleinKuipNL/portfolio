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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('/posts', 'PostController');

Route::get('login/{provider}', 'Auth\SocialAccountController@redirectToProvider');
Route::get('login/{provider}/callback', 'Auth\SocialAccountController@handleProviderCallback');

// show new post form
Route::get('new-post', 'PostController@create');
// save new post
Route::post('new-post', 'PostController@store');
// edit post form
Route::get('edit/{slug}', 'PostController@edit');
// update post
Route::post('update', 'PostController@update');
// delete post
Route::get('delete/{id}', 'PostController@destroy');
// display user's all posts
Route::get('my-all-posts', 'UserController@user_posts_all');
// display user's drafts
Route::get('my-drafts', 'UserController@user_posts_draft');
// add comment
Route::post('comment/add', 'CommentController@store');
// delete comment
Route::post('comment/delete/{id}', 'CommentController@distroy');
