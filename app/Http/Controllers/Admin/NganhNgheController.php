<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\NganhNghe;
use App\User;

class NganhNgheController extends Controller
{        
    public function getNganhNghe(){    
        $nganhnghe = NganhNghe::all();    
        return view('admin.nganhnghe.nganhnghe',['nganhnghe' => $nganhnghe]);
    }
    public function getAddNganhNghe(){ 
        return view('admin.nganhnghe.add_nganhnghe');
    } 
    public static function saveNganhNghe($request,$nganhnghe,$action){
        DB::beginTransaction();
        try {
            $nganhnghe->nganhnghe_vn = $request->nganhnghe_vn;
            $nganhnghe->nganhnghe_jp = $request->nganhnghe_jp;
            $nganhnghe->ghichu = $request->ghichu;            
            $nganhnghe->save();            
            DB::commit();
            return true;
        } 
        catch (Exception $e) {
            DB::rollBack();
            return fail;
        }
    } 

    public function postAddNganhNghe(Request $request){
        $nganhnghe = new NganhNghe;
        if($this->saveNganhNghe($request,$nganhnghe,"add")){
        return redirect('admin-dashboard/nganhnghes')->with('status','Đã thêm "' . $request->nganhnghe_vn . '" thành công!');
        }
        return redirect('admin-dashboard/nganhnghes')->with('status','Đã thêm "' . $request->nganhnghe_vn . '" không thành công!');

    }   
    public function getEditNganhNghe($id){
        $nganhnghe = NganhNghe::find($id);
        return view('admin.nganhnghe.edit_nganhnghe',['nganhnghe' => $nganhnghe]);
    }
    public function postEditNganhNghe(Request $request,$id){
        $nganhnghe = NganhNghe::find($id);
        if($this->saveNganhNghe($request,$nganhnghe,"edit")){
        return redirect('admin-dashboard/nganhnghes')->with('status','Đã sửa "' . $request->nganhnghe_vn . '" thành công!');
        }
        return redirect('admin-dashboard/nganhnghes')->with('status','Đã sửa "' . $request->nganhnghe_vn . '" không thành công!');
    }

    public function getDeleteNganhNghe($id){
        NganhNghe::destroy($id);
        return redirect()->back()->with('status','Đã xóa thành công!');
    }


}
