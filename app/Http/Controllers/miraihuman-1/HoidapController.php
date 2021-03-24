<?php
namespace App\Http\Controllers\miraihuman;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\miraihuman\Hoidap;
use App\Models\miraihuman\Loaihoidap;
use App\User;

class HoidapController extends Controller
{        
    public function getHoidap(){    
        $hoidap = Hoidap::orderBy('id','desc')->get(); 
        $loaihoidap = Loaihoidap::orderBy('id','desc')->get(); 
        return view('admin.miraihuman.hoidap.hoidap',['hoidap' => $hoidap,'loaihoidap' => $loaihoidap]);
    }
    public function getAddHoidap(){ 
        $hoidap = Hoidap::orderBy('id','desc')->get(); 
        $loaihoidap = Loaihoidap::orderBy('id','desc')->get(); 
        return view('admin.miraihuman.hoidap.add_hoidap',['hoidap' => $hoidap,'loaihoidap' => $loaihoidap]);
    } 
    public static function saveHoidap($request,$hoidap,$action){
        DB::beginTransaction();
        try {    
            $hoidap->id_loaicauhoi = $request->id_loaicauhoi;
            $hoidap->hoi = $request->hoi;
            $hoidap->hoijp = $request->hoijp;
            $hoidap->dap = $request->dap;
            $hoidap->dapjp = $request->dapjp;
            $hoidap->stt = ($request->stt == 'on' ? 1 : 0);
            if ($request->sapxep == null) {
                $hoidap->sapxep = 0;
            }else{
                $hoidap->sapxep = $request->sapxep;
            }           
            $hoidap->save();
            
            DB::commit();
            return true;
        } 
        catch (Exception $e) {
            DB::rollBack();
            return fail;
        }
    } 

    public function postAddHoidap(Request $request){
        $hoidap = new Hoidap;
        if($this->saveHoidap($request,$hoidap,"add")){
            $lastid = Hoidap::orderBy('id', 'desc')->first();
            return redirect('hoidap/'.$lastid->id.'/edit')->with('status', 'Đã thêm "' . $request->hoi . '" thành công!');
        }
        return redirect('hoidap')->with('status','Đã thêm "' . $request->ten. '" không thành công!');

    }   
    public function getEditHoidap($id){
        $hoidap = Hoidap::find($id);
        $loaihoidap = Loaihoidap::orderBy('id','desc')->get(); 
        return view('admin.miraihuman.hoidap.edit_hoidap',['hoidap' => $hoidap,'loaihoidap' => $loaihoidap]);
    }
    public function postEditHoidap(Request $request,$id){
        $hoidap = Hoidap::find($id);
        if($this->saveHoidap($request,$hoidap,"edit")){
            return redirect('hoidap/'.$hoidap->id.'/edit')->with('status','Đã sửa "' . $request->hoi. '" thành công!');
        }
        return redirect('hoidap/'.$hoidap->id.'/edit')->with('status','Đã sửa "' . $request->hoi. '" không thành công!');
    }

    public function getDeleteHoidap($id){
        Hoidap::destroy($id);
        return redirect()->back()->with('status','Đã xóa thành công!');
    }

    public function status(Request $request,$id){
        $hoidap = Hoidap::find($id);
        $hoidap->stt = $request->status;
        $hoidap->save();
        return $request->status;
    }

}
