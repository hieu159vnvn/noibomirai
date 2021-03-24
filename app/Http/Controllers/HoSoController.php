<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\HoSoHocVien;
use App\Models\HoSoHocVienJP;
use App\Models\NguoiThanTaiNhat;
use App\Models\City;
use App\Models\QuaTrinhHocTap;
use App\Models\QuaTrinhLamViec;
use App\Models\GiaDinh;
use App\Models\HosoImage;
use App\User;
// use Maatwebsite\Excel\Facades\Excel;
// use App\Exports\HoSoHocViensExport;
// use PDF;
use Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
class HoSoController extends Controller
{
    public function vn_to_str ($str){
        $unicode = array(
        'a'=>'á|à|ả|ã|ạ|ă|ắ|ặ|ằ|ẳ|ẵ|â|ấ|ầ|ẩ|ẫ|ậ',
        'd'=>'đ',
        'e'=>'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ',
        'i'=>'í|ì|ỉ|ĩ|ị',
        'o'=>'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ',
        'u'=>'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự',
        'y'=>'ý|ỳ|ỷ|ỹ|ỵ',
        'A'=>'Á|À|Ả|Ã|Ạ|Ă|Ắ|Ặ|Ằ|Ẳ|Ẵ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ',
        'D'=>'Đ',
        'E'=>'É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ',
        'I'=>'Í|Ì|Ỉ|Ĩ|Ị',
        'O'=>'Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',
        'U'=>'Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự',
        'Y'=>'Ý|Ỳ|Ỷ|Ỹ|Ỵ',
        );
        foreach($unicode as $nonUnicode=>$uni){ 
            $str = preg_replace("/($uni)/i", $nonUnicode, $str);
        }
        $str = str_replace(' ','_',$str);
        return $str;
    }
    public function index(Request $request){        
        $nam = HoSoHocVien::where([['gioitinh','1'],['xetduyet',null]])->get();
        $nu = HoSoHocVien::where([['gioitinh','0'],['xetduyet',null]])->get();       
    	return view('admin.hoso.index',['nam'=>count($nam),'nu'=>count($nu)]);
    }
    public function getSourceHoso(Request $request){        
        $nam = HoSoHocVien::where([['gioitinh','1'],['xetduyet','1']])->get();
        $nu = HoSoHocVien::where([['gioitinh','0'],['xetduyet','1']])->get();       
        return view('admin.hoso.source',['nam'=>count($nam),'nu'=>count($nu)]);
    }
    public function testMissHoso(Request $request){        
        $nam = HoSoHocVien::where([['gioitinh','1'],['xetduyet',null]])->get();
        $nu = HoSoHocVien::where([['gioitinh','0'],['xetduyet',null]])->get();       
        return view('admin.hoso.testmiss',['nam'=>count($nam),'nu'=>count($nu)]);
    }
    public function getShowHoso($id){        
        $hoso = HoSoHocVien::find($id);
        $hosojp = HoSoHocVienJP::where('id_hocvien',$id)->first();
        $hoctap = QuaTrinhHocTap::where('hocvien_id',$id)->get();
        $lamviec = QuaTrinhLamViec::where('hocvien_id',$id)->get();
        $giadinh = GiaDinh::where('hocvien_id',$id)->get();
        $city = City::all();
        $nguoithan = NguoiThanTaiNhat::where('hocvien_id',$id)->get();
        $hocvien_daotao = DB::table('hoso_hocviens')
            ->leftJoin('daotao_hocviens','daotao_hocviens.id_hocvien','=','hoso_hocviens.id')
            ->leftJoin('daotaos','daotaos.id','=','daotao_hocviens.id_daotao')
            ->leftJoin('donhangs','donhangs.id','=','hoso_hocviens.id_donhang')
            ->leftJoin('nganhnghes','nganhnghes.id','=','donhangs.nganhnghe_id')
            ->leftJoin('doitacs','doitacs.id','=','donhangs.doitac_id')
            ->leftJoin('nghiepdoans','nghiepdoans.id','=','doitacs.id_nghiepdoan')
            ->where('hoso_hocviens.id',$id)
            ->select('hoso_hocviens.*','daotaos.ten_lop_hoc','donhangs.dukienxc','donhangs.ngaytuyenkt','nganhnghes.nganhnghe_vn','nganhnghes.nganhnghe_jp',
                'doitacs.tencongty','donhangs.doitacvn','nghiepdoans.tennghiepdoan','donhangs.diachi','daotaos.ngay_khai_giang')->first();
           
        return view('admin.hoso.show',[
            'hoso' => $hoso,
            'hosojp'=> $hosojp,
            'hoctap' => $hoctap,
            'lamviec' => $lamviec,
            'giadinh' => $giadinh,
            'city' => $city,
            'nguoithan' => $nguoithan,
            'hocvien'   => $hocvien_daotao
            ]);
    }
    public function getAddHoso(){
        $city = City::all();
		return view('admin.hoso.create',['city'=>$city]);
	}
    public function getEditHoso($id){
        $hoso = HoSoHocVien::find($id);
        $city = City::all();
        $hoctap = QuaTrinhHocTap::where('hocvien_id',$id)->get();
        $lamviec = QuaTrinhLamViec::where('hocvien_id',$id)->get();
        $giadinh = GiaDinh::where('hocvien_id',$id)->get();
        $hosoImages = HosoImage::where('id_hocvien',$id)->orderBy('id','ASC')->get();
        $nguoithan = NguoiThanTaiNhat::where('hocvien_id',$id)->get();
        return view('admin.hoso.edit',[
            'hoso' => $hoso,
            'city' => $city,
            'hosoImages' => $hosoImages,
            'hoctap' => $hoctap,
            'lamviec'=>$lamviec,
            'giadinh'=>$giadinh,
            'nguoithan'=> $nguoithan
        ]);
    }
    public function getTranHoso($id){
        
        $hoso = HoSoHocVien::find($id);
        $user = User::find($hoso->id_user);
        $hocvien = HoSoHocVienJP::where('id_hocvien',$id)->first();
        if($hocvien)
        {
            // $city = City::all();
            $city = City::where('id',$hoso->tinhthanh)->first();
            $hoctap = QuaTrinhHocTap::where('hocvien_id',$id)->orderBy('id','asc')->get();
            $lamviec = QuaTrinhLamViec::where('hocvien_id',$id)->orderBy('id','asc')->get();
            $giadinh = GiaDinh::where('hocvien_id',$id)->orderBy('id','asc')->get();
            $nguoithan = NguoiThanTaiNhat::where('hocvien_id',$id)->orderBy('id','asc')->get();
            return view('admin.hoso.tran_edit',[
                'hosojp'=> $hocvien,
                'hoso' => $hoso,
                'city' => $city,
                'ehoctap' => $hoctap,
                'elamviec'=>$lamviec,
                'egiadinh'=>$giadinh,
                'enguoithan'=>$nguoithan,
                'user'=>$user
            ]);
        }
        else
        {
            // $city = City::all();
            $city = City::where('id',$hoso->tinhthanh)->first();
            $hoctap = QuaTrinhHocTap::where('hocvien_id',$id)->get();
            $lamviec = QuaTrinhLamViec::where('hocvien_id',$id)->get();
            $giadinh = GiaDinh::where('hocvien_id',$id)->get();
            $nguoithan = NguoiThanTaiNhat::where('hocvien_id',$id)->get();
            return view('admin.hoso.tran',[
                'hoso' => $hoso,
                'city' => $city,
                'hoctap' => $hoctap,
                'lamviec'=>$lamviec,
                'giadinh'=>$giadinh,
                'nguoithan'=>$nguoithan,
                'user'=>$user
            ]);
        }
    }
    public function TranHoso($request,$hoso,$hocvienvn)
    {   
        DB::beginTransaction();
        try {       
            $hoso->id_hocvien = $request->id_hocvien;
            $hoso->hoten = $request->hoten;
            $hoso->noisinh = $request->noisinh.$request->noisinhplus;
            $hoso->diachi = $request->diachi;
            $hoso->diachimien = $request->diachimien;
            $hoso->honnhan = $request->honnhan;
            $hoso->benhan = $request->benhan;
            $hoso->tongiao = $request->tongiao;
            $hoso->mattrai = $request->mattrai;
            $hoso->matphai = $request->matphai;    
            $hoso->mien = $request->mien;   
            $hoso->dchk = json_encode([
                'dchk_dc' => $request->dchk_dc,
                'dchk_dc_plus' => $request->dchk_dc_plus,
                'dchk_xa' => $request->dchk_xa,
                'dchk_xa_plus' => $request->dchk_xa_plus,
                'dchk_huyen' => $request->dchk_huyen,
                'dchk_huyen_plus' => $request->dchk_huyen_plus,
                'dchk_tinh' => $request->dchk_tinh,
                'dchk_tinh_plus' => $request->dchk_tinh_plus
            ]);
       
            $content = json_encode([
                'thoigianbd' => $request->thoigianhocbd,
                'thoigiankt' => $request->thoigianhockt,
                'tentruong' => $request->tentruong,
                'diachitruong' => $request->diachitruong,
                'dctinh' => $request->dctinh //tinh
            ]);
            $content1 = json_encode([
                'thoigianbd' => $request->thoigianlamviecbd,
                'thoigiankt' => $request->thoigianlamvieckt,
                'tencongty' => $request->tencongty,
                'ndcongviec' => $request->ndcongviec,
            ]);
            $content2 = json_encode([
                'quanhe' => $request->quanhegiadinh,
                'hoten' => $request->hotengiadinh,
                'namsinh' => $request->namsinhgiadinh,
                'congviec' => $request->congviecgiadinh,
                'noilam' => $request->noilamviecgiadinh,
                'dctinh' => $request->gdtinhplus, //tinh
                'thunhap' => $request->thunhapgiadinh,
            ]);
            $content3 = json_encode([
                'hoten' => $request->hotennguoithan,
                'tuoi' => $request->tuoinguoithan,
                'quanhe' => $request->quanhenguoithan,
            ]);
            $hoso->hoctap = $content;
            $hoso->lamviec = $content1;
            $hoso->giadinh = $content2;        
            $hoso->nguoithan = $content3;          
            $hoso->mucdich = $request->mucdich;
            $hoso->muctieu = $request->muctieu;
            $hoso->diemmanh = $request->diemmanh;
            $hoso->sothich = $request->sothich;
            //nhat ngu
            $hoso->nhatngu = $request->nhatngu;
            $hoso->save();
            //IQ edit row root
            $iq = json_encode([
                'm1' => $request->m1,
                'm2' => $request->m2,
                'm3' => $request->m3,
                'm4' => $request->m4,
                'm5' => $request->m5
            ]);
            $hocvienvn->iq = $iq;

            // hinh anh
            $image = $request->featureImage;         
            $name_image = $this->vn_to_str($hocvienvn->hoten);
            $timestamp_image = strtotime($hocvienvn->created_at);
            $year_image = date("Y", $timestamp_image);
            $month_image = date("m", $timestamp_image);
            $day_image = date("d", $timestamp_image);
            if (strlen($image) >= 100){
                $id_image = $day_image.$month_image;
                $image = str_replace('data:image/png;base64,', '', $image);
                $image = str_replace(' ', '+', $image);
                $imageName = $name_image."_".$id_image . '.png';    
                Storage::disk('local')->put("/".$year_image."/".$month_image."/".$imageName, base64_decode($image));
                $hocvienvn->hinhanh = $imageName;
            }   
            // $hocvienvn->hinhanh = $request->featureImage; // hinh anh
            $hocvienvn->save();
        DB::commit();
        return true;
        } 
        catch (Exception $e) {
            DB::rollBack();
            return fail;
        }       
    }
    public function TranEditHoso($request,$hocvien,$hocvienvn,$action)
    {
        DB::beginTransaction();
        try {
            $hocvien->id_hocvien = $request->id_hocvien;
            $hocvien->hoten = $request->hoten;
            $hocvien->noisinh = $request->noisinh.$request->noisinhplus;
            $hocvien->diachi = $request->diachi;
            $hocvien->diachimien = $request->diachimien;
            $hocvien->honnhan = $request->honnhan;
            $hocvien->benhan = $request->benhan;
            $hocvien->tongiao = $request->tongiao;   
            $hocvien->mattrai = $request->mattrai;
            $hocvien->matphai = $request->matphai;       
            $hocvien->mien = $request->mien;
            $hocvien->dchk = json_encode([
                'dchk_dc' => $request->dchk_dc,
                'dchk_dc_plus' => $request->dchk_dc_plus,
                'dchk_xa' => $request->dchk_xa,
                'dchk_xa_plus' => $request->dchk_xa_plus,
                'dchk_huyen' => $request->dchk_huyen,
                'dchk_huyen_plus' => $request->dchk_huyen_plus,
                'dchk_tinh' => $request->dchk_tinh,
                'dchk_tinh_plus' => $request->dchk_tinh_plus
            ]);

            $content = json_encode([
                'thoigianbd' => $request->thoigianhocbd,
                'thoigiankt' => $request->thoigianhockt,
                'tentruong' => $request->tentruong,
                'diachitruong' => $request->diachitruong,
                'dctinh' => $request->dctinh //tinh
            ]);
            $content1 = json_encode([
                'thoigianbd' => $request->thoigianlamviecbd,
                'thoigiankt' => $request->thoigianlamvieckt,
                'tencongty' => $request->tencongty,
                'ndcongviec' => $request->ndcongviec,
            ]);
            $content2 = json_encode([
                'quanhe' => $request->quanhegiadinh,
                'hoten' => $request->hotengiadinh,
                'namsinh' => $request->namsinhgiadinh,
                'congviec' => $request->congviecgiadinh,
                'noilam' => $request->noilamviecgiadinh,
                'dctinh' => $request->gdtinhplus, //tinh
                'thunhap' => $request->thunhapgiadinh,
            ]);
            $content3 = json_encode([
                'hoten' => $request->hotennguoithan,
                'tuoi' => $request->tuoinguoithan,
                'quanhe' => $request->quanhenguoithan,
            ]);
            $hocvien->hoctap = $content;
            $hocvien->lamviec = $content1;
            $hocvien->giadinh = $content2;    
            $hocvien->nguoithan = $content3;          
            $hocvien->mucdich = $request->mucdich;
            $hocvien->muctieu = $request->muctieu;
            $hocvien->diemmanh = $request->diemmanh;
            $hocvien->sothich = $request->sothich;
            //NHAT NGU
            $hocvien->nhatngu = $request->nhatngu;
            $hocvien->save();
            //IQ edit row root
            $iq = json_encode([
                'm1' => $request->m1,
                'm2' => $request->m2,
                'm3' => $request->m3,
                'm4' => $request->m4,
                'm5' => $request->m5
            ]);
            $hocvienvn->iq = $iq;

             // hinh anh
             $image = $request->featureImage;         
             $name_image = $this->vn_to_str($hocvienvn->hoten);
             $timestamp_image = strtotime($hocvienvn->created_at);
             $year_image = date("Y", $timestamp_image);
             $month_image = date("m", $timestamp_image);
             $day_image = date("d", $timestamp_image);
             if (strlen($image) >= 100){
                 $id_image = $day_image.$month_image;
                 $image = str_replace('data:image/png;base64,', '', $image);
                 $image = str_replace(' ', '+', $image);
                 $imageName = $name_image."_".$id_image . '.png';    
                 Storage::disk('local')->put("/".$year_image."/".$month_image."/".$imageName, base64_decode($image));
                 $hocvienvn->hinhanh = $imageName;
             }   
            $hocvienvn->hinhanh = $request->featureImage; // hinh anh
            
            $hocvienvn->save();
        DB::commit();
        return true;
        } 
        catch (Exception $e) {
            DB::rollBack();
            return fail;
        }       
    }
	public function saveHoso($request,$hoso,$action){

		DB::beginTransaction();
        try {
			$hoso->id_user = Auth::user()->id;
            $hoso->hoten = $request->hoten;
            $image = $request->featureImage;
            if ($action == "edit") {
                $name_image = $this->vn_to_str($hoso->hoten);
                $timestamp_image = strtotime($hoso->created_at);
                $year_image = date("Y", $timestamp_image);
                $month_image = date("m", $timestamp_image);
                $day_image = date("d", $timestamp_image);
                if (strlen($image) >= 100){
                    $id_image = $day_image.$month_image;
                    $image = str_replace('data:image/png;base64,', '', $image);
                    $image = str_replace(' ', '+', $image);
                    $imageName = $name_image."_".$id_image . '.png';    
                    Storage::disk('local')->put("/".$year_image."/".$month_image."/".$imageName, base64_decode($image));
                    $hoso->hinhanh = $imageName;
                }
            } elseif ($action == "add") {
                $name_image = $this->vn_to_str($request->hoten);
                $year_image = date("Y");
                $month_image = date("m");
                $day_image = date("d");                
                $id_image = $day_image.$month_image;
                $image = str_replace('data:image/png;base64,', '', $image);
                $image = str_replace(' ', '+', $image);
                $imageName = $name_image."_".$id_image . '.png';    
                Storage::disk('local')->put("/".$year_image."/".$month_image."/".$imageName, base64_decode($image));
                $hoso->hinhanh = $imageName;
            }
            // exit();
            $hoso->ngaysinh = date_format(date_create($request->ngaysinh), "Y-m-d");
            $hoso->gioitinh = $request->gioitinh;
            $hoso->honnhan = $request->honnhan;
            $hoso->benhan = $request->benhan;
            $hoso->noisinh = $request->noisinh;
            $hoso->tongiao = $request->tongiao;
            $hoso->dienthoai = $request->dienthoai;
            $hoso->dtnguoithan = $request->dtnguoithan;
            $hoso->congviec = $request->congviec;
            $hoso->keo = $request->keo;
            $hoso->dua = $request->dua;
            $hoso->viet = $request->viet;
            $hoso->chieucao = $request->chieucao;
            $hoso->cannang = $request->cannang;
            $hoso->nhommau = $request->nhommau;
            $hoso->mattrai = $request->mattrai;
            $hoso->matphai = $request->matphai;
            $hoso->mien = $request->mien;
            // mới (địa chỉ hộ khẩu)
            $hoso->diachi = $request->diachi;    
            $hoso->dchk_huyen = $request->dchk_huyen;
            $hoso->dchk_xa = $request->dchk_xa;
            // $hoso->dchk_ap = $request->dchk_ap;
            $hoso->dchk_dc = $request->dchk_dc;
            $hoso->tinhthanh = $request->tinhthanh;
            $ngoaingu = json_encode([
                'tienganh' => $request->anhngu,
                'tiengnhat' => $request->nhatngu,
                'ngoaingukhac' => $request->ngoaingukhac,
            ]);
            $hoso->ngoaingu = $ngoaingu;
            $iq = json_encode([
                'm1' => $request->m1,
                'm2' => $request->m2,
                'm3' => $request->m3,
                'm4' => $request->m4,
                'm5' => $request->m5
            ]);
            $hoso->iq = $iq;

            $hoso->anhngu = $request->anhngu;
            $hoso->nhatngu = $request->nhatngu;
            $hoso->ngoaingukhac = $request->ngoaingukhac;

            $hoso->datungtoinhat = $request->datungtoinhat;
            $hoso->conguoithantainhat = $request->conguoithantainhat;
            $hoso->mucdich = $request->mucdich;
            $hoso->sotientrenthang = $request->sotientrenthang;
            $hoso->sotientrennam = $request->sotientrennam;
            $hoso->muctieu = $request->muctieu;
            $hoso->banglai = $request->banglai;
            if(isset($request->xemay))
                $hoso->xemay = 1;
            else
                $hoso->xemay = 0;
            if(isset($request->oto))
                $hoso->oto = 1;
            else
                $hoso->oto = 0;
            $hoso->xekhac = $request->xekhac;
            $hoso->sothich = $request->sothich;
            $hoso->diemmanh = $request->diemmanh;
            $hoso->ngaydangky = date_format(date_create($request->ngaydangky), "Y-m-d");
            $hoso->nguoiphutrach = $request->nguoiphutrach;
            $hoso->nguoigioithieu = $request->nguoigioithieu;
            if($request->tinhtrang == ''|| $request->tinhtrang == null){
                $hoso->tinhtrang = 1;
            }
            else{
                $hoso->tinhtrang = $request->tinhtrang;
            }

                //SUC KHOE
            $hoso->sk_uongruou  = $request->sk_uongruou;
            $hoso->sk_hutthuoc = $request->sk_hutthuoc;
            $hoso->sk_mumau = $request->sk_mumau;
            $hoso->sk_ditat = $request->sk_ditat;
            $hoso->sk_hinhxam = $request->sk_hinhxam;
            $hoso->sk_deokinh = $request->sk_deokinh;


                //HO CHIEU
            $hoso->hc_sohochieu = $request->hc_sohochieu;
            $hoso->hc_noicap = $request->hc_noicap;
            $hoso->hc_ngaycap = $request->hc_ngaycap;
            $hoso->hc_ngayhethan = $request->hc_ngayhethan;
            $hoso->hc_ngaynhan = $request->hc_ngaynhan;
                //CHUNG MINH NHAN DAN
            $hoso->cmnd_socmnd = $request->cmnd_socmnd;
            $hoso->cmnd_noicap = $request->cmnd_noicap;
            $hoso->cmnd_ngaycap = $request->cmnd_ngaycap;
            

                //LY LICH
            $hoso->ll_ngaycap = $request->ll_ngaycap;
            $hoso->ll_ngaycohieuluc =  $request->ll_ngaycohieuluc;
            $hoso->ll_hethan =  $request->ll_hethan;

                //VISA
            $hoso->vs_sohieu = $request->vs_sohieu;
            $hoso->vs_ngaydangky =  $request->vs_ngaydangky;
            $hoso->vs_ngaycap = $request->vs_ngaycap;
            $hoso->vs_ngayhethan = $request->vs_ngayhethan;

                //THONG TIN
            $hoso->tt_giayto = $request->tt_giayto;
            $hoso->tt_loaikhac = $request->tt_loaikhac;
            $hoso->tt_ghichu = $request->tt_ghichu;

            // re edit
            $hoso->re_edit = NULL;
            
            $hoso->save();

            if($action == "add"){
            	$hoso = HoSoHocVien::latest()->first();
            }
           if($action == "edit"){
                HosoImage::where('id_hocvien', $hoso->id)->delete();
                QuaTrinhHocTap::where('hocvien_id', $hoso->id)->delete();
                QuaTrinhLamViec::where('hocvien_id', $hoso->id)->delete();
                GiaDinh::where('hocvien_id', $hoso->id)->delete();
                NguoiThanTaiNhat::where('hocvien_id', $hoso->id)->delete();
            }

			
            //save data table nguoithan_tainhats
            if ($request->hotennguoithan) {
                $ht = $request->hotennguoithan ;
                $nt = $request->tuoinguoithan ;
                $qh = $request->quanhenguoithan ;
                $nguoithan = array($ht,$nt,$qh);
                for ($i = 0; $i < count($ht) ; $i++) {   
                    if ($nguoithan[0][$i] != '') {              
                        DB::table('nguoithan_tainhats')->insert(
                        [
                            'hocvien_id' => $hoso->id,
                            'hoten' => $nguoithan[0][$i],
                            'tuoi' => $nguoithan[1][$i],
                            'quanhe' => $nguoithan[2][$i]
                        ]);
                    }
                }                
            }

            //jp

            //save data table hoctaps
            if($request->thoigianhocbd){
                $tghocbd = $request->thoigianhocbd ;
                $tghockt = $request->thoigianhockt ;
                $tt = $request->tentruong ;
                $dc = $request->diachitruong;
                $hoctap = array($tghocbd,$tghockt,$tt,$dc);
                for ($i = 0; $i < count($tghocbd) ; $i++) { 
                    if($hoctap[0][$i] != '' || $hoctap[0][$i] != null ) {               
                    DB::table('hoctaps')->insert(
                        [
                            'hocvien_id' => $hoso->id,
                            'thoigianbd' => $hoctap[0][$i],
                            'thoigiankt' => $hoctap[1][$i],
                            'tentruong' => $hoctap[2][$i],
                            'diachi' => $hoctap[3][$i]
                        ]);
                    }
                }                
            }

            //save data table lamviecs
            if($request->thoigianlamviecbd){
                $tglamviecbd = $request->thoigianlamviecbd ;
                $tglamvieckt = $request->thoigianlamvieckt ;
                $cty = $request->tencongty ;
                $ndcongviec = $request->ndcongviec;
                $lamviec = array($tglamviecbd,$tglamvieckt,$cty,$ndcongviec);
                for ($i = 0; $i < count($tglamviecbd) ; $i++) {   
                    if($lamviec[0][$i] != '' || $lamviec[0][$i] != null){              
                    DB::table('lamviecs')->insert(
                        [
                            'hocvien_id' => $hoso->id,
                            'thoigianbd' => $lamviec[0][$i],
                            'thoigiankt' => $lamviec[1][$i],
                            'tencongty' => $lamviec[2][$i],
                            'congviec' => $lamviec[3][$i]
                        ]);
                    }
                }                
            }
            //save data table giadinhs    
             if($request->quanhegiadinh){
                $qhgiadinh = $request->quanhegiadinh ;
                $htgiadinh = $request->hotengiadinh ;
                $nsgiadinh = $request->namsinhgiadinh ;
                $cvgiadinh = $request->congviecgiadinh;
                $nlgiadinh = $request->noilamviecgiadinh;
                $thunhapgiadinh = $request->thunhapgiadinh;
                $giadinh = array($qhgiadinh,$htgiadinh,$nsgiadinh,$cvgiadinh,$nlgiadinh,$thunhapgiadinh);
                for ($i = 0; $i < count($qhgiadinh) ; $i++) {    
                    if($giadinh[0][$i] != '' || $giadinh[0][$i] != null)  {           
                    DB::table('giadinhs')->insert(
                        [
                            'hocvien_id' => $hoso->id,
                            'quanhe' => $giadinh[0][$i],
                            'hoten' => $giadinh[1][$i],
                            'namsinh' => $giadinh[2][$i],
                            'congviec' => $giadinh[3][$i],
                            'noilamviec' => $giadinh[4][$i],
                            'luong' => $giadinh[5][$i]
                        ]);
                    }
                }                
            }

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
                ),
                'scan' => array(
                'request_file' => $request->scan_file,
                'request_hidden' => $request->file_scan_hidden,
                'file' => 'scan_file',
                )
            );
    
