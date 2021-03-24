<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\NhanVien;
use App\Models\HoSoHocVien;
use App\Models\DaoTao;
use App\Models\DiemDanh;
use Illuminate\Support\Facades\DB;
use Auth;
use Illuminate\Support\Facades\File;
class DiemDanhController extends Controller
{
    public function getDiemDanh(){      
        $giaovien = NhanVien::all();
        $daotao = DB::table('daotaos')
        ->join('nhanviens','nhanviens.id','=','daotaos.gvcn')
        ->select('daotaos.*','nhanviens.email')    
        ->get();
        $diemdanh = DB::table('diemdanhs')->whereDate('created_at',date('Y-m-d'))->pluck("id_lop")->toArray();
        $khoaduyet = DB::table('diemdanhs')->whereDate('created_at',date('Y-m-d'))->where('khoaduyet',1)->pluck("id_lop")->toArray();
        return view('admin.diemdanh.manage_diemdanh',['daotao' => $daotao,'giaovien'=> $giaovien,'diemdanh'=>$diemdanh,'khoaduyet'=>$khoaduyet]);
    }

    public function postDiemDanh(Request $request){
        $arr = $request->mcheck;
        if ($arr) {
            $mid = implode("-",$arr);
            return redirect('diemdanh/viewmanage/'.$request->mdate.'/'.$mid);
        }else{
            return redirect('diemdanh/manage')->with('status','Chưa có điểm danh!');
        }
    }
    public function getViewDiemDanh($mdate , $mid){
        $mdate = date('Y-m-d', strtotime($mdate));
        $arr = explode("-",$mid);
        $database = DB::table('diemdanhs')
            ->join('daotaos','daotaos.id','=','diemdanhs.id_lop')
            ->join('nhanviens','nhanviens.id','=','daotaos.gvcn')
            ->join('diemdanh_hocviens','diemdanh_hocviens.id_diemdanh','=','diemdanhs.id')
            ->join('hoso_hocviens','hoso_hocviens.id','=','diemdanh_hocviens.id_hocvien')
            ->whereDate('diemdanhs.created_at',$mdate)->whereIn('diemdanhs.id_lop', $arr)
            ->select('diemdanhs.id_lop','diemdanhs.created_at','diemdanhs.updated_at','diemdanhs.khoaduyet','daotaos.ten_lop_hoc','nhanviens.hoten',
                'diemdanh_hocviens.*', 'hoso_hocviens.hoten AS hotenhv')
            ->get()
            ->groupBy('id_lop');
        if (!$database || $database == null ) {
            return redirect()->back()->with('status','Chưa có điểm danh!');
        }
        $khoaduyet = DB::table('diemdanhs')->whereDate('created_at',$mdate)->whereIn('id_lop', $arr)->where('khoaduyet','<>',null)->pluck('id_lop')->toArray();
        // dd($database);
        return view('admin.diemdanh.viewmanage_diemdanh',[
            'mdate' => $mdate,
            'database' => $database,
            'arr'   => $arr,
            'khoaduyet' => $khoaduyet
        ]);
    }
    public function postViewDiemDanh(Request $request, $mdate , $mid){
        $mdate = date('Y-m-d', strtotime($mdate));
        if ($request->khoaduyet) {
            foreach ($request->khoaduyet as $item) {
                DB::table('diemdanhs')->whereDate('created_at',$mdate)->where('id_lop',$item)->update(['khoaduyet' => 1]);
            }         
        }
        if ($request->huykhoaduyet) {
            foreach ($request->huykhoaduyet as $item) {
                DB::table('diemdanhs')->whereDate('created_at',$mdate)->where('id_lop',$item)->update(['khoaduyet' => NULL]);
            }         
        }
        if ($request->duyet) {
            foreach ($request->duyet as $key => $items) {
                foreach ($items as $item) {
                    DB::table('diemdanh_hocviens')->where([['id_hocvien',$item],['id_diemdanh',$key]])->update(['duyet' => 1]);
                }
            }
        }
        if ($request->huyduyet) {
            foreach ($request->huyduyet as $key => $items) {
                foreach ($items as $item) {
                    DB::table('diemdanh_hocviens')->where([['id_hocvien',$item],['id_diemdanh',$key]])->update(['duyet' => NULL]);
                }
            }
        }
        
        return redirect()->back()->with('status','Xác nhận thành công!');
    }
    public function getAddDiemDanh($id){  
        $count =  DaoTao::where('id',$id)->count();
        if ($count == 0) {
            return redirect('diemdanh/error')->with('status','Chưa có lớp học này!');
        }
        $checkdiemdanh = DB::table('daotaos')
            ->join('nhanviens','nhanviens.id','=','daotaos.gvcn')
            ->where('daotaos.id',$id)->first();
        if ($checkdiemdanh->email != Auth::user()->email) {
            if(!Auth::user()->hasRole('Đào Tạo')){
                return redirect()->back()->with('status','Bạn không phải là giáo viên chủ nhiệm lớp vừa chọn!');
            }
        }
        $lop = DB::table('daotaos')
            ->join('nhanviens','nhanviens.id','=','daotaos.gvcn')
            ->where('daotaos.id',$id)
            ->select('daotaos.ten_lop_hoc','nhanviens.hoten','nhanviens.hinhanh')->first();

        $dbcheck = DB::table('diemdanhs')->whereDate('created_at',date("Y-m-d"))->where('id_lop',$id)->first();
        if (isset($dbcheck) && $dbcheck != null) {
            // edit diem danh
            $hocvien = DB::table('diemdanh_hocviens')
                ->join('diemdanhs','diemdanh_hocviens.id_diemdanh','=','diemdanhs.id')
                ->join('hoso_hocviens','hoso_hocviens.id','=','diemdanh_hocviens.id_hocvien')
                ->whereDate('diemdanhs.created_at',date('Y-m-d'))
                ->where('diemdanhs.id_lop',$id)
                ->select('diemdanh_hocviens.*','hoso_hocviens.hoten','diemdanhs.created_at')
                ->get();
        } else {
            // add diem danh
            $hocvien = DB::table('daotao_hocviens')
            ->join('hoso_hocviens','hoso_hocviens.id','=','daotao_hocviens.id_hocvien')
            ->where('daotao_hocviens.id_daotao',$id)->get();    
        }
    	return view('admin.diemdanh.add_diemdanh',['lop'=>$lop,'hocvien'=>$hocvien,'dbcheck'=>$dbcheck]);
    }
    
