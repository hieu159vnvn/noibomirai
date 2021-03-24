<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\NhanVien;
use App\Models\HoSoHocVien;
use App\Models\DaoTao;
use App\Models\DiemDanh;
use Illuminate\Support\Facades\DB;
use Auth;
class DiemDanhController extends Controller
{
    public function getDiemDanh(){
        $daotao = DaoTao::all();
        return view('admin.diemdanh.manage_diemdanh',['daotao' => $daotao]);
    }

    public function postDiemDanh(Request $request){
        $arr = $request->mcheck;
        if ($arr) {
            $mid = implode("-",$arr);
            return redirect('admin-dashboard/diemdanhs/viewmanage/'.$request->mdate.'/'.$mid);
        }else{
            return redirect('admin-dashboard/diemdanhs/manage')->with('status','chưa có điểm danh!');
        }
    }
    
    public function getViewDiemDanh($mdate , $mid){
        $daotao = DaoTao::all();
        $hocvien = HoSoHocVien::all();
        $data = DiemDanh::whereDate('created_at',$mdate )->first();
        if ($data) {
            $mdata = $data->diemdanh;
        }else{
            return redirect()->back()->with('status','chưa có điểm danh!');
        }
        $arr = explode("-",$mid);
        return view('admin.diemdanh.viewmanage_diemdanh',['mdate' => $mdate, 'mid' => $arr, 'mdata' => $mdata, 'mdaotao' => $daotao, 'mhocvien' => $hocvien]);
    }
    
    public function postViewDiemDanh(Request $request, $mdate , $mid){
        $dd = DiemDanh::whereDate('created_at', $mdate)->first();
        $diemdanh = DiemDanh::find($dd->id);
        $a = ltrim($request->diemdanhsave,",");
        $a1 = "{".$a."}";
    
        $aa= json_decode($a1,true);
        $dd1 = $dd->diemdanh;
        $aa1= json_decode($dd1,true);
        foreach ($aa as $key => $value) {
            $aa1[$key] = $value; //change value array
        }
        $ab = json_encode($aa1);
        echo $diemdanh->diemdanh = $ab;
        $diemdanh->save();
        return redirect()->back()->with('status','Xác nhận thành công!');
    }

    public function getAddDiemDanh($id){
        
        if (Auth::user()) {
            $user = Auth::user();
            if ($user->level == 2) {
                $dt = DB::table('daotaos')->where(['gvcn'=>$user->id_nhan_vien ])->orderBy('id', 'desc')->first();
                if ($dt->id != $id) {
                    return redirect('admin-dashboard/diemdanhs/'.$dt->id.'/add')->with('status','');
                }
            }
        }else{
            return redirect('admin-login');
        }
        
        $daotao = DaoTao::where('id',$id)->first();
        $count =  DaoTao::where('id',$id)->count();
        $dd = DiemDanh::whereDate('created_at', date("Y-m-d"))->first();
        if ($count == 0) {
            return redirect('admin-dashboard/diemdanhs/error')->with('status','chưa có lớp học này!');
        }
        else{
    	   $giaovien = NhanVien::find($daotao->gvcn);
        }
        $hocvien = HoSoHocVien::all();
        if ($dd) {
        	$diemdanh = $dd->diemdanh;
        	$created_at = $dd->created_at;
        }else{
        	$diemdanh = '';
        	$created_at = date("Y-m-d");
        }	
    	return view('admin.diemdanh.add_diemdanh',['daotao'=>$daotao,'giaovien'=>$giaovien, 'hocvien'=>$hocvien,'id'=>$id, 'dd'=>$diemdanh, 'date'=>$created_at]);
    }
    
    public function postAddDiemDanh(Request $request, $id){
    	$this->validate($request,
            [
                'diemdanhsave' => 'required'
            ],
            [
                'diemdanhsave.required' => 'Bạn chưa đồng ý !',
            ]);

    	$count = DiemDanh::whereDate('created_at', date("Y-m-d"))->count();
    	if ($count < 1) {
    		$diemdanh = new DiemDanh;
    		$luus = '{"'.$id.'" : ['.$request->diemdanhsave.']}';
    		$diemdanh->diemdanh = $luus;
    		$diemdanh->save();
    		return redirect()->back()->with('status','Điểm danh thành công!');
    	}else{
    		$dd = DiemDanh::whereDate('created_at', date("Y-m-d"))->first();
    		$diemdanh = DiemDanh::find($dd->id);
    		$dd1 = $dd->diemdanh;
			$aa= json_decode($dd1,true);
			unset($aa[$id]);
			$ab = json_encode($aa);
            $ab = trim($ab,"{");
            $ab = rtrim($ab,"}");
            if (count($aa) > 0){
    		    $luu = $ab .','. '"'.$id.'" : ['.$request->diemdanhsave.']';
            }else {
                $luu =  '"'.$id.'" : ['.$request->diemdanhsave.']';
            }
	        echo $diemdanh->diemdanh = "{".$luu."}";
	        $diemdanh->save();
	        return redirect()->back()->with('status','Cập nhật thành công!');
    	}
    }
    public function getErrorDiemDanh(){

        return view('admin.diemdanh.error_diemdanh');
    }
    
}