            $timestamp = strtotime($hoso->created_at);
            $year = date("Y", $timestamp);
            $month = date("m", $timestamp);
            foreach ($arrrequest as $key => $value) {
                if ($value["request_hidden"] == "create") {
                    
                    $folder = str_slug($hoso->id, '-');
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
                            $fileup = str_random(4)."_".$this->vn_to_str($name);
                            while (file_exists("uploads/pdfs/".$year."/".$month."/".$folder."/".$key."/".$fileup)) 
                            {
                                $fileup = str_random(4)."_".$this->vn_to_str($name);
                            }        
                            $file->move("uploads/pdfs/".$year."/".$month."/".$folder."/".$key,$fileup);
                            array_push($arrfileup,$fileup); 
                        }
                        $arrfileupgo = $arrfileup;
                        if ($key == "cmnd") {
                            $hoso->cmnd_file = json_encode($arrfileupgo);
                        }elseif ($key == "hc") {
                            $hoso->hc_file = json_encode($arrfileupgo);
                        }elseif ($key == "vs") {
                            $hoso->vs_file = json_encode($arrfileupgo);
                        }elseif ($key == "ll") {
                            $hoso->ll_file = json_encode($arrfileupgo);
                        }elseif ($key == "scan") {
                            $hoso->scan_file = json_encode($arrfileupgo);
                        }          
                        $hoso->save();
                    }
                }
            }
            

            if($request->hosoImage){
                foreach ($request->hosoImage as $hosoImage) {
                    $image = new HosoImage;
                    $image->hinhanh = $hosoImage;
                    $image->id_hocvien = $hoso->id;
                    $image->save();
                }
            }

            DB::commit();
            return true;
        } 
        catch (Exception $e) {
            DB::rollBack();
            return fail;
        }		
	}
