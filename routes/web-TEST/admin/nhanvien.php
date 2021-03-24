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

	Route::get('nhanviens','NhanVienController@getNhanVien');

	Route::get('nhanviens/{id}/delete','NhanVienController@getDeleteNhanVien');

/*

 * Route for add

 

// */	

 	Route::get('nhanviens/add','NhanVienController@getAddNhanVien');

 	Route::post('nhanviens/add','NhanVienController@postAddNhanVien');

/*

 * Route for edit

*/	

	Route::get('nhanviens/{id}/edit','NhanVienController@getEditNhanVien');

	Route::post('nhanviens/{id}/edit','NhanVienController@postEditNhanVien');



	Route::get('nhanviens/export','NhanVienController@export');

	    //	

});

