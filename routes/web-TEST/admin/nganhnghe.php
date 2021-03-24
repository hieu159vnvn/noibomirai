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

	Route::get('nganhnghes','NganhNgheController@getNganhNghe');

	Route::get('nganhnghes/{id}/delete','NganhNgheController@getDeleteNganhNghe');

/*

 * Route for add

 

// */	

 	Route::get('nganhnghes/add','NganhNgheController@getAddNganhNghe');

 	Route::post('nganhnghes/add','NganhNgheController@postAddNganhNghe');

/*

 * Route for edit

*/	

	Route::get('nganhnghes/{id}/edit','NganhNgheController@getEditNganhNghe');

	Route::post('nganhnghes/{id}/edit','NganhNgheController@postEditNganhNghe');

	    //	

});

