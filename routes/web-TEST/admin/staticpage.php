<?php

/*
|--------------------------------------------------------------------------
| Static page Routes of Web Route
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware(['auth'])->prefix('admin-dashboard')->namespace('Admin')->group(function () {
/*
 * Route for home_page.blade.php
*/
	Route::get('staticpages/homepage','StaticPageController@getHomePage');
	Route::post('staticpages/homepage','StaticPageController@postHomePage');

/*
 * Route for contact_us.blade.php
*/
	Route::get('staticpages/contactus','StaticPageController@getContactUsPage');
	Route::post('staticpages/contactus','StaticPageController@postContactUsPage');

/*
 * Route for about_us.blade.php
*/
	Route::get('staticpages/aboutus','StaticPageController@getAboutUsPage');
	Route::post('staticpages/aboutus','StaticPageController@postAboutUsPage');	

/*
 * Route for san_pham.blade.php
*/
	Route::get('staticpages/product','StaticPageController@getProductPage');
	Route::post('staticpages/product','StaticPageController@postProductPage');	

/*
 * Route for tuyen_dung.blade.php
*/
	Route::get('staticpages/recruitment','StaticPageController@getRecruitmentPage');
	Route::post('staticpages/recruitment','StaticPageController@postRecruitmentPage');	

/*
 * Route for du_toan_kinh_phi.blade.php
*/
	Route::get('staticpages/dutoan','StaticPageController@getTrangDuToan');
	Route::post('staticpages/dutoan','StaticPageController@postTrangDuToan');
	
});
