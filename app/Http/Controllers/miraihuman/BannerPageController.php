<?php
namespace App\Http\Controllers\miraihuman;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\miraihuman\bannerpage;
use App\User;

class BannerPageController extends Controller
{        
    public function index(){    
        $bannerpage = bannerpage::orderBy('id','desc')->get();    
        return view('admin.miraihuman.bannerpage.index',['bannerpage' => $bannerpage]);
    }
    public static function save($request,$item){
        DB::beginTransaction();
        try {    
            $item->image = strstr($request->image, 'miraiuploads/');  
            $item->save();
            DB::commit();
            return true;
        } 
        catch (Exception $e) {
            DB::rollBack();
            return fail;
        }
    } 
    public function getEdit($id){
        $item = bannerpage::find($id);
        return view('admin.miraihuman.bannerpage.edit',['item' => $item]);
    }
    public function postEdit(Request $request,$id){
        $item = bannerpage::find($id);
        if($this->save($request,$item)){
            return redirect('bannerpage')->with('status','Đã sửa thành công!');
        }
        return redirect('bannerpage')->with('status','Đã sửa không thành công!');
    }
}