    public function postAddDiemDanh(Request $request, $id){
        $count = DB::table('diemdanhs')->whereDate('created_at',date("Y-m-d"))->where('id_lop',$id)->first();
        if($count){
            DB::table('diemdanhs')->where('id',$count->id)->update(['updated_at'=>date("Y-m-d H:i:s")]);
            $array = array();
            foreach ($request->id_hocvien as $key => $item) {
                $id_diemdanh = $request->id_diemdanh[$key];
                $vang = (isset($request->vang) && in_array($item, $request->vang)) ? 1 : NULL;
                $phep = (isset($request->phep) && in_array($item, $request->phep)) ? 1 : NULL;
                $tre = (isset($request->tre) && in_array($item, $request->tre)) ? 1 : NULL;
                $duyet = isset($request->duyet[$key]) == 'on' ? 1 : NULL;
                $lydo = isset($request->lydo[$key])? $request->lydo[$key] : NULL;
                $tiet = isset($tre)? $request->tiet[$key] : NULL;
                $donphep = $this->donphep($request,$key,$id_diemdanh,$item);
                if(!isset($donphep)){
                   $donphep = isset($request->donphephide[$key])? $request->donphephide[$key] : NULL;
                }
                // echo $donphep;
                DB::table('diemdanh_hocviens')->where([['id_diemdanh', $id_diemdanh],['id_hocvien',$item]])
                    ->update([ 'vang'=> $vang, 'phep'=> $phep, 'tre'=> $tre, 'tiet'=> $tiet,
                        'duyet'=> $duyet, 'lydo'=> $lydo, 'donphep'=> $donphep
                    ]);
            }            
            return redirect()->back()->with('status','Cập nhật thành công!');
        }else{
            // add diem danh
            $diemdanh = new DiemDanh;
            $diemdanh->id_lop = $id;
            $diemdanh->save();

            $array = array();
            foreach ($request->id_hocvien as $key => $item) {
                $vang = (isset($request->vang) && in_array($item, $request->vang)) ? 1 : NULL;
                $phep = (isset($request->phep) && in_array($item, $request->phep)) ? 1 : NULL;
                $tre = (isset($request->tre) && in_array($item, $request->tre)) ? 1 : NULL;
                $duyet = isset($request->duyet[$key]) == 'on' ? 1 : NULL;
                $lydo = isset($request->lydo[$key])? $request->lydo[$key] : NULL;
                $tiet = isset($tre)? $request->tiet[$key] : NULL;
                $donphep = $this->donphep($request,$key,$diemdanh->id,$item);
                array_push($array,[
                    'id_diemdanh'=>$diemdanh->id, 'id_hocvien'=> $item,
                    'vang'=> $vang, 'phep'=> $phep,
                    'tre'=> $tre, 'tiet'=> $tiet,
                    'duyet'=> $duyet, 'lydo'=> $lydo,
                    'donphep'=> $donphep
                ]);
            }
            DB::table('diemdanh_hocviens')->insert($array);
            return redirect()->back()->with('status','Điểm danh thành công!');
        }
    }
    public function donphep($request,$key,$id_diemdanh,$id_hocvien) {
        $timestamp = strtotime(date("Y-m-d H:i:s"));
        $year = date("Y", $timestamp);
        $month = date("m", $timestamp);
        if (isset($request->file('donphep')[$key])) {
            $file = $request->file('donphep')[$key];
            $duoi = $file->getClientOriginalExtension();
            if ($duoi != 'jpg' && $duoi != 'png' && $duoi != 'jpeg') {
                return NULL;
            }
            $name = $file->getClientOriginalName();
            $donphep = $id_diemdanh."_".$id_hocvien.".png";

            // while (file_exists("uploads/daotao/phep/".$year."/".$month."/".$donphep)) {
            //     $donphep = str_random(4)."_".$name;
            // }
            $file->move("uploads/daotao/phep/".$year."/".$month,$donphep);
            return $donphep;                    
        }else{
            return NULL;
        }
    }
    public function getErrorDiemDanh(){
        return view('admin.diemdanh.error_diemdanh');
    }
    
}