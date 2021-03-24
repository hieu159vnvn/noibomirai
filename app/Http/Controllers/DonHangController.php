<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\DoiTac;
use App\Models\DonHang;
use App\Models\HoSoHocVien;
use App\Models\HoSoHocVienJP;
use App\Models\NganhNghe;
use App\Models\NghiepDoan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
class DonHangController extends Controller
{
    public function printAjax($id){
        $donhang = DonHang::find($id);
        if ($donhang) {
            $doitac = DoiTac::where('id',$donhang->doitac_id)->first();
            $nghiepdoan = NghiepDoan::where('id',$doitac->id_nghiepdoan)->first();
            $nganhnghe = NganhNghe::where('id',$donhang->nganhnghe_id)->first();   
            $hoso = DB::table('hoso_hocviens')
                ->leftJoin('hoso_hocviens_jp', 'hoso_hocviens.id', '=', 'hoso_hocviens_jp.id_hocvien')
                ->where('hoso_hocviens.id_donhang', $donhang->id)
                ->select(
                    'hoso_hocviens.*', 
                    'hoso_hocviens_jp.hoten as hotenjp', 
                    'hoso_hocviens_jp.noisinh as noisinhjp', 
                    'hoso_hocviens_jp.honnhan as honnhanjp',
                    'hoso_hocviens_jp.id_hocvien as id_hocvien'
                )
                ->get();    
            $hosojps = DB::table('hoso_hocviens')
            ->join('hoso_hocviens_jp', 'hoso_hocviens.id', '=', 'hoso_hocviens_jp.id_hocvien')
            ->select('hoso_hocviens_jp.*', 
                'hoso_hocviens.stt as stt',
                'hoso_hocviens.hinhanh as hinhanh', 
                'hoso_hocviens.hoten as hotenvn',
                'hoso_hocviens.ngaysinh as ngaysinh',
                'hoso_hocviens.congviec as congviec',
                'hoso_hocviens.dua as dua',
                'hoso_hocviens.gioitinh as gioitinh',
                'hoso_hocviens.keo as keo',
                'hoso_hocviens.viet as viet' ,
                'hoso_hocviens.chieucao as chieucao',
                'hoso_hocviens.cannang as cannang',
                'hoso_hocviens.nhommau as nhommau',
                'hoso_hocviens.anhngu as anhngu',
                'hoso_hocviens.sotientrenthang as sotientrenthang',
                'hoso_hocviens.sotientrennam as sotientrennam',
                'hoso_hocviens.banglai as banglai',
                'hoso_hocviens.xemay as xemay',
                'hoso_hocviens.oto as oto',
                'hoso_hocviens.xekhac as xekhac',
                'hoso_hocviens.created_at as created_at'
                )
            ->where('hoso_hocviens.id_donhang', $id)
            ->get();
            return view('admin.donhang.printajax',[
                'doitac' => $doitac,
                'donhang' => $donhang, 
                'nganhnghe' => $nganhnghe, 
                'hoso' => $hoso,
                'nghiepdoan' => $nghiepdoan,
                'hosojps'   => $hosojps
                ]);
        } else {
            return redirect('donhang');
        }
    }
    public function getDonHang(){
        $donhang = DB::table("donhangs")->orderBy('ngaypv','desc')->get();
        $doitac = DoiTac::all();
        $nganhnghe = NganhNghe::all();
        $hoso = HoSoHocVien::whereNull('id_donhang')->get();
        return view('admin.donhang.donhang',['donhang' => $donhang,'doitac' => $doitac, 'nganhnghe' => $nganhnghe, 'hoso' => $hoso]);
    }
    public function getInDonHang($id){
        $donhang = DonHang::find($id);
        $doitac = DoiTac::where('id',$donhang->doitac_id)->first();
        if ($doitac) {
            $nghiepdoan = NghiepDoan::where('id',$doitac->id_nghiepdoan)->first();
        }else{
            $nghiepdoan = "";
        }
        
        $nganhnghe = NganhNghe::where('id',$donhang->nganhnghe_id)->first();
        return view('admin.donhang.indonhang',['donhang' => $donhang,'doitac' => $doitac, 'nganhnghe' => $nganhnghe,'nghiepdoan' => $nghiepdoan]);
    }
    public function postIndonhang(){
        return response()->json('OK', 200);
    }
    public function postChangeDonHangStt(Request $request){
        $hoso = HoSoHocVien::find($request->id);
        $hoso->stt = $request->stt;
        $hoso->save();
        return response()->json('OK', 200);
    }
// ajax nghiep doan
    public function getNghiepDoanAjax($id){
        $doitac = Doitac::where('id_nghiepdoan',$id)->get();
        return response()->json($doitac);
    }
// ajax doi tac
public function getDoiTacAjax($id){
    $doitac = Doitac::find($id);
    $arrays = json_decode($doitac->nganhnghe);
    if ($arrays != null) {
        $nganhnghe = DB::table('nganhnghes')
                        ->whereIn('id', $arrays)
                        ->get();
        return response()->json($nganhnghe);
    }
    return response()->json();
}
// ajax nghe nghiep
public function getNgheNghiepAjax(Request $request,$id){
    $nganhnghe_dt = json_encode(array_unique($request->nganhnghe));
    DB::table('doitacs')
            ->where('id', $id)
            ->update(['nganhnghe' => $nganhnghe_dt]);
    $nganhnghe = DB::table('nganhnghes')
                        ->whereIn('id', array_unique($request->nganhnghe))
                        ->get();
    return response()->json($nganhnghe);
}
//ajax tinh trang
    public function postChangeTinhTrang(Request $request){
        $hoso = HoSoHocVien::find($request->id);
        $hoso->tinhtrang = 0;
        $hoso->id_donhang = $request->dh;
        if($request->status === 'false'){
            $hoso->tinhtrang = 1;
            $hoso->id_donhang = null;
        }        
        $hoso->save();
        return response()->json('OK', 200);
    }
    public function postChangeDau(Request $request){
        $hoso = HoSoHocVien::find($request->id);
        $hoso->tinhtrang = 2; //Phong van Dat
        $hoso->save();
        return response()->json('OK', 200);
    }

