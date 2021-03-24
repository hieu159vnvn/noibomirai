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

	Route::get('donhangs','DonHangController@getDonHang');

	Route::get('donhangs/{id}/delete','DonHangController@getDeleteDonHang');

/*

 * Route for add

 

// */	

 	Route::get('donhangs/add','DonHangController@getAddDonHang');

 	Route::post('donhangs/add','DonHangController@postAddDonHang');

 	Route::post('donhangs/changestt','DonHangController@postChangeDonHangStt');

 	Route::post('donhangs/changetinhtrang','DonHangController@postChangeTinhTrang');

 	Route::post('donhangs/phongvandau','DonHangController@postChangeDau');
 	Route::post('donhangs/phongvanrot','DonHangController@postChangeRot');
/*

 * Route for edit

*/	

	Route::get('donhangs/{id}/edit','DonHangController@getEditDonHang');

	Route::post('donhangs/{id}/edit','DonHangController@postEditDonHang');


	Route::get('donhangs/{id}/show','DonHangController@getShowDonHang');


	Route::get('donhangs/{id}/create','DonHangController@getCreateDonHang');

	Route::post('donhangs/{id}/create','DonHangController@postCreateDonHang');


	    //	

});

