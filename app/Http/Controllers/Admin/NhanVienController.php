<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\City;
use App\Models\NhanVien;
use App\Models\ChucVu;
use App\User;
use Maatwebsite\Excel\Facades\Excel;

class NhanVienController extends Controller
{        
    public function getNhanVien(){        
        $nhanvien = NhanVien::all();
        $nam = NhanVien::where('gioitinh','1')->get();
        $nu = NhanVien::where('gioitinh','0')->get();
        $tinhthanh = City::all(); 
        $chucvu = ChucVu::all();       
        return view('admin.nhanvien.nhanvien',['nhanvien' => $nhanvien,'chucvu'=>$chucvu,'tinhthanh' => $tinhthanh,'nam'=>count($nam),'nu'=>count($nu)]);
    }
    public function getAddNhanVien(){
        $tinhthanh = City::all(); 
        $chucvu = ChucVu::all();  
        return view('admin.nhanvien.add_nhanvien',['city'=> $tinhthanh,'chucvu'=> $chucvu]);
    } 
    public static function saveNhanvien($request,$nhanvien,$action){
        DB::beginTransaction();
        try {
            $nhanvien->hinhanh = $request->featureImage;
            $nhanvien->hoten = $request->hoten;
            $nhanvien->namsinh = $request->namsinh;
            $nhanvien->gioitinh = $request->gioitinh;
            $nhanvien->chucvu = $request->chucvu;
            $nhanvien->honnhan = $request->honnhan;                     
            $nhanvien->sodienthoai = $request->dienthoai; 
            $nhanvien->email = $request->email; 
            $nhanvien->diachi = $request->diachi;
            $nhanvien->ngayvaolam = $request->ngayvaolam;
            $nhanvien->tinhthanh = $request->tinhthanh;
            $nhanvien->trinhdo = $request->trinhdo;
            $nhanvien->chuyenmon = $request->chuyenmon;
            $nhanvien->ngoaingu = $request->ngoaingu;
            $nhanvien->kinhnghiem = $request->kinhnghiem;
            $nhanvien->ghichu = $request->ghichu;
            $nhanvien->save();
            
            DB::commit();
            return true;
        } 
        catch (Exception $e) {
            DB::rollBack();
            return fail;
        }
    } 

    public function postAddNhanVien(Request $request){
        $nhanvien = new NhanVien;
        if($this->saveNhanvien($request,$nhanvien,"add")){
        return redirect('admin-dashboard/nhanviens')->with('status','Đã thêm "' . $request->hoten . '" thành công!');
        }
        return redirect('admin-dashboard/nhanviens')->with('status','Đã thêm "' . $request->hoten . '" không thành công!');

    }   
    public function getEditNhanVien($id){
        $nhanvien = NhanVien::find($id);
        $tinhthanh = City::all(); 
        $chucvu = ChucVu::all(); 
        return view('admin.nhanvien.edit_nhanvien',['nhanvien' => $nhanvien,'tinhthanh' => $tinhthanh,'chucvu' => $chucvu]);
    }
    public function postEditNhanVien(Request $request,$id){
        $nhanvien = NhanVien::find($id);
        if($this->saveNhanvien($request,$nhanvien,"edit")){
        return redirect('admin-dashboard/nhanviens')->with('status','Đã sửa học viên "' . $request->hoten . '" thành công!');
        }
         return redirect('admin-dashboard/nhanviens')->with('status','Đã sửa "' . $request->hoten . '" không thành công!');
     }
    public function getDeleteNhanVien($id){
        NhanVien::destroy($id);
        return redirect()->back()->with('status','Đã xóa thành công!');
    }

 //    public function export() 
 //    {
 //        return Excel::download(new HoSoHocViensExport, 'hoso.xlsx');
 //    }  