    public function postChangeRot(Request $request){
        $hoso = HoSoHocVien::find($request->id);
        $hoso->tinhtrang = 4; //Phong van Rot
        $hoso->save();
        return response()->json('OK', 200);
    }
    public function getDuyetDH($id){
        $donhang = DonHang::find($id);
        if($donhang->tinhtrang == 1){
            $donhang->tinhtrang = 0;
        }else{
            $donhang->tinhtrang = 1;
        }
        $donhang->save();
        return response()->json('OK', 200);
    }

    public function getAddDonHang(){
        $nghiepdoan = NghiepDoan::all();
        $doitac = DoiTac::all();
        $nganhnghe = NganhNghe::all();    
        return view('admin.donhang.add_donhang',['nghiepdoan'=>$nghiepdoan,'doitac' => $doitac,'nganhnghe' => $nganhnghe]);
    }
    public static function saveDonHang($request,$donhang,$action){
    	$name = Auth::user()->name;
        DB::beginTransaction();
        try {
            $donhang->tendonhang = $request->tendonhang;
            $donhang->hocvien_id = $request->hocvien_id;
            $donhang->diachi = $request->diachi;
            $donhang->doitac_id = $request->doitac;
            $donhang->doitacvn = $request->doitacvn;
            $donhang->nganhnghe_id = $request->congviec;
            $donhang->tieudethem = $request->tieudethem;
            $donhang->tieudethemjp = $request->tieudethemjp;
            $donhang->nguoiqldh = $request->nguoiqldh;
            $donhang->nguoiqldhjp = $request->nguoiqldhjp;
            $donhang->noilamviec = $request->noilamviec;
            $donhang->thoigian = $request->thoigian;
            $donhang->luongcoban = $request->luongcoban;
            

            $donhang->khautru = $request->khautru;
            $donhang->luongthuclanh = $request->luongthuclanh;
            $donhang->soluongtuyen = $request->soluongtuyen;
            $donhang->soluongtuyenjp = $request->soluongtuyenjp;
            $donhang->soluongungvien = $request->soluongungvien;
            $donhang->soluongungvienjp = $request->soluongungvienjp;
            $donhang->dukienxc = $request->dukienxc;
            $donhang->ngaytuyenbd = $request->ngaytuyenbd;
            $donhang->ngaytuyenkt = $request->ngaytuyenkt;
            // ngay phong van
            $LogintDate = strtotime($request->ngaypv);
            $ngaypv = date('Y-m-d', $LogintDate);
            $donhang->ngaypv =  $ngaypv;
            
            $donhang->ngayguill = $request->ngayguill;
            $donhang->trinhdo = $request->trinhdo;
            $donhang->yeucau = $request->yeucau;
            $donhang->baohiem = $request->baohiem;
            $donhang->noithi = $request->noithi;
			$donhang->nguoitao = $name;
            // add file pdf
            $arrrequest = array(
                'hc' => array(
                'request_file' => $request->hc_file,
                'request_hidden' => $request->file_hc_hidden,
                'file' => 'hc_file',
                )
            );
            //add
            $timestamp = strtotime($donhang->created_at);
            $year = date("Y", $timestamp);
            $month = date("m", $timestamp);
            foreach ($arrrequest as $key => $value) {
                if ($value["request_hidden"] == "create") {
                    
                    $folder = str_slug($donhang->id, '-');
                    if ($value["request_file"]) {  
                         $arrfileup = array();
                        for ($i=0; $i < count($value["request_file"]) ; $i++) { 
                            
                            $file = $request->file($value["file"])[$i];
                            $duoi = $file->getClientOriginalExtension();
                            if ($duoi != 'doc' && $duoi != 'docx' && $duoi != 'pdf') 
                            {
                                return redirect()->back()->with('error','Không phải định dạng DOC, DOCX, PDF!');
                            }
                            $name = $file->getClientOriginalName();
                            $fileup = str_random(4)."_".$name;
                            while (file_exists("uploads/donhangpdfs/".$year."/".$month."/".$folder."/".$key."/".$fileup)) 
                            {
                                $fileup = str_random(4)."_".$name;
                            }        
                            $file->move("uploads/donhangpdfs/".$year."/".$month."/".$folder."/".$key,$fileup);
                            array_push($arrfileup,$fileup); 
                        }
                        $arrfileupgo = $arrfileup;
                        if ($key == "hc") {
                            $donhang->hc_file = json_encode($arrfileupgo);
                        }
                    }
                }
            }
            $donhang->save();
        DB::commit();
        return true;
        } 
        catch (Exception $e) {
            DB::rollBack();
            return fail;
        }       

    }
    public function postAddDonHang(Request $request){
        $this->validate($request,['doitac' => 'required'],['doitac.required' => 'lỗi thiếu thông tin công ty tiếp nhận',]);
        $donhang = new DonHang;
        if($this->saveDonHang($request,$donhang,"add")){
            $lastid = DonHang::orderBy('id', 'desc')->first();
            return redirect('donhang/'.$lastid->id.'/edit')->with('status', 'Đã thêm thành công!');
        }else{
            return redirect('donhang/add')->with('error','Đã thêm không thành công!');
        }

    }

