<?php
namespace App\Http\Controllers\miraihuman;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\miraihuman\dichvuhome;
use App\User;

class dichvuhomeController extends Controller
{        
    public function getdichvuhome(){    
        $dichvuhome = dichvuhome::orderBy('id','desc')->get();
        return view('admin.miraihuman.dichvuhome.dichvuhome',['dichvuhome' => $dichvuhome]);
    }
    // public function getAdddichvuhome(){ 
    //     return view('admin.miraihuman.dichvuhome.add_dichvuhome');
    // } 
    public static function savedichvuhome($request,$dichvuhome,$action){
        DB::beginTransaction();
        try {    
            $dichvuhome->ten = $request->ten;
            $dichvuhome->tenjp = $request->tenjp;
            $dichvuhome->noidung = $request->noidung;
            $dichvuhome->noidungjp = $request->noidungjp;
            $dichvuhome->link = $request->link;
            $dichvuhome->image = strstr($request->image, 'miraiuploads/');  
            $dichvuhome->stt = ($request->stt == 'on' ? 1 : 0);        
            $dichvuhome->save();
            
            DB::commit();
            return true;
        } 
        catch (Exception $e) {
            DB::rollBack();
            return fail;
        }
    } 

    public function postAdddichvuhome(Request $request){
        $dichvuhome = new dichvuhome;
        if($this->savedichvuhome($request,$dichvuhome,"add")){
            $lastid = dichvuhome::orderBy('id', 'desc')->first();
            return redirect('dichvuhome/'.$lastid->id.'/edit')->with('status', 'Đã thêm "' . $request->ten . '" thành công!');
        }
        return redirect('dichvuhome')->with('status','Đã thêm "' . $request->ten. '" không thành công!');

    }   
    public function getEditdichvuhome($id){
        $dichvuhome = dichvuhome::find($id);
        return view('admin.miraihuman.dichvuhome.edit_dichvuhome',['dichvuhome' => $dichvuhome]);
    }
    public function postEditdichvuhome(Request $request,$id){
        $dichvuhome = dichvuhome::find($id);
        if($this->savedichvuhome($request,$dichvuhome,"edit")){
            return redirect('dichvuhome/'.$dichvuhome->id.'/edit')->with('status','Đã sửa "' . $request->ten. '" thành công!');
        }
        return redirect('tintuc/'.$dichvuhome->id.'/edit')->with('status','Đã sửa "' . $request->ten. '" không thành công!');
    }

    public function getDeletedichvuhome($id){
        dichvuhome::destroy($id);
        return redirect()->back()->with('status','Đã xóa thành công!');
    }

    public function status(Request $request,$id){
        $dichvuhome = dichvuhome::find($id);
        $dichvuhome->stt = $request->status;
        $dichvuhome->save();
        return $request->status;
    }

}