 //    public function getHoso(){        
 //    	$hoso = HoSoHocVien::all();
 //        $nam = HoSoHocVien::where('gioitinh','1')->get();
 //        $nu = HoSoHocVien::where('gioitinh','0')->get();
 //        $tinhthanh = City::all();        
 //    	return view('admin.hoso.hosohocvien',['hoso' => $hoso,'tinhthanh' => $tinhthanh,'nam'=>count($nam),'nu'=>count($nu)]);
 //    }
 //    public function getAddHoso(){
 //        $city = City::all();
	// 	return view('admin.hoso.add_hosohocvien',['city'=>$city]);
	// }
 //    public function getEditHoso($id){
 //        $hoso = HoSoHocVien::find($id);
 //        $city = City::all();
 //        return view('admin.hoso.edit_hosohocvien',['hoso' => $hoso,'city' => $city]);
 //    }
	// public static function saveHoso($request,$hoso,$action){
 //        //dd($request);
	// 	DB::beginTransaction();
 //        try {
 //            $hoso->hinhanh = $request->featureImage;
	// 		$hoso->hoten = $request->hoten;
 //            $hoso->ngaysinh = $request->ngaysinh;
 //            $hoso->gioitinh = $request->gioitinh;
 //            $hoso->honnhan = $request->honnhan;
 //            $hoso->benhan = $request->benhan;
 //            $hoso->noisinh = $request->noisinh;
 //            $hoso->tuoi = $request->tuoi;
 //            $hoso->tongiao = $request->tongiao;
 //            $hoso->mien = $request->tinhthanh;
 //            $hoso->dienthoai = $request->dienthoai;
 //            $hoso->dtnguoithan = $request->dtnguoithan;
 //            $hoso->congviec = $request->congviec;
 //            $hoso->keo = $request->keo;
 //            $hoso->dua = $request->dua;
 //            $hoso->viet = $request->viet;
 //            $hoso->chieucao = $request->chieucao;
 //            $hoso->cannang = $request->cannang;
 //            $hoso->nhommau = $request->nhommau;
 //            $hoso->mattrai = $request->mattrai;
 //            $hoso->matphai = $request->matphai;
 //            $hoso->diachi = $request->diachi;
 //            $hoso->anhngu = $request->anhngu;
 //            $hoso->nhatngu = $request->nhatngu;
 //            $hoso->ngoaingukhac = $request->ngoaingukhac;
 //            $hoso->datungtoinhat = $request->datungtoinhat;
 //            $hoso->conguoithantainhat = $request->nguoithantainhat;
 //            $hoso->mucdich = $request->mucdich;
 //            $hoso->sotientrenthang = $request->sotientrenthang;
 //            $hoso->sotientrennam = $request->sotientrennam;
 //            $hoso->muctieu = $request->muctieu;
 //            $hoso->banglai = $request->banglai;
 //            $hoso->loaixe = $request->loaixe;
 //            $hoso->sothich = $request->sothich;
 //            $hoso->diemmanh = $request->diemmanh;
 //            $hoso->ngaydangky = $request->ngaydangky;
 //            $hoso->nguoiphutrach = $request->nguoiphutrach;
 //            $hoso->nguoigioithieu = $request->nguoigioithieu;

 //                //TIENG NHAT 
 //            $hoso->hoten_jp = $request->hoten_jp;
 //            $hoso->noisinh_jp = $request->noisinh_jp;
 //            $hoso->diachi_jp = $request->diachi_jp;
 //            $hoso->mien_jp = $request->mien_jp;
 //            $hoso->honnhan_jp = $request->honnhan_jp;
 //            $hoso->benhan_jp = $request->benhan_jp;
 //            $hoso->tongiao_jp = $request->tongiao_jp;
 //            $hoso->anhngu_jp = $request->anhngu_jp;
 //            $hoso->nhatngu_jp = $request->nhatngu_jp;
 //            $hoso->ngoaingukhac_jp = $request->ngoaingukhac_jp;
 //            $hoso->mucdich_jp = $request->mucdich_jp;
 //            $hoso->muctieu_jp = $request->muctieu_jp;
 //            $hoso->sotienthang_jp = $request->sotienthang_jp;
 //            $hoso->sotiennam_jp = $request->sotiennam_jp;
 //            $hoso->sothich_jp = $request->sothich_jp;
 //            $hoso->diemmanh_jp = $request->diemmanh_jp;

