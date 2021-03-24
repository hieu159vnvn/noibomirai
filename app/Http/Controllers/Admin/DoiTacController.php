<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\DoiTac;
use App\Models\NghiepDoan;

class DoiTacController extends Controller
{
    public function getDoiTac(){    
        $doitac = Doitac::all();   
        $nghiepdoan = NghiepDoan::all(); 
        return view('admin.doitac.doitac',['doitac' => $doitac, 'nghiepdoan' => $nghiepdoan]);
    }
    public function getAddDoiTac(){    
        $doitac = Doitac::all();
        $nghiepdoan = NghiepDoan::all();    
        return view('admin.doitac.add_doitac',['doitac' => $doitac,'nghiepdoan' => $nghiepdoan]);
    }
    public static function saveDoiTac($request,$doitac,$action){
        DB::beginTransaction();
        try {
            $doitac->tencongty = $request->tencongty;
            $doitac->id_nghiepdoan = $request->nghiepdoan;
            $doitac->diachi = $request->diachi;
            $doitac->nguoidaidien = $request->nguoidaidien;
            $doitac->dienthoai = $request->dienthoai;
            $doitac->email = $request->email;
            $doitac->ghichu = $request->ghichu;
            $doitac->save();
        DB::commit();
        return true;
        } 
        catch (Exception $e) {
            DB::rollBack();
            return fail;
        }       

    }
    public function postAddDoiTac(Request $request){
        $doitac = new DoiTac;
        if($this->saveDoiTac($request,$doitac,"add")){
        return redirect('admin-dashboard/doitacs')->with('status','Đã thêm "' . $request->tencongty . '" thành công!');
        }
        return redirect('admin-dashboard/doitacs')->with('status','Đã thêm "' . $request->tencongty . '" không thành công!');

    }
    public function postEditDoiTac(Request $request,$id){
        $doitac = Doitac::find($id);
        if($this->saveDoiTac($request,$doitac,"edit")){
        return redirect('admin-dashboard/doitacs')->with('status','Đã sửa "' . $request->id . '" thành công!');
        }
        return redirect('admin-dashboard/doitacs')->with('status','Đã sửa "' . $request->id . '" không thành công!');

    }
    public function getEditDoiTac($id){
    	$doitac = Doitac::find($id);
    	$nghiepdoan = NghiepDoan::all();
    	return view('admin.doitac.edit_doitac',['doitac' => $doitac,'nghiepdoan' => $nghiepdoan]);
    }
}
