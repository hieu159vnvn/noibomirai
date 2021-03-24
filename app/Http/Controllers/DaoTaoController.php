<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\NhanVien;
use App\Models\HoSoHocVien;
use App\Models\DaoTao;
use Illuminate\Support\Facades\DB;
use Auth;
class DaoTaoController extends Controller
{
    public function getDaoTao(){
    	$nhanvien = NhanVien::all();
    	$hocvien = HoSoHocVien::all();
    	$daotao = DaoTao::all();
        
    	$giaovien = NhanVien::where('chucvu','7')->get();
    	return view('admin.daotao.daotao',['daotao' => $daotao,'hocvien' => $hocvien,'giaovien' => $giaovien]);
    }
    public function getAddDaoTao(){
    	$giaovien = NhanVien::where('chucvu','7')->get();
        $hocvien = HoSoHocVien::all();
    	return view('admin.daotao.add_daotao',['giaovien'=>$giaovien, 'hocvien'=>$hocvien]);
    }
    public function postAddDaoTao(Request $request){
    	$this->validate($request,
            [
                'ten_lop_hoc' => 'required|min:4|max:100',
                // 'dshv' => 'required'
            ],
            [
                'ten_lop_hoc.required' => 'tên lớp học đừng bỏ trống',
                'ten_lop_hoc.min' => 'tên lớp học phải lớn hơn 3 ký tự',
                // 'dshv.required' => 'danh sách học viên phải thêm vào'
            ]);
        $daotao = new DaoTao;

        $daotao->ten_lop_hoc = $request->ten_lop_hoc;
        $daotao->ngay_khai_giang = $request->ngay_khai_giang;
        $daotao->gvcn = $request->gvcn;
        $daotao->coso = $request->coso;
        $daotao->save();
        // insert dao tao hoc vien
        $id = $daotao->id;
        $strdata = $request->dshv;
        if (isset($strdata)) {
            foreach ($strdata as $item) {
                DB::table('daotao_hocviens')->insert( ['id_daotao' => $id, 'id_hocvien' => $item]);
            }
        }
        
        return redirect('daotao')->with('status','Thêm lớp học thành công');
    }
    public function chuyenDaotao(Request $request,$id )
    {
        $id_hv = $request->id_hv;
        $id_lop = $request->id_lop;
        $id_chuyen = $request->id_chuyen;
        DB::table('daotao_hocviens')->insert(
            ['id_daotao'=>$id_lop,'id_hocvien'=>$id_hv]
        );
        DB::table('daotao_hocviens')->where([['id_hocvien',$id_hv],['id_daotao',$id_chuyen]])->delete();

        $date = date("Y-m-d H:i:s");
        DB::table('daotao_chuyenlops')->insert(
            ['id_daotao' => $id_chuyen,'id_hocvien' => $request->id_hv,'trangthai' => 0, 'created_at' => $date,'updated_at' => $date]
        );
        return "ok";
    }
  
