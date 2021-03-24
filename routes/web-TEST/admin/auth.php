<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Controllers Within The "App\Http\Controllers\Admin" Namespace
Route::prefix('')->namespace('Admin')->group(function () {
    Route::get('admin-login', 'AuthenticateController@getAdminLogin')->name('getAdminLogin');
	Route::post('admin-login', 'AuthenticateController@postAdminLogin')->name('postAdminLogin');
	Route::get('admin-dashboard/logout', 'AuthenticateController@getAdminLogout')->name('getAdminLogout');

	// Forgot Password
	Route::get('admin/resetpassword', 'AuthenticateController@getAdminResetPassword');
	Route::post('admin/resetpassword', 'AuthenticateController@postAdminResetPassword');
	Route::get('admin/resetpassword/{token}', 'AuthenticateController@getAdminChangePassword');
	Route::post('admin/resetpassword/{token}', 'AuthenticateController@postAdminChangePassword');
});