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

}
