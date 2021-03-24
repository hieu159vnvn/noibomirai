<?php
namespace App\Http\Controllers\miraihuman;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\miraihuman\Gioithieu;
use App\User;

class GioithieuController extends Controller
{        
    public function getGioithieu(){    
        $gioithieu = Gioithieu::orderBy('id','desc')->get();
        return view('admin.miraihuman.gioithieu.gioithieu',['gioithieu' => $gioithieu]);
    }
    public function getAddGioithieu(){ 
        return view('admin.miraihuman.gioithieu.add_gioithieu');
    } 
    public static function saveGioithieu($request,$gioithieu,$action){
        DB::beginTransaction();
        try {    
            $gioithieu->ten = $request->ten;
            $gioithieu->tenjp = $request->tenjp;
            $gioithieu->noidung = $request->noidung;
            $gioithieu->noidungjp = $request->noidungjp;
            $gioithieu->stt = ($request->stt == 'on' ? 1 : 0);
            if ($request->sapxep == null) {
                $gioithieu->sapxep = 0;
            }else{
                $gioithieu->sapxep = $request->sapxep;
            }           
            $gioithieu->save();
            
            DB::commit();
            return true;
        } 
        catch (Exception $e) {
            DB::rollBack();
            return fail;
        }
    } 

    public function postAddGioithieu(Request $request){
        $gioithieu = new Gioithieu;
        $gioithieu->slug =  str_slug($request->ten, '-');
        $gioithieu->created_at = date("Y-m-d H:i:s");
        $gioithieu->updated_at = date("Y-m-d H:i:s");
        if($this->saveGioithieu($request,$gioithieu,"add")){
            $lastid = Gioithieu::orderBy('id', 'desc')->first();
            return redirect('gioithieu/'.$lastid->id.'/edit')->with('status', 'Đã thêm "' . $request->ten . '" thành công!');
        }
        return redirect('gioithieu')->with('status','Đã thêm "' . $request->ten. '" không thành công!');

    }   
    public function getEditGioithieu($id){
        $gioithieu = Gioithieu::find($id);
        return view('admin.miraihuman.gioithieu.edit_gioithieu',['gioithieu' => $gioithieu]);
    }
    public function postEditGioithieu(Request $request,$id){
        $gioithieu = Gioithieu::find($id);
        $gioithieu->slug =  str_slug($request->slug, '-');
        $gioithieu->updated_at = date("Y-m-d H:i:s");
        if($this->saveGioithieu($request,$gioithieu,"edit")){
            return redirect('gioithieu/'.$gioithieu->id.'/edit')->with('status','Đã sửa "' . $request->ten. '" thành công!');
        }
        return redirect('gioithieu/'.$gioithieu->id.'/edit')->with('status','Đã sửa "' . $request->ten. '" không thành công!');
    }

    public function getDeleteGioithieu($id){
        Gioithieu::destroy($id);
        return redirect()->back()->with('status','Đã xóa thành công!');
    }

    public function status(Request $request,$id){
        $gioithieu = Gioithieu::find($id);
        $gioithieu->stt = $request->status;
        $gioithieu->save();
        return $request->status;
    }

}
