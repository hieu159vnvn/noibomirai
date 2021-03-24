<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\KiTucXa;
use App\Models\NhanVien;
use App\Models\HoSoHocVien;
use Illuminate\Support\Facades\DB;
use Auth;
class KiTucXaController extends Controller
{
    public function getDanhSach(){
    	$danhsach = KiTucXa::where('loaiphong',1)->orderBy('id','desc')->get();
    	$danhsachdacbiet = KiTucXa::where('loaiphong',2)->orderBy('id','desc')->get();
    	return view('admin.kitucxa.danhsach',[
            'danhsach' => $danhsach,
            'danhsachdacbiet' => $danhsachdacbiet,
            ]);
    }
    public function delete($id){
        $check = DB::table('kitucxa_hocvien')->get();
        foreach ($check as $item) {
            if($item->id_kitucxa == $id){
                return redirect()->back()->with('error','Không xóa được khi phòng vẫn còn học viên');
            }
        }
        KiTucXa::destroy($id);
        return redirect()->back()->with('status','Đã xóa thành công!');
    }
    public function getAdd(){
    	return view('admin.kitucxa.add');
    }
    public function postAdd(Request $request){
        $check = KiTucXa::get();
        foreach ($check as $item) {
            if($item->tenphong == $request->tenphong){
                return redirect()->back()->with('error','Tên phòng đã tồn tại');
            }
        }
        $item = new KiTucXa;
        $item->tenphong = $request->tenphong;
        $item->loaiphong = 1;
        $item->sohocvien = $request->sohocvien;
        $item->save(); 
    	return redirect()->back()->with('status','Đã thêm thành công!');
    }
    public function getAddDacBiet(){
    	return view('admin.kitucxa.adddacbiet');
    }
    public function postAddDacBiet(Request $request){
        $check = KiTucXa::get();
        foreach ($check as $item) {
            if($item->tenphong == $request->tenphong){
                return redirect()->back()->with('error','Tên phòng đã tồn tại');
            }
        }
        $item = new KiTucXa;
        $item->tenphong = $request->tenphong;
        $item->loaiphong = 2;
        $item->sohocvien = $request->sohocvien;
        $item->save(); 
    	return redirect()->back()->with('status','Đã thêm thành công!');
    }
    public function getEdit($id){
        $kitucxa = KiTucXa::find($id);
    	return view('admin.kitucxa.edit',['kitucxa' => $kitucxa]);
    }
    public function postEdit(Request $request,$id){
        $check = KiTucXa::get();
        foreach ($check as $item) {
            if($item->tenphong == $request->tenphong){
                return redirect()->back()->with('error','Tên phòng đã tồn tại');
            }
        }
        $kitucxa = KiTucXa::find($id);
        if($request->tenphong!=null){
            $kitucxa->tenphong = $request->tenphong;
        }
        $kitucxa->sohocvien = $request->sohocvien;
        $kitucxa->save();
        return redirect('/kitucxa/danhsachphong')->with('status','Đã sửa thành công!');
    }
    public function getEditDacBiet($id){
        $kitucxa = KiTucXa::find($id);
    	return view('admin.kitucxa.editdacbiet',['kitucxa' => $kitucxa]);
    }
    public function postEditDacBiet(Request $request,$id){
        $check = KiTucXa::get();
        foreach ($check as $item) {
            if($item->tenphong == $request->tenphong){
                return redirect()->back()->with('error','Tên phòng đã tồn tại');
            }
        }
        $kitucxa = KiTucXa::find($id);
        if($request->tenphong!=null){
            $kitucxa->tenphong = $request->tenphong;
        }
        $kitucxa->sohocvien = $request->sohocvien;
        $kitucxa->save();
        return redirect('/kitucxa/danhsachphong')->with('status','Đã sửa thành công!');
    }
    public function addHocVien($idktx,$idhv){
        $check = DB::table('kitucxa_hocvien')->where([['id_kitucxa',$idktx],['id_hocvien',$idhv]])->first(); 
        $demhocvien=DB::table('kitucxa_hocvien')->where('id_kitucxa',$idktx)->count();
        $kitucxa = KiTucXa::find($idktx);
        if($demhocvien < $kitucxa->sohocvien){
            if($check==null){
                DB::table('kitucxa_hocvien')->insert(
                    ['id_kitucxa'=>$idktx,'id_hocvien'=>$idhv]
                );
                $creator = Auth::user()->name;
                $created_at = date("Y-m-d H:i:s");
                DB::table('kitucxa_hocvien_del')->insert(
                    ['thaotac'=> 'Thêm học viên vào phòng','id_kitucxa' => $idktx,'id_hocvien' => $idhv,'created_at' => $created_at,'creator' => $creator]
                );   
                $ngayvaoktx = HoSoHocVien::find($idhv);
                $ngayvaoktx->ngayvaoktx = $created_at;
                $ngayvaoktx->save();
            }
        }
    }
    public function delHocVien($idktx,$idhv,$lido){
        $item = DB::table('kitucxa_hocvien')->where('id_hocvien',$idhv)->delete();
        $created_at = date("Y-m-d H:i:s");
        $creator = Auth::user()->name;
        $insert = DB::table('kitucxa_hocvien_del')->insert(
            ['lido' => $lido,'thaotac'=> 'Xóa học viên ra khỏi phòng','id_kitucxa' => $idktx,'id_hocvien' => $idhv,'created_at' => $created_at,'creator' => $creator]
        );
    }
    public function view($id){
        $kitucxa = KiTucXa::find($id);
    	return view('admin.kitucxa.view',['kitucxa' => $kitucxa]);
    }
    public function getLichSu(){
        $lichsu = DB::table('kitucxa_hocvien_del')->orderBy('id','desc')->get();
        $kitucxa = KiTucXa::get();
        $hocvien = DB::table('hoso_hocviens')
		->select('id','hoten','hinhanh','ngaysinh','created_at')
		->orderBy('id','desc')
		->where('trangthaidongtienktx',1)
		->get();
    	return view('admin.kitucxa.lichsu',['lichsu' => $lichsu,'kitucxa' => $kitucxa,'hocvien' => $hocvien]);
    }
    public function getDanhSachHocVien(){
    	return view('admin.kitucxa.danhsachhocvien');
    }
}
