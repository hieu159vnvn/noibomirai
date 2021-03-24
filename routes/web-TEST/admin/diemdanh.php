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

	Route::get('diemdanhs/manage','DiemDanhController@getDiemDanh');

	Route::post('diemdanhs/manage','DiemDanhController@postDiemDanh');

	Route::get('diemdanhs/viewmanage/{mdate}/{mid}','DiemDanhController@getViewDiemDanh');
	
	Route::post('diemdanhs/viewmanage/{mdate}/{mid}','DiemDanhController@postViewDiemDanh');

});

Route::prefix('admin-dashboard')->namespace('Admin')->group(function () {	

 	Route::get('diemdanhs/{id}/add','DiemDanhController@getAddDiemDanh');

 	Route::post('diemdanhs/{id}/add','DiemDanhController@postAddDiemDanh');

 	Route::get('diemdanhs/error','DiemDanhController@getErrorDiemDanh');

});