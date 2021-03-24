<?php
namespace App\Http\Controllers\miraihuman;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\miraihuman\Camnhanhocvien;
use App\User;

class CamnhanhocvienController extends Controller
{        
    public function index(){    
        $camnhan = Camnhanhocvien::orderBy('id','desc')->get();    
        return view('admin.miraihuman.camnhan.camnhan',['camnhan' => $camnhan]);
    }
    public function getAddcamnhan(){ 
        return view('admin.miraihuman.camnhan.add_camnhan');
    } 
    public static function savecamnhan($request,$camnhan,$action){
        DB::beginTransaction();
        try {    
            $camnhan->tenhocvien=$request->tenhocvien;
            $camnhan->nganhnghe=$request->nganhnghe;
            $camnhan->nganhnghejp=$request->nganhnghejp;
            $camnhan->noidung=$request->noidung;
            $camnhan->noidungjp=$request->noidungjp;
            $camnhan->image = strstr($request->image, 'miraiuploads/');  
            $camnhan->save();
            
            DB::commit();
            return true;
        } 
        catch (Exception $e) {
            DB::rollBack();
            return fail;
        }
    } 

    public function postAddcamnhan(Request $request){
        $camnhan = new Camnhanhocvien;
        if($this->savecamnhan($request,$camnhan,"add")){
            $lastid = Camnhanhocvien::orderBy('id', 'desc')->first();
            return redirect('camnhan/'.$lastid->id.'/edit')->with('status', 'Đã thêm "' . $request->tenhocvien . '" thành công!');
        }
        return redirect('camnhan')->with('status','Đã thêm "' . $request->tenhocvien . '" không thành công!');

    }   
    public function getEditcamnhan($id){
        $camnhan = Camnhanhocvien::find($id);
        return view('admin.miraihuman.camnhan.edit_camnhan',['camnhan' => $camnhan]);
    }
    public function postEditcamnhan(Request $request,$id){
        $camnhan = Camnhanhocvien::find($id);
        if($this->savecamnhan($request,$camnhan,"edit")){
            return redirect('camnhan/'.$camnhan->id.'/edit')->with('status','Đã sửa "' . $request->tenhocvien . '" thành công!');
        }
        return redirect('camnhan/'.$camnhan->id.'/edit')->with('status','Đã sửa "' . $request->tenhocvien . '" không thành công!');
    }

    public function getDeletecamnhan($id){
        Camnhanhocvien::destroy($id);
        return redirect()->back()->with('status','Đã xóa thành công!');
    }

    public function status(Request $request,$id){
        $camnhan = Camnhanhocvien::find($id);
        $camnhan->stt = $request->status;
        $camnhan->save();
        return $request->status;
    }

}