 //                //SUC KHOE
 //            $hoso->sk_uongruou  = $request->sk_uongruou;
 //            $hoso->sk_hutthuoc = $request->sk_hutthuoc;
 //            $hoso->sk_mumau = $request->sk_mumau;
 //            $hoso->sk_ditat = $request->sk_ditat;
 //            $hoso->sk_hinhxam = $request->sk_hinhxam;
 //            $hoso->sk_nhommau = $request->sk_nhommau;
 //            $hoso->sk_chieucao = $request->sk_chieucao;
 //            $hoso->sk_cannang = $request->sk_cannang;
 //            $hoso->sk_taythuan = $request->sk_taythuan;
 //            $hoso->sk_deokinh = $request->sk_deokinh;
 //            $hoso->sk_mattrai = $request->sk_mattrai;
 //            $hoso->sk_matphai = $request->sk_matphai;

 //                //HO CHIEU
 //            $hoso->hc_sohochieu = $request->hc_sohochieu;
 //            $hoso->hc_noicap = $request->hc_noicap;
 //            $hoso->hc_ngaycap = $request->hc_ngaycap;
 //            $hoso->hc_ngayhethan = $request->hc_ngayhethan;
 //            $hoso->hc_ngaynhan = $request->hc_ngaynhan;

 //                //LY LICH
 //            $hoso->ll_ngaycap = $request->ll_ngaycap;
 //            $hoso->ll_ngayhethan = $request->ll_ngayhethan;
 //            $hoso->ll_ngaynhan = $request->ll_ngaynhan;

 //                //VISA
 //            $hoso->vs_sohieu = $request->vs_sohieu;
 //            $hoso->vs_ngaydangky = $request->vs_ngaydangky;
 //            $hoso->vs_ngaycap = $request->vs_ngaycap;
 //            $hoso->vs_ngayhethan = $request->vs_ngayhethan;

 //                //THONG TIN
 //            $hoso->tt_giayto = "";
 //            if(count($request->tt_giayto) > 0){
 //            $giayto = '{"';
 //            foreach ($request->tt_giayto as $k => $gt) {
 //                    $giayto .= $k.'":"';
 //                    $giayto .= $gt.'","';
 //                }
 //                $giayto = rtrim($giayto,',"');
 //                $giayto .= '"}';  
 //                $hoso->tt_giayto = $giayto;          
 //            }
 //            $hoso->tt_loaikhac = $request->tt_loaikhac;
 //            $hoso->tt_ghichu = $request->tt_ghichu;

 //            $hoso->save();

           

			
 //            //save data table nguoithan_tainhats
 //            if($request->nguoithantainhat == 1){
 //                $ht = $request->hotennguoithan ;
 //                $nt = $request->tuoinguoithan ;
 //                $qh = $request->quanhenguoithan ;
 //                $nguoithan = array($ht,$nt,$qh);
 //                for ($i = 0; $i < count($ht) ; $i++) {                 
 //                    DB::table('nguoithan_tainhats')->insert(
 //                        [
 //                            'hocvien_id' => $hoso->id,
 //                            'hoten' => $nguoithan[0][$i],
 //                            'tuoi' => $nguoithan[1][$i],
 //                            'quanhe' => $nguoithan[2][$i]
 //                        ]);
 //                }                
 //            }
 //            //jp

 //            //save data table hoctaps
 //            if(count($request->thoigianhocbd)>0){
 //                $tghocbd = $request->thoigianhocbd ;
 //                $tghockt = $request->thoigianhockt ;
 //                $tt = $request->tentruong ;
 //                $dc = $request->diachitruong;
 //                $hoctap = array($tghocbd,$tghockt,$tt,$dc);
 //                for ($i = 0; $i < count($tghocbd) ; $i++) { 
 //                    if($hoctap[0][$i] != '' || $hoctap[0][$i] != null ) {               
 //                    DB::table('hoctaps')->insert(
 //                        [
 //                            'hocvien_id' => $hoso->id,
 //                            'thoigianbd' => $hoctap[0][$i],
 //                            'thoigiankt' => $hoctap[1][$i],
 //                            'tentruong' => $hoctap[2][$i],
 //                            'diachi' => $hoctap[3][$i]
 //                        ]);
 //                    }
 //                }                
 //            }

