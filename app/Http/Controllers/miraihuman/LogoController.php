<?php
namespace App\Http\Controllers\miraihuman;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\miraihuman\Logo;
use App\User;

class LogoController extends Controller
{        
    public function getLogo(){    
        $logo = Logo::orderBy('id','desc')->get();  
        return view('admin.miraihuman.logo.logo',['logo' => $logo]);
    }
    public function getAddLogo(){ 
        return view('admin.miraihuman.logo.add_logo');
    } 
    public static function saveLogo($request,$logo,$action){
        DB::beginTransaction();
        try {

            // $logo->image = $request->image;     
            $logo->image = strstr($request->image, 'miraiuploads/');  
            $logo->stt = ($request->stt == 'on' ? 1 : 0);     
            $logo->sapxep = 0;
            $logo->save();
            
            DB::commit();
            return true;
        } 
        catch (Exception $e) {
            DB::rollBack();
            return fail;
        }
    } 

    public function postAddLogo(Request $request){
        $logo = new Logo;
        if($this->saveLogo($request,$logo,"add")){
            $lastid = Logo::orderBy('id', 'desc')->first();
            return redirect('logo/'.$lastid->id.'/edit')->with('status', 'Đã thêm "' . $request->image . '" thành công!');
            //return redirect('logo')->with('status','Đã thêm "' . $request->image . '" thành công!');
        }
        return redirect('logo')->with('status','Đã thêm "' . $request->image . '" không thành công!');

    }   
    public function getEditLogo($id){
        $logo = Logo::find($id);
        return view('admin.miraihuman.logo.edit_logo',['logo' => $logo]);
    }
    public function postEditLogo(Request $request,$id){
        $logo = Logo::find($id);
        if($this->saveLogo($request,$logo,"edit")){
            return redirect('logo/'.$logo->id.'/edit')->with('status','Đã sửa "' . $request->image . '" thành công!');
        }
        return redirect('logo/'.$logo->id.'/edit')->with('status','Đã sửa "' . $request->image . '" không thành công!');
    }

    public function getDeleteLogo($id){
        Logo::destroy($id);
        return redirect()->back()->with('status','Đã xóa thành công!');
    }

    public function status(Request $request,$id){
        $logo = Logo::find($id);
        $logo->stt = $request->status;
        $logo->save();
        return $request->status;
    }

}
