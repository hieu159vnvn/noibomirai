<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\NhanVien;
use App\Models\HoSoHocVien;
use App\Models\DoiTac;
use App\Models\History;
use App\Models\DonHang;

class DashboardController extends Controller
{
    public function getAdminDashBoard(){
    	$nhanvien = NhanVien::where('chucvu','<>',7)->get();
    	$hocvien = HoSoHocVien::all();
    	$giaovien = NhanVien::where('chucvu',7)->get();
    	$dadinhat = HoSoHocVien::where('tinhtrang','5')->get();
		$doitac = DoiTac::all();
		$history = History::take(10)->orderByRaw('created_at ASC')->get();;
		$donhang = DonHang::all();
    	return view('welcome',['nhanvien' => $nhanvien,'hocvien' => $hocvien,'giaovien' => $giaovien,'doitac' => $doitac , 'dadinhat' => $dadinhat, 'history' => $history , 'donhang' => $donhang]);
    }
}
