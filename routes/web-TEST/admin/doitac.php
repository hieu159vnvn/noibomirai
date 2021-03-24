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

	Route::get('doitacs','DoiTacController@getDoiTac');

	Route::get('doitacs/{id}/delete','DoiTacController@getDeleteDoiTac');

/*

 * Route for add

 

// */	

 	Route::get('doitacs/add','DoiTacController@getAddDoiTac');

 	Route::post('doitacs/add','DoiTacController@postAddDoiTac');

/*

 * Route for edit

*/	

	Route::get('doitacs/{id}/edit','DoiTacController@getEditDoiTac');

	Route::post('doitacs/{id}/edit','DoiTacController@postEditDoiTac');



	Route::get('doitacs/export','DoiTacController@export');

	    //	

});

