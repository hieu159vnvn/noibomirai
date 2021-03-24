<?php
namespace App\Http\Controllers\miraihuman;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\miraihuman\Lienhe;
use App\User;

class LienheController extends Controller
{        
    public function index(){    
        $lienhe = Lienhe::orderBy('id','desc')->get(); 
        return view('admin.miraihuman.lienhe.index',['lienhe' => $lienhe]);
    }

}
