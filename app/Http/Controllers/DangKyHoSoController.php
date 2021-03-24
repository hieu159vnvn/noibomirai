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
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\HoSoHocViensExport;
use PDF;
use Auth;
use Illuminate\Support\Facades\File;

class DangKyHoSoController extends Controller
{
    
   
    public function getDangKyHoSo(){       
        $city = City::all(); 
        return view('admin.dangkyhoso.create',['city'=>$city]);
    }
    public function postDangKyHoSo(Request $request){
            $hoso = new HoSoHocVien;
        //$hoso->id_user = Auth::user()->id;
            //$hoso->hinhanh = $request->featureImage;
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
            // $iq = json_encode([
            //     'm1' => $request->m1,
            //     'm2' => $request->m2,
            //     'm3' => $request->m3,
            //     'm4' => $request->m4,
            //     'm5' => $request->m5
            // ]);
            // $hoso->iq = $iq;

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
            //$hoso->ngaydangky = date_format(date_create($request->ngaydangky), "Y-m-d");
            $hoso->ngaydangky = date("Y-m-d");
            $hoso->nguoiphutrach = $request->nguoiphutrach;
            $hoso->nguoigioithieu = $request->nguoigioithieu;
            if($request->tinhtrang == ''|| $request->tinhtrang == null){
                $hoso->tinhtrang = 1;
            }
            else{
                $hoso->tinhtrang = $request->tinhtrang;
            }

            $hoso->xetduyet = 1;
            $hoso->save();

           // if($action == "edit"){
           //      HosoImage::where('id_hocvien', $hoso->id)->delete();
           //      QuaTrinhHocTap::where('hocvien_id', $hoso->id)->delete();
           //      QuaTrinhLamViec::where('hocvien_id', $hoso->id)->delete();
           //      GiaDinh::where('hocvien_id', $hoso->id)->delete();
           //  }

            
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

             return redirect('dangky')->with('status', 'Đã thêm học viên thành công!');
            
    }

}
