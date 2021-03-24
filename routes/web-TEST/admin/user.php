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
Route::prefix('admin-dashboard')->namespace('Admin')->group(function () {
//ajax route
	Route::post('users/checkuniqueusername','UserController@checkUniqueUsername');
	Route::post('users/checkuniqueemail','UserController@checkUniqueEmail');

//web route
	Route::get('users','UserController@getUsers')->middleware('adminlevel');
	Route::get('users/{id}/delete','UserController@getDeleteUser')->middleware('adminlevel');

	Route::get('users/add','UserController@getAddUser')->middleware('adminlevel');
	Route::post('users/add','UserController@postAddUser')->middleware('adminlevel');

	Route::get('users/{id}/edit','UserController@getEditUser');
	Route::post('users/{id}/edit','UserController@postEditUser');
});