    public function getEditDaoTao($id)
    {
        $hocvien = HoSoHocVien::all();
        $daotao = DaoTao::find($id);
        $giaovien = NhanVien::where('chucvu','7')->get();
        $lophoc = DB::table('daotaos')->whereNotIn('id', [$id])->get();
        return view('admin.daotao.edit_daotao',[ 
            'dt' => $daotao,
            'giaovien'=> $giaovien,
            'hocvien'=>$hocvien,
            'lophoc'=>$lophoc
            ]);
    }
    public function postEditDaoTao(Request $request,$id){
        $this->validate($request,
            [
                'ten_lop_hoc' => 'required|min:4|max:100',
                // 'dshv' => 'required'
            ],
            [
                'ten_lop_hoc.required' => 'tên lớp học đừng bỏ trống',
                'ten_lop_hoc.min' => 'tên lớp học phải lớn hơn 3 ký tự',
                // 'dshv.required' => 'danh sách học viên phải thêm vào'
            ]);
        $daotao = DaoTao::find($id);
        $daotao->ten_lop_hoc = $request->ten_lop_hoc;
        $daotao->ngay_khai_giang = $request->ngay_khai_giang;
        $daotao->gvcn = $request->gvcn;
        $daotao->coso = $request->coso;
        $daotao->save();
        return redirect('daotao/'.$id.'/edit')->with('status','Sửa lớp học thành công');   
    }
    public function ajaxPostEditDaoTao(Request $request,$id){
        try {
            $list = DB::table('daotao_hocviens')->where('id_daotao',$id)->pluck("id_hocvien")->toArray();
            if(in_array($request->id_hv,$list)){
                DB::table('daotao_hocviens')->where([['id_daotao', $id],['id_hocvien',$request->id_hv]])->delete();
            }else{
                DB::table('daotao_hocviens')->insert( ['id_daotao' => $id, 'id_hocvien' => $request->id_hv]);
            }
            return "ok";
        } catch (\Throwable $th) {
            return "false";
        }
        
    }
    public function getDeleteDaoTao($id){
    	DaoTao::destroy($id);
        return redirect()->back()->with('status','Đã xóa thành công!');
    }
    public function getViewDaoTao($id){

        $daotao = DB::table('daotaos')->join('nhanviens','nhanviens.id','=','daotaos.gvcn')->where('daotaos.id',$id)
        ->select('daotaos.id','daotaos.ten_lop_hoc','nhanviens.hoten')
        ->first();
        $hocviens = DB::table('daotao_hocviens')->join('hoso_hocviens','daotao_hocviens.id_hocvien','=','hoso_hocviens.id')
            ->where('daotao_hocviens.id_daotao',$id)
            ->select('hoso_hocviens.id','hoso_hocviens.created_at','hoso_hocviens.hinhanh','hoso_hocviens.hoten')
            ->get();
        return view('admin.daotao.view_daotao',[
            'dt' => $daotao,
            'hocviens'=>$hocviens]);
    }

