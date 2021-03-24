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

Route::middleware(['auth'])->prefix('admin-dashboard')->namespace('Admin')->group(function () {
/*
 * Route for dashboard.blade.php
*/
	Route::get('import', 'ExcelController@getImport');
	Route::post('import', 'ExcelController@postImport');
	//Route::get('display', 'DisplayController@getDisplays')->name('getDisplays');


});
