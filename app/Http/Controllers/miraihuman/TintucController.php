<?php
namespace App\Http\Controllers\miraihuman;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\miraihuman\Tintuc;
use App\Models\miraihuman\Loaitintuc;
use App\User;

class TintucController extends Controller
{        
    public function getTintuc(){    
        $tintuc = Tintuc::orderBy('id','desc')->get();
        $loaitintuc = Loaitintuc::orderBy('id','asc')->get(); 
        return view('admin.miraihuman.tintuc.tintuc',['tintuc' => $tintuc,'loaitintuc' => $loaitintuc]);
    }
    public function getAddTintuc(){ 
        $tintuc = Tintuc::orderBy('id','desc')->get();
        $loaitintuc = Loaitintuc::orderBy('id','asc')->get(); 
        return view('admin.miraihuman.tintuc.add_tintuc',['tintuc' => $tintuc,'loaitintuc' => $loaitintuc]);
    } 
    public static function saveTintuc($request,$tintuc,$action){
        DB::beginTransaction();
        try {    
            $tintuc->ten = $request->ten;
            $tintuc->tenjp = $request->tenjp;
            $tintuc->image = strstr($request->image, 'miraiuploads/');  
            $tintuc->description = $request->description;
            $tintuc->descriptionjp = $request->descriptionjp;
            $tintuc->noidung = $request->noidung;
            $tintuc->noidungjp = $request->noidungjp;
            $tintuc->id_loaitintuc = $request->id_loaitintuc;
            $tintuc->stt = ($request->stt == 'on' ? 1 : 0);
            if ($request->sapxep == null) {
                $tintuc->sapxep = 0;
            }else{
                $tintuc->sapxep = $request->sapxep;
            }           
            $tintuc->save();
            
            DB::commit();
            return true;
        } 
        catch (Exception $e) {
            DB::rollBack();
            return fail;
        }
    } 

    public function postAddTintuc(Request $request){
        $tintuc = new Tintuc;
        $tintuc->slug =  str_slug($request->ten, '-');
        $tintuc->created_at = date("Y-m-d H:i:s");
        $tintuc->updated_at = date("Y-m-d H:i:s");
        if($this->saveTintuc($request,$tintuc,"add")){
            $lastid = Tintuc::orderBy('id', 'desc')->first();
            return redirect('tintuc/'.$lastid->id.'/edit')->with('status', 'Đã thêm "' . $request->ten . '" thành công!');
        }
        return redirect('tintuc')->with('status','Đã thêm "' . $request->ten. '" không thành công!');

    }   
    public function getEditTintuc($id){
        $tintuc = Tintuc::find($id);
        $loaitintuc = Loaitintuc::orderBy('id','asc')->get(); 
        return view('admin.miraihuman.tintuc.edit_tintuc',['tintuc' => $tintuc,'loaitintuc' => $loaitintuc]);
    }
    public function postEditTintuc(Request $request,$id){
        $tintuc = Tintuc::find($id);
        $tintuc->slug =  str_slug($request->slug, '-');
        $tintuc->updated_at = date("Y-m-d H:i:s");
        if($this->saveTintuc($request,$tintuc,"edit")){
            return redirect('tintuc/'.$tintuc->id.'/edit')->with('status','Đã sửa "' . $request->ten. '" thành công!');
        }
        return redirect('tintuc/'.$tintuc->id.'/edit')->with('status','Đã sửa "' . $request->ten. '" không thành công!');
    }

    public function getDeleteTintuc($id){
        Tintuc::destroy($id);
        return redirect()->back()->with('status','Đã xóa thành công!');
    }

    public function status(Request $request,$id){
        $tintuc = Tintuc::find($id);
        $tintuc->stt = $request->status;
        $tintuc->save();
        return $request->status;
    }

}
