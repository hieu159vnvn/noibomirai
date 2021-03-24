<?php
namespace App\Http\Controllers\miraihuman;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\miraihuman\Mangxahoi;
use App\User;

class MangxahoiController extends Controller
{        
    public function getMangxahoi(){    
        $mangxahoi = Mangxahoi::orderBy('id','desc')->get();
        return view('admin.miraihuman.mangxahoi.mangxahoi',['mangxahoi' => $mangxahoi]);
    }
    public function getAddMangxahoi(){ 
        return view('admin.miraihuman.mangxahoi.add_mangxahoi');
    } 
    public static function saveMangxahoi($request,$mangxahoi,$action){
        DB::beginTransaction();
        try {    
            $mangxahoi->ten = $request->ten;
            $mangxahoi->link = $request->link;
            $mangxahoi->image = strstr($request->image, 'miraiuploads/');  
            $mangxahoi->stt = ($request->stt == 'on' ? 1 : 0);
            if ($request->sapxep == null) {
                $mangxahoi->sapxep = 0;
            }else{
                $mangxahoi->sapxep = $request->sapxep;
            }           
            $mangxahoi->save();
            
            DB::commit();
            return true;
        } 
        catch (Exception $e) {
            DB::rollBack();
            return fail;
        }
    } 

    public function postAddMangxahoi(Request $request){
        $mangxahoi = new Mangxahoi;
        if($this->saveMangxahoi($request,$mangxahoi,"add")){
            $lastid = Mangxahoi::orderBy('id', 'desc')->first();
            return redirect('mangxahoi/'.$lastid->id.'/edit')->with('status', 'Đã thêm "' . $request->ten . '" thành công!');
        }
        return redirect('tintuc')->with('status','Đã thêm "' . $request->ten. '" không thành công!');

    }   
    public function getEditMangxahoi($id){
        $mangxahoi = Mangxahoi::find($id);
        return view('admin.miraihuman.mangxahoi.edit_mangxahoi',['mangxahoi' => $mangxahoi]);
    }
    public function postEditMangxahoi(Request $request,$id){
        $mangxahoi = Mangxahoi::find($id);
        if($this->saveMangxahoi($request,$mangxahoi,"edit")){
            return redirect('mangxahoi/'.$mangxahoi->id.'/edit')->with('status','Đã sửa "' . $request->ten. '" thành công!');
        }
        return redirect('tintuc/'.$mangxahoi->id.'/edit')->with('status','Đã sửa "' . $request->ten. '" không thành công!');
    }

    public function getDeleteMangxahoi($id){
        Mangxahoi::destroy($id);
        return redirect()->back()->with('status','Đã xóa thành công!');
    }

    public function status(Request $request,$id){
        $mangxahoi = Mangxahoi::find($id);
        $mangxahoi->stt = $request->status;
        $mangxahoi->save();
        return $request->status;
    }

}
