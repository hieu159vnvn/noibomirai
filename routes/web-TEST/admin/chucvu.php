<?php



/*

|--------------------------------------------------------------------------

| Product Routes of Web Route

|--------------------------------------------------------------------------

|

| Here is where you can register web routes for your application. These

| routes are loaded by the RouteServiceProvider within a group which

| contains the "web" middleware group. Now create something great!

|

*/



Route::middleware(['auth'])->prefix('admin-dashboard')->namespace('Admin')->group(function () {	

/*

 * Route for hosohocvien.blade.php

*/

	//web route

	Route::get('chucvus','ChucvuController@getChucVu');

	Route::get('chucvus/{id}/delete','ChucvuController@getDeleteChucVu');

/*

 * Route for add

 

// */	

 	Route::get('chucvus/add','ChucvuController@getAddChucVu');

 	Route::post('chucvus/add','ChucvuController@postAddChucVu');

/*

 * Route for edit

*/	

	Route::get('chucvus/{id}/edit','ChucvuController@getEditChucVu');

	Route::post('chucvus/{id}/edit','ChucvuController@postEditChucVu');

	    //	

});

