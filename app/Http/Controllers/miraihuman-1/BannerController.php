<?php
namespace App\Http\Controllers\miraihuman;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\miraihuman\Banner;
use App\User;

class BannerController extends Controller
{        
    public function getBanner(){    
        $banner = Banner::orderBy('id','desc')->get();    
        return view('admin.miraihuman.banner.banner',['banner' => $banner]);
    }
    public function getAddBanner(){ 
        return view('admin.miraihuman.banner.add_banner');
    } 
    public static function saveBanner($request,$banner,$action){
        DB::beginTransaction();
        try {    
            $banner->image = strstr($request->image, 'miraiuploads/');  
            $banner->stt = ($request->stt == 'on' ? 1 : 0);     
            $banner->sapxep = 0;
            $banner->save();
            
            DB::commit();
            return true;
        } 
        catch (Exception $e) {
            DB::rollBack();
            return fail;
        }
    } 

    public function postAddBanner(Request $request){
        $banner = new Banner;
        if($this->saveBanner($request,$banner,"add")){
            $lastid = Banner::orderBy('id', 'desc')->first();
            return redirect('banner/'.$lastid->id.'/edit')->with('status', 'Đã thêm "' . $request->image . '" thành công!');
        }
        return redirect('banner')->with('status','Đã thêm "' . $request->image . '" không thành công!');

    }   
    public function getEditBanner($id){
        $banner = Banner::find($id);
        return view('admin.miraihuman.banner.edit_banner',['banner' => $banner]);
    }
    public function postEditBanner(Request $request,$id){
        $banner = Banner::find($id);
        if($this->saveBanner($request,$banner,"edit")){
            return redirect('banner/'.$banner->id.'/edit')->with('status','Đã sửa "' . $request->image . '" thành công!');
        }
        return redirect('banner/'.$banner->id.'/edit')->with('status','Đã sửa "' . $request->image . '" không thành công!');
    }

    public function getDeleteBanner($id){
        Banner::destroy($id);
        return redirect()->back()->with('status','Đã xóa thành công!');
    }

    public function status(Request $request,$id){
        $banner = Banner::find($id);
        $banner->stt = $request->status;
        $banner->save();
        return $request->status;
    }

}
