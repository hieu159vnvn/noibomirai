<?php
namespace App\Http\Controllers\miraihuman;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\miraihuman\Dichvu;
use App\Models\miraihuman\Dichvucat;
use App\User;

class DichvuController extends Controller
{        
    public function getDichvu(){    
        $dichvu = Dichvu::orderBy('id','desc')->get();

        $dichvu = DB::table('zm_dichvucats')
            ->join('zm_dichvus', 'zm_dichvucats.id', '=', 'zm_dichvus.dichvu_id')
            ->select('zm_dichvus.*', 'zm_dichvucats.ten as tendvcat')
            ->get();
        return view('admin.miraihuman.dichvu.dichvu',['dichvu' => $dichvu]);
    }
    public function getAddDichvu(){ 
        $dichvucat = Dichvucat::all();   
        return view('admin.miraihuman.dichvu.add_dichvu',['dichvucat' => $dichvucat]);
    } 
    public static function saveDichvu($request,$dichvu,$action){
        DB::beginTransaction();
        try {    
            $dichvu->ten = $request->ten;
            $dichvu->tenjp = $request->tenjp;
            $dichvu->dichvu_id = $request->dichvu_id;
            $dichvu->noidung = $request->noidung;
            $dichvu->noidungjp = $request->noidungjp;
            $dichvu->stt = ($request->stt == 'on' ? 1 : 0);
            if ($request->sapxep == null) {
                $dichvu->sapxep = 0;
            }else{
                $dichvu->sapxep = $request->sapxep;
            }           
            $dichvu->save();
            
            DB::commit();
            return true;
        } 
        catch (Exception $e) {
            DB::rollBack();
            return fail;
        }
    } 

    public function postAddDichvu(Request $request){
        $dichvu = new Dichvu;
        $dichvu->slug =  str_slug($request->ten, '-');
        $dichvu->created_at = date("Y-m-d H:i:s");
        $dichvu->updated_at = date("Y-m-d H:i:s");
        if($this->saveDichvu($request,$dichvu,"add")){
            $lastid = Dichvu::orderBy('id', 'desc')->first();
            return redirect('dichvu/'.$lastid->id.'/edit')->with('status', '???? th??m "' . $request->ten . '" th??nh c??ng!');
        }
        return redirect('dichvu')->with('status','???? th??m "' . $request->ten. '" kh??ng th??nh c??ng!');

    }   
    public function getEditDichvu($id){
        $dichvu = Dichvu::find($id);
        $dichvucat = Dichvucat::all();
        return view('admin.miraihuman.dichvu.edit_dichvu',['dichvu' => $dichvu,'dichvucat' => $dichvucat]);
    }
    public function postEditDichvu(Request $request,$id){
        $dichvu = Dichvu::find($id);
        $dichvu->slug =  str_slug($request->slug, '-');
        $dichvu->updated_at = date("Y-m-d H:i:s");
        if($this->saveDichvu($request,$dichvu,"edit")){
            return redirect('dichvu/'.$dichvu->id.'/edit')->with('status','???? s???a "' . $request->ten. '" th??nh c??ng!');
        }
        return redirect('dichvu/'.$dichvu->id.'/edit')->with('status','???? s???a "' . $request->ten. '" kh??ng th??nh c??ng!');
    }

    public function getDeleteDichvu($id){
        Dichvu::destroy($id);
        return redirect()->back()->with('status','???? x??a th??nh c??ng!');
    }

    public function status(Request $request,$id){
        $dichvu = Dichvu::find($id);
        $dichvu->stt = $request->status;
        $dichvu->save();
        return $request->status;
    }

}
