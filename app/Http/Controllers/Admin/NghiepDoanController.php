<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\NghiepDoan;


class NghiepDoanController extends Controller
{
    public function getNghiepDoan(){
    	$nghiepdoan = NghiepDoan::all();
    	return view('admin.nghiepdoan.nghiepdoan',['nghiepdoan' => $nghiepdoan]);
    }
    public function getAddNghiepDoan(){
        return view('admin.nghiepdoan.add_nghiepdoan');
    }
    public function getEditNghiepDoan($id){
        $nghiepdoan = NghiepDoan::find($id);
        return view('admin.nghiepdoan.edit_nghiepdoan',['nghiepdoan' => $nghiepdoan]);
    }
    public static function saveNghiepDoan($request,$nghiepdoan,$action){
        DB::beginTransaction();
        try {
            $nghiepdoan->tennghiepdoan = $request->tennghiepdoan;
            $nghiepdoan->diachi = $request->diachi;
            $nghiepdoan->nguoidaidien = $request->nguoidaidien;
            $nghiepdoan->dienthoai = $request->dienthoai;
            $nghiepdoan->email = $request->email;
            $nghiepdoan->ghichu = $request->ghichu;
            $nghiepdoan->save();
        DB::commit();
        return true;
        } 
        catch (Exception $e) {
            DB::rollBack();
            return fail;
        }       

    }
    public function postAddNghiepDoan(Request $request){
        $nghiepdoan = new NghiepDoan;
        if($this->saveNghiepDoan($request,$nghiepdoan,"add")){
        return redirect('admin-dashboard/nghiepdoans')->with('status','Đã thêm "' . $request->tennghiepdoan . '" thành công!');
        }
        return redirect('admin-dashboard/nghiepdoans')->with('status','Đã thêm "' . $request->tennghiepdoan . '" không thành công!');

    }
     public function postEditNghiepDoan(Request $request,$id){
        $nghiepdoan = NghiepDoan::find($id);
        if($this->saveNghiepDoan($request,$nghiepdoan,"edit")){
        return redirect('admin-dashboard/nghiepdoans')->with('status','Đã sửa "' . $request->tennghiepdoan . '" thành công!');
        }
        return redirect('admin-dashboard/nghiepdoans')->with('status','Đã sửa "' . $request->tennghiepdoan . '" không thành công!');

    }
}
