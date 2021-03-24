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

//Look in app/routes/web for the partials
// foreach (File::allFiles(__DIR__ . DIRECTORY_SEPARATOR . "web") as $partial) {
// 	require_once $partial->getPathname();
// }

//datatables
Route::get('/datatables/data','DatatablesController@getHoso');
Route::get('/datatables/daotao/{id}','DatatablesController@getDaotao');

Route::get('/datatables/source','DatatablesController@getSourceHoso');
Route::get('/datatables/testmiss','DatatablesController@testMissHoso');
Route::get('/datatables/donhang/{id}','DatatablesController@getGepDonHang');

Route::get('/datatables/kitucxa','DatatablesController@getKitucxa');
Route::get('/datatables/kitucxadacbiet','DatatablesController@getKitucxaDacBiet');
Route::get('/datatables/kitucxa/view/{idktx}','DatatablesController@getViewKitucxa');
Route::get('/datatables/kitucxa/danhsachhocvien','DatatablesController@getDanhSachHocVienKTX');

//donhang datatables
Route::get('/dhdatatables/nghiepdoan','DHDatatablesController@getNghiepDoan');
Route::get('/dhdatatables/doitac','DHDatatablesController@getDoiTac');
Route::get('/dhdatatables/ctyhocvien/{idcty}','DatatablesController@getDanhSachHocVienCongTy');


Route::get('/dangky','DangKyHoSoController@getDangKyHoSo');
Route::post('/dangky','DangKyHoSoController@postDangKyHoSo');

Route::get('/', function () {
    return redirect('/home');
});

// Route::auth();
// Authentication Routes...
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

// Registration Routes...
// Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
// Route::post('register', 'Auth\RegisterController@register');

Route::get('/logout', function () {
	Session::flush();
    Auth::logout();
    return redirect('/login');
});

