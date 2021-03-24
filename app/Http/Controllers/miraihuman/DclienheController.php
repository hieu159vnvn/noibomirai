<?php
namespace App\Http\Controllers\miraihuman;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\miraihuman\Dclienhe;
use App\User;

class DclienheController extends Controller
{        
    public function getDclienhe(){    
        $dclienhe = Dclienhe::orderBy('id','desc')->get();   
        return view('admin.miraihuman.dclienhe.dclienhe',['dclienhe' => $dclienhe]);
    }
    public function getAddDclienhe(){ 
        return view('admin.miraihuman.dclienhe.add_dclienhe');
    } 
    public static function saveDclienhe($request,$dclienhe,$action){
        DB::beginTransaction();
        try {    
            $dclienhe->ten = $request->ten;
            $dclienhe->tenjp = $request->tenjp;
            $dclienhe->diachi = $request->diachi;
            $dclienhe->diachijp = $request->diachijp;
            $dclienhe->dienthoai = $request->dienthoai;
            $dclienhe->email = $request->email;
            $dclienhe->fax = $request->fax;
            $dclienhe->website = $request->website;
            $dclienhe->bando = $request->bando;
            $dclienhe->stt = ($request->stt == 'on' ? 1 : 0);
            if ($request->sapxep == null) {
                $dclienhe->sapxep = 0;
            }else{
                $dclienhe->sapxep = $request->sapxep;
            }           
            $dclienhe->save();
            
            DB::commit();
            return true;
        } 
        catch (Exception $e) {
            DB::rollBack();
            return fail;
        }
    } 

    public function postAddDclienhe(Request $request){
        $dclienhe = new Dclienhe;
        $dclienhe->slug =  str_slug($request->ten, '-');
        $dclienhe->created_at = date("Y-m-d H:i:s");
        $dclienhe->updated_at = date("Y-m-d H:i:s");
        if($this->saveDclienhe($request,$dclienhe,"add")){
            $lastid = Dclienhe::orderBy('id', 'desc')->first();
            return redirect('dclienhe/'.$lastid->id.'/edit')->with('status', 'Đã thêm "' . $request->ten . '" thành công!');
        }
        return redirect('dclienhe')->with('status','Đã thêm "' . $request->ten. '" không thành công!');

    }   
    public function getEditDclienhe($id){
        $dclienhe = Dclienhe::find($id);
        return view('admin.miraihuman.dclienhe.edit_dclienhe',['dclienhe' => $dclienhe]);
    }
    public function postEditDclienhe(Request $request,$id){
        $dclienhe = Dclienhe::find($id);
        $dclienhe->slug =  str_slug($request->slug, '-');
        $dclienhe->updated_at = date("Y-m-d H:i:s");
        if($this->saveDclienhe($request,$dclienhe,"edit")){
            return redirect('dclienhe/'.$dclienhe->id.'/edit')->with('status','Đã sửa "' . $request->ten. '" thành công!');
        }
        return redirect('dclienhe/'.$dclienhe->id.'/edit')->with('status','Đã sửa "' . $request->ten. '" không thành công!');
    }

    public function getDeleteDclienhe($id){
        Dclienhe::destroy($id);
        return redirect()->back()->with('status','Đã xóa thành công!');
    }

    public function status(Request $request,$id){
        $dclienhe = Dclienhe::find($id);
        $dclienhe->stt = $request->status;
        $dclienhe->save();
        return $request->status;
    }

}
