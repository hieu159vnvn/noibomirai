<?php

/*
|--------------------------------------------------------------------------
| Product Category Routes of Web Route
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware(['auth'])->prefix('admin-dashboard')->namespace('Admin')->group(function () {
/*
 * Route for product_category.blade.php
*/
	Route::get('productcategories','ProductCategoryController@getProductCategories');
	Route::get('productcategories/{id}/delete','ProductCategoryController@getDeleteProductCategory');
/*
 * Route for add_product_category.blade.php
*/	
	Route::get('productcategories/add','ProductCategoryController@getAddProductCategory');
	Route::post('productcategories/add','ProductCategoryController@postAddProductCategory');
/*
 * Route for edit_product_category.blade.php
*/	
	Route::get('productcategories/{id}/edit','ProductCategoryController@getEditProductCategory');
	Route::post('productcategories/{id}/edit','ProductCategoryController@postEditProductCategory');
	
});