Route::group(['middleware' => ['auth']], function() {
	

	Route::get('/home', 'HomeController@index');

	Route::resource('users','UserController')->middleware('role:admin');

	Route::get('users/{id}/change-pass','UserController@getChangePass');
	Route::post('users/{id}/change-pass','UserController@postChangePass');

	Route::get('roles',['as'=>'roles.index','uses'=>'RoleController@index','middleware' => ['permission:role-list|role-create|role-edit|role-delete']]);
	Route::get('roles/create',['as'=>'roles.create','uses'=>'RoleController@create','middleware' => ['permission:role-create']]);
	Route::post('roles/create',['as'=>'roles.store','uses'=>'RoleController@store','middleware' => ['permission:role-create']]);
	Route::get('roles/{id}',['as'=>'roles.show','uses'=>'RoleController@show']);
	Route::get('roles/{id}/edit',['as'=>'roles.edit','uses'=>'RoleController@edit','middleware' => ['permission:role-edit']]);
	Route::patch('roles/{id}',['as'=>'roles.update','uses'=>'RoleController@update','middleware' => ['permission:role-edit']]);
	Route::delete('roles/{id}',['as'=>'roles.destroy','uses'=>'RoleController@destroy','middleware' => ['permission:role-delete']]);

	//Hoso
	Route::get('hoso','HoSoController@index')->middleware(['permission:hoso-list|hoso-create|hoso-edit|hoso-delete|hoso-tran']);
	Route::get('hoso/{id}/delete','HoSoController@getDeleteHoso')->middleware(['permission:hoso-delete']);	
	Route::get('hoso/create','HoSoController@getAddHoso')->middleware(['permission:hoso-create']);
 	Route::post('hoso/create','HoSoController@postAddHoso')->middleware(['permission:hoso-create']);
	Route::get('hoso/{id}/show','HoSoController@getShowHoso');
	Route::get('hoso/{id}/edit','HoSoController@getEditHoso')->middleware(['permission:hoso-edit']);
	Route::post('hoso/{id}/edit','HoSoController@postEditHoso')->middleware(['permission:hoso-edit']);
	Route::get('hoso/{id}/tran','HoSoController@getTranHoso')->middleware('permission:hoso-tran');
	Route::post('hoso/{id}/tran','HoSoController@postTranHoso')->middleware('permission:hoso-tran');
	Route::get('hoso/{id}/{type}/{file}/removefile','HoSoController@getRemoveFileHoso')->middleware(['permission:hoso-edit']);

	Route::get('hoso/source','HoSoController@getSourceHoso')->middleware(['permission:hoso-create']);
	Route::get('hoso/{id}/delsource','HoSoController@delSourceHoso')->middleware(['permission:hoso-create']);
	Route::get('hoso/testmiss','HoSoController@testMissHoso')->middleware(['permission:hoso-create']);

	Route::post('hoso/re-edit/{id}','HoSoController@re_edit');
	//INHOSO
	Route::get('hoso/print/{id}','HoSoController@print')->middleware(['permission:hoso-list|hoso-create|hoso-edit|hoso-delete|hoso-tran']);
	Route::get('pdf/{id}','pdfController@index');
	Route::get('pdf','pdfController@getShowAll');
	Route::post('pdf','pdfController@postShowAll');

	//THONG KE
	Route::get('thongke','ThongKeController@index');
	Route::post('thongke/dayly','ThongKeController@getDay');
	Route::get('thongke/{year}','ThongKeController@getYear');

	//Nhanvien
	Route::get('nhanvien','NhanVienController@getNhanVien')->middleware(['permission:nhanvien-list|nhanvien-create|nhanvien-edit|nhanvien-delete']);;
	Route::get('nhanvien/{id}/delete','NhanVienController@getDeleteNhanVien')->middleware('permission:nhanvien-delete');
 	Route::get('nhanvien/add','NhanVienController@getAddNhanVien')->middleware('permission:nhanvien-create');
 	Route::post('nhanvien/add','NhanVienController@postAddNhanVien')->middleware('permission:nhanvien-create');
	Route::get('nhanvien/{id}/edit','NhanVienController@getEditNhanVien')->middleware('permission:nhanvien-edit');
	Route::post('nhanvien/{id}/edit','NhanVienController@postEditNhanVien')->middleware('permission:nhanvien-edit');

	//DaoTao
	Route::get('daotao','DaoTaoController@getDaoTao')->middleware('permission:daotao-list');
	Route::get('daotao/{id}/delete','DaoTaoController@getDeleteDaoTao')->middleware('permission:daotao-delete');

 	Route::get('daotao/add','DaoTaoController@getAddDaoTao')->middleware('permission:daotao-create');
 	Route::post('daotao/add','DaoTaoController@postAddDaoTao')->middleware('permission:daotao-create');

	Route::get('daotao/{id}/edit','DaoTaoController@getEditDaoTao')->middleware('permission:daotao-edit');
	Route::post('daotao/{id}/edit','DaoTaoController@postEditDaoTao')->middleware('permission:daotao-edit');
	Route::get('daotao/{id}/view','DaoTaoController@getViewDaoTao')->middleware('permission:daotao-show');

	Route::post('daotao/{id}/editajax','DaoTaoController@ajaxPostEditDaoTao')->middleware('permission:daotao-edit');
	Route::get('daotao/{id}/showdaotao','DaoTaoController@getShowDaoTao');
	// DaoTao bÃ¡o cÃ¡o 11-2020
	Route::post('daotao/manage-baocao/{date}','DaoTaoController@postManageBaoCao');
	Route::get('daotao/manage-baocao/{date}','DaoTaoController@getManageBaoCao');
	Route::get('daotao/ajaxbaocao/{date}/{id}','DaoTaoController@getAjaxManageBaoCao');
	Route::get('daotao/ajaxthang/{date}','DaoTaoController@getAjaxThang');
	Route::get('daotao/ajaxnam/{date}','DaoTaoController@getAjaxNam');
	Route::get('daotao/baocao/{date}/{id}','DaoTaoController@getBaoCao');
	Route::post('daotao/baocao/{date}/{id}','DaoTaoController@postBaoCao');
	Route::get('daotao/ajaxwatchbaocao/{date}/{id}','DaoTaoController@getAjaxWatchBaoCao');
	Route::get('daotao/watchbaocao/{date}/{id}','DaoTaoController@getWatchBaoCao');
// //////////////////////////////////////////////////////////////////////////////////////////////////////////
	Route::post('daotao/{id}/chuyen','DaoTaoController@chuyenDaotao')->middleware('permission:daotao-edit');
	//ChucVu
	Route::get('chucvu','ChucvuController@getChucVu')->middleware('permission:chucvu-list');
	Route::get('chucvu/{id}/delete','ChucvuController@getDeleteChucVu')->middleware('permission:chucvu-delete');

 	Route::get('chucvu/add','ChucvuController@getAddChucVu')->middleware('permission:chucvu-create');
 	Route::post('chucvu/add','ChucvuController@postAddChucVu')->middleware('permission:chucvu-create');

	Route::get('chucvu/{id}/edit','ChucvuController@getEditChucVu')->middleware('permission:chucvu-edit');
	Route::post('chucvu/{id}/edit','ChucvuController@postEditChucVu')->middleware('permission:chucvu-edit');

	//DiemDanh
	Route::get('diemdanh/manage','DiemDanhController@getDiemDanh')->middleware('permission:diemdanh-list');

	Route::post('diemdanh/manage','DiemDanhController@postDiemDanh')->middleware('permission:diemdanh-list');

	Route::get('diemdanh/viewmanage/{mdate}/{mid}','DiemDanhController@getViewDiemDanh')->middleware('permission:diemdanh-show');	
	Route::post('diemdanh/viewmanage/{mdate}/{mid}','DiemDanhController@postViewDiemDanh')->middleware('permission:diemdanh-show');

 	Route::get('diemdanh/{id}/add','DiemDanhController@getAddDiemDanh')->middleware('permission:diemdanh-create');
 	Route::post('diemdanh/{id}/add','DiemDanhController@postAddDiemDanh')->middleware('permission:diemdanh-create');

 	Route::get('diemdanh/error','DiemDanhController@getErrorDiemDanh');

 	//DoiTac
 	Route::get('doitac','DoiTacController@getDoiTac')->middleware('permission:doitac-list');
	Route::get('doitac/{id}/delete','DoiTacController@getDeleteDoiTac')->middleware('permission:doitac-delete');

 	Route::get('doitac/add','DoiTacController@getAddDoiTac')->middleware('permission:doitac-create');
 	Route::post('doitac/add','DoiTacController@postAddDoiTac')->middleware('permission:doitac-create');

	Route::get('doitac/{id}/edit','DoiTacController@getEditDoiTac')->middleware('permission:doitac-edit');
	Route::post('doitac/{id}/edit','DoiTacController@postEditDoiTac')->middleware('permission:doitac-edit');
    Route::get('/doitac/view/{idcty}','DoiTacController@getViewHocVien');

	//DonHang
	Route::get('donhang','DonHangController@getDonHang')->middleware('permission:donhang-list');
	Route::get('donhang/{id}/delete','DonHangController@getDeleteDonHang')->middleware('permission:donhang-delete');

 	Route::get('donhang/add','DonHangController@getAddDonHang')->middleware('permission:donhang-create');
 	Route::post('donhang/add','DonHangController@postAddDonHang')->middleware('permission:donhang-create');

 	Route::post('donhang/changestt','DonHangController@postChangeDonHangStt');
 	Route::post('donhang/changetinhtrang','DonHangController@postChangeTinhTrang');

 	Route::post('donhang/phongvandau','DonHangController@postChangeDau')->middleware('permission:donhang-create');
 	Route::post('donhang/phongvanrot','DonHangController@postChangeRot')->middleware('permission:donhang-create');
 	Route::get('donhang/duyetdonhang/{id}','DonHangController@getDuyetDH');

	Route::get('donhang/{id}/edit','DonHangController@getEditDonHang')->middleware('permission:donhang-edit');
	Route::post('donhang/{id}/edit','DonHangController@postEditDonHang')->middleware('permission:donhang-edit');

	Route::get('donhang/{id}/show','DonHangController@getShowDonHang')->middleware('permission:donhang-list');

	Route::get('donhang/{id}/create','DonHangController@getCreateDonHang')->middleware('permission:donhang-show');
	Route::post('donhang/{id}/create','DonHangController@postCreateDonHang')->middleware('permission:donhang-show');

	Route::get('donhang/{id}/print','DonHangController@getInDonHang');
	Route::get('donhang/{id}/{type}/{file}/removefile','DonHangController@getRemoveFileDonhang')->middleware(['permission:donhang-edit']);

	// don hang print ajax
	Route::get('donhang/{id}/printAjax','DonHangController@printAjax');

	// DonHang Ajax
	Route::get('donhang/nghiepdoan/{id}/ajax','DonHangController@getNghiepDoanAjax');
	Route::get('donhang/doitac/{id}/ajax','DonHangController@getDoiTacAjax');
	Route::post('donhang/nganhnghe-dt/{id}/ajax','DonHangController@getNgheNghiepAjax');
	//NganhNghe
	Route::get('nganhnghe','NganhNgheController@getNganhNghe')->middleware('permission:nganhnghe-list');
	Route::get('nganhnghe/{id}/delete','NganhNgheController@getDeleteNganhNghe')->middleware('permission:nganhnghe-delete');

 	Route::get('nganhnghe/add','NganhNgheController@getAddNganhNghe')->middleware('permission:nganhnghe-create');
 	Route::post('nganhnghe/add','NganhNgheController@postAddNganhNghe')->middleware('permission:nganhnghe-create');

	Route::get('nganhnghe/{id}/edit','NganhNgheController@getEditNganhNghe')->middleware('permission:nganhnghe-edit');
	Route::post('nganhnghe/{id}/edit','NganhNgheController@postEditNganhNghe')->middleware('permission:nganhnghe-edit');

	//NghiepDoan
	Route::get('nghiepdoan','NghiepDoanController@getNghiepDoan')->middleware('permission:nghiepdoan-list');
	Route::get('nghiepdoan/{id}/delete','NghiepDoanController@getDeleteNghiepDoan')->middleware('permission:nghiepdoan-delete');

 	Route::get('nghiepdoan/add','NghiepDoanController@getAddNghiepDoan')->middleware('permission:nghiepdoan-create');
 	Route::post('nghiepdoan/add','NghiepDoanController@postAddNghiepDoan')->middleware('permission:nghiepdoan-create');

	Route::get('nghiepdoan/{id}/edit','NghiepDoanController@getEditNghiepDoan')->middleware('permission:nghiepdoan-edit');

	Route::post('nghiepdoan/{id}/edit','NghiepDoanController@postEditNghiepDoan')->middleware('permission:nghiepdoan-edit');
	Route::get('/nghiepdoan/view/{idnghciepdoan}','NghiepDoanController@viewDoiTac');
	//LichCongTac
	Route::get('lichcongtac', 'LichcongtacController@index')->name('lichcongtac.index');
	Route::get('addlichcongtac', 'LichcongtacController@getaddEvent');
	Route::post('lichcongtac', 'LichcongtacController@addEvent')->name('lichcongtac.add');
	Route::get('danhsachlich', 'LichcongtacController@listEvent');
	Route::get('lichcongtac/{id}/delete','LichcongtacController@delete');
	// Route::get('lichcongtac/{id}/update','LichcongtacController@update');
	Route::get('lichcongtac/{id}/edit','LichcongtacController@getEditEvent');	
    Route::post('lichcongtac/{id}/edit','LichcongtacController@postEditEvent');
    // Ki tuc xa Híu code
    Route::get('/kitucxa/danhsachphong','KiTucXaController@getDanhSach')->middleware(['permission:kitucxa']);
    Route::get('/kitucxa/danhsach/{id}/delete','KiTucXaController@delete')->middleware(['permission:kitucxa']);
    Route::get('/kitucxa/add','KiTucXaController@getAdd')->middleware(['permission:kitucxa']);
    Route::post('/kitucxa/add','KiTucXaController@postAdd')->middleware(['permission:kitucxa']);
    Route::get('/kitucxa/adddacbiet','KiTucXaController@getAddDacBiet')->middleware(['permission:kitucxa']);
    Route::post('/kitucxa/adddacbiet','KiTucXaController@postAddDacBiet')->middleware(['permission:kitucxa']);
    Route::get('/kitucxa/{id}/edit','KiTucXaController@getEdit')->middleware(['permission:kitucxa']);
    Route::post('/kitucxa/{id}/edit','KiTucXaController@postEdit')->middleware(['permission:kitucxa']);
    Route::get('/kitucxa/{id}/editdacbiet','KiTucXaController@getEditDacBiet')->middleware(['permission:kitucxa']);
    Route::post('/kitucxa/{id}/editdacbiet','KiTucXaController@postEditDacBiet')->middleware(['permission:kitucxa']);
    Route::post('/kitucxa/addhocvien/{idktx}/{idhv}','KiTucXaController@addHocVien')->middleware(['permission:kitucxa']);
    Route::post('/kitucxa/delhocvien/{idktx}/{idhv}/{lido}','KiTucXaController@delHocVien')->middleware(['permission:kitucxa']);
    Route::get('/kitucxa/view/{idktx}','KiTucXaController@view')->middleware(['permission:kitucxa']);
    Route::get('/kitucxa/lichsu','KiTucXaController@getLichSu')->middleware(['permission:kitucxa']);
    Route::get('/kitucxa/danhsachhocvien','KiTucXaController@getDanhSachHocVien')->middleware(['permission:kitucxa']);
	

    Route::post('/hoso/status/{id}','HoSoController@status')->middleware(['permission:kitucxa']);

});
////// Miraihuman
Route::group(['namespace' => 'miraihuman','middleware' => ['auth']], function() {
	//logo
	Route::group(['prefix' => 'logo'], function() {
		Route::get('','LogoController@getLogo');
		Route::get('add','LogoController@getAddLogo')->middleware('permission:vietbai');
		Route::post('add','LogoController@postAddLogo')->middleware('permission:vietbai');
		Route::get('{id}/edit','LogoController@getEditLogo')->middleware('permission:vietbai');
		Route::post('{id}/edit','LogoController@postEditLogo')->middleware('permission:vietbai');
		Route::get('{id}/delete','LogoController@getDeleteLogo')->middleware('permission:vietbai');
		Route::post('status/{id}','LogoController@status')->middleware('permission:vietbai');
	});
	//dclienhe
	Route::group(['prefix' => 'dclienhe'], function() {
		Route::get('','DclienheController@getDclienhe');
		Route::get('add','DclienheController@getAddDclienhe')->middleware('permission:vietbai');
		Route::post('add','DclienheController@postAddDclienhe')->middleware('permission:vietbai');
		Route::get('{id}/edit','DclienheController@getEditDclienhe')->middleware('permission:vietbai');
		Route::post('{id}/edit','DclienheController@postEditDclienhe')->middleware('permission:vietbai');
		Route::get('{id}/delete','DclienheController@getDeleteDclienhe')->middleware('permission:vietbai');
		Route::post('status/{id}','DclienheController@status')->middleware('permission:vietbai');
	});
	//vietbai
	Route::group(['prefix' => 'baiviet'], function() {
		Route::get('','baivietController@getbaiviet');
		Route::get('add','baivietController@getAddbaiviet')->middleware('permission:vietbai');
		Route::post('add','baivietController@postAddbaiviet')->middleware('permission:vietbai');
		Route::get('{id}/edit','baivietController@getEditbaiviet')->middleware('permission:vietbai');
		Route::post('{id}/edit','baivietController@postEditbaiviet')->middleware('permission:vietbai');
		Route::get('{id}/delete','baivietController@getDeletebaiviet')->middleware('permission:vietbai');
		Route::post('status/{id}','baivietController@status')->middleware('permission:vietbai');
	});
	//gioithieu
	Route::group(['prefix' => 'gioithieu'], function() {
		Route::get('','GioithieuController@getgioithieu');
		// Route::get('add','gioithieuController@getAddgioithieu');//->middleware('permission:doitac-create');
		// Route::post('add','gioithieuController@postAddgioithieu');//->middleware('permission:doitac-create');
		Route::get('{id}/edit','GioithieuController@getEditgioithieu')->middleware('permission:vietbai');
		Route::post('{id}/edit','GioithieuController@postEditgioithieu')->middleware('permission:vietbai');
		Route::get('{id}/delete','GioithieuController@getDeletegioithieu')->middleware('permission:vietbai');
		Route::post('status/{id}','GioithieuController@status')->middleware('permission:vietbai');
	});
	//tintuc
	Route::group(['prefix' => 'tintuc'], function() {
		Route::get('','TintucController@getTintuc');
		Route::get('add','TintucController@getAddTintuc')->middleware('permission:vietbai');
		Route::post('add','TintucController@postAddTintuc')->middleware('permission:vietbai');
		Route::get('{id}/edit','TintucController@getEditTintuc')->middleware('permission:vietbai');
		Route::post('{id}/edit','TintucController@postEditTintuc')->middleware('permission:vietbai');
		Route::get('{id}/delete','TintucController@getDeleteTintuc')->middleware('permission:vietbai');
		Route::post('status/{id}','TintucController@status')->middleware('permission:vietbai');
	});
	//camnhan
	Route::group(['prefix' => 'camnhan'], function() {
		Route::get('','CamnhanhocvienController@index');
		Route::get('add','CamnhanhocvienController@getAddcamnhan')->middleware('permission:vietbai');
		Route::post('add','CamnhanhocvienController@postAddcamnhan')->middleware('permission:vietbai');
		Route::get('{id}/edit','CamnhanhocvienController@getEditcamnhan')->middleware('permission:vietbai');
		Route::post('{id}/edit','CamnhanhocvienController@postEditcamnhan')->middleware('permission:vietbai');
		Route::get('{id}/delete','CamnhanhocvienController@getDeletecamnhan')->middleware('permission:vietbai');
	});
	//doitac
	Route::group(['prefix' => 'doitac-miraihuman'], function() {
		Route::get('','DoitacController@getDoitac');
		Route::get('add','DoitacController@getAddDoitac')->middleware('permission:vietbai');
		Route::post('add','DoitacController@postAddDoitac')->middleware('permission:vietbai');
		Route::get('{id}/edit','DoitacController@getEditDoitac')->middleware('permission:vietbai');
		Route::post('{id}/edit','DoitacController@postEditDoitac')->middleware('permission:vietbai');
		Route::get('{id}/delete','DoitacController@getDeleteDoitac')->middleware('permission:vietbai');
		Route::post('status/{id}','DoitacController@status')->middleware('permission:vietbai');
	});
	//dichvucat
	Route::group(['prefix' => 'dichvucat'], function() {
		Route::get('','DichvucatController@getDichvucat');
		Route::get('add','DichvucatController@getAddDichvucat')->middleware('permission:vietbai');
		Route::post('add','DichvucatController@postAddDichvucat')->middleware('permission:vietbai');
		Route::get('{id}/edit','DichvucatController@getEditDichvucat')->middleware('permission:vietbai');
		Route::post('{id}/edit','DichvucatController@postEditDichvucat')->middleware('permission:vietbai');
		Route::get('{id}/delete','DichvucatController@getDeleteDichvucat')->middleware('permission:vietbai');
		Route::post('status/{id}','DichvucatController@status')->middleware('permission:vietbai');
	});
	//dichvu
	Route::group(['prefix' => 'dichvu'], function() {
		Route::get('','DichvuController@getDichvu');
		Route::get('add','DichvuController@getAddDichvu')->middleware('permission:vietbai');
		Route::post('add','DichvuController@postAddDichvu')->middleware('permission:vietbai');
		Route::get('{id}/edit','DichvuController@getEditDichvu')->middleware('permission:vietbai');
		Route::post('{id}/edit','DichvuController@postEditDichvu')->middleware('permission:vietbai');
		Route::get('{id}/delete','DichvuController@getDeleteDichvu')->middleware('permission:vietbai');
		Route::post('status/{id}','DichvuController@status')->middleware('permission:vietbai');
	});
	//mangxahoi
	Route::group(['prefix' => 'mangxahoi'], function() {
		Route::get('','MangxahoiController@getMangxahoi');
		Route::get('add','MangxahoiController@getAddMangxahoi')->middleware('permission:vietbai');
		Route::post('add','MangxahoiController@postAddMangxahoi')->middleware('permission:vietbai');
		Route::get('{id}/edit','MangxahoiController@getEditMangxahoi')->middleware('permission:vietbai');
		Route::post('{id}/edit','MangxahoiController@postEditMangxahoi')->middleware('permission:vietbai');
		Route::get('{id}/delete','MangxahoiController@getDeleteMangxahoi')->middleware('permission:vietbai');
		Route::post('status/{id}','MangxahoiController@status')->middleware('permission:vietbai');
	});
	//hoidap
	Route::group(['prefix' => 'hoidap'], function() {
		Route::get('','HoidapController@getHoidap');
		Route::get('add','HoidapController@getAddHoidap')->middleware('permission:vietbai');
		Route::post('add','HoidapController@postAddHoidap')->middleware('permission:vietbai');
		Route::get('{id}/edit','HoidapController@getEditHoidap')->middleware('permission:vietbai');
		Route::post('{id}/edit','HoidapController@postEditHoidap')->middleware('permission:vietbai');
		Route::get('{id}/delete','HoidapController@getDeleteHoidap')->middleware('permission:vietbai');
		Route::post('status/{id}','HoidapController@status')->middleware('permission:vietbai');
	});
	//loaicauhoi
	Route::group(['prefix' => 'loaihoidap'], function() {
		Route::get('','LoaiHoiDapController@index');
		Route::get('create','LoaiHoiDapController@create')->middleware('permission:vietbai');
		Route::post('store','LoaiHoiDapController@store')->middleware('permission:vietbai');
		Route::get('{id}/edit','LoaiHoiDapController@edit')->middleware('permission:vietbai');
		Route::post('{id}/update','LoaiHoiDapController@update')->middleware('permission:vietbai');
		Route::get('{id}/delete','LoaiHoiDapController@delete')->middleware('permission:vietbai');
		Route::post('status/{id}','LoaiHoiDapController@status')->middleware('permission:vietbai');
	});
	//lienhe
	Route::group(['prefix' => 'lienhe'], function() {
		Route::get('','LienheController@index')->middleware('permission:vietbai');
		Route::post('{id}','LienheController@changeTT')->middleware('permission:vietbai');
	});
	//tuvan
	Route::group(['prefix' => 'tuvan'], function() {
		Route::get('','TuvanController@index')->middleware('permission:vietbai');
		Route::post('{id}','TuvanController@changeTT')->middleware('permission:vietbai');
	});
	//tuyendung
	Route::group(['prefix' => 'tuyendung'], function() {
		Route::get('','TuyendungController@index')->middleware('permission:vietbai');
		Route::post('{id}','TuyendungController@changeTT')->middleware('permission:vietbai');
	});
	//video
	Route::group(['prefix' => 'video'], function() {
		Route::get('','VideoController@getVideo');
		Route::get('add','VideoController@getAddVideo')->middleware('permission:vietbai');
		Route::post('add','VideoController@postAddVideo')->middleware('permission:vietbai');
		Route::get('{id}/edit','VideoController@getEditVideo')->middleware('permission:vietbai');
		Route::post('{id}/edit','VideoController@postEditVideo')->middleware('permission:vietbai');
		Route::get('{id}/delete','VideoController@getDeleteVideo')->middleware('permission:vietbai');
		Route::post('status/{id}','VideoController@status')->middleware('permission:vietbai');
	});
	//hinhanh
	Route::group(['prefix' => 'hinhanh'], function() {
		Route::get('','HinhanhController@getHinhanh');
		Route::get('add','HinhanhController@getAddHinhanh')->middleware('permission:vietbai');
		Route::post('add','HinhanhController@postAddHinhanh')->middleware('permission:vietbai');
		Route::get('{id}/edit','HinhanhController@getEditHinhanh')->middleware('permission:vietbai');
		Route::post('{id}/edit','HinhanhController@postEditHinhanh')->middleware('permission:vietbai');
		Route::get('{id}/delete','HinhanhController@getDeleteHinhanh')->middleware('permission:vietbai');
		Route::post('status/{id}','HinhanhController@status')->middleware('permission:vietbai');
	});
	//banner
	Route::group(['prefix' => 'banner'], function() {
		Route::get('','BannerController@getBanner');
		Route::get('add','BannerController@getAddBanner')->middleware('permission:vietbai');
		Route::post('add','BannerController@postAddBanner')->middleware('permission:vietbai');
		Route::get('{id}/edit','BannerController@getEditBanner')->middleware('permission:vietbai');
		Route::post('{id}/edit','BannerController@postEditBanner')->middleware('permission:vietbai');
		Route::get('{id}/delete','BannerController@getDeleteBanner')->middleware('permission:vietbai');
		Route::post('status/{id}','BannerController@status')->middleware('permission:vietbai');
	});
	//status donhang
	Route::group(['prefix' => 'donhangstt'], function() {
		Route::get('','DonhangsttController@getDonhangstt');
		Route::post('status/{id}','DonhangsttController@status')->middleware('permission:vietbai');
	});
	//truonghoc
	Route::group(['prefix' => 'truonghoc'], function() {
		Route::get('','TruonghocController@getTruonghoc');
		Route::get('add','TruonghocController@getAddTruonghoc')->middleware('permission:vietbai');
		Route::post('add','TruonghocController@postAddTruonghoc')->middleware('permission:vietbai');
		Route::get('{id}/edit','TruonghocController@getEditTruonghoc')->middleware('permission:vietbai');
		Route::post('{id}/edit','TruonghocController@postEditTruonghoc')->middleware('permission:vietbai');
		Route::get('{id}/delete','TruonghocController@getDeleteTruonghoc')->middleware('permission:vietbai');
		Route::post('status/{id}','TruonghocController@status')->middleware('permission:vietbai');
	});
	//fbfooter
	Route::group(['prefix' => 'fbfooter'], function() {
		Route::get('','FbfooterController@getfbfooter');
		Route::get('add','FbfooterController@getAddfbfooter')->middleware('permission:vietbai');
		Route::post('add','FbfooterController@postAddfbfooter')->middleware('permission:vietbai');
		Route::get('{id}/edit','FbfooterController@getEditfbfooter')->middleware('permission:vietbai');
		Route::post('{id}/edit','FbfooterController@postEditfbfooter')->middleware('permission:vietbai');
		Route::get('{id}/delete','FbfooterController@getDeletefbfooter')->middleware('permission:vietbai');
		Route::post('status/{id}','FbfooterController@status')->middleware('permission:vietbai');
	});
	//menu
	Route::group(['prefix' => 'menu'], function() {
		Route::get('','menuController@getmenu');
		// Route::get('add','menuController@getAddmenu');//->middleware('permission:doitac-create');
		// Route::post('add','menuController@postAddmenu');//->middleware('permission:doitac-create');
		Route::get('{id}/edit','menuController@getEditmenu')->middleware('permission:vietbai');
		Route::post('{id}/edit','menuController@postEditmenu')->middleware('permission:vietbai');
		Route::get('{id}/delete','menuController@getDeletemenu')->middleware('permission:vietbai');
		Route::post('status/{id}','menuController@status')->middleware('permission:vietbai');
	});
	//gioithieuhome
	Route::group(['prefix' => 'gioithieuhome'], function() {
		Route::get('','gioithieuhomeController@getgioithieuhome');
		// Route::get('add','gioithieuhomeController@getAddgioithieuhome');//->middleware('permission:doitac-create');
		// Route::post('add','gioithieuhomeController@postAddgioithieuhome');//->middleware('permission:doitac-create');
		Route::get('{id}/edit','gioithieuhomeController@getEditgioithieuhome')->middleware('permission:vietbai');
		Route::post('{id}/edit','gioithieuhomeController@postEditgioithieuhome')->middleware('permission:vietbai');
		Route::get('{id}/delete','gioithieuhomeController@getDeletegioithieuhome')->middleware('permission:vietbai');
		Route::post('status/{id}','gioithieuhomeController@status')->middleware('permission:vietbai');
	});
	//dichvuhome
	Route::group(['prefix' => 'dichvuhome'], function() {
		Route::get('','dichvuhomeController@getdichvuhome');
		// Route::get('add','dichvuhomeController@getAdddichvuhome');//->middleware('permission:doitac-create');
		// Route::post('add','dichvuhomeController@postAdddichvuhome');//->middleware('permission:doitac-create');
		Route::get('{id}/edit','dichvuhomeController@getEditdichvuhome')->middleware('permission:vietbai');
		Route::post('{id}/edit','dichvuhomeController@postEditdichvuhome')->middleware('permission:vietbai');
		Route::get('{id}/delete','dichvuhomeController@getDeletedichvuhome')->middleware('permission:vietbai');
		Route::post('status/{id}','dichvuhomeController@status')->middleware('permission:vietbai');
	});
	//daotaohome
	Route::group(['prefix' => 'daotaohome'], function() {
		Route::get('','daotaohomeController@getdaotaohome');
		Route::get('{id}/edit','daotaohomeController@getEditdaotaohome')->middleware('permission:vietbai');
		Route::post('{id}/edit','daotaohomeController@postEditdaotaohome')->middleware('permission:vietbai');
		Route::get('{id}/delete','daotaohomeController@getDeletedaotaohome')->middleware('permission:vietbai');
		Route::post('status/{id}','daotaohomeController@status')->middleware('permission:vietbai');
	});
	//magazine
	Route::group(['prefix' => 'magazine'], function() {
		Route::get('','MagazineController@index');
		Route::get('add','MagazineController@getadd');
		Route::post('add','MagazineController@postAdd');
		Route::get('edit/{id}','MagazineController@getEdit');
		Route::post('edit/{id}','MagazineController@postEdit');
		Route::get('{id}/delete','MagazineController@delete');
	});
	//bannerpage
	Route::group(['prefix' => 'bannerpage'], function() {
		Route::get('','BannerPageController@index');
		Route::get('edit/{id}','BannerPageController@getEdit');
		Route::post('edit/{id}','BannerPageController@postEdit');
	});
});

// fix file image or rename
// Route::get('fixfile/{skip}','FixfileController@index');