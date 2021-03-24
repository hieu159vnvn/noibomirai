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
class DiemDanhController extends Controller
{
    public function getDiemDanh(){      
        $giaovien = NhanVien::all();
        $daotao = DaoTao::all();
        return view('admin.diemdanh.manage_diemdanh',['daotao' => $daotao,'giaovien'=> $giaovien]);
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
        // dd($mdate);
        $mdate = date('Y-m-d', strtotime($mdate));
        $daotao = DaoTao::all();
        $hocvien = HoSoHocVien::all();
        $data = DiemDanh::whereDate('created_at',$mdate )->first();
        if ($data) {
            $mdata = $data->diemdanh;
        }else{
            return redirect()->back()->with('status','Chưa có điểm danh!');
        }
        $arr = explode("-",$mid);
        return view('admin.diemdanh.viewmanage_diemdanh',['mdate' => $mdate, 'mid' => $arr, 'mdata' => $mdata, 'mdaotao' => $daotao, 'mhocvien' => $hocvien]);
    }
    
    public function postViewDiemDanh(Request $request, $mdate , $mid){
        // dd($mdate);
        $mdate = date('Y-m-d', strtotime($mdate));
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
        
        
        $email = Auth::user()->email;
        $giaovien = NhanVien::where('email',$email)->first();
        if($giaovien){
            $dt = DB::table('daotaos')->orderBy('id', 'desc')->first();
            echo $dt->id;
            echo $id;
            $roleid = DB::table('role_user')->where('user_id', Auth::user()->id)->first();
            $per = DB::table('permission_role')
            ->join('permissions', 'permission_role.permission_id', '=', 'permissions.id')
            ->select('permissions.name')
            ->where('permission_role.role_id', $roleid->role_id)
            ->get();
            $arr = array();
            foreach ($per as $key => $value) {
                array_push($arr,$value->name);
            }

            if ( ($dt->id != $id) && (in_array("daotao-list", $arr)) ) {
                return redirect()->back()->with('status','Bạn không phải là giáo viên chủ nhiệm lớp vừa chọn!');
            }
        }
              
        $daotao = DaoTao::where('id',$id)->first();
        $count =  DaoTao::where('id',$id)->count();
        $dd = DiemDanh::whereDate('created_at', date("Y-m-d"))->first();
        if ($count == 0) {
            return redirect('diemdanh/error')->with('status','Chưa có lớp học này!');
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