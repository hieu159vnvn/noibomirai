<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NhanVien;
use App\Models\HoSoHocVien;
use App\Models\DoiTac;
use App\Models\History;
use App\Models\DonHang;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
class ThongKeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */

    public function getYear($year){
        $orderMonth = DB::table('hoso_hocviens')
            ->select(DB::raw('month(ngaydangky) as getMonth'), DB::raw('COUNT(*) as value'))
            ->whereYear('ngaydangky', '=', $year)
            ->groupBy('getMonth')
            ->orderBy('getMonth', 'ASC')
            ->get();
        return  $orderMonth;
    }
    public function getDay($begin,$end){

        $orderDay = DB::table('historys')
        ->select(DB::raw('tm as getDay'), DB::raw('COUNT(*) as value'))
        ->where([['tm', '>=', $begin],['tm','<',$end]])
        ->groupBy('getDay')
        ->orderBy('getDay', 'ASC')
        ->get();
        return $orderDay;
    }

    public function index()
    {
        $locktime        =  15;
        $initialvalue    =    1;
        $records        =    100000;
        
        $s_today        =    1;
        $s_yesterday    =    1;
        $s_all            =    1;
        $s_week            =    0;
        $s_month        =    1;
        
        $s_digit        =    1;
        
        $locktime        =    $locktime * 60;

        $day             =    date('d');
        $month             =    date('n');
        $year             =    date('Y');
        $daystart         =    mktime(0,0,0,$month,$day,$year);
        $monthstart         =  mktime(0,0,0,$month,1,$year);

        $weekday         =    date('w');
        $weekday--;
        if ($weekday < 0)    $weekday = 7;
        $weekday         =    $weekday * 24*60*60;
        $weekstart         =    $daystart - $weekday;

        $yesterdaystart     =    $daystart - (24*60*60);

        $now             =    time();

        $ip = \Request::ip();

        $q = DB::table('historys')
        ->first([
          DB::raw('MAX(id) as total')
        ]);

        $all_visitors     =    $q->total;

        if ($all_visitors !== NULL) {
            $all_visitors += $initialvalue;
        } else {
            $all_visitors = $initialvalue;
        }

        $name = Auth::user()->name;


        $q = DB::table('historys')->insert(['id_user' => $name ,'tm' => $now, 'ip' => $ip,'create_at' => date('Y/m/d')]);


        $n = $all_visitors;
        $div = 100000;
        while ($n > $div) {
            $div *= 10;
        }

        //Homnay
        $q = DB::table('historys')->where('tm','>',$daystart)->first([
          DB::raw('count(*) as todayrecord')
        ]);
        $today_visitors = $q->todayrecord;

        //Homqua
        $q = DB::table('historys')->where([['tm','>',$yesterdaystart],['tm','<',$daystart]])->first([
          DB::raw('count(*) as yesterdayrec')
        ]);
        $yesterday_visitors = $q->yesterdayrec;

        //Trong Tuan
        $q = DB::table('historys')->where('tm','>=',$weekstart)->first([
          DB::raw('count(*) as weekrec')
        ]);
        $week_visitors = $q->weekrec;

        //TrongThang
        $q = DB::table('historys')->where('tm','>=',$monthstart)->first([
          DB::raw('count(*) as monthrec')
        ]);
        $month_visitors = $q->monthrec;

        $rangeyear = Carbon::now()->subYears(1);
        $orderYear = DB::table('hoso_hocviens')
            ->select(DB::raw('year(ngaydangky) as getYear'), DB::raw('COUNT(*) as value'))
            ->where('ngaydangky', '>=', $rangeyear)
            ->groupBy('getYear')
            ->orderBy('getYear', 'ASC')
            ->get();

        $orderMonth = DB::table('hoso_hocviens')
            ->select(DB::raw('month(ngaydangky) as getMonth'), DB::raw('COUNT(*) as value'))
            ->whereYear('ngaydangky',$year)
            ->groupBy('getMonth')
            ->orderBy('getMonth', 'ASC')
            ->get();

        $tkDay = DB::table('historys')
            ->select(DB::raw('create_at as getDay'),DB::raw('COUNT(*) as value'))
            ->whereMonth('create_at',date('n'))
            ->whereYear('create_at',date('Y'))
            ->groupBy('getDay')
            ->orderBy('getDay', 'ASC')
            ->get(); 

        $nhanvien = NhanVien::where('chucvu','<>',7)->get();
        $hocvien = HoSoHocVien::all();
        $giaovien = NhanVien::where('chucvu',7)->get();
        $dadinhat = HoSoHocVien::where('tinhtrang','5')->get();
        $doitac = DoiTac::all();
        $history = History::take(10)->orderByRaw('tm DESC')->get();
        $donhang = DonHang::all();
        
        //THONG KE TINH TRANG HOC VIEN
        $moidk = HoSoHocVien::where('tinhtrang','1')->count();
        $daupv = HoSoHocVien::where('tinhtrang','2')->count();
        $daxuatcanh = HoSoHocVien::where('tinhtrang','5')->count();
        $dubi   = HoSoHocVien::where('tinhtrang','0')->count();
        $tinhtranghv = array();
        array_push($tinhtranghv,$moidk,$daupv,$daxuatcanh,$dubi);

        return view('admin.thongke.index',
            [
                'nhanvien' => $nhanvien,
                'hocvien' => $hocvien,
                'giaovien' => $giaovien,
                'doitac' => $doitac , 
                'dadinhat' => $dadinhat,
                'history' => $history ,
                'donhang' => $donhang, 
                'days' => $today_visitors,
                'weekend' => $week_visitors,
                'month' => $month_visitors,
                'tkyear' => $orderYear,
                'tkmonth' => $orderMonth, 
                'tkday' => $tkDay,
                'all' => $all_visitors,
                'tinhtranghv' => $tinhtranghv
            ]);
        }
}
