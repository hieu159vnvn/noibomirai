<?php
namespace App\Http\Controllers\miraihuman;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\miraihuman\Tuvan;
use App\User;

class TuvanController extends Controller
{        
    public function index(){    
        $tuvan = Tuvan::orderBy('id','desc')->get(); 
        return view('admin.miraihuman.tuvan.index',['tuvan' => $tuvan]);
    }
    //ajax tinh trang
    public function changeTT($id){
        $tuvan = Tuvan::find($id);
        if($tuvan->tinhtrang == 1){
            $tuvan->tinhtrang = 0;
        }else{
            $tuvan->tinhtrang = 1;
        }
        $tuvan->save();
        return response()->json('OK', 200);
    }
}
