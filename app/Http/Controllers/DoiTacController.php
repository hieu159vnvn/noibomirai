<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\DoiTac;
use App\Models\NghiepDoan;
use App\Models\NganhNghe;
use App\Models\DonHang;

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
        $nganhnghe = NganhNghe::all();
        return view('admin.doitac.add_doitac',['doitac' => $doitac,'nghiepdoan' => $nghiepdoan, 'nganhnghe' => $nganhnghe]);
    }
    public static function saveDoiTac($request,$doitac,$tencongty,$action){
        DB::beginTransaction();
        try {
            $doitac->tencongty = $tencongty;
            $doitac->id_nghiepdoan = $request->nghiepdoan;
            $doitac->diachi = $request->diachi;
            $doitac->nguoidaidien = $request->nguoidaidien;
            $doitac->dienthoai = $request->dienthoai; //
            $doitac->email = $request->email;
            $doitac->ghichu = $request->ghichu;
            $doitac->nganhnghe = json_encode(array_unique($request->nganhnghe));
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
        $count = DB::table('doitacs')->where([
            ['id_nghiepdoan', '=', $request->nghiepdoan],
            ['tencongty', '=', $request->tencongty],
        ])->count();
        if ($count >= 1) {
            return redirect('doitac/add')->with('error','Tên công ty không để trống hoặc đã tồn tại!');
        }
        $tencongty = $request->tencongty;
        $doitac = new DoiTac;
        if($this->saveDoiTac($request,$doitac,$tencongty,"add")){
        return redirect('doitac')->with('status','Đã thêm "' . $tencongty . '" thành công!');
        }
        return redirect('doitac/add')->with('error','Đã thêm "' . $tencongty . '" không thành công!');

    }
    public function postEditDoiTac(Request $request,$id){

        $tencongty = $request->tencongty;
        if (($request->tencongty != '') && ($request->tencongty != $request->tencongtyhide)) {
            $tencongty = $request->tencongty;
        } else {
            $tencongty = $request->tencongtyhide;
        }
        $count = DB::table('doitacs')->where([
            ['id', '=', $id],
            ['tencongty', '=', $tencongty],
            ['id_nghiepdoan', '=', $request->nghiepdoan],
        ])->count();
        if ($count < 1) {
            $counta = DB::table('doitacs')->where([
                ['tencongty', '=', $tencongty],
                ['id_nghiepdoan', '=', $request->nghiepdoan],
            ])->count();
            if($counta >= 1){
                return redirect('doitac/'.$id.'/edit')->with('error','Tên công ty không để trống hoặc đã tồn tại!!');
            }
        }
        $doitac = Doitac::find($id);
        if($this->saveDoiTac($request,$doitac,$tencongty,"edit")){
            return redirect('doitac/'.$id.'/edit')->with('status','Đã sửa "' . $tencongty . '" thành công!');
        }
        return redirect('doitac/'.$id.'/edit')->with('error','Đã sửa "' . $tencongty . '" không thành công!');

    }
    public function getEditDoiTac($id){
        $doitac = Doitac::find($id);
        $doitacs = Doitac::all();
        $nghiepdoan = NghiepDoan::all();
        $nganhnghe = NganhNghe::all();     

        $nganhnghearray = array();
        $nganhngheselected = json_decode($doitac->nganhnghe,true);
        if (is_array($nganhngheselected) || is_object($nganhngheselected))
        {
            foreach ($doitacs as $key => $value) {
                $i = 0;
                foreach ($nganhngheselected as $mkey => $mvalue) {
                    if ($value->id == $mvalue) {
                        $i++;
                    }
                }
                if ($i > 0) {
                    array_push($nganhnghearray,$value);
                }            
            }
        }
       
        return view('admin.doitac.edit_doitac',['doitac' => $doitac,'doitacs' => $doitacs,'nghiepdoan' => $nghiepdoan , 'nganhnghe' => $nganhnghe, 'nganhnghearray' => $nganhnghearray]);
    }

    public function getDeleteDoiTac($id){
        $donhang = Donhang::where('doitac_id',$id)->count();
        if($donhang == 0){
            Doitac::destroy($id);
            return redirect()->back()->with('status','Đã xóa thành công!');
        }else {
            return redirect()->back()->with('error','Đã xóa không thành công!, công ty vẫn còn lưu nghiệp đoàn này');
        }
    }

    public function getViewHocVien($idcongty){
        $congty = Doitac::find($idcongty);
        return view('admin.doitac.view',[
            'congty' => $congty
        ]);
    }
}
