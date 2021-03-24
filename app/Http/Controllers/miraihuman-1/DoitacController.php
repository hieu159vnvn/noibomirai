<?php
namespace App\Http\Controllers\miraihuman;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\miraihuman\Doitac;
use App\User;

class DoitacController extends Controller
{        
    public function getDoitac(){    
        $doitac = Doitac::orderBy('id','desc')->get();
        return view('admin.miraihuman.doitac.doitac',['doitac' => $doitac]);
    }
    public function getAddDoitac(){ 
        return view('admin.miraihuman.doitac.add_doitac');
    } 
    public static function saveDoitac($request,$doitac,$action){
        DB::beginTransaction();
        try {    
            $doitac->ten = $request->ten;
            $doitac->tenjp = $request->tenjp;
            $doitac->image = strstr($request->image, 'miraiuploads/');  
            $doitac->noidung = $request->noidung;
            $doitac->noidungjp = $request->noidungjp;
            $doitac->stt = ($request->stt == 'on' ? 1 : 0);
            if ($request->sapxep == null) {
                $doitac->sapxep = 0;
            }else{
                $doitac->sapxep = $request->sapxep;
            }           
            $doitac->save();
            
            DB::commit();
            return true;
        } 
        catch (Exception $e) {
            DB::rollBack();
            return fail;
        }
    } 

    public function postAddDoitac(Request $request){
        $doitac = new Doitac;
        $doitac->slug =  str_slug($request->ten, '-');
        $doitac->created_at = date("Y-m-d H:i:s");
        $doitac->updated_at = date("Y-m-d H:i:s");
        if($this->saveDoitac($request,$doitac,"add")){
            $lastid = Doitac::orderBy('id', 'desc')->first();
            return redirect('doitac-miraihuman/'.$lastid->id.'/edit')->with('status', 'Đã thêm "' . $request->ten . '" thành công!');
        }
        return redirect('doitac-miraihuman')->with('status','Đã thêm "' . $request->ten. '" không thành công!');

    }   
    public function getEditDoitac($id){
        $doitac = Doitac::find($id);
        return view('admin.miraihuman.doitac.edit_doitac',['doitac' => $doitac]);
    }
    public function postEditDoitac(Request $request,$id){
        $doitac = Doitac::find($id);
        $doitac->slug =  str_slug($request->slug, '-');
        $doitac->updated_at = date("Y-m-d H:i:s");
        if($this->saveDoitac($request,$doitac,"edit")){
            return redirect('doitac-miraihuman/'.$doitac->id.'/edit')->with('status','Đã sửa "' . $request->ten. '" thành công!');
        }
        return redirect('doitac-miraihuman/'.$doitac->id.'/edit')->with('status','Đã sửa "' . $request->ten. '" không thành công!');
    }

    public function getDeleteDoitac($id){
        Doitac::destroy($id);
        return redirect()->back()->with('status','Đã xóa thành công!');
    }

    public function status(Request $request,$id){
        $doitac = Doitac::find($id);
        $doitac->stt = $request->status;
        $doitac->save();
        return $request->status;
    }

}
