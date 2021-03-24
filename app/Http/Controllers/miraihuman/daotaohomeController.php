<?php
namespace App\Http\Controllers\miraihuman;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\miraihuman\daotaohome;
use App\User;

class daotaohomeController extends Controller
{        
    public function getdaotaohome(){    
        $daotaohome = daotaohome::orderBy('id','desc')->get();
        return view('admin.miraihuman.daotaohome.daotaohome',['daotaohome' => $daotaohome]);
    }
    public function getAdddaotaohome(){ 
        return view('admin.miraihuman.daotaohome.add_daotaohome');
    } 
    public static function savedaotaohome($request,$daotaohome,$action){
        DB::beginTransaction();
        try {    
            $daotaohome->noidung = $request->noidung;
            $daotaohome->stt = ($request->stt == 'on' ? 1 : 0);        
            $daotaohome->save();
            
            DB::commit();
            return true;
        } 
        catch (Exception $e) {
            DB::rollBack();
            return fail;
        }
    } 

    public function postAdddaotaohome(Request $request){
        $daotaohome = new daotaohome;
        if($this->savedaotaohome($request,$daotaohome,"add")){
            $lastid = daotaohome::orderBy('id', 'desc')->first();
            return redirect('daotaohome/'.$lastid->id.'/edit')->with('status', 'Đã thêm "' . $request->ten . '" thành công!');
        }
        return redirect('daotaohome')->with('status','Đã thêm "' . $request->ten. '" không thành công!');

    }   
    public function getEditdaotaohome($id){
        $daotaohome = daotaohome::find($id);
        return view('admin.miraihuman.daotaohome.edit_daotaohome',['daotaohome' => $daotaohome]);
    }
    public function postEditdaotaohome(Request $request,$id){
        $daotaohome = daotaohome::find($id);
        if($this->savedaotaohome($request,$daotaohome,"edit")){
            return redirect('daotaohome/'.$daotaohome->id.'/edit')->with('status','Đã sửa "' . $request->ten. '" thành công!');
        }
        return redirect('tintuc/'.$daotaohome->id.'/edit')->with('status','Đã sửa "' . $request->ten. '" không thành công!');
    }

    public function getDeletedaotaohome($id){
        daotaohome::destroy($id);
        return redirect()->back()->with('status','Đã xóa thành công!');
    }

    public function status(Request $request,$id){
        $daotaohome = daotaohome::find($id);
        $daotaohome->stt = $request->status;
        $daotaohome->save();
        return $request->status;
    }

}
