<?php
namespace App\Http\Controllers\miraihuman;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\miraihuman\Tuyendung;
use App\User;

class TuyendungController extends Controller
{        
    public function index(){    
        $tuyendung = Tuyendung::orderBy('id','desc')->get(); 
        return view('admin.miraihuman.tuyendung.index',['tuyendung' => $tuyendung]);
    }
    //ajax tinh trang
    public function changeTT($id){
        $tuyendung = Tuyendung::find($id);
        if($tuyendung->tinhtrang == 1){
            $tuyendung->tinhtrang = 0;
        }else{
            $tuyendung->tinhtrang = 1;
        }
        $tuyendung->save();
        return response()->json('OK', 200);
    }
}
