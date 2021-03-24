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
 * Route for product.blade.php
*/
	//ajax route
	Route::post('products/changestatus','ProductController@postChangeProductStatus');
	Route::post('products/changenoibat','ProductController@postChangeProductNoiBat');
	Route::post('products/changebanchay','ProductController@postChangeProductBanChay');
	Route::post('products/changestt','ProductController@postChangeProductStt');

	//web route
	Route::get('products','ProductController@getProducts');
	Route::get('products/{id}/delete','ProductController@getDeleteProduct');
/*
 * Route for add_post.blade.php
// */	
 	Route::get('products/add','ProductController@getAddProduct');
 	Route::post('products/add','ProductController@postAddProduct');
/*
 * Route for edit_post.blade.php
*/	
	Route::get('products/{id}/edit','ProductController@getEditProduct');
	Route::post('products/{id}/edit','ProductController@postEditProduct');
	
});