    public function getEditDonHang($id){
        $donhang = DonHang::find($id);
        $doitac = DoiTac::all();
        $doitac_attemp = DoiTac::find($donhang->doitac_id);
        $nganhnghes = NganhNghe::all();
        if ($doitac_attemp->nganhnghe) {
            $nganhnghe_array = json_decode($doitac_attemp->nganhnghe);
            $nganhnghe_dt = Nganhnghe::whereIn('id', $nganhnghe_array)->get();
        } else {
            $nganhnghe_dt = array();
        }
        $nghiepdoans = NghiepDoan::all();
        $nghiepdoan = NghiepDoan::find($doitac_attemp->id_nghiepdoan);
        return view('admin.donhang.edit_donhang',['nghiepdoans'=>$nghiepdoans,'nghiepdoan'=>$nghiepdoan,'doitac' => $doitac,'donhang' => $donhang, 'nganhnghes' => $nganhnghes, 'nganhnghe_dt'=>$nganhnghe_dt]);
    }
    

    public function getShowDonHang($id){
        $donhang = DonHang::find($id);
        if ($donhang) {
            $doitac = DoiTac::where('id',$donhang->doitac_id)->first();
            $nghiepdoan = NghiepDoan::where('id',$doitac->id_nghiepdoan)->first();
            $nganhnghe = NganhNghe::where('id',$donhang->nganhnghe_id)->first();   
            $hoso = DB::table('hoso_hocviens')
                ->leftJoin('hoso_hocviens_jp', 'hoso_hocviens.id', '=', 'hoso_hocviens_jp.id_hocvien')
                ->where('hoso_hocviens.id_donhang', $donhang->id)
                ->select(
                    'hoso_hocviens.*', 
                    'hoso_hocviens_jp.hoten as hotenjp', 
                    'hoso_hocviens_jp.noisinh as noisinhjp', 
                    'hoso_hocviens_jp.honnhan as honnhanjp',
                    'hoso_hocviens_jp.id_hocvien as id_hocvien'
                )
                ->get();    
            return view('admin.donhang.show_donhang',[
                'doitac' => $doitac,
                'donhang' => $donhang, 
                'nganhnghe' => $nganhnghe, 
                'hoso' => $hoso,
                'nghiepdoan' => $nghiepdoan]);
        } else {
            return redirect('donhang');
        }
    }

