<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\HoSoHocVien;
use App\Models\HoSoHocVienJP;
use App\Models\NguoiThanTaiNhat;
use App\Models\City;
use App\Models\QuaTrinhHocTap;
use App\Models\QuaTrinhLamViec;
use App\Models\GiaDinh;
use App\Models\HosoImage;
use App\Models\KiTucXa;
use Illuminate\Support\Facades\Auth;
use Session;
use App\User;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\HoSoHocViensExport;
use PDF;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\URL;

class DatatablesController extends Controller
{
    /**
     * Displays datatables front end view
     *
     * @return \Illuminate\View\View
     */
    public function getIndex()
    {
        return view('admin.datatables.index');
    }
    /**
     * Process datatables ajax request.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getDaotao($id)
    {
		$order = ($id == '')?'DESC':'ASC';
		$checked = DB::table('daotao_hocviens')->where('id_daotao',$id)->pluck("id_hocvien")->toArray();
		$arrchecked = implode(",",$checked);
		$otherchecked = DB::table('daotao_hocviens')->where('id_daotao','<>',$id)->pluck("id_hocvien")->toArray();
		$arrotherchecked = implode(",",$otherchecked);
		$users = DB::table('hoso_hocviens')
			->leftJoin('daotao_hocviens','daotao_hocviens.id_hocvien','=','hoso_hocviens.id')
			->leftJoin('daotaos','daotaos.id','=','daotao_hocviens.id_daotao')
			->leftJoin('nhanviens','nhanviens.id','=','daotaos.gvcn')
			->select( 
				'hoso_hocviens.id','hoso_hocviens.hoten','hoso_hocviens.created_at','hoso_hocviens.hinhanh','hoso_hocviens.ngaysinh',
				'daotaos.ten_lop_hoc','nhanviens.hoten AS giaovien','nhanviens.hinhanh AS hagiaovien',
				'daotao_hocviens.id_daotao',
				DB::raw(' (CASE 
				WHEN FIND_IN_SET(vnw_hoso_hocviens.id, "'.$arrchecked.'") THEN "1"
				WHEN FIND_IN_SET(vnw_hoso_hocviens.id, "'.$arrotherchecked.'") THEN "2"  
				ELSE "3" 
				END) AS checked')
			)
			->orderBy('checked',$order)
			->orderBy('id_daotao','asc')
			->orderBy('id','desc')
			->get()
			->unique('id');
		$datatables =  DataTables::of($users);
		$datatables->editColumn('hoten', function ($hoso) {			
			return $hoso->hoten;
		});
        $datatables->editColumn('hinhanh', function ($hoso) {
			$timestamp_image = strtotime($hoso->created_at);
			$year_image = date("Y", $timestamp_image);
			$month_image = date("m", $timestamp_image);
			if ( strlen($hoso->hinhanh) >= 100) {
				return '<img src="' . $hoso->hinhanh . '" alt="" class="ui mini rounded image">';
			} elseif (strlen($hoso->hinhanh) < 100 && strlen($hoso->hinhanh) > 1 ) {
				return '<img src="'.url('').'/'.'hocviens/'.$year_image.'/'.$month_image.'/'. $hoso->hinhanh .'?rand='.md5(time()). '" alt="" class="ui mini rounded image">';
			}else{
				return '<img src="'.url('').'/'.'hocviens/'.'logo.png'. '" alt="" class="ui mini rounded image">';
			} 	        
		});
		$datatables->addColumn('ghep', function ($hoso) {
			switch($hoso->checked){
				case(1):
					if ($hoso->id_daotao != 0) {
						return '<div class="ui toggle checkbox">
							<input type="checkbox"  name="dshv[]" class="edit" value="'.$hoso->id.'" data-name="'.$hoso->hoten.'" checked >
							<label>Đã ghép </label>
						</div> '.
						' <img class="hagiaovien" src="'.$hoso->hagiaovien.'" > ('.$hoso->ten_lop_hoc.' : '.$hoso->giaovien.')';
					}else{
						return '<div class="ui toggle checkbox">
						<input type="checkbox"  name="dshv[]" class="edit" value="'.$hoso->id.'" data-name="'.$hoso->hoten.'" >
						<label>Chưa xác định lớp</label>
					</div> '.
					' <img class="hagiaovien" src="'.$hoso->hagiaovien.'" > ('.$hoso->ten_lop_hoc.' : '.$hoso->giaovien.')';
					}
	                break;
				case(2):
					return '<div class="ui toggle checkbox">
							<input type="checkbox"  name="dshv[]" value="'.$hoso->id.'" disabled >
							<label>Đã có lớp </label>
						</div> '.
						'<img class="hagiaovien" src="'.$hoso->hagiaovien.'" > ('.$hoso->ten_lop_hoc.' : '.$hoso->giaovien.')';
					break;
	            case(3):
	                return '<div class="ui toggle checkbox ">
						<input type="checkbox"  name="dshv[]" class="edit" value="'.$hoso->id.'" data-name="'.$hoso->hoten.'" >
						<label>Chưa ghép</label>
					</div>';
	                break;
	            default:
					return '<div class="ui toggle checkbox">
						<input type="checkbox"  name="dshv[]" value="'.$hoso->id.'" >
						<label>Chưa ghép</label>
					</div>';
            }
		});
		if ($id != 'add') {
			$datatables->addColumn('chuyen', function ($hoso) {		
				switch ($hoso->checked) {
					case (1):
						return '<button type="button"  name="chuyen" class="mini ui icon blue button btn-chuyen" data-id-chuyen="'.$hoso->id_daotao.'" data-id="'.$hoso->id.'" data-name="'.$hoso->hoten.'"title="Chuyển lớp">
						<i class="window exchange icon"></i></button> Chuyển lớp';
						break;
					case (2):
						if ($hoso->id_daotao == 0) {
							return '<button type="button"  name="chuyen" class="mini ui icon red button btn-chuyen" data-id-chuyen="'.$hoso->id_daotao.'" data-id="'.$hoso->id.'" data-name="'.$hoso->hoten.'"title="Chuyển lớp">
							<i class="window exchange icon"></i></button>Chưa xác định lớp';
						}else{
							return '<button type="button"  name="chuyen" class="mini ui icon gray button btn-chuyen" data-id-chuyen="'.$hoso->id_daotao.'" data-id="'.$hoso->id.'" data-name="'.$hoso->hoten.'"title="Chuyển lớp">
							<i class="window exchange icon"></i></button>Chuyển lớp';
						}
						break;
					default:
						break;
				}
			});
		}else{
			$datatables->addColumn('chuyen', function ($hoso) {
				return '';
			});
		}	
		$datatables->editColumn('ngaysinh', function ($hoso) {			
			$time = strtotime($hoso->ngaysinh);
			$newformat = date('d - m - Y',$time);
			return $newformat;
		});
	    $datatables->rawColumns(['hinhanh','ngaysinh','ghep','chuyen']);
		return $datatables->make(true);
	}
    public function getHoso()
    {
        $users = DB::table('hoso_hocviens')
			->leftJoin('hoso_hocviens_jp', 'hoso_hocviens.id', '=', 'hoso_hocviens_jp.id_hocvien')
			->where('hoso_hocviens.xetduyet','=',NULL)		
			->select([
        	'hoso_hocviens.id',
        	'hoso_hocviens.hinhanh',
			'hoso_hocviens.hoten as hoten',
			'hoso_hocviens.ngaysinh',
			'hoso_hocviens.dienthoai',
        	'hoso_hocviens.nguoigioithieu',
        	'hoso_hocviens.tinhtrang',
			'hoso_hocviens.tinhthanh',
			'hoso_hocviens.id_donhang',
			'hoso_hocviens_jp.id_hocvien as id_hocvien',
			'hoso_hocviens.re_edit',
			'hoso_hocviens.created_at',
			'hoso_hocviens.cmnd_socmnd',
			'hoso_hocviens_jp.nguoidich',
			'hoso_hocviens.nguoinhap',
			])
			->orderBy('hoso_hocviens.re_edit','desc')
			->orderBy('hoso_hocviens.id','desc')
			;
        return DataTables::of($users)
		->editColumn('hoten', function ($hoso) {
	        return $hoso->hoten;
		})
        ->editColumn('hinhanh', function ($hoso) {
			$timestamp_image = strtotime($hoso->created_at);
			$year_image = date("Y", $timestamp_image);
			$month_image = date("m", $timestamp_image);
			if ( strlen($hoso->hinhanh) >= 100) {
				return '<img src="' . $hoso->hinhanh . '" alt="" class="ui mini rounded image">';
			} elseif (strlen($hoso->hinhanh) < 100 && strlen($hoso->hinhanh) > 1 ) {
				return '<img src="hocviens/'.$year_image.'/'.$month_image.'/'. $hoso->hinhanh .'?rand='.md5(time()). '" alt="" class="ui mini rounded image">';
			}else{
				return '<img src="hocviens/'.'logo.png'. '" alt="" class="ui mini rounded image">';
			} 	        
		})
		->editColumn('ngaysinh', function ($hoso) {
	        $time = strtotime($hoso->ngaysinh);
			$newformat = date('d-m-Y',$time);
			return $newformat;
	    })
	    ->editColumn('tinhtrang', function ($hoso) {
	    	switch($hoso->tinhtrang){
		        case(0):
	                return '<a class="ui blue label">Đang phỏng vấn</a>';
	                break;
	            case(1):
	                return '<a class="ui yellow label">Chưa đăng ký đơn hàng </a>';
	                break;
	            case(2):
	                return '<a class="ui green label">Đậu phỏng vấn</a>';
	                break;
	            case(3):
	                return '<a class="ui teal label">Dự bị</a>';
	                break;
	            case(4):
	                return '<a class="ui red label">Rớt phỏng vấn</a>';
	                break;
	            case(5):
	                return '<a class="ui pink label">Đã xuất cảnh</a>';
	                break;
	            default:
	                return '<a class="ui black label">Đã hủy</a>';
            }
	    	// return 'tinh trang';
		})
	    ->editColumn('tinhthanh', function ($hoso) {
	    	if ($hoso->tinhthanh) {
	    		$tinh = City::find($hoso->tinhthanh);
	    		return $tinh->ten;
	    	}else{
	    		return 'city';
	    	}
	    	
	    	
		})
		->editColumn('created_at', function ($hoso) {
	        $time = strtotime($hoso->created_at);
			$newformat = date('d-m-Y',$time);
			return $newformat;
			return 'created at';
	    })
	    ->editColumn('nguoidich', function ($hoso) {
			// return $hoso->nguoidich;
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
			$permission='';
	        if (in_array("hoso-nguoidich", $arr))
  			{
  				$permission .= $hoso->nguoidich;
  			}
			
			return $permission;
		})
		->editColumn('nguoinhap', function ($hoso) {
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
			$permission='';
	        if (in_array("hoso-nguoinhap", $arr))
  			{
  				$permission .= $hoso->nguoinhap;
  			}
			
			return $permission;
		})
	    ->addColumn('action', function ($hoso) {
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
	        $permission = '<a href="'.url('/hoso/'.$hoso->id.'/show').'" class="mini ui icon green button" title="Xem"><i class="eye icon"></i></a>';
	        if (in_array("hoso-edit", $arr))
  			{
  				$permission .= '<a href="'.url('/hoso/'.$hoso->id.'/edit').'" class="mini ui icon blue button" title="Sửa"><i class="edit icon"></i></a>';
  			}
  			if (in_array("hoso-tran", $arr)) {
  				$permission .= '<a href="'.url('/hoso/' . $hoso->id . '/tran').'" class="mini ui icon yellow button" title="Dịch"><i class="language icon"></i></a>';
  			}
  			if (in_array("hoso-delete", $arr)) {
  				$permission .= '<a href="'.url('/hoso/' . $hoso->id . '/delete').'" class="mini ui icon red button" title="Hủy"><i class="x icon"></i></a>';
			}
			
			return $permission;
		})
		->setRowClass(function ($hoso) {
			if ($hoso->id_hocvien) {
				if ($hoso->re_edit == 1) {
					return "negative";
				}else{
					return 'positive';
				}
			}else{
				if ($hoso->re_edit == 1) {
					return "negative";
				}
			}
			return 'rowclass';
		})
	    ->rawColumns(['hoten','tinhthanh','tinhtrang','hinhanh', 'action','created_at','nguoidich','nguoinhap'])
	    ->make(true);
	}

	public function getSourceHoso()
    {
        $users = HoSoHocVien::where('xetduyet',1)->select([
        	'id',
        	'hinhanh',
			'hoten',
			'ngaysinh',
			'dienthoai',
        	'nguoigioithieu',
        	'tinhtrang',
        	'tinhthanh'
        ])->orderBy('id','desc');

        return DataTables::of($users)

        ->editColumn('hinhanh', function ($hoso) {
	        return '<img src="' . $hoso->hinhanh . '" alt="" class="ui mini rounded image">';
		})
		->editColumn('ngaysinh', function ($hoso) {
	        $time = strtotime($hoso->ngaysinh);
			$newformat = date('d-m-Y',$time);
			return $newformat;
	    })
	    ->editColumn('tinhtrang', function ($hoso) {
	    	switch($hoso->tinhtrang){
		        case(0):
	                return '<a class="ui blue label">Đang phỏng vấn</a>';
	                break;
	            case(1):
	                return '<a class="ui yellow label">Chưa đăng ký đơn hàng</a>';
	                break;
	            case(2):
	                return '<a class="ui green label">Đậu phỏng vấn</a>';
	                break;
	            case(3):
	                return '<a class="ui teal label">Dự bị</a>';
	                break;
	            case(4):
	                return '<a class="ui red label">Rớt phỏng vấn</a>';
	                break;
	            case(5):
	                return '<a class="ui pink label">Đã xuất cảnh</a>';
	                break;
	            default:
	                return '<a class="ui black label">Đã hũy</a>';
            }
	    })
	    ->editColumn('tinhthanh', function ($hoso) {
	    	$tinh = City::find($hoso->tinhthanh);
	    	return $tinh->ten;
	    })
	    ->addColumn('action', function ($hoso) {
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
	        $permission = '<a href="'.url('/hoso/'.$hoso->id.'/show').'" class="mini ui icon green button" title="Xem"><i class="eye icon"></i></a>';
	        if (in_array("hoso-edit", $arr))
  			{
  				$permission .= '<a href="'.url('/hoso/'.$hoso->id.'/edit').'" class="mini ui icon blue button" title="Sửa"><i class="edit icon"></i></a>';
  			}
  			if (in_array("hoso-delete", $arr)) {
  				$permission .= '<a  onclick="myFunction('.$hoso->id.')" class="mini ui icon red button"  title="xóa"><i class="x icon"></i></a>';
			}
			  
	        return $permission;

	    })
	    ->rawColumns(['tinhthanh','tinhtrang','hinhanh', 'action'])

	    ->make(true);
	}

	public function testMissHoso() 
    {
        $users =  DB::table('hoso_hocviens')
        ->where('xetduyet',null)
        ->where(function($query){
	        return $query
	        ->orWhereNull('hinhanh')
	        ->orWhere('hoten',"")->orWhereNull('hoten')
	        ->orWhere('ngaysinh',"")->orWhereNull('ngaysinh')
	        ->orWhereNull('gioitinh')
	        ->orWhere('honnhan',"")->orWhereNull('honnhan')
	        ->orWhere('benhan',"")->orWhereNull('benhan')
	        ->orWhere('noisinh',"")->orWhereNull('noisinh')
	        ->orWhere('tongiao',"")->orWhereNull('tongiao')
	        ->orWhere('mien',"")->orWhereNull('mien')
	        ->orWhere('tinhthanh',"")->orWhereNull('tinhthanh')
	        ->orWhere('dienthoai',"")->orWhereNull('dienthoai')
	        ->orWhere('dtnguoithan',"")->orWhereNull('dtnguoithan')
	        ->orWhereNull('congviec')
	        ->orWhereNull('keo')
	        ->orWhereNull('dua')
	        ->orWhereNull('viet')
			->orWhere('chieucao',"")->orWhereNull('chieucao')
	        ->orWhere('cannang',"")->orWhereNull('cannang')
	        ->orWhereNull('nhommau')
	        ->orWhere('mattrai',"")->orWhereNull('mattrai')
	        ->orWhere('matphai',"")->orWhereNull('matphai')
	        // ->orWhere('diachi',"")->orWhereNull('diachi')
	        ->orWhere('ngoaingu',"")->orWhereNull('ngoaingu')
	        ->orWhere('anhngu',"")->orWhereNull('anhngu')
	        ->orWhere('nhatngu',"")->orWhereNull('nhatngu')
	        ->orWhere('mucdich',"")->orWhereNull('mucdich')
	        ->orWhere('sotientrenthang',"")->orWhereNull('sotientrenthang')
	        ->orWhere('sotientrennam',"")->orWhereNull('sotientrennam')
	        ->orWhere('muctieu',"")->orWhereNull('muctieu')
	        ->orWhere('sothich',"")->orWhereNull('sothich')
	        ->orWhere('diemmanh',"")->orWhereNull('diemmanh')
	        ->orWhere('iq',"")->orWhereNull('iq')
	        ->orWhere('nguoiphutrach',"")->orWhereNull('nguoiphutrach')
	        ->orWhere('nguoigioithieu',"")->orWhereNull('nguoigioithieu')
	        ->orWhereNull('sk_uongruou')
	        ->orWhereNull('sk_hutthuoc')
	        ->orWhereNull('sk_mumau')
	        ->orWhereNull('sk_ditat')
	        ->orWhereNull('sk_hinhxam')
	        ->orWhereNull('sk_deokinh')
	        ;
	    })

      	->select([
        	'id',
        	'hinhanh',
			'hoten',
			'ngaysinh',
			'dienthoai',
        	'nguoigioithieu',
        	'tinhtrang',
        	'tinhthanh'
        ])->orderBy('id','desc');
        return DataTables::of($users)

        ->editColumn('hinhanh', function ($hoso) {
	        return '<img src="' . $hoso->hinhanh . '" alt="" class="ui mini rounded image">';
	    })
	    ->editColumn('tinhtrang', function ($hoso) {
	    	switch($hoso->tinhtrang){
		        case(0):
	                return '<a class="ui blue label">Đang phỏng vấn</a>';
	                break;
	            case(1):
	                return '<a class="ui yellow label">Chưa đăng ký đơn hàng</a>';
	                break;
	            case(2):
	                return '<a class="ui green label">Đậu phỏng vấn</a>';
	                break;
	            case(3):
	                return '<a class="ui teal label">Dự bị</a>';
	                break;
	            case(4):
	                return '<a class="ui red label">Rớt phỏng vấn</a>';
	                break;
	            case(5):
	                return '<a class="ui pink label">Đã xuất cảnh</a>';
	                break;
	            default:
	                return '<a class="ui black label">Đã hũy</a>';
            }
	    })
	    ->editColumn('tinhthanh', function ($hoso) {
	    	$tinh = City::find($hoso->tinhthanh);
	    	return $tinh->ten;
	    })
	    ->addColumn('action', function ($hoso) {
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
	        $permission = '<a href="'.url('/hoso/'.$hoso->id.'/show').'" class="mini ui icon green button" title="Xem"><i class="eye icon"></i></a>';
	        if (in_array("hoso-edit", $arr))
  			{
  				$permission .= '<a href="'.url('/hoso/'.$hoso->id.'/edit').'" class="mini ui icon blue button" title="Sửa"><i class="edit icon"></i></a>';
  			}
  			if (in_array("hoso-tran", $arr)) {
  				$permission .= '<a href="'.url('/hoso/' . $hoso->id . '/tran').'" class="mini ui icon yellow button" title="Dịch"><i class="language icon"></i></a>';
  			}
  			if (in_array("hoso-delete", $arr)) {
  				$permission .= '<a href="'.url('/hoso/' . $hoso->id . '/delete').'" class="mini ui icon red button" title="Hủy"><i class="x icon"></i></a>';
  			}
	        return $permission;

	    })
	    ->setRowClass(function ($hoso) {
	    	return "negative";
        })
	    ->rawColumns(['tinhthanh','tinhtrang','hinhanh', 'action'])

	    ->make(true);
	}

	public function getGepDonHang()
    {		
		$users = DB::table('hoso_hocviens')
			->leftJoin('hoso_hocviens_jp', 'hoso_hocviens.id', '=', 'hoso_hocviens_jp.id_hocvien')
			->where('hoso_hocviens.tinhtrang','<>','2')
			->where(function($query){
				return $query	
				->orWhere('hoso_hocviens.xetduyet',"0")->orWhereNull('hoso_hocviens.xetduyet');
			})
			->select([
        	'hoso_hocviens.id',
        	'hoso_hocviens.hinhanh',
			'hoso_hocviens.hoten',
			'hoso_hocviens.gioitinh',
			'hoso_hocviens.ngaysinh',
			'hoso_hocviens.dienthoai',
			'hoso_hocviens.id_donhang',
        	'hoso_hocviens.nguoigioithieu',
        	'hoso_hocviens.tinhtrang',
			'hoso_hocviens_jp.id_hocvien as id_hocvien',
			'hoso_hocviens.created_at'
        ])->orderBy('hoso_hocviens.id','desc');
        return DataTables::of($users)

        // ->editColumn('hinhanh', function ($hoso) {
	    //     return '<img src="' . $hoso->hinhanh . '" alt="" class="ui mini rounded image">';
		// })
		->editColumn('hinhanh', function ($hoso) {
			$timestamp_image = strtotime($hoso->created_at);
			$year_image = date("Y", $timestamp_image);
			$month_image = date("m", $timestamp_image);
			if ( strlen($hoso->hinhanh) >= 100) {
				return '<img src="' . $hoso->hinhanh . '" alt="" class="ui mini rounded image">';
			} elseif (strlen($hoso->hinhanh) < 100 && strlen($hoso->hinhanh) > 1 ) {
				return '<img src="/hocviens/'.$year_image.'/'.$month_image.'/'. $hoso->hinhanh . '" alt="" class="ui mini rounded image">';
			} 
	        
		})
		
		->editColumn('ngaysinh', function ($hoso) {
	        $time = strtotime($hoso->ngaysinh);
			$newformat = date('d-m-Y',$time);
			return $newformat;
	    })
	    ->editColumn('gioitinh', function ($hoso) {
	    	switch($hoso->gioitinh){
		        case(0):
	                return  'nữ';
	                break;
	            case(1):
	                return 'nam';
	                break;      
	            default:
	                return 'nữ';
            }
		})  
		
		->editColumn('hoten', function ($hoso) {
			$abc = '<a href="'.url('hoso/'.$hoso->id.'/show').'" title="Xem">'.$hoso->hoten.'</a> &nbsp &nbsp';
			if ($hoso->id_hocvien) {
				$abc = $abc . '<a href="'.url('hoso/' . $hoso->id . '/tran').'" class="mini ui icon yellow button" title="Dịch"><i class="language icon"></i></a>';
			}else{
				$abc = $abc . '<a href="'.url('hoso/' . $hoso->id . '/tran').'" class="mini ui icon blue button" title="Dịch"><i class="language icon"></i></a>';
			}
			return $abc;
			
	    })
	    ->addColumn('chon', function ($hoso) {
			$chuoi = strstr(URL::current(), 'donhang/');
			$iddh = str_replace('donhang/', '', $chuoi);
			if ($hoso->id_donhang == $iddh) {
				$checked = "checked";
			} else {
				$checked = "";
			}
			if ( ($hoso->tinhtrang == '0') && ($hoso->id_donhang != $iddh) ) {
				return '<div class="ui toggle checkbox">
					<input type="checkbox" class="ghepdonhang" name="ghepdonhang" data-id="'.$hoso->id.'" data-dh="'.$iddh.'" '.$checked.' disabled >
					<label>không được chọn</label>
				</div>';
			}else {
				if ($hoso->tinhtrang == '4') {
					$a = '<div class="ui toggle checkbox">
					<input type="checkbox" class="ghepdonhang" name="ghepdonhang" data-id="'.$hoso->id.'" data-dh="'.$iddh.'" '.$checked.'  >
					<label> chọn <a href="/donhang/'.$hoso->id_donhang.'/show">(rớt đơn hàng trước)</a> </label>
				</div>';
				}else{
					$a = '<div class="ui toggle checkbox">
						<input type="checkbox" class="ghepdonhang" name="ghepdonhang" data-id="'.$hoso->id.'" data-dh="'.$iddh.'" '.$checked.'  >
						<label> chọn </label>
					</div>';
				}
				return $a;
			}
		})
		->setRowClass(function ($hoso) {
			if ($hoso->id_hocvien) {
				return 'positive';
			}
		})
	    ->rawColumns(['hoten','tinhthanh','tinhtrang','hinhanh', 'chon'])
	    ->make(true);
	}
	public function getKitucxa(){
		$hocvien = DB::table('hoso_hocviens')
		->select('id','hoten','hinhanh','ngaysinh','noisinh','created_at','dienthoai','cmnd_socmnd','ngayvaoktx')
		->orderBy('id','desc')
		->where('trangthaidongtienktx',1)
		->get();
		$datatables = Datatables::of($hocvien);
		$datatables->editColumn('hinhanh', function ($hocvien) {
			$timestamp_image = strtotime($hocvien->created_at);
			$year_image = date("Y", $timestamp_image);
			$month_image = date("m", $timestamp_image);
			if ( strlen($hocvien->hinhanh) >= 100) {
				return '<img src="' . $hocvien->hinhanh . '" alt="" class="ui mini rounded image">';
			} elseif (strlen($hocvien->hinhanh) < 100 && strlen($hocvien->hinhanh) > 1 ) {
				return '<img src="'.url('').'/'.'hocviens/'.$year_image.'/'.$month_image.'/'. $hocvien->hinhanh .'?rand='.md5(time()). '" alt="" class="ui mini rounded image">';
			}else{
				return '<img src="https://via.placeholder.com/150" alt="" class="ui mini rounded image">';
			} 	        
		});
		$datatables->editColumn('ngaysinh', function ($hocvien) {
	        $time = strtotime($hocvien->ngaysinh);
			$newformat = date('d-m-Y',$time);
			return $newformat;
		});
		$datatables->editColumn('ngayvaoktx', function ($hocvien) {
			if($hocvien->ngayvaoktx){
				$time = strtotime($hocvien->ngayvaoktx);
				$newformat = date('H:i:s d-m-Y',$time);
				return $newformat;
			}
	    });
		$datatables->addColumn('thaotac', function ($hocvien) {
			$check = DB::table('kitucxa_hocvien')->select('id_hocvien')->get();
			foreach ($check as $item ) {
			   	if($item->id_hocvien == $hocvien->id){
					return '<div class="btn-del-ktx" id-hocvien="'.$hocvien->id .'"><a class="btn-del-ktx-'.$hocvien->id .' btn-ktx-del" ><i class="check icon" id="del-hocvien-ktx-'.$hocvien->id .'"  style="  display: none; transition: opacity 1s ease-out; opacity: 0;"></i>Xóa khỏi phòng hiện tại</a></div>';
			   	}
			}
			return '<div class="btn-add-ktx" id-hocvien="'.$hocvien->id .'"><a class="btn-add-ktx-'.$hocvien->id .' btn-ktx-add" ><i class="check icon" id="add-hocvien-ktx-'.$hocvien->id .'"  style="  display: none; transition: opacity 1s ease-out; opacity: 0;"></i>Thêm vào phòng</a></div>';
		
		});
		$datatables->rawColumns(['hinhanh','thaotac']);
		return $datatables->make(true);
    }
	public function getKitucxaDacBiet(){
		$hocvien = DB::table('hoso_hocviens')
		->select('id','hoten','hinhanh','ngaysinh','noisinh','created_at','dienthoai','cmnd_socmnd','ngayvaoktx')
		->orderBy('id','desc')
		->get();
		$datatables = Datatables::of($hocvien);
		$datatables->editColumn('hinhanh', function ($hocvien) {
			$timestamp_image = strtotime($hocvien->created_at);
			$year_image = date("Y", $timestamp_image);
			$month_image = date("m", $timestamp_image);
			if ( strlen($hocvien->hinhanh) >= 100) {
				return '<img src="' . $hocvien->hinhanh . '" alt="" class="ui mini rounded image">';
			} elseif (strlen($hocvien->hinhanh) < 100 && strlen($hocvien->hinhanh) > 1 ) {
				return '<img src="'.url('').'/'.'hocviens/'.$year_image.'/'.$month_image.'/'. $hocvien->hinhanh .'?rand='.md5(time()). '" alt="" class="ui mini rounded image">';
			}else{
				return '<img src="https://via.placeholder.com/150" alt="" class="ui mini rounded image">';
			} 	        
		});
		$datatables->editColumn('ngaysinh', function ($hocvien) {
	        $time = strtotime($hocvien->ngaysinh);
			$newformat = date('d-m-Y',$time);
			return $newformat;
		});
		$datatables->editColumn('ngayvaoktx', function ($hocvien) {
			if($hocvien->ngayvaoktx){
				$time = strtotime($hocvien->ngayvaoktx);
				$newformat = date('H:i:s d-m-Y',$time);
				return $newformat;
			}
	    });
		$datatables->addColumn('thaotac', function ($hocvien) {
			$check = DB::table('kitucxa_hocvien')->select('id_hocvien')->get();
			foreach ($check as $item ) {
			   	if($item->id_hocvien == $hocvien->id){
					return '<div class="btn-del-ktx" id-hocvien="'.$hocvien->id .'"><a class="btn-del-ktx-'.$hocvien->id .' btn-ktx-del" ><i class="check icon" id="del-hocvien-ktx-'.$hocvien->id .'"  style="  display: none; transition: opacity 1s ease-out; opacity: 0;"></i>Xóa khỏi phòng hiện tại</a></div>';
			   	}
			}
			return '<div class="btn-add-ktx" id-hocvien="'.$hocvien->id .'"><a class="btn-add-ktx-'.$hocvien->id .' btn-ktx-add" ><i class="check icon" id="add-hocvien-ktx-'.$hocvien->id .'"  style="  display: none; transition: opacity 1s ease-out; opacity: 0;"></i>Thêm vào phòng</a></div>';
		
		});
		$datatables->rawColumns(['hinhanh','thaotac']);
		return $datatables->make(true);
    }
	public function getViewKitucxa($idktx){
		$hocvien = DB::table('hoso_hocviens')
		->join('kitucxa_hocvien', 'hoso_hocviens.id', '=', 'kitucxa_hocvien.id_hocvien')
		->select('hoso_hocviens.id','hoso_hocviens.hoten','hoso_hocviens.hinhanh','hoso_hocviens.ngaysinh','hoso_hocviens.noisinh','hoso_hocviens.created_at','hoso_hocviens.dienthoai','hoso_hocviens.cmnd_socmnd','hoso_hocviens.ngayvaoktx')
		->orderBy('hoso_hocviens.id','desc')
		->where('kitucxa_hocvien.id_kitucxa',$idktx)
		->get();
		$datatables = Datatables::of($hocvien);
		$datatables->editColumn('hinhanh', function ($hocvien) {
			$timestamp_image = strtotime($hocvien->created_at);
			$year_image = date("Y", $timestamp_image);
			$month_image = date("m", $timestamp_image);
			if ( strlen($hocvien->hinhanh) >= 100) {
				return '<img src="' . $hocvien->hinhanh . '" alt="" class="ui mini rounded image">';
			} elseif (strlen($hocvien->hinhanh) < 100 && strlen($hocvien->hinhanh) > 1 ) {
				return '<img src="'.url('').'/'.'hocviens/'.$year_image.'/'.$month_image.'/'. $hocvien->hinhanh .'?rand='.md5(time()). '" alt="" class="ui mini rounded image">';
			}else{
				return '<img src="https://via.placeholder.com/150" alt="" class="ui mini rounded image">';
			} 	        
		});
		$datatables->editColumn('ngaysinh', function ($hocvien) {
	        $time = strtotime($hocvien->ngaysinh);
			$newformat = date('d-m-Y',$time);
			return $newformat;
	    });
		$datatables->editColumn('ngayvaoktx', function ($hocvien) {
			if($hocvien->ngayvaoktx){
				$time = strtotime($hocvien->ngayvaoktx);
				$newformat = date('H:i:s d-m-Y',$time);
				return $newformat;
			}
	    });
		$datatables->addColumn('thaotac', function ($hocvien) {
			return '<div class="btn-del-ktx" id-hocvien="'.$hocvien->id .'"><a class="btn-del-ktx-'.$hocvien->id .' btn-ktx-del" ><i class="check icon" id="del-hocvien-ktx-'.$hocvien->id .'"  style="  display: none; transition: opacity 1s ease-out; opacity: 0;"></i>Xóa khỏi phòng hiện tại</a></div>';
		});
		$datatables->rawColumns(['hinhanh','thaotac']);
		return $datatables->make(true);
	}
	public function getDanhSachHocVienKTX(){
		$hocvien = DB::table('hoso_hocviens')
		->select('id','hoten','hinhanh','ngaysinh','noisinh','created_at','dienthoai','cmnd_socmnd')
		->orderBy('id','desc')
		->where('trangthaidongtienktx',1)
		->get();
		$datatables = Datatables::of($hocvien);
		$datatables->editColumn('hinhanh', function ($hocvien) {
			$timestamp_image = strtotime($hocvien->created_at);
			$year_image = date("Y", $timestamp_image);
			$month_image = date("m", $timestamp_image);
			if ( strlen($hocvien->hinhanh) >= 100) {
				return '<img src="' . $hocvien->hinhanh . '" alt="" class="ui mini rounded image">';
			} elseif (strlen($hocvien->hinhanh) < 100 && strlen($hocvien->hinhanh) > 1 ) {
				return '<img src="'.url('').'/'.'hocviens/'.$year_image.'/'.$month_image.'/'. $hocvien->hinhanh .'?rand='.md5(time()). '" alt="" class="ui mini rounded image">';
			}else{
				return '<img src="https://via.placeholder.com/150" alt="" class="ui mini rounded image">';
			} 	        
		});
		$datatables->editColumn('ngaysinh', function ($hocvien) {
	        $time = strtotime($hocvien->ngaysinh);
			$newformat = date('d-m-Y',$time);
			return $newformat;
	    });
		$datatables->addColumn('phonghientai', function ($hocvien) {
			$item = DB::table('kitucxa_hocvien')->where('id_hocvien',$hocvien->id)->first();
			if($item){
				$ktx = KiTucXa::find($item->id_kitucxa);
				return $ktx->tenphong;
			}
		});
		$datatables->rawColumns(['hinhanh','phonghientai']);
		return $datatables->make(true);
	}
	public function getDanhSachHocVienCongTy($idcty){
		$hocvien = DB::table('hoso_hocviens')
		->join('donhangs', 'hoso_hocviens.id_donhang','=','donhangs.id')
		->select('hoso_hocviens.id','hoso_hocviens.hoten','hoso_hocviens.hinhanh','hoso_hocviens.ngaysinh','hoso_hocviens.created_at','hoso_hocviens.dienthoai','hoso_hocviens.cmnd_socmnd')
		->orderBy('hoso_hocviens.id','desc')
		->where('donhangs.doitac_id',$idcty)
		->get();
		$datatables = Datatables::of($hocvien);
		$datatables->editColumn('hinhanh', function ($hocvien) {
			$timestamp_image = strtotime($hocvien->created_at);
			$year_image = date("Y", $timestamp_image);
			$month_image = date("m", $timestamp_image);
			if ( strlen($hocvien->hinhanh) >= 100) {
				return '<img src="' . $hocvien->hinhanh . '" alt="" class="ui mini rounded image">';
			} elseif (strlen($hocvien->hinhanh) < 100 && strlen($hocvien->hinhanh) > 1 ) {
				return '<img src="'.url('').'/'.'hocviens/'.$year_image.'/'.$month_image.'/'. $hocvien->hinhanh .'?rand='.md5(time()). '" alt="" class="ui mini rounded image">';
			}else{
				return '<img src="https://via.placeholder.com/150" alt="" class="ui mini rounded image">';
			} 	        
		});
		$datatables->editColumn('ngaysinh', function ($hocvien) {
	        $time = strtotime($hocvien->ngaysinh);
			$newformat = date('d-m-Y',$time);
			return $newformat;
	    });
		$datatables->rawColumns(['hinhanh']);
		return $datatables->make(true);
	}
}