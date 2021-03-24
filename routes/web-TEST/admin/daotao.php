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

 * Route for daotao.blade.php

*/

	//web route

	Route::get('daotaos','DaoTaoController@getDaoTao');

	Route::get('daotaos/{id}/delete','DaoTaoController@getDeleteDaoTao');

/*

 * Route for add

 

// */	

 	Route::get('daotaos/add','DaoTaoController@getAddDaoTao');

 	Route::post('daotaos/add','DaoTaoController@postAddDaoTao');

/*

 * Route for edit

*/	

	Route::get('daotaos/{id}/edit','DaoTaoController@getEditDaoTao');

	Route::post('daotaos/{id}/edit','DaoTaoController@postEditDaoTao');

/*

 * Route for view

*/	
	 Route::get('daotaos/{id}/view','DaoTaoController@getViewDaoTao');

});
