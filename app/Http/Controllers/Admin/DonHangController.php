<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\DoiTac;
use App\Models\DonHang;
use App\Models\HoSoHocVien;
use App\Models\NganhNghe;
class DonHangController extends Controller
{
	public function getDonHang(){    
        $donhang = DonHang::all(); 
        $doitac = DoiTac::all();
        $nganhnghe = NganhNghe::all();
        $hoso = HoSoHocVien::all();
        return view('admin.donhang.donhang',['donhang' => $donhang,'doitac' => $doitac, 'nganhnghe' => $nganhnghe, 'hoso' => $hoso]);
    }
    public function postChangeDonHangStt(Request $request){
        $hoso = HoSoHocVien::find($request->id);
        $hoso->stt = $request->stt;
        $hoso->save();
        return response()->json('OK', 200);
    }

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

    public function getAddDonHang(){
    	$doitac = DoiTac::all();
        $nganhnghe = NganhNghe::all();    
        return view('admin.donhang.add_donhang',['doitac' => $doitac,'nganhnghe' => $nganhnghe]);
    }
    public static function saveDonHang($request,$donhang,$action){
        DB::beginTransaction();
        try {
            $donhang->hocvien_id = $request->hocvien_id;
            $donhang->doitac_id = $request->doitac;
            $donhang->nganhnghe_id = $request->congviec;
            $donhang->thoigian = $request->thoigian;
            $donhang->luongcoban = $request->luongcoban;
            $donhang->thue = $request->thue;
            $donhang->baohiem = $request->baohiem;
            $donhang->tiennha = $request->tiennha;
            $donhang->luongthuclanh = $request->luongthuclanh;
            $donhang->ngaytuyenbd = $request->ngaytuyenbd;
            $donhang->ngaytuyenkt = $request->ngaytuyenkt;
            $donhang->soluongtuyen = $request->soluongtuyen;
            $donhang->dukienxc = $request->dukienxc;
            $donhang->trinhdo = $request->trinhdo;
            $donhang->yeucau = $request->yeucau;
            $donhang->baohiem = $request->baohiem;
            $donhang->noithi = $request->noithi;
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
        $donhang = new DonHang;
        if($this->saveDonHang($request,$donhang,"add")){
        return redirect('admin-dashboard/donhangs')->with('status','Đã thêm Đơn hàng DH-0' . $request->id . ' thành công!');
        }
        return redirect('admin-dashboard/doitacs')->with('status','Đã thêm Đơn hàng DH-0' . $request->id . ' không thành công!');

    }

    public function getEditDonHang($id){
        $donhang = DonHang::find($id);
        $doitac = DoiTac::all();
        $nganhnghe = NganhNghe::all();
        return view('admin.donhang.edit_donhang',['doitac' => $doitac,'donhang' => $donhang, 'nganhnghe' => $nganhnghe]);
    }

    public function getShowDonHang($id){
        $donhang = DonHang::find($id);
        $doitac = DoiTac::all();
        $nganhnghe = NganhNghe::all();
        $hoso = HoSoHocVien::orderByRaw('stt ASC')->get();
        return view('admin.donhang.show_donhang',['doitac' => $doitac,'donhang' => $donhang, 'nganhnghe' => $nganhnghe, 'hoso' => $hoso]);
    }

    public function postEditDonHang(Request $request,$id){
        $donhang = DonHang::find($id);
        if($this->saveDonHang($request,$donhang,"edit")){
        return redirect('admin-dashboard/donhangs')->with('status','Đã sửa Đơn hàng DH-0' . $request->id . ' thành công!');
        }
        return redirect('admin-dashboard/donhangs')->with('status','Đã sửa Đơn hàng DH-0' . $request->id . ' không thành công!');

    }

    public function getCreateDonHang($id){
        $donhang = DonHang::find($id);
        $doitac = DoiTac::all();
        $hoso = HoSoHocVien::where('tinhtrang',1)->orWhere('id_donhang', $id)->orderByRaw('id_donhang DESC')->get();
        $nganhnghe = NganhNghe::all();
        return view('admin.donhang.create_donhang',['doitac' => $doitac,'donhang' => $donhang, 'hoso' => $hoso, 'nganhnghe' => $nganhnghe]);
    }
    public function postCreateDonHang(Request $request,$id){
        $donhang = DonHang::find($id);
        if($this->saveDonHang($request,$donhang,"create")){
        return redirect('admin-dashboard/donhangs')->with('status','Đã ghép Đơn hàng DH-0' . $request->id . ' thành công!');
        }
        return redirect('admin-dashboard/donhangs')->with('status','Đã ghép Đơn hàng DH-0' . $request->id . ' không thành công!');

    }
}
