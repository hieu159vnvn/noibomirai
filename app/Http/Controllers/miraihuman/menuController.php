<?php
namespace App\Http\Controllers\miraihuman;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\miraihuman\menu;
use App\User;

class menuController extends Controller
{        
    public function getmenu(){    
        $menu = menu::orderBy('id','desc')->get();
        return view('admin.miraihuman.menu.menu',['menu' => $menu]);
    }
    public function getAddmenu(){ 
        return view('admin.miraihuman.menu.add_menu');
    } 
    public static function savemenu($request,$menu,$action){
        DB::beginTransaction();
        try {    
            $menu->ten = $request->ten;
            $menu->tenjp = $request->tenjp;
            $menu->link = $request->link; 
            $menu->stt = ($request->stt == 'on' ? 1 : 0);        
            $menu->save();
            
            DB::commit();
            return true;
        } 
        catch (Exception $e) {
            DB::rollBack();
            return fail;
        }
    } 

    public function postAddmenu(Request $request){
        $menu = new menu;
        if($this->savemenu($request,$menu,"add")){
            $lastid = menu::orderBy('id', 'desc')->first();
            return redirect('menu/'.$lastid->id.'/edit')->with('status', 'Đã thêm "' . $request->ten . '" thành công!');
        }
        return redirect('menu')->with('status','Đã thêm "' . $request->ten. '" không thành công!');

    }   
    public function getEditmenu($id){
        $menu = menu::find($id);
        return view('admin.miraihuman.menu.edit_menu',['menu' => $menu]);
    }
    public function postEditmenu(Request $request,$id){
        $menu = menu::find($id);
        if($this->savemenu($request,$menu,"edit")){
            return redirect('menu/'.$menu->id.'/edit')->with('status','Đã sửa "' . $request->ten. '" thành công!');
        }
        return redirect('tintuc/'.$menu->id.'/edit')->with('status','Đã sửa "' . $request->ten. '" không thành công!');
    }

    public function getDeletemenu($id){
        menu::destroy($id);
        return redirect()->back()->with('status','Đã xóa thành công!');
    }

    public function status(Request $request,$id){
        $menu = menu::find($id);
        $menu->stt = $request->status;
        $menu->save();
        return $request->status;
    }

}
