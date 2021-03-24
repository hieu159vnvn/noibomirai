<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Foundation\Auth\User as Authenticatable;

class ExcelController extends Controller
{
    //
    public function getImport(){
    	return view('admin.excel.import');
    }
    public function postImport(Request $request){
    	Excel::($request->file('file'),function($reader){
    		$reader->each(function($sheet){
    			foreach ($sheet->toArry() as $row) {
    				User::firstOrCreate($sheet->toArry());
    			}
    		});
    	});
    	echo "OK";

    }
}