// UPDATE FILE   
    public function updatefile($hoso,$id,$request){
        $timestamp = strtotime($hoso->created_at);
        $year = date("Y", $timestamp);
        $month = date("m", $timestamp);
        $folder = str_slug($hoso->id, '-');

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
            ),
            'scan' => array(
            'request_file' => $request->scan_file,
            'request_hidden' => $request->file_scan_hidden,
            'file' => 'scan_file',
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
                    $fileup = str_random(4)."_".$this->vn_to_str($name);
                    while (file_exists("uploads/pdfs/".$year."/".$month."/".$folder."/".$key."/".$fileup)) 
                    {
                        $fileup = str_random(4)."_".$this->vn_to_str($name);
                    }        
                    $file->move("uploads/pdfs/".$year."/".$month."/".$folder."/".$key."",$fileup);
                    array_push($arrfileup,$fileup); 
                }
                if ($value["request_hidden"]) {
                    $arrold = json_decode($value["request_hidden"]);
                    $arrfileupgo =  array_merge($arrfileup, $arrold);
                }else{
                    $arrfileupgo = $arrfileup;
                }
                if ($key == "cmnd") {
                    $hoso->cmnd_file = json_encode($arrfileupgo);
                }elseif ($key == "hc") {
                    $hoso->hc_file = json_encode($arrfileupgo);
                }elseif ($key == "vs") {
                    $hoso->vs_file = json_encode($arrfileupgo); 
                }elseif ($key == "ll") {
                    $hoso->ll_file = json_encode($arrfileupgo);
                }elseif ($key == "scan") {
                    $hoso->scan_file = json_encode($arrfileupgo); 
                }
                
                $hoso->save();
                
                $arrfolder = array(); 
                $dir = "uploads/pdfs/".$year."/".$month."/".$folder."/".$key."";
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
                    File::delete("uploads/pdfs/".$year."/".$month."/".$folder."/".$key."/".$value);
                }
            
            } else{
                $arrfolder = array(); 
                $dir = "uploads/pdfs/".$year."/".$month."/".$folder."/".$key;
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
                        File::delete("uploads/pdfs/".$year."/".$month."/".$folder."/".$key."/".$value);
                    }
                }
                $hoso->save();
            }
        }
        
    }
    public function postAddHoso(Request $request){
        $hoso = new HoSoHocVien;
        
        if($this->saveHoso($request,$hoso,"add")){
            $lastid = HoSoHocVien::orderBy('id', 'desc')->first();
            return redirect('hoso/'.$lastid->id.'/edit')->with('status', 'Đã thêm thành công!');
        }else{
            return redirect('hoso/create')->with('error','Đã thêm không thành công!');
        }
    }
    public function postEditHoso(Request $request,$id){
        $hoso = HoSoHocVien::find($id);
        $hoso->xetduyet = null;
        $this->updatefile($hoso,$id,$request);

        if($this->saveHoso($request,$hoso,"edit")){
            if ($hoso->save()) {
                 return redirect('hoso/'.$hoso->id.'/edit')->with('status', 'Đã sửa học viên thành công!');
            }else{
                return redirect('hoso/'.$hoso->id.'/edit')->with('error', 'Đã sửa học viên không thành công!');
            }
        }
        return redirect('hoso/'.$hoso->id.'/edit')->with('error', 'Đã sửa học viên không thành công!');

    }
    public function postTranHoso(Request $request,$id){
        $hocvien = HoSoHocVienJP::where('id_hocvien',$id)->first();
        $hocvienvn = HoSoHocVien::where('id',$id)->first();
        if($hocvien){
            if($this->TranEditHoso($request,$hocvien,$hocvienvn,"edit")){
                return redirect('hoso/'.$id.'/tran')->with('status', 'Đã sửa dịch học viên thành công!');
            }
            return redirect('hoso/'.$id.'/tran')->with('error', 'Dịch học viên không thành công!');
        }
        $hoso = new HoSoHocVienJP;
        if($this->TranHoso($request,$hoso,$hocvienvn)){
            return redirect('hoso/'.$id.'/tran')->with('status', 'Đã dịch học viên thành công!');
        }
            return redirect('hoso/'.$id.'/tran')->with('status', 'Dịch học viên không thành công!');

    }
    public function postModal(Request $request){
        $hocvien = HoSoHocVien::find($request->id);
        return response()->json($hocvien,200);
    }
    public function getDeleteHoso($id){
        
        $hocvien = HoSoHocVien::find($id);
        $hocvien->tinhtrang = 6;
        $hocvien->save();
        return redirect()->back()->with('status','Đã xóa thành công!');
    }

    public function getRemoveFileHoso($id,$file,$type){
        $hocvien = HoSoHocVien::find($id);
        
        $timestamp = strtotime($hocvien->created_at);
        $year = date("Y", $timestamp);
        $month = date("m", $timestamp);
        $folder = str_slug($id, '-');
        $arrfile = array($file);

        if ($type == "cmnd") {
            $arrdiff = array_diff(json_decode($hocvien->cmnd_file), $arrfile );
        }elseif ($type == "hc") {
            $arrdiff = array_diff(json_decode($hocvien->hc_file), $arrfile );
        }elseif ($type == "vs") {
            $arrdiff = array_diff(json_decode($hocvien->vs_file), $arrfile );
        }elseif ($type == "ll") {
            $arrdiff = array_diff(json_decode($hocvien->ll_file), $arrfile );
        }elseif ($type == "scan") {
            $arrdiff = array_diff(json_decode($hocvien->scan_file), $arrfile );
        }
        
        $success = "";
        foreach ($arrdiff as $key => $value) {
            $success .= '"'.$value.'",';
        }
        $success = '['.rtrim($success,',').']';
        if ($type == "cmnd") {
            $hocvien->cmnd_file = $success;
        }elseif ($type == "hc") {
            $hocvien->hc_file = $success;
        }elseif ($type == "vs") {
            $hocvien->vs_file = $success;
        }elseif ($type == "ll") {
            $hocvien->ll_file = $success;
        }elseif ($type == "scan") {
            $hocvien->scan_file = $success;
        }
        
        $hocvien->save();
        
        File::delete("uploads/pdfs/".$year."/".$month."/".$folder."/".$type."/".$file);

        return json_encode($file);
    }

    public function delSourceHoso($id){
        $hocvien = HoSoHocVien::find($id);
        if ($hocvien) {
            if ($hocvien->xetduyet == 1) {
                $hocvien->delete();
                return redirect()->back()->with('status','Đã xóa học viên thành công');
            }else{
                return redirect()->back()->with('error','Bạn không có quyền xóa');
            } 
        }else{
            return redirect('hoso/source')->with('error','Không có học viên để xóa');
        }     
    }
    
    public function print($id){
        $arr = explode("-",$id);
        $hosos = DB::table('hoso_hocviens')->join('hoctaps','hoso_hocviens.id','=','hoctaps.hocvien_id')
        ->select('hoctaps.*')->whereIn('hoctaps.hocvien_id', $arr)->get();
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
            ->whereIn('hoso_hocviens_jp.id_hocvien', $arr)
            ->get();
        return view('admin.hoso.print',['hosos'=>$hosos, 'hosojps' => $hosojps]);
    }

    

    public function re_edit(Request $request,$id){
        $hoso_re_edit = HoSoHocVien::find($id);
        // $hoso_re_edit->re_edit = $request->re_edit;
        if ($request->re_edit == 1) {
            $hoso_re_edit->re_edit = 0;
        }else{
            $hoso_re_edit->re_edit = 1;
        }
        $hoso_re_edit->save();
        return 'success';
    }
    public function status(Request $request,$id){
        $item = HoSoHocVien::find($id);
        $item->trangthaidongtienktx = $request->status;
        $item->save();
        return $request->status;
    }

}