 //            //save data table lamviecs
 //            if(count($request->thoigianlamviecbd)>0){
 //                $tglamviecbd = $request->thoigianlamviecbd ;
 //                $tglamvieckt = $request->thoigianlamvieckt ;
 //                $cty = $request->tencongty ;
 //                $ndcongviec = $request->ndcongviec;
 //                $lamviec = array($tglamviecbd,$tglamvieckt,$cty,$ndcongviec);
 //                for ($i = 0; $i < count($tglamviecbd) ; $i++) {   
 //                    if($lamviec[0][$i] != '' || $lamviec[0][$i] != null){              
 //                    DB::table('lamviecs')->insert(
 //                        [
 //                            'hocvien_id' => $hoso->id,
 //                            'thoigianbd' => $lamviec[0][$i],
 //                            'thoigiankt' => $lamviec[1][$i],
 //                            'tencongty' => $lamviec[2][$i],
 //                            'congviec' => $lamviec[3][$i]
 //                        ]);
 //                    }
 //                }                
 //            }
 //            //save data table giadinhs    
 //             if(count($request->quanhegiadinh)>0){
 //                $qhgiadinh = $request->quanhegiadinh ;
 //                $htgiadinh = $request->hotengiadinh ;
 //                $nsgiadinh = $request->namsinhgiadinh ;
 //                $cvgiadinh = $request->congviecgiadinh;
 //                $nlgiadinh = $request->noilamviecgiadinh;
 //                $thunhapgiadinh = $request->thunhapgiadinh;
 //                $giadinh = array($qhgiadinh,$htgiadinh,$nsgiadinh,$cvgiadinh,$nlgiadinh,$thunhapgiadinh);
 //                for ($i = 0; $i < count($qhgiadinh) ; $i++) {    
 //                    if($giadinh[0][$i] != '' || $giadinh[0][$i] != null)  {           
 //                    DB::table('giadinhs')->insert(
 //                        [
 //                            'hocvien_id' => $hoso->id,
 //                            'quanhe' => $giadinh[0][$i],
 //                            'hoten' => $giadinh[1][$i],
 //                            'namsinh' => $giadinh[2][$i],
 //                            'congviec' => $giadinh[3][$i],
 //                            'noilamviec' => $giadinh[4][$i],
 //                            'luong' => $giadinh[5][$i]
 //                        ]);
 //                    }
 //                }                
 //            }
            
 //            DB::commit();
 //            return true;
 //        } 
 //        catch (Exception $e) {
 //            DB::rollBack();
 //            return fail;
 //        }		
	// }
 //    public function postAddHoso(Request $request){
 //        $hoso = new HoSoHocVien;
 //        if($this->saveHoso($request,$hoso,"add")){
 //        return redirect('admin-dashboard/hosohocviens')->with('status','Đã thêm "' . $request->hoten . '" thành công!');
 //        }
 //        return redirect('admin-dashboard/hosohocviens')->with('status','Đã thêm "' . $request->hoten . '" không thành công!');

 //    }
 //    public function postEditHoso(Request $request,$id){
 //        $hoso = HoSoHocVien::find($id);
 //        if($this->saveHoso($request,$hoso,"edit")){
 //        return redirect('admin-dashboard/hosohocviens')->with('status','Đã sửa học viên "' . $request->hoten . '" thành công!');
 //        }
 //         return redirect('admin-dashboard/hosohocviens')->with('status','Đã sửa "' . $request->hoten . '" không thành công!');

 //    }
 //    public function postModal(Request $request){
 //        $hocvien = HoSoHocVien::find($request->id);
 //        return response()->json($hocvien,200);
 //    }
 //    public function getDeleteHoso($id){
 //        HoSoHocVien::destroy($id);
 //        return redirect()->back()->with('status','Đã xóa thành công!');
 //    }

}
