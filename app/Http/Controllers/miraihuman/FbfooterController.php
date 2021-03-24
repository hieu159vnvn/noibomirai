<?php
namespace App\Http\Controllers\miraihuman;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\miraihuman\fbfooter;
use App\User;

class FbfooterController extends Controller
{        
    public function getfbfooter(){    
        $fbfooter = fbfooter::orderBy('id','desc')->get();
        return view('admin.miraihuman.fbfooter.fbfooter',['fbfooter' => $fbfooter]);
    }
    public function getAddfbfooter(){ 
        return view('admin.miraihuman.fbfooter.add_fbfooter');
    } 
    public static function savefbfooter($request,$fbfooter,$action){
        DB::beginTransaction();
        try {    
            $fbfooter->link = $request->link;
            $fbfooter->stt = ($request->stt == 'on' ? 1 : 0);        
            $fbfooter->save();
            
            DB::commit();
            return true;
        } 
        catch (Exception $e) {
            DB::rollBack();
            return fail;
        }
    } 

    public function postAddfbfooter(Request $request){
        $fbfooter = new fbfooter;
        if($this->savefbfooter($request,$fbfooter,"add")){
            $lastid = fbfooter::orderBy('id', 'desc')->first();
            return redirect('fbfooter/'.$lastid->id.'/edit')->with('status', 'Đã thêm "' . $request->ten . '" thành công!');
        }
        return redirect('fbfooter')->with('status','Đã thêm "' . $request->ten. '" không thành công!');

    }   
    public function getEditfbfooter($id){
        $fbfooter = fbfooter::find($id);
        return view('admin.miraihuman.fbfooter.edit_fbfooter',['fbfooter' => $fbfooter]);
    }
    public function postEditfbfooter(Request $request,$id){
        $fbfooter = fbfooter::find($id);
        if($this->savefbfooter($request,$fbfooter,"edit")){
            return redirect('fbfooter/'.$fbfooter->id.'/edit')->with('status','Đã sửa "' . $request->ten. '" thành công!');
        }
        return redirect('tintuc/'.$fbfooter->id.'/edit')->with('status','Đã sửa "' . $request->ten. '" không thành công!');
    }

    public function getDeletefbfooter($id){
        fbfooter::destroy($id);
        return redirect()->back()->with('status','Đã xóa thành công!');
    }

    public function status(Request $request,$id){
        $fbfooter = fbfooter::find($id);
        $fbfooter->stt = $request->status;
        $fbfooter->save();
        return $request->status;
    }

}
