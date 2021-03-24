<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\HoSoHocVien;
use App\Models\NguoiThanTaiNhat;
use App\Models\City;
use App\User;
use PDF;
class pdfController extends Controller
{
    public function index($id)
    {
        $arr = explode("-",$id);
        $hoso = HoSoHocVien::whereIn('id', $arr)->get();
        return view('admin.pdf.getpdf',['hoso' => $hoso]);
    }
    public function getShowAll(){
    	$hoso = HoSoHocVien::all();
        $nam = HoSoHocVien::where('gioitinh','1')->get();
        $nu = HoSoHocVien::where('gioitinh','0')->get();
        $tinhthanh = City::all();        
    	return view('admin.pdf.showall',['hoso' => $hoso,'tinhthanh' => $tinhthanh,'nam'=>count($nam),'nu'=>count($nu)]);
    }
    public function postShowAll(Request $request){
    	$arr = $request->mcheck;
        if ($arr) {
            $id = implode("-",$arr);
            return redirect('/pdf/'.$id);
        }else{
            return redirect('/pdf')->with('status','chưa check!');
        }
    }
}
