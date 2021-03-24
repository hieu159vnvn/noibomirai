<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\NghiepDoan;
use App\Models\DoiTac;
use Illuminate\Support\Facades\Auth;
use Session;
use App\User;

use Yajra\Datatables\Datatables;
class DHDatatablesController extends Controller
{
    /**
     * Displays datatables front end view
     *
     * @return \Illuminate\View\View
     */
    /**
     * Process datatables ajax request.
     *
     * @return \Illuminate\Http\JsonResponse
     */
	public function getNghiepDoan()
	{
		$nghiepdoans = NghiepDoan::select(['id', 'tennghiepdoan','diachi','nguoidaidien','dienthoai','email'])->get();
		return DataTables::of($nghiepdoans)
		->addColumn('action', function ($data) {
			return $data->id;
		})
		->addColumn('action', function ($data) {

	        $roleid = DB::table('role_user')->where('user_id', Auth::user()->id)->first();
	        $per = DB::table('permission_role')
	        ->join('permissions', 'permission_role.permission_id', '=', 'permissions.id')
            ->select('permissions.name')
            ->where('permission_role.role_id', $roleid->role_id)
            ->get();
	        $arr = array();
	        foreach ($per as $key => $value) {
	        	array_push($arr,$value->name);
	        }
	        $permission = '';
	        if (in_array("nghiepdoan-edit", $arr))
  			{
				  $permission .= '<a href="'.url('/nghiepdoan/'.$data->id.'/edit').'" class="mini ui icon blue button" title="Sửa"><i class="edit icon"></i></a>';
  			}
  			
  			if (in_array("nghiepdoan-delete", $arr)) {
				  $permission .= '<button type="button" class="mini ui icon red button btn-delete " data-id="'.$data->id.'" data-name="'.$data->tennghiepdoan.'" title="Xóa"><i class="window close icon"></i></button>';  
			}
	        return $permission;

		})
		->editColumn('tennghiepdoan', function($data){
			return '<a href="/nghiepdoan/view/'.$data->id.'">'.$data->tennghiepdoan.'</a>';
		})
		->rawColumns(['tennghiepdoan', 'action'])
		->make(true);    
	}

	public function getDoiTac()
	{
		//$doitacs = DoiTac::select(['id','id_nghiepdoan', 'tencongty','diachi','nguoidaidien','dienthoai','email'])->get();
		$doitacs = DB::table('nghiepdoans')
            ->join('doitacs', 'nghiepdoans.id', '=', 'doitacs.id_nghiepdoan')
			->select('doitacs.*', 'nghiepdoans.tennghiepdoan as tennghiepdoan')
			->orderBy('doitacs.id_nghiepdoan', 'asc')
            ->get();
		return DataTables::of($doitacs)
		->addColumn('action', function ($data) {
			return $data->id;
		})
		->addColumn('action', function ($data) {

	        $roleid = DB::table('role_user')->where('user_id', Auth::user()->id)->first();
	        $per = DB::table('permission_role')
	        ->join('permissions', 'permission_role.permission_id', '=', 'permissions.id')
            ->select('permissions.name')
            ->where('permission_role.role_id', $roleid->role_id)
            ->get();
	        $arr = array();
	        foreach ($per as $key => $value) {
	        	array_push($arr,$value->name);
	        }
	        $permission = '';
	        if (in_array("doitac-edit", $arr))
  			{
				  $permission .= '<a href="'.url('/doitac/'.$data->id.'/edit').'" class="mini ui icon blue button" title="Sửa"><i class="edit icon"></i></a>';
  			}
  			
  			if (in_array("doitac-delete", $arr)) {
				  $permission .= '<button type="button" class="mini ui icon red button btn-delete " data-id="'.$data->id.'" data-name="'.$data->tencongty.'" title="Xóa"><i class="window close icon"></i></button>';  
			}
	        return $permission;

		})
		->editColumn('tencongty', function($data){
			return '<a href="/doitac/view/'.$data->id.'">'.$data->tencongty.'</a>';
		})
		->rawColumns(['tencongty', 'action'])
		->make(true);
	}
}