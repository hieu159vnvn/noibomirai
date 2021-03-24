@extends('admin.master')
@section('title', 'Đào Tạo - Hồ Sơ Học Viên ')
@section('PageContent')
<style>
    table, th, td {
        border: 1px solid black;
        border-collapse: collapse;
        padding-left: 5px; font-weight: 700;
    }
    tr {
        height: 50px;
    }
</style>
@php
   function ndjp($string) {
        $number =  strpos($string, '(');
        return substr($string,0,$number);
    }
    function ndvn($string) {
        return strstr($string, '(');
    }
    function newformat($datatime){
        $time = strtotime($datatime);
        $newformat = date('d - m - Y',$time);
        return $newformat;
    }
    function tinhtrang($datatinhtrang){
        switch($datatinhtrang){
		        case(0):
	                return 'Đang phỏng vấn';
	                break;
	            // case(1):  return '<a class="ui yellow label">Chưa đăng ký đơn hàng</a>'; break;
	            case(2):
	                return 'Đậu phỏng vấn';
	                break;
	            // case(3): return '<a class="ui teal label">Dự bị</a>'; break;
	            case(4):
	                return 'Rớt phỏng vấn';
	                break;
	            case(5):
	                return 'Đã xuất cảnh';
	                break;
	            default:
	                return 'Đã hũy';
            }
    }
@endphp
<table style="width: 100%">
    <tr>
        <th colspan="4" style="text-align: center; font-size: 30px;">{{$hocvien->hoten}}</th>
    </tr>
    <tr>
        <td style="width: 10%;">\</td>
        <td style="width: 50%;">{{newformat($hocvien->ngaysinh)}}  
            @php 
                
            @endphp  </td>
        <td style="width: 10%;" >SĐT</td>
        <td style="width: 30%;">{{$hocvien->dienthoai}}</td>
    </tr>
    <tr>
        <td>Lớp</td>
        <td>{{$hocvien->ten_lop_hoc}}</td>
        <td>SĐT GD</td>
        <td>{{$hocvien->dtnguoithan}}</td>
    </tr>
    <tr>
        <td>Quê Quán</td>
        <td>{{$hocvien->noisinh}}</td>
        <td>Ngày nhập học</td>
        <td>{{newformat($hocvien->ngaydangky)}}</td>
    </tr>
    <tr>
        <td>Tình trạng</td>
        <td>{{tinhtrang($hocvien->tinhtrang)}}</td>
        <td>DKXC</td>
        <td> @if($hocvien->dukienxc) {{$hocvien->dukienxc}} @else Chưa chốt @endif </td>
    </tr>
    <tr>
        <td>Ngày đậu PV</td>
        <td>{{newformat($hocvien->ngaypv)}}</td>
        <td>Ghi chú</td>
        <td> </td>
    </tr>
    <tr>
        <td rowspan="2">Ngành nghề</td>
        <td colspan="3">{{$hocvien->nganhnghe_jp}}</td>
    </tr>
    <tr>
        <td colspan="3">{{$hocvien->nganhnghe_vn}}</td>
    </tr>
    <tr>
        <td rowspan="2">Nghiệp đoàn</td>
        <td colspan="3">{{ndjp($hocvien->tennghiepdoan)}}</td>
    </tr>
    <tr>
        <td colspan="3">{{ndvn($hocvien->tennghiepdoan)}}</td>
    </tr>
    <tr>
        <td rowspan="2">Công ty</td>
        <td colspan="3">{{$hocvien->tencongty}}</td>
    </tr>
    <tr>
        <td colspan="3">{{$hocvien->doitacvn}}</td>
    </tr>
    <tr>
        <td>ĐỊA CHỈ</td>
        <td colspan="3">{{$hocvien->diachi}}</td>
    </tr>
</table>

@endsection