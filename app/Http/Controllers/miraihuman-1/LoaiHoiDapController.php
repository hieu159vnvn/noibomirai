<?php
namespace App\Http\Controllers\miraihuman;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\miraihuman\Loaihoidap;
use App\User;

class LoaiHoiDapController extends Controller
{        
    public function index(){    
        $loaicauhoi = Loaihoidap::orderBy('id','desc')->get(); 
        return view('admin.miraihuman.loaicauhoi.index',['loaicauhoi' => $loaicauhoi]);
    }
    public function create(){ 
        // $hoidap = Hoidap::orderBy('id','desc')->get(); 
        return view('admin.miraihuman.loaicauhoi.create');
    } 
    
    public function store(Request $request){
        $item = new Loaihoidap;
        $item->tenloai=$request->tenloai;
        $item->save();
        return redirect('loaihoidap')->with('status','Đã thêm "' . $request->tenloai. '"thành công!');
        // if($this->saveHoidap($request,$hoidap,"add")){
        //     $lastid = Hoidap::orderBy('id', 'desc')->first();
        //     return redirect('hoidap/'.$lastid->id.'/edit')->with('status', 'Đã thêm "' . $request->ten . '" thành công!');
        // }
        // return redirect('hoidap')->with('status','Đã thêm "' . $request->ten. '" không thành công!');

    }   
    public function edit($id){
        $item = Loaihoidap::find($id);
        return view('admin.miraihuman.loaicauhoi.edit',['item' => $item]);
    }
    public function update(Request $request,$id){
        $item = Loaihoidap::find($id);
        $item->tenloai=$request->tenloai;
        $item->save();
        return redirect('loaihoidap/'.$item->id.'/edit')->with('status','Đã sửa "' . $request->tenloai. '"  thành công!');

    }

    public function delete($id){
        Loaihoidap::destroy($id);
        return redirect()->back()->with('status','Đã xóa thành công!');
    }

    public function status(Request $request,$id){
        $hoidap = Hoidap::find($id);
        $hoidap->stt = $request->status;
        $hoidap->save();
        return $request->status;
    }

}
