<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\ChucVu;
use App\User;

class ChucvuController extends Controller
{        
    public function getChucVu(){    
        $chucvu = ChucVu::all();    
        return view('admin.chucvu.chucvu',['chucvu' => $chucvu]);
    }
    public function getAddChucVu(){ 
        return view('admin.chucvu.add_chucvu');
    } 
    public static function saveChucvu($request,$chucvu,$action){
        DB::beginTransaction();
        try {

            $chucvu->chucvu_vn = $request->chucvu_vn;
            $chucvu->chucvu_jp = $request->chucvu_jp;
            $chucvu->ghichu = $request->ghichu;
            
            $chucvu->save();
            
            DB::commit();
            return true;
        } 
        catch (Exception $e) {
            DB::rollBack();
            return fail;
        }
    } 

    public function postAddChucVu(Request $request){
        $chucvu = new ChucVu;
        if($this->saveChucvu($request,$chucvu,"add")){
        return redirect('admin-dashboard/chucvus')->with('status','Đã thêm "' . $request->chucvu_vn . '" thành công!');
        }
        return redirect('admin-dashboard/chucvus')->with('status','Đã thêm "' . $request->chucvu_vn . '" không thành công!');

    }   
    public function getEditChucvu($id){
        $chucvu = ChucVu::find($id);
        return view('admin.chucvu.edit_chucvu',['chucvu' => $chucvu]);
    }
    public function postEditChucvu(Request $request,$id){
        $chucvu = ChucVu::find($id);
        if($this->saveChucvu($request,$chucvu,"edit")){
        return redirect('admin-dashboard/chucvus')->with('status','Đã sửa "' . $request->chucvu_vn . '" thành công!');
        }
        return redirect('admin-dashboard/chucvus')->with('status','Đã sửa "' . $request->chucvu_vn . '" không thành công!');
    }

    public function getDeleteChucVu($id){
        ChucVu::destroy($id);
        return redirect()->back()->with('status','Đã xóa thành công!');
    }


}