    public function updatefile($donhang,$id,$request){
        $timestamp = strtotime($donhang->created_at);
        $year = date("Y", $timestamp);
        $month = date("m", $timestamp);
        $folder = str_slug($donhang->id, '-');

        $arrrequest = array(
            'cmnd' => array(
            'request_file' => $request->cmnd_file,
            'request_hidden' => $request->file_cmnd_hidden,
            'file'  => 'cmnd_file',
            ),
            'hc' => array(
            'request_file' => $request->hc_file,
            'request_hidden' => $request->file_hc_hidden,
            'file' => 'hc_file',
            ),
            'vs' => array(
            'request_file' => $request->vs_file,
            'request_hidden' => $request->file_vs_hidden,
            'file' => 'vs_file',
            ),
            'll' => array(
            'request_file' => $request->ll_file,
            'request_hidden' => $request->file_ll_hidden,
            'file' => 'll_file',
            )
        );

        foreach ($arrrequest as $key => $value) {
            if ($value["request_file"]) {  
                $arrfileup = array();
                for ($i=0; $i < count($value["request_file"]) ; $i++) {              
                    $file = $request->file($value['file'])[$i];
                    $duoi = $file->getClientOriginalExtension();
                    if ($duoi != 'doc' && $duoi != 'docx' && $duoi != 'pdf') 
                    {
                        return redirect()->back()->with('error','Không phải định dạng DOC, DOCX, PDF!');
                    }
                    $name = $file->getClientOriginalName();
                    $fileup = str_random(4)."_".$name;
                    while (file_exists("uploads/donhangpdfs/".$year."/".$month."/".$folder."/".$key."/".$fileup)) 
                    {
                        $fileup = str_random(4)."_".$name;
                    }        
                    $file->move("uploads/donhangpdfs/".$year."/".$month."/".$folder."/".$key."",$fileup);
                    array_push($arrfileup,$fileup); 
                }
                if ($value["request_hidden"]) {
                    $arrold = json_decode($value["request_hidden"]);
                    $arrfileupgo =  array_merge($arrfileup, $arrold);
                }else{
                    $arrfileupgo = $arrfileup;
                }
                if ($key == "cmnd") {
                    $donhang->cmnd_file = json_encode($arrfileupgo);
                }elseif ($key == "hc") {
                    $donhang->hc_file = json_encode($arrfileupgo);
                }elseif ($key == "vs") {
                    $donhang->vs_file = json_encode($arrfileupgo); 
                }elseif ($key == "ll") {
                    $donhang->ll_file = json_encode($arrfileupgo);
                }
                
                $donhang->save();
                
                $arrfolder = array(); 
                $dir = "uploads/donhangpdfs/".$year."/".$month."/".$folder."/".$key."";
                if (is_dir($dir)) {
                    if ($dh = opendir($dir)) {
                        while (($file = readdir($dh)) !== false) {
                            array_push($arrfolder,$file);       
                        }
                        closedir($dh);
                    }
                }   
                $arrdiff = array_diff($arrfolder,$arrfileupgo);
                foreach ($arrdiff as $key => $value) {
                    File::delete("uploads/donhangpdfs/".$year."/".$month."/".$folder."/".$key."/".$value);
                }
            
            } else{
                $arrfolder = array(); 
                $dir = "uploads/donhangpdfs/".$year."/".$month."/".$folder."/".$key;
                if (is_dir($dir)) {
                    if ($dh = opendir($dir)) {
                        while (($file = readdir($dh)) !== false) {
                            array_push($arrfolder,$file);       
                        }
                        closedir($dh);
                    }
                }   
                if ($value["request_hidden"]) {
                    $arrold = json_decode($value["request_hidden"]);
                }else{
                    $arrold = null;
                }
                if ($value["request_hidden"]) {
                    $arrdiff = array_diff($arrfolder,$arrold);
                    foreach ($arrdiff as $key => $value) {
                        File::delete("uploads/donhangpdfs/".$year."/".$month."/".$folder."/".$key."/".$value);
                    }
                }
                $donhang->save();
            }
        }
        
    }
    public function getRemoveFileDonhang($id,$file,$type){
        $donhang = DonHang::find($id);
        
        $timestamp = strtotime($donhang->created_at);
        $year = date("Y", $timestamp);
        $month = date("m", $timestamp);
        $folder = str_slug($id, '-');
        $arrfile = array($file);

        if ($type == "cmnd") {
            $arrdiff = array_diff(json_decode($donhang->cmnd_file), $arrfile );
        }elseif ($type == "hc") {
            $arrdiff = array_diff(json_decode($donhang->hc_file), $arrfile );
        }elseif ($type == "vs") {
            $arrdiff = array_diff(json_decode($donhang->vs_file), $arrfile );
        }elseif ($type == "ll") {
            $arrdiff = array_diff(json_decode($donhang->ll_file), $arrfile );
        }
        
        $success = "";
        foreach ($arrdiff as $key => $value) {
            $success .= '"'.$value.'",';
        }
        $success = '['.rtrim($success,',').']';
        if ($type == "cmnd") {
            $donhang->cmnd_file = $success;
        }elseif ($type == "hc") {
            $donhang->hc_file = $success;
        }elseif ($type == "vs") {
            $donhang->vs_file = $success;
        }elseif ($type == "ll") {
            $donhang->ll_file = $success;
        }
        
        $donhang->save();
        
        File::delete("uploads/donhangpdfs/".$year."/".$month."/".$folder."/".$type."/".$file);

        return json_encode($file);
    }
    public function postEditDonHang(Request $request,$id){
        $this->validate($request,['doitac' => 'required'],['doitac.required' => 'thiếu thông tin công ty tiếp nhận',]);
        $donhang = DonHang::find($id);
        $this->updatefile($donhang,$id,$request);
        if($this->saveDonHang($request,$donhang,"edit")){  
            return redirect('donhang/'.$donhang->id.'/edit')->with('status', 'Đã sữa thành công!');
        }else{
            return redirect('donhang')->with('status','Đã sửa Đơn hàng DH-0' . $request->id . ' không thành công!');
        }

    }

