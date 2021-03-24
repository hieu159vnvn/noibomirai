<?php

/*
|--------------------------------------------------------------------------
| Post Routes of Web Route
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware(['auth'])->prefix('admin-dashboard')->namespace('Admin')->group(function () {	
/*
 * Route for post.blade.php
*/
	//ajax route
	Route::post('posts/changestatus','PostController@postChangePostStatus');
	//web route
	Route::get('posts','PostController@getPosts');
	Route::get('posts/{id}/delete','PostController@getDeletePost');
/*
 * Route for add_post.blade.php
// */	
 	Route::get('posts/add','PostController@getAddPost');
 	Route::post('posts/add','PostController@postAddPost');
/*
 * Route for edit_post.blade.php
*/	
	Route::get('posts/{id}/edit','PostController@getEditPost');
	Route::post('posts/{id}/edit','PostController@postEditPost');
	
});
