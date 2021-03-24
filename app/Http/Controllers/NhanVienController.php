<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\City;
use App\Models\NhanVien;
use App\Models\ChucVu;
use App\User;
use Maatwebsite\Excel\Facades\Excel;

class NhanVienController extends Controller
{        
    public function getNhanVien(){        
        $nhanvien = NhanVien::orderBy('id','DESC')->get();
        $nam = NhanVien::where('gioitinh','1')->get();
        $nu = NhanVien::where('gioitinh','0')->get();
        $tinhthanh = City::all(); 
        $chucvu = ChucVu::all();       
        return view('admin.nhanvien.index',['nhanvien' => $nhanvien,'chucvu'=>$chucvu,'tinhthanh' => $tinhthanh,'nam'=>count($nam),'nu'=>count($nu)]);
    }
    public function getAddNhanVien(){
        $tinhthanh = City::all(); 
        $chucvu = ChucVu::all();  
        return view('admin.nhanvien.create',['city'=> $tinhthanh,'chucvu'=> $chucvu]);
    } 
    public static function saveNhanvien($request,$nhanvien,$action){
        DB::beginTransaction();
        try {
            $nhanvien->hinhanh = $request->featureImage;
            $nhanvien->hoten = $request->hoten;
            $nhanvien->namsinh = $request->namsinh;
            $nhanvien->gioitinh = $request->gioitinh;
            $nhanvien->chucvu = $request->chucvu;
            $nhanvien->honnhan = $request->honnhan;                     
            $nhanvien->sodienthoai = $request->dienthoai; 
            $nhanvien->email = $request->email; 
            $nhanvien->diachi = $request->diachi;
            $nhanvien->ngayvaolam = $request->ngayvaolam;
            $nhanvien->ngaynghiviec = $request->ngaynghiviec;
            $nhanvien->tinhthanh = $request->tinhthanh;
            $nhanvien->trinhdo = $request->trinhdo;
            $nhanvien->chuyenmon = $request->chuyenmon;
            $nhanvien->ngoaingu = $request->ngoaingu;
            $nhanvien->kinhnghiem = $request->kinhnghiem;
            $nhanvien->ghichu = $request->ghichu;
            $nhanvien->save();            
            DB::commit();
            return true;
        } 
        catch (Exception $e) {
            DB::rollBack();
            return fail;
        }
    } 

    public function postAddNhanVien(Request $request){
        $nhanvien = new NhanVien;
        if($this->saveNhanvien($request,$nhanvien,"add")){
        return redirect('nhanvien')->with('status','Đã thêm "' . $request->hoten . '" thành công!');
        }
        return redirect('nhanvien')->with('status','Đã thêm "' . $request->hoten . '" không thành công!');

    }   
    public function getEditNhanVien($id){
        $nhanvien = NhanVien::find($id);
        $tinhthanh = City::all(); 
        $chucvu = ChucVu::all(); 
        return view('admin.nhanvien.edit',['nhanvien' => $nhanvien,'tinhthanh' => $tinhthanh,'chucvu' => $chucvu]);
    }
    public function postEditNhanVien(Request $request,$id){
        $nhanvien = NhanVien::find($id);
        if($this->saveNhanvien($request,$nhanvien,"edit")){
        return redirect('nhanvien')->with('status','Đã sửa "' . $request->hoten . '" thành công!');
        }
         return redirect('nhanvien')->with('status','Đã sửa "' . $request->hoten . '" không thành công!');
     }
    public function getDeleteNhanVien($id){
        NhanVien::destroy($id);
        return redirect()->back()->with('status','Đã xóa thành công!');
    }
}