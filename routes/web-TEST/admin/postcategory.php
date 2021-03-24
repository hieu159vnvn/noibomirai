<?php

/*
|--------------------------------------------------------------------------
| Post Category Routes of Web Route
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware(['auth'])->prefix('admin-dashboard')->namespace('Admin')->group(function () {
/*
 * Route for tag.blade.php
*/
	Route::get('postcategories','PostCategoryController@getPostCategories');
	Route::get('postcategories/{id}/delete','PostCategoryController@getDeletePostCategory');
/*
 * Route for add_category.blade.php
*/	
	Route::get('postcategories/add','PostCategoryController@getAddPostCategory');
	Route::post('postcategories/add','PostCategoryController@postAddPostCategory');
/*
 * Route for edit_category.blade.php
*/	
	Route::get('postcategories/{id}/edit','PostCategoryController@getEditPostCategory');
	Route::post('postcategories/{id}/edit','PostCategoryController@postEditPostCategory');
	
});
