<?php
namespace App\Http\Controllers\miraihuman;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\miraihuman\truonghoc;
use App\User;

class TruonghocController extends Controller
{        
    public function gettruonghoc(){    
        $truonghoc = truonghoc::orderBy('id','desc')->get();
        return view('admin.miraihuman.truonghoc.truonghoc',['truonghoc' => $truonghoc]);
    }
    public function getAddtruonghoc(){ 
        return view('admin.miraihuman.truonghoc.add_truonghoc');
    } 
    public static function savetruonghoc($request,$truonghoc,$action){
        DB::beginTransaction();
        try {    
            $truonghoc->ten = $request->ten;
            $truonghoc->tenjp = $request->tenjp;
            $truonghoc->link = $request->link;
            $truonghoc->image = strstr($request->image, 'miraiuploads/');  
            $truonghoc->stt = ($request->stt == 'on' ? 1 : 0);        
            $truonghoc->save();
            
            DB::commit();
            return true;
        } 
        catch (Exception $e) {
            DB::rollBack();
            return fail;
        }
    } 

    public function postAddtruonghoc(Request $request){
        $truonghoc = new truonghoc;
        if($this->savetruonghoc($request,$truonghoc,"add")){
            $lastid = truonghoc::orderBy('id', 'desc')->first();
            return redirect('truonghoc/'.$lastid->id.'/edit')->with('status', 'Đã thêm "' . $request->ten . '" thành công!');
        }
        return redirect('truonghoc')->with('status','Đã thêm "' . $request->ten. '" không thành công!');

    }   
    public function getEdittruonghoc($id){
        $truonghoc = truonghoc::find($id);
        return view('admin.miraihuman.truonghoc.edit_truonghoc',['truonghoc' => $truonghoc]);
    }
    public function postEdittruonghoc(Request $request,$id){
        $truonghoc = truonghoc::find($id);
        if($this->savetruonghoc($request,$truonghoc,"edit")){
            return redirect('truonghoc/'.$truonghoc->id.'/edit')->with('status','Đã sửa "' . $request->ten. '" thành công!');
        }
        return redirect('tintuc/'.$truonghoc->id.'/edit')->with('status','Đã sửa "' . $request->ten. '" không thành công!');
    }

    public function getDeletetruonghoc($id){
        truonghoc::destroy($id);
        return redirect()->back()->with('status','Đã xóa thành công!');
    }

    public function status(Request $request,$id){
        $truonghoc = truonghoc::find($id);
        $truonghoc->stt = $request->status;
        $truonghoc->save();
        return $request->status;
    }

}
