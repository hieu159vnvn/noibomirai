<?php
namespace App\Http\Controllers\miraihuman;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\miraihuman\Dichvucat;
use App\User;

class DichvucatController extends Controller
{        
    public function getDichvucat(){    
        $dichvucat = Dichvucat::orderBy('id','desc')->get();
        return view('admin.miraihuman.dichvucat.dichvucat',['dichvucat' => $dichvucat]);
    }
    public function getAddDichvucat(){ 
        return view('admin.miraihuman.dichvucat.add_dichvucat');
    } 
    public static function saveDichvucat($request,$dichvucat,$action){
        DB::beginTransaction();
        try {    
            $dichvucat->ten = $request->ten;
            $dichvucat->tenjp = $request->tenjp;
            $dichvucat->description = $request->description;
            $dichvucat->descriptionjp = $request->descriptionjp;
            $dichvucat->image = strstr($request->image, 'miraiuploads/');  
            $dichvucat->stt = ($request->stt == 'on' ? 1 : 0);
            if ($request->sapxep == null) {
                $dichvucat->sapxep = 0;
            }else{
                $dichvucat->sapxep = $request->sapxep;
            }           
            $dichvucat->save();
            
            DB::commit();
            return true;
        } 
        catch (Exception $e) {
            DB::rollBack();
            return fail;
        }
    } 

    public function postAddDichvucat(Request $request){
        $dichvucat = new Dichvucat;
        $dichvucat->slug =  str_slug($request->ten, '-');
        $dichvucat->created_at = date("Y-m-d H:i:s");
        $dichvucat->updated_at = date("Y-m-d H:i:s");
        if($this->saveDichvucat($request,$dichvucat,"add")){
            $lastid = Dichvucat::orderBy('id', 'desc')->first();
            return redirect('dichvucat/'.$lastid->id.'/edit')->with('status', 'Đã thêm "' . $request->ten . '" thành công!');
        }
        return redirect('dichvucat')->with('status','Đã thêm "' . $request->ten. '" không thành công!');

    }   
    public function getEditDichvucat($id){
        $dichvucat = Dichvucat::find($id);
        return view('admin.miraihuman.dichvucat.edit_dichvucat',['dichvucat' => $dichvucat]);
    }
    public function postEditDichvucat(Request $request,$id){
        $dichvucat = Dichvucat::find($id);
        $dichvucat->slug =  str_slug($request->slug, '-');
        $dichvucat->updated_at = date("Y-m-d H:i:s");
        if($this->saveDichvucat($request,$dichvucat,"edit")){
            return redirect('dichvucat/'.$dichvucat->id.'/edit')->with('status','Đã sửa "' . $request->ten. '" thành công!');
        }
        return redirect('dichvucat/'.$dichvucat->id.'/edit')->with('status','Đã sửa "' . $request->ten. '" không thành công!');
    }

    public function getDeleteDichvucat($id){
        Dichvucat::destroy($id);
        return redirect()->back()->with('status','Đã xóa thành công!');
    }

    public function status(Request $request,$id){
        $dichvucat = Dichvucat::find($id);
        $dichvucat->stt = $request->status;
        $dichvucat->save();
        return $request->status;
    }

}
