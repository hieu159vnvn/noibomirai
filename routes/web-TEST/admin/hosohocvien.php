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

	Route::get('hosohocviens','HoSoHocVienController@getHoso');
	Route::get('hosohocviens/{id}/delete','HoSoHocVienController@getDeleteHoso');

/*

 * Route for add

 

// */	

 	Route::get('hosohocviens/add','HoSoHocVienController@getAddHoso');

 	Route::post('hosohocviens/add','HoSoHocVienController@postAddHoso');

/*

 * Route for edit

*/	Route::get('hosohocviens/{id}/show','HoSoHocVienController@getShowHoso');

	Route::get('hosohocviens/{id}/edit','HoSoHocVienController@getEditHoso');

	Route::post('hosohocviens/{id}/edit','HoSoHocVienController@postEditHoso');

	Route::get('hosohocviens/{id}/tran','HoSoHocVienController@getTranHoso');

	Route::post('hosohocviens/{id}/tran','HoSoHocVienController@postTranHoso');



	Route::get('hosohocviens/export','HoSoHocVienController@export');
	Route::get('hosohocviens/pdf','HoSoHocVienController@pdf');



	Route::post('api/modal','HoSoHocVienController@postModal');

	    //	

});

