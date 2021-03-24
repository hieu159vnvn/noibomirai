<?php

/*
|--------------------------------------------------------------------------
| Post Tag Routes of Web Route
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware(['auth'])->prefix('admin-dashboard')->namespace('Admin')->group(function () {
/*
 * Route for tag.blade.php
*/
	Route::get('posttags','PostTagController@getPostTags');
	Route::get('posttags/{id}/delete','PostTagController@getDeletePostTag');
/*
 * Route for add_tag.blade.php
*/	
	Route::get('posttags/add','PostTagController@getAddPostTag');
	Route::post('posttags/add','PostTagController@postAddPostTag');
/*
 * Route for edit_tag.blade.php
*/	
	Route::get('posttags/{id}/edit','PostTagController@getEditPostTag');
	Route::post('posttags/{id}/edit','PostTagController@postEditPostTag');


});