    public function getCreateDonHang($id){
        $donhang = DonHang::find($id);
        $doitac = DoiTac::where('id',$donhang->doitac_id)->first();
        $hoso = HoSoHocVien::where('tinhtrang',1)->orWhere('id_donhang', $id)->orderBy('id_donhang','DESC')->orderBy('id','DESC')->get();
        $nganhnghe = NganhNghe::where('id',$donhang->nganhnghe_id)->first();
        return view('admin.donhang.create_donhang',['doitac' => $doitac,'donhang' => $donhang, 'hoso' => $hoso, 'nganhnghe' => $nganhnghe, 'iddh' => $id]);
    }
    public function postCreateDonHang(Request $request,$id){
        $donhang = DonHang::find($id);
        if($this->saveDonHang($request,$donhang,"create")){
        return redirect('donhang')->with('status','Đã ghép Đơn hàng DH-0' . $request->id . ' thành công!');
        }
        return redirect('donhang')->with('status','Đã ghép Đơn hàng DH-0' . $request->id . ' không thành công!');

    }

    public function getDeleteDonHang($id){
        $hosohocvien = HoSoHocVien::where('id_donhang',$id)->count();
        if($hosohocvien == 0){
            DonHang::destroy($id);
            return redirect()->back()->with('status','Đã xóa thành công!');
        }else {
            return redirect()->back()->with('error','Đã xóa không thành công!, học viên vẫn còn lưu đơn hàng này');
        }
    }

}
