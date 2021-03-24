<?php

/*
|--------------------------------------------------------------------------
| Config Routes of Web Route
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware(['auth'])->prefix('admin-dashboard')->namespace('Admin')->group(function () {
/*
 * Route for header.blade.php
*/
	Route::get('configs/header','ConfigController@getHeader');
	Route::post('configs/header','ConfigController@postHeader');
/*
 * Route for footer.blade.php
*/
	Route::get('configs/footer','ConfigController@getFooter');
	Route::post('configs/footer','ConfigController@postFooter');
/*
 * Route for insert_code.blade.php
*/
	Route::get('configs/insertcode','ConfigController@getInsertCode');
	Route::post('configs/insertcode','ConfigController@postInsertCode');

	Route::get('configs/hotro','ConfigController@getHoTro');
	Route::post('configs/hotro','ConfigController@postHotro');
	
});
