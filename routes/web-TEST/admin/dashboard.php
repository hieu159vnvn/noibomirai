<?php

/*
|--------------------------------------------------------------------------
| Dashboard Routes of Web Route
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware(['auth'])->namespace('Admin')->group(function () {
/*
 * Route for dashboard.blade.php
*/
	Route::get('admin-dashboard', 'DashboardController@getAdminDashBoard')->name('getAdminDashBoard');
	//Route::get('display', 'DisplayController@getDisplays')->name('getDisplays');


});
