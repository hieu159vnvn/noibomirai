<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\NhanVien;
use App\Models\HoSoHocVien;
use App\Models\DaoTao;

class DaoTaoController extends Controller
{
    public function getDaoTao(){
        $nhanvien = NhanVien::all();
        $hocvien = HoSoHocVien::all();
        $daotao = DaoTao::all();
        $mdata=array();
        foreach ($daotao as $key => $value) {
            foreach (json_decode($value->dshv,true) as $mvalue) {
                array_push($mdata,$mvalue);
            }
        }
        foreach ($hocvien as $key => $value) {
            $i = 0;
            foreach ($mdata as $mkey => $mvalue) {
                if ($value->id == $mvalue) {
                    $i++;
                }
            }
            if ($i > 0) {
                unset($hocvien[$key]);
            }            
        }
         
        $giaovien = NhanVien::where('chucvu','7')->get();
        return view('admin.daotao.daotao',['daotao' => $daotao,'hocvien' => $hocvien,'giaovien' => $giaovien]);
    }
    public function getAddDaoTao(){
        $giaovien = NhanVien::where('chucvu','7')->get();
        $hocvien = HoSoHocVien::all();
        $daotao = DaoTao::all();

        $mdata=array();
        foreach ($daotao as $key => $value) {
            foreach (json_decode($value->dshv,true) as $mvalue) {
                array_push($mdata,$mvalue);
            }
        }
        foreach ($hocvien as $key => $value) {
            $i = 0;
            foreach ($mdata as $mkey => $mvalue) {
                if ($value->id == $mvalue) {
                    $i++;
                }
            }
            if ($i > 0) {
                unset($hocvien[$key]);
            }            
        }
        return view('admin.daotao.add_daotao',['giaovien'=>$giaovien, 'hocvien'=>$hocvien]);
    }
    public function postAddDaoTao(Request $request){
        $this->validate($request,
            [
                'ten_lop_hoc' => 'required|min:4|max:100',
                'dshv' => 'required'
            ],
            [
                'ten_lop_hoc.required' => 'tên lớp học đừng bỏ trống',
                'ten_lop_hoc.min' => 'tên lớp học phải lớn hơn 3 ký tự',
                'dshv.required' => 'danh sách học viên phải thêm vào'
            ]);
        $daotao = new DaoTao;
        $daotao->ten_lop_hoc = $request->ten_lop_hoc;
        $daotao->ngay_khai_giang = $request->ngay_khai_giang;
        $daotao->gvcn = $request->gvcn;
        $daotao->coso = $request->coso;
        $strdata = $request->dshv;
        $data = explode(",",$strdata);
        $dshv = "";
        foreach ($data as $key => $value) {
            $dshv .= '"'.$key.'":"'.$value.'",';
        }
        $dshv = '{'.rtrim($dshv,',').'}';
        echo $daotao->dshv = $dshv;
        $daotao->save();
        return redirect('daotao')->with('status','Thêm lớp học thành công');
    }
    public function getEditDaoTao($id){
        $hocvien = HoSoHocVien::all();
        $hocvien1 = HoSoHocVien::all();
        $daotao = DaoTao::find($id);
        $giaovien = NhanVien::where('chucvu','7')->get();
        $daotaoall = DaoTao::all();
        $mdata=array();
        foreach ($daotaoall as $key => $value) {
            foreach (json_decode($value->dshv,true) as $mvalue) {
                array_push($mdata,$mvalue);
            }
        }
        foreach ($hocvien as $key => $value) {
            $i = 0;
            foreach ($mdata as $mkey => $mvalue) {
                if ($value->id == $mvalue) {
                    $i++;
                }
            }
            if ($i > 0) {
                unset($hocvien[$key]);
            }            
        }

        $dshv=array();
        $mdshv = json_decode($daotao->dshv,true);
        foreach ($hocvien1 as $key => $value) {
            $i = 0;
            foreach ($mdshv as $mkey => $mvalue) {
                if ($value->id == $mvalue) {
                    $i++;
                }
            }
            if ($i > 0) {
                 array_push($dshv,$value);
            }            
        }
        return view('admin.daotao.edit_daotao',['dt' => $daotao,'dshv'=>$dshv,'giaovien'=> $giaovien,'hocvien'=>$hocvien]);
    }
    public function postEditDaoTao(Request $request,$id){
///////////////////////////////////////////////////////////

        $this->validate($request,
            [
                'ten_lop_hoc' => 'required|min:4|max:100',
                'dshv' => 'required'
            ],
            [
                'ten_lop_hoc.required' => 'tên lớp học đừng bỏ trống',
                'ten_lop_hoc.min' => 'tên lớp học phải lớn hơn 3 ký tự',
                'dshv.required' => 'danh sách học viên phải thêm vào'
            ]);
        $daotao = DaoTao::find($id);
        $daotao->ten_lop_hoc = $request->ten_lop_hoc;
        $daotao->ngay_khai_giang = $request->ngay_khai_giang;
        $daotao->gvcn = $request->gvcn;
        $daotao->coso = $request->coso;
        $strdata = $request->dshv;
        // dd($strdata);
        $data = explode(",",$strdata);
        $dshv = "";
        foreach ($data as $key => $value) {
            $dshv .= '"'.$key.'":"'.$value.'",';
        }
        $dshv = '{'.rtrim($dshv,',').'}';
        $daotao->dshv = $dshv;
        $daotao->save();
        return redirect('daotao')->with('status','Sửa lớp học thành công');
        
    }
    public function getDeleteDaoTao($id){
        DaoTao::destroy($id);
        return redirect()->back()->with('status','Đã xóa thành công!');
    }
    public function getViewDaoTao($id){
        $hocvien = HoSoHocVien::all();
        $daotao = DaoTao::find($id);
        $dshv = json_decode($daotao->dshv);
        $giaovien = NhanVien::find($daotao->gvcn);
        return view('admin.daotao.view_daotao',['dt' => $daotao,'dshv'=>$dshv,'giaovien'=> $giaovien,'hocvien'=>$hocvien]);
    }
}
