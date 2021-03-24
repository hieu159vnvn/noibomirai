<?php

/*
|--------------------------------------------------------------------------
| Contact Routes of Web Route
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
	Route::get('contacts','ContactController@getContacts');
	Route::get('contacts/{id}/delete','ContactController@getDeleteContact');

/*
 * Route for edit_tag.blade.php
*/	
	Route::get('contacts/{id}/edit','ContactController@getEditContact');
	// Route::post('contacts/{id}/edit','PostTagController@postEditPostTag');


});
