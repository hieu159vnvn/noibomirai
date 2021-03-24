<?php

/*
|--------------------------------------------------------------------------
| Post Tag Routes of Web Route
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware(['auth'])->prefix('admin-dashboard')->namespace('Admin')->group(function () {
/*
 * Route for product_tag.blade.php
*/
	Route::get('producttags','ProductTagController@getProductTags');
	Route::get('producttags/{id}/delete','ProductTagController@getDeleteProductTag');
/*
 * Route for add_product_tag.blade.php
*/	
	Route::get('producttags/add','ProductTagController@getAddProductTag');
	Route::post('producttags/add','ProductTagController@postAddProductTag');
/*
 * Route for edit_product_tag.blade.php
*/	
	Route::get('producttags/{id}/edit','ProductTagController@getEditProductTag');
	Route::post('producttags/{id}/edit','ProductTagController@postEditProductTag');


});