    public function getShowDaoTao($id){
        $hocvien = DB::table('hoso_hocviens')
            ->leftJoin('daotao_hocviens','daotao_hocviens.id_hocvien','=','hoso_hocviens.id')
            ->leftJoin('daotaos','daotaos.id','=','daotao_hocviens.id_daotao')
            ->leftJoin('donhangs','donhangs.id','=','hoso_hocviens.id_donhang')
            ->leftJoin('nganhnghes','nganhnghes.id','=','donhangs.nganhnghe_id')
            ->leftJoin('doitacs','doitacs.id','=','donhangs.doitac_id')
            ->leftJoin('nghiepdoans','nghiepdoans.id','=','doitacs.id_nghiepdoan')
            ->where('hoso_hocviens.id',$id)
            ->select('hoso_hocviens.*','daotaos.ten_lop_hoc','donhangs.dukienxc','donhangs.ngaypv','nganhnghes.nganhnghe_vn','nganhnghes.nganhnghe_jp',
                'doitacs.tencongty','donhangs.doitacvn','nghiepdoans.tennghiepdoan','donhangs.diachi')->first();
            return view('admin.daotao.show_hoso_daotao',['hocvien'=>$hocvien]
        );
    }
// báo cáo
    public function getManageBaoCao($date){
    //      dang lam
        if ($date == 'all') {
            $date = date('Y').'-'.date('m');
        }
        $year = date("Y",strtotime($date));
        $month = date("m",strtotime($date));
        $checked = DB::table('daotao_thoihans')
        ->join('daotao_baocaos','daotao_baocaos.date_baocao','=','daotao_thoihans.id')
            ->whereYear('daotao_thoihans.thang_baocao','=',$year)
            ->whereMonth('daotao_thoihans.thang_baocao','=',$month)
            ->groupBy('daotao_baocaos.id_daotao')
            ->pluck("daotao_baocaos.id_daotao")->toArray();
        $arrchecked = implode(",",$checked);
  
        $daotao = DB::table('daotaos')
            ->join('nhanviens','nhanviens.id','=','daotaos.gvcn')
            ->leftJoin('daotao_baocaos','daotao_baocaos.id_daotao','=','daotaos.id')
            ->leftJoin('daotao_thoihans','daotao_thoihans.thang_baocao','=','daotao_baocaos.date_baocao')
            ->select(
                'daotaos.*','nhanviens.email','nhanviens.hoten',
                DB::raw('
                    SUM(CASE WHEN vnw_daotao_baocaos.id_daotao > 0 THEN 1 ELSE 0 END) AS cobaocao,
                    CASE WHEN FIND_IN_SET(vnw_daotaos.id, "'.$arrchecked.'") THEN "1" ELSE "0" END AS checkbaocao
                ')
            )
            ->groupBy('daotao_baocaos.id_daotao')
            ->get();
        
        $checkdate = DB::table('daotao_thoihans')->whereYear('daotao_thoihans.thang_baocao','=',$year)->whereMonth('daotao_thoihans.thang_baocao','=',$month)->first();
        

        $giaovien = DB::table('nhanviens')->where('email',Auth::user()->email)->first();
        if($giaovien)
        {
            $dt = DB::table('daotaos')->where('gvcn',$giaovien->id)->orderBy('id', 'desc')->first();
            if($dt){
                $iddaotao = $dt->id;
            }else{
                $iddaotao = 0;
            }
                   
        }else{
            $iddaotao = 0;
        }
        return view('admin.daotao.manage-baocao',['daotao'=>$daotao,'checkdate'=>$checkdate,'date'=>$date,'iddaotao'=>$iddaotao]);
    }
    public function postManageBaoCao(Request $request, $date){
    //      dang lam
        $tgbd = date("Y-m-d",strtotime($request->tgbd));
        $tgkt = date("Y-m-d",strtotime($request->tgkt));
        $duyet = $request->duyet == 'on' ? 1 : 0;

        $thang_baocao = $request->year.'-'.$request->month.'-01';
        $check = DB::table('daotao_thoihans')->whereDate('thang_baocao', $thang_baocao)->exists();
  
        if ($check) {
            DB::table('daotao_thoihans')->whereDate('thang_baocao', $thang_baocao)->update([
                'tgbd' => $tgbd, 
                'tgkt' => $tgkt, 
                'duyet' => $duyet, 
                'updated_at' => date("Y-m-d H:i:s") 
            ]);
        }else{
            DB::table('daotao_thoihans')->insert([
                'tgbd' => $tgbd, 
                'tgkt' => $tgkt, 
                'thang_baocao' => $thang_baocao, 
                'duyet' => $duyet, 
                'created_at' => date("Y-m-d H:i:s"), 
                'updated_at' => date("Y-m-d H:i:s") 
            ]);
        }
        $daotao = DB::table('daotaos')
            ->join('nhanviens','nhanviens.id','=','daotaos.gvcn')
            ->select('daotaos.*','nhanviens.email','nhanviens.hoten')    
            ->get();
        return redirect('daotao/manage-baocao/'.$request->year.'-'.$request->month)->with('status','Cập nhật đánh giá báo cáo thành công!');
    }
    public function getAjaxManageBaoCao($date,$id){
        return $id.$date;
    }
    public function getAjaxWatchBaoCao($date,$id){
        return $id.$date;
    }
    public function getAjaxThang ($date){
        return $date;
    }
    public function getAjaxNam ($date){
        return $date;
    }
    
    public function getBaoCao($date,$id) {
    //      dang lam
        $year = date("Y",strtotime($date));
        $month = date("m",strtotime($date));
        $thang_baocao = $year.'-'.$month.'-01';
        $checkbaocao = DB::table('daotao_thoihans')
            ->whereDate('thang_baocao', $thang_baocao)
            ->whereDate('tgbd','<=',date('Y-m-d'))
            ->whereDate('tgkt','>=',date('Y-m-d'))
            ->where('duyet',1)
            ->first();

        if (!$checkbaocao) {
            return redirect('daotao/manage-baocao/'.$year.'-'.$month)->with('status','Báo cáo tháng này đang tạm khóa!');
        }
        $checkdiemdanh = DB::table('daotaos')
            ->join('nhanviens','nhanviens.id','=','daotaos.gvcn')
            ->where('daotaos.id',$id)->first();
        if ($checkdiemdanh->email != Auth::user()->email) {
            if(!Auth::user()->hasRole('Đào Tạo')){
                return redirect()->back()->with('status','Bạn không phải là giáo viên chủ nhiệm lớp vừa chọn!');
            }
        }

        $dbcheck = DB::table('daotao_baocaos')
            ->join('hoso_hocviens','hoso_hocviens.id','=','daotao_baocaos.id_hocvien')
            ->join('daotao_thoihans','daotao_thoihans.id','=','daotao_baocaos.date_baocao')
            ->whereDate('daotao_thoihans.thang_baocao',$thang_baocao)
            ->where('daotao_baocaos.id_daotao',$id)
            ->select('hoso_hocviens.hoten','hoso_hocviens.gioitinh','hoso_hocviens.ngaysinh','daotao_baocaos.*')
            ->get();
        
        $data = DB::table('diemdanhs')
            ->join('diemdanh_hocviens','diemdanh_hocviens.id_diemdanh','=','diemdanhs.id')
            ->join('hoso_hocviens','hoso_hocviens.id','=','diemdanh_hocviens.id_hocvien')
            ->whereYear('diemdanhs.created_at','=',$year)
            ->whereMonth('diemdanhs.created_at','=',$month)
            ->where('diemdanhs.id_lop',$id)
            ->select(
                'hoso_hocviens.id AS id_hocvien','hoso_hocviens.hoten','hoso_hocviens.gioitinh','hoso_hocviens.ngaysinh','diemdanhs.id',
                DB::raw("
                    SUM(CASE WHEN vnw_diemdanh_hocviens.vang > 0 THEN 0 ELSE 1 END) AS comat,
                    SUM(CASE WHEN vnw_diemdanh_hocviens.tre > 0 THEN 1 ELSE 0 END) AS tre,
                    SUM(CASE WHEN vnw_diemdanh_hocviens.vang = 1 THEN 1 ELSE 0 END) AS vangmat
                "))
            ->groupBy('id_hocvien')
            ->get();
        $dataedit = NULL;
        if ($dbcheck->count() > 0) {
           $dataedit = $dbcheck;
        }
        return view('admin.daotao.baocao',['id'=>$id,'data'=>$data,'dataedit'=>$dataedit]);
    }

    public function postBaoCao(Request $request,$date,$id){
    //      dang lam
        $year = date("Y",strtotime($date));
        $month = date("m",strtotime($date));
        $thang_baocao = $year.'-'.$month.'-01';
        $checkbaocao = DB::table('daotao_thoihans')
            ->whereDate('thang_baocao', $thang_baocao)
            ->whereDate('tgbd','<=',date('Y-m-d'))
            ->whereDate('tgkt','>=',date('Y-m-d'))
            ->where('duyet',1)
            ->first();
        if (!$checkbaocao) {
            return redirect('daotao/manage-baocao/'.$year.'-'.$month)->with('status','Báo cáo tháng này đang tạm khóa!');
        }

        $checkdiemdanh = DB::table('daotaos')
            ->join('nhanviens','nhanviens.id','=','daotaos.gvcn')
            ->where('daotaos.id',$id)->first();
        if ($checkdiemdanh->email != Auth::user()->email) {
            if(!Auth::user()->hasRole('Đào Tạo')){
                return redirect()->back()->with('status','Bạn không phải là giáo viên chủ nhiệm lớp vừa chọn!');
            }
        }

        $dbcheck = DB::table('daotao_baocaos')
            ->join('daotao_thoihans','daotao_thoihans.id','=','daotao_baocaos.date_baocao')
            ->whereDate('daotao_thoihans.thang_baocao',$thang_baocao)
            ->where('daotao_baocaos.id_daotao',$id)
            ->count();

        $date_baocao = $checkbaocao->id;
       
        if ($dbcheck > 0) {
            // update baocao
            foreach ($request->id_hocvien as $key => $item) {
                $co_mat = isset($request->co_mat[$key])? $request->co_mat[$key] : NULL;
                $vang = isset($request->vang[$key])? $request->vang[$key] : NULL;
                $tre = isset($request->tre[$key])? $request->tre[$key] : NULL;
                $bai_hoc = isset($request->bai_hoc[$key])? $request->bai_hoc[$key] : NULL;
                $ngu_phap = isset($request->ngu_phap[$key])? $request->ngu_phap[$key] : NULL;
                $nghe = isset($request->nghe[$key])? $request->nghe[$key] : NULL;
                $noi = isset($request->noi[$key])? $request->noi[$key] : NULL;
                $diem_trung_binh = isset($request->diem_trung_binh[$key])? $request->diem_trung_binh[$key] : NULL;
                $diem_danh_gia = isset($request->diem_danh_gia[$key])? $request->diem_danh_gia[$key] : NULL;
                $danh_gia = isset($request->danh_gia[$key])? $request->danh_gia[$key] : NULL;
                DB::table('daotao_baocaos')
                    ->where([['id_daotao', $id],['id_hocvien',$item],['date_baocao',$date_baocao]])
                    ->update([ 
                        'co_mat'=> $co_mat,
                        'vang'=> $vang,
                        'tre'=> $tre,
                        'bai_hoc'=> $bai_hoc,
                        'ngu_phap'=> $ngu_phap,
                        'nghe'=> $nghe,
                        'noi'=> $noi,
                        'diem_trung_binh'=> $diem_trung_binh,
                        'diem_danh_gia'=> $diem_danh_gia,
                        'danh_gia'=> $danh_gia,
                        'updated_at'=> date("Y-m-d H:i:s")
                    ]);
            }
            return redirect()->back()->with('status','Cập nhật đánh giá báo cáo thành công!');
        } else {
            // insert baocao
            $array = array();
            foreach ($request->id_hocvien as $key => $item) {
                $co_mat = isset($request->co_mat[$key])? $request->co_mat[$key] : NULL;
                $vang = isset($request->vang[$key])? $request->vang[$key] : NULL;
                $tre = isset($request->tre[$key])? $request->tre[$key] : NULL;
                $bai_hoc = isset($request->bai_hoc[$key])? $request->bai_hoc[$key] : NULL;
                $ngu_phap = isset($request->ngu_phap[$key])? $request->ngu_phap[$key] : NULL;
                $nghe = isset($request->nghe[$key])? $request->nghe[$key] : NULL;
                $noi = isset($request->noi[$key])? $request->noi[$key] : NULL;
                $diem_trung_binh = isset($request->diem_trung_binh[$key])? $request->diem_trung_binh[$key] : NULL;
                $diem_danh_gia = isset($request->diem_danh_gia[$key])? $request->diem_danh_gia[$key] : NULL;
                $danh_gia = isset($request->danh_gia[$key])? $request->danh_gia[$key] : NULL;
                array_push($array,[
                    'id_daotao'=> $id,
                    'date_baocao' => $date_baocao,
                    'id_hocvien'=> $item,
                    'co_mat'=> $co_mat,
                    'vang'=> $vang,
                    'tre'=> $tre,
                    'bai_hoc'=> $bai_hoc,
                    'ngu_phap'=> $ngu_phap,
                    'nghe'=> $nghe,
                    'noi'=> $noi,
                    'diem_trung_binh'=> $diem_trung_binh,
                    'diem_danh_gia'=> $diem_danh_gia,
                    'danh_gia'=> $danh_gia,
                    'created_at'=> date("Y-m-d H:i:s"),
                    'updated_at'=> date("Y-m-d H:i:s")
                ]);
            }
            DB::table('daotao_baocaos')->insert($array);
            return redirect()->back()->with('status','Đánh giá báo cáo thành công!');
        }
    }

    public function getWatchBaoCao($date,$id) {
        //      dang lam
            $year = date("Y",strtotime($date));
            $month = date("m",strtotime($date));
            $checkdiemdanh = DB::table('daotaos')
                ->join('nhanviens','nhanviens.id','=','daotaos.gvcn')
                ->where('daotaos.id',$id)->first();
            if ($checkdiemdanh->email != Auth::user()->email) {
                if(!Auth::user()->hasRole('Đào Tạo')){
                    return redirect()->back()->with('status','Bạn không phải là giáo viên chủ nhiệm lớp vừa chọn!');
                }
            }
    
            $dbcheck = DB::table('daotao_baocaos')
                ->join('hoso_hocviens','hoso_hocviens.id','=','daotao_baocaos.id_hocvien')
                ->join('daotao_thoihans','daotao_thoihans.id','=','daotao_baocaos.date_baocao')
                ->whereYear('daotao_thoihans.thang_baocao',$year)
                ->whereMonth('daotao_thoihans.thang_baocao',$month)
                ->where('daotao_baocaos.id_daotao',$id)
                ->select('hoso_hocviens.hoten','hoso_hocviens.gioitinh','hoso_hocviens.ngaysinh','daotao_baocaos.*')
                ->get();

            $dataedit = NULL;
            if ($dbcheck->count() > 0) {
               $dataedit = $dbcheck;
            }
            return view('admin.daotao.watch_baocao',['id'=>$id,'dataedit'=>$dataedit]);
        }

}
