<?php

/*
|--------------------------------------------------------------------------
| Asset Routes of Web Route
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/master', function(){
	return view('front.master');
});	

Route::middleware(['web','minify'])->namespace('Front')->group(function () {	
	 Route::get('/', 'FrontController@getHomePage');	
	// Route::get('gioi-thieu', 'FrontController@getAboutUs');
	// Route::get('lien-he', 'FrontController@getLienhe');
	// Route::get('du-an', 'FrontController@getDuan');
	// Route::get('dich-vu', 'FrontController@getDichvu');
	// Route::get('tuyen-dung', 'FrontController@getTuyenDung');
	// Route::get('tin-tuc', 'FrontController@getTintuc');
	// Route::get('zlapp/login','FrontController@getZalo');
	// Route::get('zlapp/call_back','FrontController@getZaloCallBack');
	// Route::get('{slug}','FrontController@getRoute');
	// Route::post('api/guilienhe', 'FrontController@postGuiLienHe');
	// Route::post('api/guimail', 'FrontController@postGuiMail');
	//Route::get('{slug}-bv.html', 'FrontController@getChiTietBaiViet')->name('baiviet.chitiet');
	//Route::get('{slug}.html', 'FrontController@getChiTietChuyenMuc')->name('chuyenmuc.chitiet');
});

//Route::get('bai-viet/{slug}', 'Front\PostDetailController@getPostDetail');
// Route::get('chich-sach-quyen-tieng-tu-vnwis', function(){
// 	return view('front.policy');
// });
