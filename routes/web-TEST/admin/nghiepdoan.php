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

	Route::get('nghiepdoans','NghiepDoanController@getNghiepDoan');

	Route::get('nghiepdoans/{id}/delete','NghiepDoanController@getDeleteNghiepDoan');

/*

 * Route for add

 

// */	

 	Route::get('nghiepdoans/add','NghiepDoanController@getAddNghiepDoan');

 	Route::post('nghiepdoans/add','NghiepDoanController@postAddNghiepDoan');

/*

 * Route for edit

*/	

	Route::get('nghiepdoans/{id}/edit','NghiepDoanController@getEditNghiepDoan');

	Route::post('nghiepdoans/{id}/edit','NghiepDoanController@postEditNghiepDoan');


	    //	

});

