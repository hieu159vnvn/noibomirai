<?php
namespace App\Http\Controllers\miraihuman;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\miraihuman\gioithieuhome;
use App\User;

class gioithieuhomeController extends Controller
{        
    public function getgioithieuhome(){    
        $gioithieuhome = gioithieuhome::orderBy('id','desc')->get();
        return view('admin.miraihuman.gioithieuhome.gioithieuhome',['gioithieuhome' => $gioithieuhome]);
    }
    // public function getAddgioithieuhome(){ 
    //     return view('admin.miraihuman.gioithieuhome.add_gioithieuhome');
    // } 
    public static function savegioithieuhome($request,$gioithieuhome,$action){
        DB::beginTransaction();
        try {    
            $gioithieuhome->ten = $request->ten;
            $gioithieuhome->tenjp = $request->tenjp;
            $gioithieuhome->noidung = $request->noidung;
            $gioithieuhome->noidungjp = $request->noidungjp;
            $gioithieuhome->image = strstr($request->image, 'miraiuploads/');  
            $gioithieuhome->stt = ($request->stt == 'on' ? 1 : 0);        
            $gioithieuhome->save();
            
            DB::commit();
            return true;
        } 
        catch (Exception $e) {
            DB::rollBack();
            return fail;
        }
    } 

    public function postAddgioithieuhome(Request $request){
        $gioithieuhome = new gioithieuhome;
        if($this->savegioithieuhome($request,$gioithieuhome,"add")){
            $lastid = gioithieuhome::orderBy('id', 'desc')->first();
            return redirect('gioithieuhome/'.$lastid->id.'/edit')->with('status', 'Đã thêm "' . $request->ten . '" thành công!');
        }
        return redirect('gioithieuhome')->with('status','Đã thêm "' . $request->ten. '" không thành công!');

    }   
    public function getEditgioithieuhome($id){
        $gioithieuhome = gioithieuhome::find($id);
        return view('admin.miraihuman.gioithieuhome.edit_gioithieuhome',['gioithieuhome' => $gioithieuhome]);
    }
    public function postEditgioithieuhome(Request $request,$id){
        $gioithieuhome = gioithieuhome::find($id);
        if($this->savegioithieuhome($request,$gioithieuhome,"edit")){
            return redirect('gioithieuhome/'.$gioithieuhome->id.'/edit')->with('status','Đã sửa "' . $request->ten. '" thành công!');
        }
        return redirect('tintuc/'.$gioithieuhome->id.'/edit')->with('status','Đã sửa "' . $request->ten. '" không thành công!');
    }

    public function getDeletegioithieuhome($id){
        gioithieuhome::destroy($id);
        return redirect()->back()->with('status','Đã xóa thành công!');
    }

    public function status(Request $request,$id){
        $gioithieuhome = gioithieuhome::find($id);
        $gioithieuhome->stt = $request->status;
        $gioithieuhome->save();
        return $request->status;
    }

}
