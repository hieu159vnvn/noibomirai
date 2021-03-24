<?php
namespace App\Http\Controllers\miraihuman;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\miraihuman\magazine;
use App\User;

class MagazineController extends Controller
{        
    public function index(){    
        $magazine = magazine::orderBy('id','desc')->get();    
        return view('admin.miraihuman.magazine.index',['magazine' => $magazine]);
    }
    public function getAdd(){ 
        return view('admin.miraihuman.magazine.add');
    } 
    public static function save($request,$item){
        DB::beginTransaction();
        try {    
            $item->link = $request->link;
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

    public function postAdd(Request $request){
        $item = new magazine;
        if($this->save($request,$item)){
            return redirect('magazine')->with('status', 'Đã thêm tạp chí thành công!');
        }
        return redirect('magazine')->with('status','Thêm tạp chí không thành công!');

    }   
    public function getEdit($id){
        $item = magazine::find($id);
        return view('admin.miraihuman.magazine.edit',['item' => $item]);
    }
    public function postEdit(Request $request,$id){
        $item = magazine::find($id);
        if($this->save($request,$item)){
            return redirect('magazine')->with('status','Đã sửa thành công!');
        }
        return redirect('magazine')->with('status','Đã sửa không thành công!');
    }

    public function delete($id){
        magazine::destroy($id);
        return redirect()->back()->with('status','Đã xóa thành công!');
    }
}
