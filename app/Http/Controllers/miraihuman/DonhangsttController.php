<?php
namespace App\Http\Controllers\miraihuman;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\miraihuman\Donhangstt;
use App\User;

class DonhangsttController extends Controller
{        
    public function getDonhangstt(){    
        // $donhangstt = Donhangstt::orderBy('id','desc')->get();   
        $donhangstt = DB::table('donhangs')->join('nganhnghes', 'donhangs.nganhnghe_id', '=', 'nganhnghes.id')->where('donhangs.stt', '=', '1')->select('donhangs.*','nganhnghes.nganhnghe_vn as nganhnghe_vn')->orderBy('donhangs.id','desc')->get();
        return view('admin.miraihuman.donhangstt.donhangstt',['donhangstt' => $donhangstt]);
    }
    public function status(Request $request,$id){
        $donhangstt = Donhangstt::find($id);
        $donhangstt->stt = $request->status;
        $donhangstt->save();
        return $request->status;
    }

}
