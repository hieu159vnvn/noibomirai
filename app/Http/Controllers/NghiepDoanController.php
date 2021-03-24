<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\NghiepDoan;
use App\Models\DoiTac;

class NghiepDoanController extends Controller
{
    public function getNghiepDoan(){
    	$nghiepdoan = NghiepDoan::all();
    	return view('admin.nghiepdoan.nghiepdoan',['nghiepdoan' => $nghiepdoan]);
    }
    public function getAddNghiepDoan(){
        $nghiepdoan = NghiepDoan::all();
        return view('admin.nghiepdoan.add_nghiepdoan',['nghiepdoan' => $nghiepdoan]);
    }
    public function getEditNghiepDoan($id){
        $nghiepdoan = NghiepDoan::find($id);
        $nghiepdoans = NghiepDoan::all();
        return view('admin.nghiepdoan.edit_nghiepdoan',['nghiepdoan' => $nghiepdoan, 'nghiepdoans' => $nghiepdoans]);
    }
    public static function saveNghiepDoan($request,$nghiepdoan,$tennghiepdoan,$action){
        DB::beginTransaction();
        try {
            $nghiepdoan->tennghiepdoan = $tennghiepdoan;
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
        $rule = [
            'tennghiepdoan' => 'required|unique:nghiepdoans,tennghiepdoan',
         ];
         $rulestran = [
            'tennghiepdoan.required' => 'Tên nghiệp đoàn không để trống hoặc đã tồn tại',
            'tennghiepdoan.unique'  => 'Tên nghiệp đoàn đã tồn tại',
        ];
        $this->validate($request,$rule,$rulestran);
        $tennghiepdoan = $request->tennghiepdoan;
        $nghiepdoan = new NghiepDoan;
        if($this->saveNghiepDoan($request,$nghiepdoan,$tennghiepdoan,"add")){
        return redirect('nghiepdoan')->with('status','Đã thêm "' . $request->tennghiepdoan . '" thành công!');
        }
        return redirect('nghiepdoan')->with('status','Đã thêm "' . $request->tennghiepdoan . '" không thành công!');
    }
     public function postEditNghiepDoan(Request $request,$id){
         $rule = [
            'tennghiepdoan' => 'required|unique:nghiepdoans,tennghiepdoan',
         ];
         $rulestran = [
            'tennghiepdoan.required' => 'Tên nghiệp đoàn không để trống hoặc đã tồn tại',
            'tennghiepdoan.unique'  => 'Tên nghiệp đoàn đã tồn tại',
        ];
        $tennghiepdoan = $request->tennghiepdoan;
        if (($request->tennghiepdoan != '') && ($request->tennghiepdoan != $request->tennghiepdoanhide)) {
            $this->validate($request,$rule,$rulestran);
        } else {
            $tennghiepdoan = $request->tennghiepdoanhide;
        }
        $nghiepdoan = NghiepDoan::find($id);
        if($this->saveNghiepDoan($request,$nghiepdoan,$tennghiepdoan,"edit")){
        return redirect('nghiepdoan')->with('status','Đã sửa "' . $tennghiepdoan . '" thành công!');
        }
        return redirect('nghiepdoan')->with('status','Đã sửa "' . $tennghiepdoan . '" không thành công!');
    }

    public function getDeleteNghiepDoan($id){
        $doitac = Doitac::where('id_nghiepdoan',$id)->count();
        if($doitac == 0){
            NghiepDoan::destroy($id);
            return redirect()->back()->with('status','Đã xóa thành công!');
        }else {
            return redirect()->back()->with('error','Đã xóa không thành công!, đơn hàng vẫn còn lưu công ty này');
        }
    }
    public function viewDoiTac($idnghiepdoan){
        $doitac = Doitac::where('id_nghiepdoan',$idnghiepdoan)->get();
        $nghiepdoan = NghiepDoan::find($idnghiepdoan);
        return view('admin.nghiepdoan.viewdoitac',[
            'doitac' => $doitac,
            'nghiepdoan' => $nghiepdoan
        ]);
    }
}
