<?php

namespace App\Http\Controllers\Admin;

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
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\HoSoHocViensExport;
use PDF;

class HoSoHocVienController extends Controller
{
    public function export() 
    {
        return Excel::download(new HoSoHocViensExport, 'hoso.xlsx');
    }
    public function pdf() 
    {
        $data = HoSoHocVien::where('id','264');
        $pdf = PDF::loadView('admin.hoso.show_hoso', $data);
        $pdf->save(storage_path().'_filename.pdf');
        return $pdf->download('customers.pdf');
    }    

    public function getHoso(){        
    	$hoso = HoSoHocVien::all();
        $nam = HoSoHocVien::where('gioitinh','1')->get();
        $nu = HoSoHocVien::where('gioitinh','0')->get();
        $tinhthanh = City::all();        
    	return view('admin.hoso.hosohocvien',['hoso' => $hoso,'tinhthanh' => $tinhthanh,'nam'=>count($nam),'nu'=>count($nu)]);
    }
    public function getShowHoso($id){        
        $hoso = HoSoHocVien::find($id);
        $hosojp = HoSoHocVienJP::where('id_hocvien',$id)->first();
        $hoctap = QuaTrinhHocTap::where('hocvien_id',$id)->get();
        $lamviec = QuaTrinhLamViec::where('hocvien_id',$id)->get();
        $giadinh = GiaDinh::where('hocvien_id',$id)->get();
        $city = City::all();
        return view('admin.hoso.show_hoso',['hoso' => $hoso,'hosojp'=> $hosojp,'hoctap' => $hoctap,'lamviec' => $lamviec,'giadinh' => $giadinh,'city' => $city]);
    }
    public function getAddHoso(){
        $city = City::all();
		return view('admin.hoso.add_hosohocvien',['city'=>$city]);
	}
    public function getEditHoso($id){
        $hoso = HoSoHocVien::find($id);
        $city = City::all();
        $hoctap = QuaTrinhHocTap::where('hocvien_id',$id)->get();
        $lamviec = QuaTrinhLamViec::where('hocvien_id',$id)->get();
        $giadinh = GiaDinh::where('hocvien_id',$id)->get();
        $hosoImages = HosoImage::where('id_hocvien',$id)->orderBy('id','ASC')->get();
        return view('admin.hoso.edit_hosohocvien',['hoso' => $hoso,'city' => $city,'hosoImages' => $hosoImages,'hoctap' => $hoctap,'lamviec'=>$lamviec,'giadinh'=>$giadinh]);
    }
    public function getTranHoso($id){
        $hoso = HoSoHocVien::find($id);
        $hocvien = HoSoHocVienJP::where('id_hocvien',$id)->first();
        if(count($hocvien)>0){
            return view('admin.hoso.tran_edit_hosohocvien',['hocvien'=>$hoso,'hoso'=> $hocvien]);
        }
        else{
        
        $city = City::all();
        $hoctap = QuaTrinhHocTap::where('hocvien_id',$id)->get();
        $lamviec = QuaTrinhLamViec::where('hocvien_id',$id)->get();
        $giadinh = GiaDinh::where('hocvien_id',$id)->get();
        return view('admin.hoso.tran_hosohocvien',['hoso' => $hoso,'city' => $city,'hoctap' => $hoctap,'lamviec'=>$lamviec,'giadinh'=>$giadinh]);
        }
    }
    public static function TranHoso($request,$hoso)
    {   
        DB::beginTransaction();
        try {
            $hoso->id_hocvien = $request->id_hocvien;
            $hoso->hoten = $request->hoten;
            $hoso->noisinh = $request->noisinh;
            $hoso->diachi = $request->diachi;
            $hoso->honnhan = $request->honnhan;
            $hoso->benhan = $request->benhan;
            $hoso->tongiao = $request->tongiao;              
            $content = json_encode([
                'thoigianbd' => $request->thoigianhocbd,
                'thoigiankt' => $request->thoigianhockt,
                'tentruong' => $request->tentruong,
                'diachitruong' => $request->diachitruong,
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
                'thunhap' => $request->thunhapgiadinh,
            ]);
            $hoso->hoctap = $content;
            $hoso->lamviec = $content1;
            $hoso->giadinh = $content2;            
            $hoso->mucdich = $request->mucdich;
            $hoso->muctieu = $request->muctieu;
            $hoso->diemmanh = $request->diemmanh;
            $hoso->sothich = $request->sothich;
            $hoso->save();
        DB::commit();
        return true;
        } 
        catch (Exception $e) {
            DB::rollBack();
            return fail;
        }       
    }
    public static function TranEditHoso($request,$hocvien,$action)
    {
        DB::beginTransaction();
        try {
            $hocvien->id_hocvien = $request->id_hocvien;
            $hocvien->hoten = $request->hoten;
            $hocvien->noisinh = $request->noisinh;
            $hocvien->diachi = $request->diachi;
            $hocvien->honnhan = $request->honnhan;
            $hocvien->benhan = $request->benhan;
            $hocvien->tongiao = $request->tongiao;              
            $content = json_encode([
                'thoigianbd' => $request->thoigianhocbd,
                'thoigiankt' => $request->thoigianhockt,
                'tentruong' => $request->tentruong,
                'diachitruong' => $request->diachitruong,
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
                'thunhap' => $request->thunhapgiadinh,
            ]);
            $hocvien->hoctap = $content;
            $hocvien->lamviec = $content1;
            $hocvien->giadinh = $content2;            
            $hocvien->mucdich = $request->mucdich;
            $hocvien->muctieu = $request->muctieu;
            $hocvien->diemmanh = $request->diemmanh;
            $hocvien->sothich = $request->sothich;
            $hocvien->save();
        DB::commit();
        return true;
        } 
        catch (Exception $e) {
            DB::rollBack();
            return fail;
        }       
    }
	public static function saveHoso($request,$hoso,$action){
		DB::beginTransaction();
        try {
            $hoso->hinhanh = $request->featureImage;
			$hoso->hoten = $request->hoten;
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
            $hoso->diachi = $request->diachi;
            $hoso->mien = $request->mien;
            $hoso->tinhthanh = $request->tinhthanh;
            $ngoaingu = json_encode([
                'tienganh' => $request->anhngu,
                'tiengnhat' => $request->nhatngu,
                'ngoaingukhac' => $request->ngoaingukhac,
            ]);
            $hoso->ngoaingu = $ngoaingu;

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

                //LY LICH
            $hoso->ll_ngaycap = $request->ll_ngaycap;
            $hoso->ll_ngaycohieuluc = $request->ll_ngaycohieuluc;
            $hoso->ll_hethan = $request->ll_hethan;

                //VISA
            $hoso->vs_sohieu = $request->vs_sohieu;
            $hoso->vs_ngaydangky = $request->vs_ngaydangky;
            $hoso->vs_ngaycap = $request->vs_ngaycap;
            $hoso->vs_ngayhethan = $request->vs_ngayhethan;

                //THONG TIN
            $hoso->tt_giayto = $request->tt_giayto;
            $hoso->tt_loaikhac = $request->tt_loaikhac;
            $hoso->tt_ghichu = $request->tt_ghichu;

            $hoso->save();

           if($action == "edit"){
                HosoImage::where('id_hocvien', $hoso->id)->delete();
                QuaTrinhHocTap::where('hocvien_id', $hoso->id)->delete();
                QuaTrinhLamViec::where('hocvien_id', $hoso->id)->delete();
                GiaDinh::where('hocvien_id', $hoso->id)->delete();
            }

			
            //save data table nguoithan_tainhats
            if($request->nguoithantainhat == 1){
                $ht = $request->hotennguoithan ;
                $nt = $request->tuoinguoithan ;
                $qh = $request->quanhenguoithan ;
                $nguoithan = array($ht,$nt,$qh);
                for ($i = 0; $i < count($ht) ; $i++) {                 
                    DB::table('nguoithan_tainhats')->insert(
                        [
                            'hocvien_id' => $hoso->id,
                            'hoten' => $nguoithan[0][$i],
                            'tuoi' => $nguoithan[1][$i],
                            'quanhe' => $nguoithan[2][$i]
                        ]);
                }                
            }
            //jp

            //save data table hoctaps
            if(count($request->thoigianhocbd)>0){
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
            if(count($request->thoigianlamviecbd)>0){
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
             if(count($request->quanhegiadinh)>0){
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

            if(count($request->hosoImage) > 0){
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
    public function postAddHoso(Request $request){
        $hoso = new HoSoHocVien;
        if($this->saveHoso($request,$hoso,"add")){
        return redirect('admin-dashboard/hosohocviens')->with('status','Đã thêm thành công!');
        }
        return redirect('admin-dashboard/hosohocviens')->with('status','Đã thêm không thành công!');

    }
    public function postEditHoso(Request $request,$id){
        $hoso = HoSoHocVien::find($id);
        if($this->saveHoso($request,$hoso,"edit")){
        return redirect('admin-dashboard/hosohocviens')->with('status','Đã sửa học viên thành công!');
        }
        return redirect('admin-dashboard/hosohocviens')->with('status','Đã sửa không thành công!');

    }
    public function postTranHoso(Request $request,$id){
        $hocvien = HoSoHocVienJP::where('id_hocvien',$id)->first();
        if($hocvien){
            if($this->TranEditHoso($request,$hocvien,"edit")){
            return redirect('admin-dashboard/hosohocviens')->with('status','Đã sửa học viên thành công!');
            }
            return redirect('admin-dashboard/hosohocviens')->with('status','Lỗi! Đã dịch không thành công!');
        }
        $hoso = new HoSoHocVienJP;
        if($this->TranHoso($request,$hoso)){
        return redirect('admin-dashboard/hosohocviens')->with('status','Đã dịch học viên thành công!');
        }
        return redirect('admin-dashboard/hosohocviens')->with('status','Lỗi! Đã dịch không thành công!');

    }
    public function postModal(Request $request){
        $hocvien = HoSoHocVien::find($request->id);
        return response()->json($hocvien,200);
    }
    public function getDeleteHoso($id){
        HoSoHocVien::destroy($id);
        return redirect()->back()->with('status','Đã xóa thành công!');
    }

}
