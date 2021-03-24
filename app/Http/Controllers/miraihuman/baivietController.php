<?php
namespace App\Http\Controllers\miraihuman;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\miraihuman\baiviet;
use App\User;

class baivietController extends Controller
{        
    public function getbaiviet(){    
        $baiviet = baiviet::orderBy('id','desc')->get();
        return view('admin.miraihuman.baiviet.baiviet',['baiviet' => $baiviet]);
    }
    // public function getAddbaiviet(){ 
    //     return view('admin.miraihuman.baiviet.add_baiviet');
    // } 
    public static function savebaiviet($request,$baiviet,$action){
        DB::beginTransaction();
        try {    
            $baiviet->ten = $request->ten;
            $baiviet->tenjp = $request->tenjp;
            $baiviet->noidung = $request->noidung;
            $baiviet->noidungjp = $request->noidungjp;
            $baiviet->stt = ($request->stt == 'on' ? 1 : 0);
            if ($request->sapxep == null) {
                $baiviet->sapxep = 0;
            }else{
                $baiviet->sapxep = $request->sapxep;
            }           
            $baiviet->save();
            
            DB::commit();
            return true;
        } 
        catch (Exception $e) {
            DB::rollBack();
            return fail;
        }
    } 

    public function postAddbaiviet(Request $request){
        $baiviet = new baiviet;
        $baiviet->slug =  str_slug($request->ten, '-');
        $baiviet->created_at = date("Y-m-d H:i:s");
        $baiviet->updated_at = date("Y-m-d H:i:s");
        if($this->savebaiviet($request,$baiviet,"add")){
            $lastid = baiviet::orderBy('id', 'desc')->first();
            return redirect('baiviet/'.$lastid->id.'/edit')->with('status', 'Đã thêm "' . $request->ten . '" thành công!');
        }
        return redirect('baiviet')->with('status','Đã thêm "' . $request->ten. '" không thành công!');

    }   
    public function getEditbaiviet($id){
        $baiviet = baiviet::find($id);
        return view('admin.miraihuman.baiviet.edit_baiviet',['baiviet' => $baiviet]);
    }
    public function postEditbaiviet(Request $request,$id){
        $baiviet = baiviet::find($id);
        $baiviet->slug =  str_slug($request->slug, '-');
        $baiviet->updated_at = date("Y-m-d H:i:s");
        if($this->savebaiviet($request,$baiviet,"edit")){
            return redirect('baiviet/'.$baiviet->id.'/edit')->with('status','Đã sửa "' . $request->ten. '" thành công!');
        }
        return redirect('baiviet/'.$baiviet->id.'/edit')->with('status','Đã sửa "' . $request->ten. '" không thành công!');
    }

    public function getDeletebaiviet($id){
        baiviet::destroy($id);
        return redirect()->back()->with('status','Đã xóa thành công!');
    }

    public function status(Request $request,$id){
        $baiviet = baiviet::find($id);
        $baiviet->stt = $request->status;
        $baiviet->save();
        return $request->status;
    }

}
