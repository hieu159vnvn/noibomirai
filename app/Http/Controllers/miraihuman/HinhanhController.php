<?php
namespace App\Http\Controllers\miraihuman;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\miraihuman\Hinhanh;
use App\User;

class HinhanhController extends Controller
{        
    public function getHinhanh(){    
        $hinhanh = Hinhanh::orderBy('id','desc')->get();
        return view('admin.miraihuman.hinhanh.hinhanh',['hinhanh' => $hinhanh]);
    }
    public function getAddHinhanh(){ 
        return view('admin.miraihuman.hinhanh.add_hinhanh');
    } 
    public static function saveHinhanh($request,$hinhanh,$action){
        DB::beginTransaction();
        try {    
            $hinhanh->ten = $request->ten;
            $hinhanh->tenjp = $request->tenjp;
            
            $hinhanh->stt = ($request->stt == 'on' ? 1 : 0);
            if ($request->sapxep == null) {
                $hinhanh->sapxep = 0;
            }else{
                $hinhanh->sapxep = $request->sapxep;
            } 
            $a=array();
            foreach ($request->image1 as $image) {
                array_push($a,strstr($image, 'miraiuploads/'));
            }
            $hinhanh->hinhanh = json_encode($a, true);
            $hinhanh->save();
            
            DB::commit();
            return true;
        } 
        catch (Exception $e) {
            DB::rollBack();
            return fail;
        }
    } 

    public function postAddHinhanh(Request $request){
        
        
        $hinhanh = new Hinhanh;
        $hinhanh->slug =  str_slug($request->ten, '-');
        if($this->saveHinhanh($request,$hinhanh,"add")){
            $lastid = Hinhanh::orderBy('id', 'desc')->first();
            return redirect('hinhanh/'.$lastid->id.'/edit')->with('status', 'Đã thêm "' . $request->ten . '" thành công!');
        }
        return redirect('hinhanh')->with('status','Đã thêm "' . $request->ten. '" không thành công!');

    }   
    public function getEditHinhanh($id){
        $hinhanh = Hinhanh::find($id);
        return view('admin.miraihuman.hinhanh.edit_hinhanh',['hinhanh' => $hinhanh]);
    }
    public function postEditHinhanh(Request $request,$id){
        $hinhanh = Hinhanh::find($id);
        $hinhanh->slug =  str_slug($request->slug, '-');
        if($this->saveHinhanh($request,$hinhanh,"edit")){
            return redirect('hinhanh/'.$hinhanh->id.'/edit')->with('status','Đã sửa "' . $request->ten. '" thành công!');
        }
        return redirect('hinhanh/'.$hinhanh->id.'/edit')->with('status','Đã sửa "' . $request->ten. '" không thành công!');
    }

    public function getDeleteHinhanh($id){
        Hinhanh::destroy($id);
        return redirect()->back()->with('status','Đã xóa thành công!');
    }

    public function status(Request $request,$id){
        $hinhanh = Hinhanh::find($id);
        $hinhanh->stt = $request->status;
        $hinhanh->save();
        return $request->status;
    }

}
