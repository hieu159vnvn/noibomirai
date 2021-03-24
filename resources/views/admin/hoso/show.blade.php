@extends('admin.master')
@section('title', 'In Hồ Sơ')
@section('PageContent')

<body style="background:#fff !important;">
@php
function getAge($birthdate = '0000/00/00') {
    if ($birthdate == '0000/00/00') return 'Unknown';
 
    $bits = explode('/', $birthdate);
    $age = date('Y') - $bits[0] - 1;
 
    $arr[1] = 'm';
    $arr[2] = 'd';
 
    for ($i = 1; $arr[$i]; $i++) {
        $n = date($arr[$i]);
        if ($n < $bits[$i])
            break;
        if ($n >= $bits[$i]) {
            ++$age;
            break;
        }
    }
    return $age;
}
function convert_hoten($str) {
	  $str = preg_replace("/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/", 'a', $str);
	  $str = preg_replace("/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/", 'e', $str);
	  $str = preg_replace("/(ì|í|ị|ỉ|ĩ)/", 'i', $str);
	  $str = preg_replace("/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/", 'o', $str);
	  $str = preg_replace("/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/", 'u', $str);
	  $str = preg_replace("/(ỳ|ý|ỵ|ỷ|ỹ)/", 'y', $str);
	  $str = preg_replace("/(đ)/", 'd', $str);
	  $str = preg_replace("/(À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ)/", 'A', $str);
	  $str = preg_replace("/(È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ)/", 'E', $str);
	  $str = preg_replace("/(Ì|Í|Ị|Ỉ|Ĩ)/", 'I', $str);
	  $str = preg_replace("/(Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ)/", 'O', $str);
	  $str = preg_replace("/(Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ)/", 'U', $str);
	  $str = preg_replace("/(Ỳ|Ý|Ỵ|Ỷ|Ỹ)/", 'Y', $str);
	  $str = preg_replace("/(Đ)/", 'D', $str);
	  //$str = str_replace(” “, “-”, str_replace(“&*#39;”,”",$str));
	  return $str;
	}

	$timestamp_image = strtotime($hoso->created_at);
	$year_image = date("Y", $timestamp_image);
	$month_image = date("m", $timestamp_image);
@endphp
			<div class="right actions">
		      <a href="javascript:void(0)" onclick="In_Content('intiengviet')">
		        <div class="ui blue icon button">
		         <i class="print icon"></i> IN TIẾNG VIỆT
		        </div>
		      </a>
		      @if($hosojp)
		      <a href="javascript:void(0)" onclick="In_Content('intiengnhat')">
		        <div class="ui red icon button">
		         <i class="print icon"></i> IN TIẾNG NHẬT
		        </div>
		      </a>
			  @endif
			  <input class="ui green icon button" type="button" onclick="tableToExcel('testTable', '{{$hoso->hoten}}', '{{$hoso->hoten}}.xls')" value="Export to Excel">
		    </div>
	<div class="ui top attached tabular menu">
	    <a class="item @if(!Auth::user()->can('diemdanh-create')) active @endif" data-tab="tiengviet">Tiếng Việt</a>
	    @if($hosojp)
	   		 <a class="item" data-tab="tiengnhat">Tiếng Nhật</a>	
		@endif
		<a class="item @if(Auth::user()->can('diemdanh-create')) active @endif " data-tab="daotao">Hồ sơ học viên</a>	  
	</div>
{{-- TIENG VIET --}}
	<div class="ui bottom attached tab segment @if(!Auth::user()->can('diemdanh-create')) active @endif" data-tab="tiengviet">
		<div id="intiengviet">	
			<style type="text/css">
				body {
					background: #555;
					-webkit-print-color-adjust:exact;
				}		    	
				table {
				    margin: auto;
					background-color: white;
				}
				tr {
					height: 20px;
				}
				tr td {
					font-family: "Times New Roman", Times, serif;
					text-align:center;
					font-size:12px;
					border-left:1px dotted;
					border-top: 1px dotted;
					border-bottom: none;
					border-right: none;
					border-color:#000000;
				}
				.logo-form .span-logo {
					float: left;
				}
				.logo-form {
					padding: 15px;
					min-height:22px;
				}
				.logo-form h2 {
					font-size: 30px;
					font-style: italic;
					font-weight: bold;
					margin: 0px; 
					padding: 0px;
				}
				p {    margin: 2px;}
			</style>
			<table width="794" cellspacing="0" border="1" style="border: 2px solid black">
					<tr class="logo-form">
						<td colspan="26" style="  border: none;border-bottom: 1px solid" >
							<span class="span-logo"><img src="/uploads/source/Logo/logo.png" width="50" ></span>
							<h2>MIRAI HUMAN</h2>
						</td>
						<td colspan="5" width="370" rowspan="6" style="text-align: center; border: none; border-left: 1px solid;border-bottom: 1px solid">
						@if (($hoso->hinhanh != NULL) && (strlen($hoso->hinhanh) < 100))
								<img src="{{url('')}}/hocviens/{{$year_image}}/{{$month_image}}/{{$hoso->hinhanh}}" width="100%">
							@else
								<img src="{{$hoso->hinhanh}}" width="100%">
							@endif
						</td>
					</tr>
					<tr>
						<td colspan="26" class="none-border-t" style="font-size:24px;background-color:#C0C0C0;font-weight:bold; border-top: none; border-left: none;">SƠ YẾU LÝ LỊCH</td>
					</tr>
					<tr>
						<td colspan="4" rowspan="2" style="border-left: none;">HỌ TÊN</td>
						<td colspan="14" rowspan="2" style="font-size:22px;font-weight:bold;text-transform: uppercase;">{{$hoso->hoten}}</td>
						<td colspan="3">ĐIỆN THOẠI</td>
						<td colspan="5">{{$hoso->dienthoai}}</td>
					</tr>
					<tr>
						<td colspan="3">ĐT NGƯỜI THÂN</td>
						<td colspan="5">{{$hoso->dtnguoithan}}</td>
					</tr>
					<tr>
						<td colspan="4" style="border-left: none;">NGÀY SINH</td>
						<td colspan="10"> {{date_format(date_create($hoso->ngaysinh), "d/m/Y")}}</td>
						<td colspan="2">TUỔI</td>
						<td colspan="2">{{getAge(date_format(date_create($hoso->ngaysinh), "Y/m/d"))}}</td>
						<td colspan="2" rowspan="2">TAY THUẬN </td>
						<td colspan="2">CÔNG VIỆC</td>
						<td style="min-width: 50px">@if($hoso->congviec == 0) P @else T @endif</td>
						<td colspan="2" style="min-width: 50px">ĐŨA</td>
						<td style="min-width: 50px">@if($hoso->dua == 0) P @else T @endif</td>
					</tr>
					<tr>
						<td colspan="4" style="border-left: none;">GIỚI TÍNH</td>
						<td colspan="10">@if($hoso->gioitinh == 0) NỮ @else NAM @endif</td>
						<td colspan="2" rowspan="3">TÔN GIÁO</td>
						<td colspan="2" rowspan="3">{{$hoso->tongiao}}</td>
						<td colspan="2" style="min-width: 50px">KÉO</td>
						<td style="min-width: 50px">@if($hoso->keo == 0) P @else T @endif</td>
						<td colspan="2">VIẾT</td>
						<td style="min-width: 50px">@if($hoso->viet == 0) P @else T @endif</td>
					</tr>
					<tr>
						<td colspan="4" style="border-left: none;">HÔN NHÂN</td>
						<td colspan="10">{{$hoso->honnhan}}</td>
						<td colspan="4">CHIỀU CAO (cm)</td>
						<td colspan="3">{{$hoso->chieucao}}</td>
						<td colspan="3">CÂN NẶNG (kg)</td>
						<td colspan="3">{{$hoso->cannang}}</td>
					</tr>
					<tr>
						<td colspan="4" style="border-left: none;">BỆNH ÁN</td>
						<td colspan="10">{{$hoso->benhan}}</td>
						<td colspan="4">NHÓM MÁU</td>
						<td colspan="9">{{$hoso->nhommau}}</td>
					</tr>
					<tr >
						<td colspan="4" style="border-bottom: 1px solid; border-left: none;">NƠI SINH</td>
						<td colspan="10" style="border-bottom: 1px solid">{{$hoso->noisinh}}</td>
						<td colspan="2" style="border-bottom: 1px solid">MIỀN</td>
						<td colspan="2" style="border-bottom: 1px solid">{{$hoso->mien}}</td>
						<td colspan="2" style="border-bottom: 1px solid">THỊ LỰC</td>
						<td colspan="3" style="border-bottom: 1px solid">TRÁI</td>
						<td colspan="3" style="border-bottom: 1px solid">{{$hoso->mattrai}}</td>
						<td colspan="3" style="border-bottom: 1px solid">PHẢI</td>
						<td colspan="2" style="border-bottom: 1px solid">{{$hoso->matphai}}</td>
					</tr>
					<tr style="height:5px;">
					    <td colspan="31" style="border-bottom: none; border-top: none; border-left: none;"></td>
					</tr>
					<tr>
					    <td colspan="6" style="border-bottom: 1px solid; border-top: 1px solid; border-left: none;">ĐỊA CHỈ HỘ KHẨU</td>
					    <td colspan="20" style="border-bottom: 1px solid; border-top: 1px solid;text-transform: uppercase;">
					    	{{-- {{$hoso->diachi}} --}}
					    	@if ($hoso->diachi)
								{{$hoso->diachi}}
							@else
								{{$hoso->dchk_dc.",".$hoso->dchk_xa.",".$hoso->dchk_huyen}}
							@endif
					    </td>
					    <td colspan="3" style="border-bottom: 1px solid; border-top: 1px solid">TĨNH/TP</td>
					    <td colspan="2" style="border-bottom: 1px solid; border-top: 1px solid;text-transform: uppercase;">
					    		@foreach($city as $ct)
						      		@if($ct->id == $hoso->tinhthanh)
						      		{{$ct->ten}}
						      		@endif
						      	@endforeach
					  </tr>
					<tr style="height:5px;">
					    <td colspan="31" style="border-bottom: none; border-top: none; border-left: none;"></td>
					</tr>
				    <tr>
				        <td colspan="4" rowspan="{{count($hoctap) + 1}}" style="background-color:#C0C0C0;font-weight:bold; border-top: 1px solid; border-left: none;">QUÁ TRÌNH HỌC TẬP</td>
				        <td colspan="11" style="border-top: 1px solid;">THỜI GIAN HỌC</td>
				        <td colspan="11" style="border-top: 1px solid;">TÊN TRƯỜNG</td>
				        <td colspan="5" style="border-top: 1px solid;">ĐỊA CHỈ TRƯỜNG</td>
				    </tr>
					@foreach($hoctap as $ht)
						<tr>
							<td colspan="5">{{$ht->thoigianbd}}</td>
							<td style="border-left: none;">~</td>
							<td colspan="5" style="border-left: none;">{{$ht->thoigiankt}}</td>
							<td colspan="11">{{$ht->tentruong}}</td>
							<td colspan="5" >{{$ht->diachi}}</td>
						</tr>
					@endforeach  
					<tr style="height:5px;">
					    <td colspan="31" style="border-bottom: none;border-top: 1px solid; border-left: none;"></td>
					</tr>
					<tr>
					    <td colspan="4" rowspan="3" style="background-color:#C0C0C0;font-weight:bold;border-top: 1px solid; border-left: none;">QUÁ TRÌNH LÀM VIỆC</td>
					    <td colspan="11" style="border-top: 1px solid;">THỜI GIAN LÀM VIỆC</td>
					    <td colspan="11" style="border-top: 1px solid;">TÊN CÔNG TY</td>
					    <td colspan="5" style="border-top: 1px solid;">NỘI DUNG CÔNG VIỆC</td>
				  	</tr>
				  	@php 
						$subtractlv =( 2 - count($lamviec)); 
						$pluslv = 0;
					@endphp
					@if ($subtractlv <= 0)
						@foreach($lamviec as $lv)
						@if ($pluslv <= 1 )
						<tr>
							<td colspan="5">
								{{substr($lv->thoigianbd,0,2)."/"}}{{substr($lv->thoigianbd,3)}} 
							</td>
							<td style="border-left: none;">~</td>
							<td colspan="5" style="border-left: none;">
								{{substr($lv->thoigiankt,0,2)."/"}}{{substr($lv->thoigiankt,3)}}
							</td>
							<td colspan="11">{{$lv->tencongty}}</td>
							<td colspan="5">{{$lv->congviec}}</td>
						</tr>
						@endif
						@php $pluslv++; @endphp
						@endforeach 
					@else
						@foreach($lamviec as $lv)
							<tr>
								<td colspan="5">
									{{substr($lv->thoigianbd,0,2)."/"}}{{substr($lv->thoigianbd,3)}} 
								</td>
								<td style="border-left: none;">~</td>
								<td colspan="5" style="border-left: none;">
									{{substr($lv->thoigiankt,0,2)."/"}}{{substr($lv->thoigiankt,3)}}
								</td>
								<td colspan="11">{{$lv->tencongty}}</td>
								<td colspan="5">{{$lv->congviec}}</td>
							</tr>
						@endforeach 
						@for ($lvi = 0; $lvi < $subtractlv; $lvi++)
						<tr>
							<td colspan="5"></td>
							<td style="border-left: none;"></td>
							<td colspan="5" style="border-left: none;"></td>
							<td colspan="11"></td>
							<td colspan="5"></td>
						</tr>
						@endfor
					@endif
					<tr style="height:5px;">
					    <td colspan="31" style="border-bottom: none;border-top: 1px solid; border-left: none;"></td>
					</tr>
					<tr>
					    <td colspan="4" rowspan="4" style="background-color:#C0C0C0;font-weight:bold;border-bottom: 1px solid;border-top: 1px solid; border-left: none;">NGOẠI NGỮ</td>
				    	<td colspan="3" style="border-top: 1px solid;">ANH NGỮ</td>
				    	<td colspan="11" style="border-top: 1px solid;">
							@if($hoso->anhngu == 0)
								KHÔNG
							@elseif($hoso->anhngu == 1)
								Bằng A
							@elseif($hoso->anhngu == 2)
								Bằng B
							@elseif($hoso->anhngu == 3)	
								Bằng C				    
							@endif
				    	</td>
				    	<td colspan="7" style="background-color:#C0C0C0;font-weight:bold;border-top: 1px solid;">ĐÃ TỪNG TỚI NHẬT</td>
						<td colspan="6" style="border-top: 1px solid;">@if($hoso->datungtoinhat == 1) CÓ @else KHÔNG @endif</td>
				  	</tr>
					<tr>
						<td colspan="3" rowspan="2">NHẬT NGỮ</td>
						<td colspan="11" rowspan="2">
							@if($hoso->nhatngu == 0)
								KHÔNG
							@elseif($hoso->nhatngu == 1)
								BẰNG N1
							@elseif($hoso->nhatngu == 2)
								BẰNG N2
							@elseif($hoso->nhatngu == 3)	
								BẰNG N3
							@elseif($hoso->nhatngu == 4)
								BẰNG N4
							@elseif($hoso->nhatngu == 5)	
								BẰNG N5	
							@endif
						</td>
						<td colspan="7" style="background-color:#C0C0C0;font-weight:bold;">CÓ NGƯỜI THÂN TẠI NHẬT</td>
						<td colspan="6">@if($hoso->conguoithantainhat == 1) CÓ @else KHÔNG @endif </td>
					</tr>
					@php 
						$subtractnt =( 2 - count($nguoithan)); 
						$plusnt1 = 0;
						$plusnt2 = 0;
					@endphp
					
					@if($subtractnt > 1 )					
						<tr>
							<td>TÊN:</td>
							<td colspan="5">&nbsp;</td>
							<td>TUỔI:</td>
							<td colspan="2">&nbsp;</td>
							<td colspan="2">QUAN HỆ: </td>
							<td colspan="2">&nbsp;</td>
						</tr>
					@else 
						@foreach ($nguoithan as $nt)
							@if ($plusnt1 == 0)
								<tr>
									<td>TÊN:</td>
									<td colspan="5">{{$nt->hoten}}</td>
									<td>TUỔI:</td>
									<td colspan="2">{{$nt->tuoi}}</td>
									<td colspan="2">QUAN HỆ: </td>
									<td colspan="2">{{$nt->quanhe}}</td>
								</tr>
							@endif
							@php $plusnt1++; @endphp
						@endforeach
					@endif
				  <tr>
				    <td colspan="3" style="border-bottom: 1px solid;">KHÁC</td>
					<td colspan="11" style="border-bottom: 1px solid;">{{$hoso->ngoaingukhac}}</td>
					@if ($subtractnt <= 0 )
						@foreach ($nguoithan as $nt)
						@if ($plusnt2 == 1)
							<td style="border-bottom: 1px solid;">TÊN:</td>
				  			<td colspan="5" style="border-bottom: 1px solid;">{{$nt->hoten}}</td>
							<td style="border-bottom: 1px solid;">TUỔI:</td>
				  			<td colspan="2" style="border-bottom: 1px solid;">{{$nt->tuoi}}</td>
							<td colspan="2" style="border-bottom: 1px solid;">QUAN HỆ:</td>
				  			<td colspan="2" style="border-bottom: 1px solid;">{{$nt->quanhe}}</td>
						@endif
						@php $plusnt2++; @endphp
						@endforeach
					@else
						<td style="border-bottom: 1px solid;">TÊN:</td>
						<td colspan="5" style="border-bottom: 1px solid;"></td>
						<td style="border-bottom: 1px solid;">TUỔI:</td>
						<td colspan="2" style="border-bottom: 1px solid;"></td>
						<td colspan="2" style="border-bottom: 1px solid;">QUAN HỆ:</td>
						<td colspan="2" style="border-bottom: 1px solid;"></td>
					@endif
				   
				  </tr>
					<tr style="height:5px;">
					    <td colspan="31" style="border-bottom: none; border-top: none; border-left: none;"></td>
					</tr>
				  <tr>
				    <td colspan="31" style="background-color:#C0C0C0;font-weight:bold;border-top: 1px solid; border-left: none;">THỰC TẬP KỸ NĂNG Ở NHẬT</td>
				  </tr>
				  <tr>
				    <td colspan="10" style="border-left: none;">MỤC ĐÍCH ĐI NHẬT</td>
				    <td colspan="21">{{$hoso->mucdich}}</td>
				  </tr>
				  <tr>
				    <td colspan="10" style="border-left: none;">SỐ TIỀN DỰ ĐỊNH TIẾT KIỆM MỖI THÁNG TẠI NHẬT</td>
				    <td colspan="6">{{$hoso->sotientrenthang}} VND</td>
				    <td colspan="9">SỔ TIỀN DỰ ĐỊNH TIẾT KIỆM SAU 3 NĂM TẠI NHẬT</td>
				    <td colspan="6">{{$hoso->sotientrennam}} VND</td>
				  </tr>
				  <tr>
				    <td colspan="10" style="border-bottom: 1px solid; border-left: none;">MỤC TIÊU SAU KHI VỀ NƯỚC</td>
				    <td colspan="21" style="border-bottom: 1px solid">{{$hoso->muctieu}}</td>
				  </tr>
				  
					<tr style="height:5px;">
					    <td colspan="31" style="border-bottom: none; border-top: none;border-left: none;"></td>
					</tr>
					  <tr>
				    <td colspan="31" style="background-color:#C0C0C0;font-weight:bold;border-top: 1px solid;border-left: none;">KHÁC</td>
				  </tr>
				  <tr>
				    <td colspan="4" style="border-left: none;">BẰNG LÁI</td>
				    <td colspan="6">@if($hoso->banglai == 1) CÓ @else KHÔNG @endif</td>
				    <td colspan="2"> LOẠI XE </td>
				    <td colspan="19" style="text-align: left;">

				        &nbsp; @if($hoso->xemay == 1) &#9745; @else &#9744; @endif  XE MÁY 
				        &nbsp; @if($hoso->oto == 1) &#9745; @else &#9744; @endif Ô TÔ
				        &nbsp; @if($hoso->xekhac != '') &#9745; @else &#9744; @endif KHÁC (&ensp;&ensp;{{$hoso->xekhac}}&ensp;&ensp;)
				    </td>
				  </tr>
				  <tr>
				    <td colspan="4" style="border-bottom: 1px solid; border-left: none;">SỞ THÍCH</td>
				    <td colspan="12" style="border-bottom: 1px solid">{{$hoso->sothich}}</td>
				    <td colspan="4" style="border-bottom: 1px solid">ĐIỂM MẠNH</td>
				    <td colspan="11" style="border-bottom: 1px solid">{{$hoso->diemmanh}}</td>
					  </tr>
					<tr style="height:5px;">
					    <td colspan="31" style="border-bottom: none; border-top: none; border-left: none;"></td>
					</tr>
					<tr>
						<td colspan="2" rowspan="8" style="background-color:#C0C0C0;font-weight:bold; border-top: 1px solid; border-left:none;">GIA ĐÌNH</td>
						<td colspan="9" style="border-top: 1px solid; width: 300px">QUAN HỆ (Cha, Mẹ, Tất cả anh chị em ruột)</td>
						<td colspan="2" style="border-top: 1px solid">NĂM SINH</td>
						<td colspan="6" style="border-top: 1px solid">CÔNG VIỆC</td>
						<td colspan="6" style="border-top: 1px solid">NƠI LÀM VIỆC</td>
						<td colspan="6" style="border-top: 1px solid">THU NHẬP HÀNG THÁNG</td>
					</tr>
					@php 
						$subtractgd =( 7 - count($giadinh)); 
						$plusgd = 0;
					@endphp

					@if ($subtractgd <= 0)
						@foreach($giadinh as $gd)
						@if ($plusgd <= 6 )
						<tr>
							<td colspan="3">{{$gd->quanhe}}</td>
							<td colspan="6">{{$gd->hoten}}</td>
							<td colspan="2">{{$gd->namsinh}}</td>
							<td colspan="6">{{$gd->congviec}}</td>
							<td colspan="6">{{$gd->noilamviec}}</td>  
							<td colspan="6">{{$gd->luong}} VND</td>
						</tr>
						@endif
						@php $plusgd++; @endphp
						@endforeach 
					@else
						@foreach($giadinh as $gd)
						<tr>
							<td colspan="3">{{$gd->quanhe}}</td>
							<td colspan="6">{{$gd->hoten}}</td>
							<td colspan="2">{{$gd->namsinh}}</td>
							<td colspan="6">{{$gd->congviec}}</td>
							<td colspan="6">{{$gd->noilamviec}}</td>  
							<td colspan="6">{{$gd->luong}} VND</td>
						</tr>
						@endforeach 
						@for ($gdi = 0; $gdi < $subtractgd; $gdi++)
						<tr>
							<td colspan="3"></td>
							<td colspan="6"></td>
							<td colspan="2"></td>
							<td colspan="6"></td>
							<td colspan="6"></td>  
							<td colspan="6"></td>
						</tr>
						@endfor
					@endif
			</table>
			<table width="794" cellspacing="0" border="0" >
			    <tr style="height:44px;">
			        <td colspan="15" style="text-align: left; padding-left: 15px; border: none;">
			            <span>Đăng ký ngày: {{date_format(date_create($hoso->ngaydangky), "d/m/Y")}}</span>
			        </td>
			        <td colspan="16" style="text-align: left; padding-left: 15px; border: none;">
			           <span>Người phụ trách: {{$hoso->nguoiphutrach}}</span>
			           <span style="float: right;">Người giới thiệu: {{$hoso->nguoigioithieu}} &nbsp;&nbsp;</span> 
			        </td>
			    </tr>
			</table>
		</div>
	</div>
{{-- END-TIENGVIET --}}
{{-- TIENG NHAT --}}
@if($hosojp)
	<div class="ui bottom attached tab segment" data-tab="tiengnhat">
		<div id="intiengnhat">
		<style type="text/css">
			body {
				background: #555;
				-webkit-print-color-adjust:exact;
			}		    	

			table {
				margin: auto;
				background-color: white;
			}
			tr {
				height: 20px;
			}
			tr td {
				font-family: "Times New Roman", Times, serif;
				text-align:center;
				font-size:12px;
				border-left:1px dotted;
				border-top: 1px dotted;
				border-bottom: none;
				border-right: none;
				border-color:#000000;
			}
			.logo-form .span-logo {
				float: left;
			}
			.logo-form {
				padding: 15px;
				min-height:22px;
			}
			.logo-form h2 {
				font-size: 30px;
				font-style: italic;
				font-weight: bold;
				margin: 0px; 
				padding: 0px;
			}
			p {    margin: 2px;}
		</style>
		<table width="794" cellspacing="0" border="1" style="border: 2px solid black">
		<tr class="logo-form">
			<td colspan="26" style="  border: none;border-bottom: 1px solid" >
				<span class="span-logo"><img src="/uploads/source/Logo/logo.png" width="50" ></span>
				<h2>MIRAI HUMAN</h2>
			</td>
			<td colspan="5" rowspan="6" style="text-align: center; border: none; border-left: 1px solid;border-bottom: 1px solid">
				<p style="text-align: left; font-weight: bold;"> 番号：{{$hoso->stt}}</p>
				@if (($hoso->hinhanh != NULL) && (strlen($hoso->hinhanh) < 100))
					<img src="{{url('')}}/hocviens/{{$year_image}}/{{$month_image}}/{{$hoso->hinhanh}}" width="100%">
				@else
					<img src="{{$hoso->hinhanh}}" width="100%">
				@endif
			</td>
		</tr>
		
		<tr>
			<td colspan="26" class="none-border-t" style="font-size:24px;background-color:#C0C0C0;font-weight:bold; border-top: none; border-left: none;">技能実習生履歴書</td>
		</tr>
	  
		<tr>
			<td colspan="4" rowspan="2" style="border-left: none; width: 100px; ">氏名</td>
			<td colspan="3">英字表記</td>
			<td colspan="19" style="font-size:20px;font-weight:bold; text-transform: uppercase;">{{convert_hoten($hoso->hoten)}}</td>
		</tr>
		<tr>
			<td colspan="3">フリガナ</td>
			<td colspan="19" style="font-size:20px;">{{$hosojp->hoten}}</td>
		</tr>
		<tr>
			<td colspan="4" style="border-left: none;">生年月日</td>
			<td colspan="10">{{date_format(date_create($hoso->ngaysinh),"Y年m月d日")}}</td>
			<td colspan="2">年齢</td>
			<td colspan="2">{{getAge(date_format(date_create($hoso->ngaysinh),"Y/m/d"))}}</td>
			<td colspan="2" rowspan="2" style="width: 70px">利き手 </td>
			<td colspan="2">仕事</td>
			<td style="min-width: 50px">@if($hoso->congviec == 0) 右 @else 左 @endif</td>
			<td colspan="2" style="min-width: 50px">箸</td>
			<td style="min-width: 50px">@if($hoso->dua == 0) 右 @else 左 @endif</td>
		</tr>
		<tr>
			<td colspan="4" style="border-left: none;">性別</td>
			<td colspan="10">@if($hoso->gioitinh == 0) 女 @else 男 @endif</td>
			<td colspan="2" rowspan="3">宗教</td>
			<td colspan="2" rowspan="3">
			{{$hosojp->tongiao}}</td>
			<td colspan="2" style="min-width: 50px">鋏</td>
			<td style="min-width: 50px">@if($hoso->keo == 0) 右 @else 左 @endif</td>
			<td colspan="2">ペン</td>
			<td style="min-width: 50px">@if($hoso->viet == 0) 右 @else 左 @endif</td>
		</tr>
		<tr>
			<td colspan="4" style="border-left: none;">婚姻</td>
			<td colspan="10">{{$hosojp->honnhan}}</td>
			<td colspan="4">身長（センチ)</td>
			<td colspan="3">{{$hoso->chieucao}}</td>
			<td colspan="3">体重（キロ)</td>
			<td colspan="3">{{$hoso->cannang}}</td>
		</tr>
		<tr>
			<td colspan="4" style="border-left: none;">病暦</td>
			<td colspan="10">{{$hosojp->benhan}}</td>
			<td colspan="4">血液</td>
			<td colspan="9">{{$hoso->nhommau}}</td>
		</tr>
		<tr >
			<td colspan="4" style="border-bottom: 1px solid; border-left: none;">出身地</td>
			<td colspan="10" style="border-bottom: 1px solid">{{$hosojp->noisinh}}</td>
			<td colspan="2" style="border-bottom: 1px solid">地方</td>
			<td colspan="2" style="border-bottom: 1px solid">{{$hosojp->mien}}</td>
			<td colspan="2" style="border-bottom: 1px solid">視カ</td>
			<td colspan="3" style="border-bottom: 1px solid">左</td>
			<td colspan="3" style="border-bottom: 1px solid">{{$hosojp->mattrai}}</td>
			<td colspan="3" style="border-bottom: 1px solid">右</td>
			<td colspan="2" style="border-bottom: 1px solid">{{$hosojp->matphai}}</td>
		</tr>
		<tr style="height:5px;">
		    <td colspan="31" style="border-bottom: none; border-top: none; border-left: none;"></td>
		</tr>
		<tr>
			<td colspan="6" style="border-bottom: 1px solid; border-top: 1px solid; border-left: none;">戸籍住所</td>
			<td colspan="20" style="border-bottom: 1px solid; border-top: 1px solid">
				@if ($hosojp->diachi)
					{{$hosojp->diachi}}
				@else
					@if($hosojp->dchk)
						@php $dchk = json_decode($hosojp->dchk);  echo $dchk->dchk_tinh." ".$dchk->dchk_tinh_plus." ".$dchk->dchk_huyen." ".$dchk->dchk_huyen_plus." ".$dchk->dchk_xa." ".
						$dchk->dchk_xa_plus." ".$dchk->dchk_dc." ".$dchk->dchk_dc_plus; @endphp
					@endif
				@endif
			</td>				
			<td colspan="3" style="border-bottom: 1px solid; border-top: 1px solid">地方</td>
			<td colspan="2" style="border-bottom: 1px solid; border-top: 1px solid">
				{{$hosojp->diachimien}}
			</td>
		</tr>
		<tr style="height:5px;">
		    <td colspan="31" style="border-bottom: none; border-top: none; border-left: none;"></td>
		</tr>
		@php
			$example=array();
			foreach ($hoctap as $hta) {
				array_push($example,$hta->tentruong);
			}
			$searchword = ['TRƯỜNG TIỂU HỌC','TRƯỜNG THCS','TRƯỜNG THPT'];
			$arrhoctap = array();
			foreach ($searchword as $searchword) {
				foreach($example as $k=>$v) {
					if ($k == 0) {
						if(preg_match("/\b$searchword\b/i", $v)) {
							$arrhoctap[$k] = "小学校";
						}
					}elseif ($k == 1) {
						if(preg_match("/\b$searchword\b/i", $v)) {
							$arrhoctap[$k] = "中学校";
						}
					}elseif ($k == 2) {
						if(preg_match("/\b$searchword\b/i", $v)) {
							$arrhoctap[$k] = "高等学校";
						}
					}
				}
			}
		@endphp
		@php
			$hoctap = json_decode($hosojp->hoctap);
		@endphp
		@if ($hoctap->thoigianbd[0])		
	    <tr>
			<td colspan="4" rowspan="{{count($hoctap->thoigianbd)+1}}" 
				style="background-color:#C0C0C0;font-weight:bold;border-bottom: none; border-top: 1px solid; border-left: none;">学 歴</td>
	        <td colspan="11" style="border-top: 1px solid;">期 間</td>
	        <td colspan="11" style="border-top: 1px solid;">学 校 名</td>
	        <td colspan="5" style="border-top: 1px solid;">学 校 所 在 地</td>
	    </tr>
		@for($i = 0 ; $i < count($hoctap->thoigianbd); $i++)    
		  	<tr>
				@php
					$thangbd = substr( $hoctap->thoigianbd[$i],  0, 2);
					$nambd = substr( $hoctap->thoigianbd[$i],  3, 7);
					$thangkt = substr( $hoctap->thoigiankt[$i],  0, 2);
					$namkt = substr( $hoctap->thoigiankt[$i],  3, 7);
				@endphp
			  	@if (strlen($hoctap->thoigianbd[$i]) == 4)
					<td colspan="5">{{$hoctap->thoigianbd[$i]}}年09月</td>
					<td style="border-left: none;">~</td>
					<td colspan="5" style="border-left: none;">{{$hoctap->thoigiankt[$i]}}年05月</td>
				@elseif( strlen($hoctap->thoigianbd[$i]) == 7)
					<td colspan="5">{{$nambd}}年{{$thangbd}}月</td>
					<td style="border-left: none;">~</td>
					@if(strlen($hoctap->thoigiankt[$i]) == 7)
					  <td colspan="5" style="border-left: none;">{{$namkt}}年{{$thangkt}}月</td>
					@else
						<td colspan="5" style="border-left: none;">{{$hoctap->thoigiankt[$i]}}</td>
					@endif
				@else
					<td colspan="5"></td>
					<td style="border-left: none;"></td>
					<td colspan="5" style="border-left: none;"></td>
				@endif
		    
				@if ($i > 2)
					<td colspan="11">{{$hoctap->tentruong[$i]}}</td>
				@else
					<td colspan="11">{{$hoctap->tentruong[$i]}} @if (isset($arrhoctap[$i])) {{$arrhoctap[$i]}} @endif </td>
				@endif
		    	<td colspan="5">{{$hoctap->diachitruong[$i]}}@if (isset($hoctap->dctinh)) {{$hoctap->dctinh[$i]}} @endif</td>
		  	</tr>
		@endfor 
		@else
			<tr>
				<td colspan="4" rowspan="" 
				style="background-color:#C0C0C0;font-weight:bold;border-bottom: none; border-top: 1px solid; border-left: none;">学 歴</td>
				<td colspan="11" style="border-top: 1px solid;">期 間</td>
				<td colspan="11" style="border-top: 1px solid;">学 校 名</td>
				<td colspan="5" style="border-top: 1px solid;">学 校 所 在 地</td>
			</tr>
		@endif 
		<tr style="height:5px;">
		    <td colspan="31" style="border-bottom: none; border-top: 1px solid; border-left: none;"></td>
		</tr>
		@php
			$lamviec = json_decode($hosojp->lamviec); 
		@endphp
		@if ($lamviec->thoigianbd[0])
			<tr>
				<td colspan="4" rowspan="3" style="background-color:#C0C0C0;font-weight:bold;border-bottom: none; border-top: 1px solid; border-left: none;">職 歴</td>
				<td colspan="11" style="border-top: 1px solid;">期 間</td>
				<td colspan="11" style="border-top: 1px solid;">勤 務 先</td>
				<td colspan="5" style="border-top: 1px solid;">職 種</td>
			</tr>
			@php 
				$subtractlvjp =( 2 - count($lamviec->thoigianbd)); 
			@endphp
			@if ($subtractlvjp <= 0)
				@for($i = 0 ; $i < 2; $i++)
				<tr>
					<td colspan="5">
						{{substr($lamviec->thoigianbd[$i],3)."年"}}{{substr($lamviec->thoigianbd[$i],0,2)."月"}}
					</td>
					<td style="border-left: none;">~</td>
					<td colspan="5" style="border-left: none;">
						{{substr($lamviec->thoigiankt[$i],3)."年"}}{{substr($lamviec->thoigiankt[$i],0,2)."月"}}
					</td>
					<td colspan="11">{{$lamviec->tencongty[$i]}}</td>
					<td colspan="5">{{$lamviec->ndcongviec[$i]}}</td>
				</tr>
				@endfor
			@else
				@for($i = 0 ; $i < count($lamviec->thoigianbd); $i++)
				<tr>
					<td colspan="5">
						{{substr($lamviec->thoigianbd[$i],3)."年"}}{{substr($lamviec->thoigianbd[$i],0,2)."月"}}
					</td>
					<td style="border-left: none;">~</td>
					<td colspan="5" style="border-left: none;">
						{{substr($lamviec->thoigiankt[$i],3)."年"}}{{substr($lamviec->thoigiankt[$i],0,2)."月"}}
					</td>
					<td colspan="11">{{$lamviec->tencongty[$i]}}</td>
					<td colspan="5">{{$lamviec->ndcongviec[$i]}}</td>
				</tr>
				@endfor
				@for ($lvijp = 0; $lvijp < $subtractlvjp; $lvijp++)
				<tr>
					<td colspan="5"></td>
					<td style="border-left: none;"></td>
					<td colspan="5" style="border-left: none;"></td>
					<td colspan="11"></td>
					<td colspan="5"></td>
				</tr>
				@endfor
			@endif
		@else
			<tr>
				<td colspan="4" rowspan="" style="background-color:#C0C0C0;font-weight:bold;border-bottom: none; border-top: 1px solid; border-left: none;">職 歴</td>
				<td colspan="11" style="border-top: 1px solid;">期 間</td>
				<td colspan="11" style="border-top: 1px solid;">勤 務 先</td>
				<td colspan="5" style="border-top: 1px solid;">職 種</td>
			</tr>
		@endif
		<tr style="height:5px;">
		    <td colspan="31" style="border-bottom: none; border-top: 1px solid; border-left: none;"></td>
		</tr>
	    <tr>
			<td colspan="4" rowspan="4" style="background-color:#C0C0C0;font-weight:bold;border-bottom: 1px solid;border-top: 1px solid; border-left: none;">外 国 語</td>
			<td colspan="3" style="border-top: 1px solid;">英語</td>
			<td colspan="11" style="border-top: 1px solid;">
				@if($hoso->anhngu == 0)
					無
				@elseif($hoso->anhngu == 1)
					A
				@elseif($hoso->anhngu == 2)
					B
				@elseif($hoso->anhngu == 3)	
					C				    
				@endif
			</td>
			<td colspan="7" style="background-color:#C0C0C0;font-weight:bold;border-top: 1px solid;">訪 日 経 験</td>
			<td colspan="6" style="border-top: 1px solid;"> @if ($hoso->datungtoinhat == '1') はい @else 無 @endif </td>
		</tr>
		<tr>
			<td colspan="3" rowspan="2">日本語</td>
			<td colspan="11" rowspan="2">
				{{$hosojp->nhatngu}}
			</td>
			<td colspan="7" style="background-color:#C0C0C0;font-weight:bold;">在日本親戚．知人</td>
			<td colspan="6"> @if ($hoso->conguoithantainhat == '1') 有 @else 無 @endif </td>
		</tr>
		 @php
		 	if ($hosojp->nguoithan) {
				$nguoithan = json_decode($hosojp->nguoithan);
				if ($nguoithan->hoten) {
					$subtractntjp =( 2 - count($nguoithan->hoten));					
				}else{
					$subtractntjp = 2;
				}
			}else {
				$nguoithan = json_decode('{"hoten":["",""],"tuoi":["",""],"quanhe":["",""]}');
				$subtractntjp = 0;
			}
		 @endphp
		
		@if ( $subtractntjp < 2 )
			<tr>
				<td >氏名:</td>
				<td colspan="5">{{$nguoithan->hoten[0]}}</td>
				<td>年齢:</td>
				<td colspan="2">{{$nguoithan->tuoi[0]}}</td>
				<td colspan="2">続柄: </td>
				<td colspan="2">{{$nguoithan->quanhe[0]}}</td>
			</tr>
		@else
			<tr>
				<td style="border-top: 1px solid">氏名:</td>
				<td colspan="5">&nbsp;</td>
				<td>年齢:</td>
				<td colspan="2">&nbsp;</td>
				<td colspan="2">続柄: </td>
				<td colspan="2">&nbsp;</td>
			</tr>
		 @endif
	    <tr>
			<td colspan="3" style="border-bottom: 1px solid;">その他</td>
			<td colspan="11" style="border-bottom: 1px solid;">無</td>
			@if ( $subtractntjp < 1 )
				<td style="border-bottom: 1px solid;">氏名:</td>
				<td colspan="5" style="border-bottom: 1px solid;">{{$nguoithan->hoten[1]}}</td>
				<td style="border-bottom: 1px solid;">年齢:</td>
				<td colspan="2" style="border-bottom: 1px solid;">{{$nguoithan->tuoi[1]}}</td>
				<td colspan="2" style="border-bottom: 1px solid;">続柄: </td>
				<td colspan="2" style="border-bottom: 1px solid;">{{$nguoithan->quanhe[1]}}</td>	
			@else
				<td style="border-bottom: 1px solid;">氏名:</td>
				<td colspan="5" style="border-bottom: 1px solid;">&nbsp;</td>
				<td style="border-bottom: 1px solid;">年齢:</td>
				<td colspan="2" style="border-bottom: 1px solid;">&nbsp;</td>
				<td colspan="2" style="border-bottom: 1px solid;">続柄: </td>
				<td colspan="2" style="border-bottom: 1px solid;">&nbsp;</td>
			@endif
	    </tr>
		<tr style="height:5px;">
		    <td colspan="31" style="border-bottom: none; border-top: none; border-left: none;"></td>
		</tr>
		<tr>
			<td colspan="31" style="background-color:#C0C0C0;font-weight:bold;border-top: 1px solid; border-left: none;">日本での技能実習について</td>
		</tr>
		<tr>
			<td colspan="10" style="border-left: none;">日本に行く目的</td>
			<td colspan="21">{{$hosojp->mucdich}}</td>
		</tr>
		<tr>
			<td colspan="10" style="border-left: none;">毎月の貯金</td>
			<td colspan="8">{{$hoso->sotientrenthang}} ドン</td>
			<td colspan="7">3年間の貯金</td>
			<td colspan="6">{{$hoso->sotientrennam}} ドン</td>
		</tr>
		<tr>
			<td colspan="10" style="border-bottom: 1px solid; border-left: none;">帰国後の目摽</td>
			<td colspan="21" style="border-bottom: 1px solid">
				{{$hosojp->muctieu}}
			</td>
		</tr>
	  
		<tr style="height:5px;">
		    <td colspan="31" style="border-bottom: none; border-top: none;border-left: none;"></td>
		</tr>
		<tr>
			<td colspan="31" style="background-color:#C0C0C0;font-weight:bold;border-top: 1px solid;border-left: none;">その他</td>
		</tr>
		<tr>
			<td colspan="4" style="border-left: none;">免許</td>
			<td colspan="6">@if($hoso->banglai == 1) 有 @else 無 @endif  </td>
			<td colspan="2"> 種類 </td>
			<td colspan="19" style="text-align: left;">
				&nbsp; @if($hoso->xemay == 1) &#9745; @else &#9744; @endif  バイク  
									&nbsp; @if($hoso->oto == 1) &#9745; @else &#9744; @endif 車
									&nbsp; @if($hoso->xekhac != '') &#9745; @else &#9744; @endif その他 (&ensp;&ensp;{{$hoso->xekhac}}&ensp;&ensp;)
			</td>
		</tr>
		<tr>
			<td colspan="4" style="border-bottom: 1px solid; border-left: none;">趣味</td>
			<td colspan="12" style="border-bottom: 1px solid">{{$hosojp->sothich}}</td>
			<td colspan="4" style="border-bottom: 1px solid">長所</td>
			<td colspan="11" style="border-bottom: 1px solid">{{$hosojp->diemmanh}}</td>
		</tr>
		<tr style="height:5px;">
		    <td colspan="31" style="border-bottom: none; border-top: none; border-left: none;"></td>
		</tr>
		@php
			$giadinh = json_decode($hosojp->giadinh);
		@endphp
		@if ($giadinh->quanhe[0])
			<tr>
				<td colspan="2" rowspan="8" style="background-color:#C0C0C0;font-weight:bold; border-top: 1px solid; border-left:none;">家族構成</td>
				<td colspan="3" style="border-top: 1px solid;">続柄</td>
				<td colspan="8" style="border-top: 1px solid;">氏名</td>		
				<td colspan="2" style="border-top: 1px solid">年生</td>
				<td colspan="7" style="border-top: 1px solid">職業</td>
				<td colspan="4" style="border-top: 1px solid">就職先</td>
				<td colspan="4" style="border-top: 1px solid">月収</td>
			</tr>
			@php 
				$subtractgdjp =( 7 - count($giadinh->quanhe)); 
			@endphp
			@if ($subtractgdjp <= 0)
				@for($i = 0 ; $i < 7; $i++)
				<tr>
					<td colspan="3">{{$giadinh->quanhe[$i]}}</td>
					<td colspan="8">{{$giadinh->hoten[$i]}}</td>
					<td colspan="2">{{$giadinh->namsinh[$i]}}</td>
					<td colspan="7">{{$giadinh->congviec[$i]}}</td>
					<td colspan="4">{{$giadinh->noilam[$i]}} @if (isset($giadinh->dctinh[$i])) {{$giadinh->dctinh[$i]}}  @endif</td>
					<td colspan="4">{{$giadinh->thunhap[$i]}} ドン</td>
				</tr>
				@endfor
			@else
				@for($i = 0 ; $i < count($giadinh->quanhe); $i++)
				<tr>
					<td colspan="3">{{$giadinh->quanhe[$i]}}</td>
					<td colspan="8">{{$giadinh->hoten[$i]}}</td>
					<td colspan="2">{{$giadinh->namsinh[$i]}}</td>
					<td colspan="7">{{$giadinh->congviec[$i]}}</td>
					<td colspan="4">{{$giadinh->noilam[$i]}} @if (isset($giadinh->dctinh[$i])) {{$giadinh->dctinh[$i]}}  @endif</td>
					<td colspan="4">{{$giadinh->thunhap[$i]}} ドン</td>
				</tr>
				@endfor
				@for ($gdijp = 0; $gdijp < $subtractgdjp; $gdijp++)
				<tr>
					<td colspan="3"></td>
					<td colspan="8"></td>
					<td colspan="2"></td>
					<td colspan="7"></td>
					<td colspan="4"></td>
					<td colspan="4"></td>
				</tr>
				@endfor
			@endif
		@else
		<tr>
			<td colspan="2" rowspan="8" style="background-color:#C0C0C0;font-weight:bold; border-top: 1px solid; border-left:none;">家族構成</td>
			<td colspan="3" style="border-top: 1px solid;">続柄</td>
			<td colspan="8" style="border-top: 1px solid;">氏名</td>
			
			<td colspan="2" style="border-top: 1px solid">年生</td>
			<td colspan="7" style="border-top: 1px solid">職業</td>
			<td colspan="4" style="border-top: 1px solid">就職先</td>
			<td colspan="4" style="border-top: 1px solid">月収</td>
		</tr>
		@for ($gdijp = 0; $gdijp < 7; $gdijp++)
		<tr>
			<td colspan="3"></td>
			<td colspan="8"></td>
			<td colspan="2"></td>
			<td colspan="7"></td>
			<td colspan="4"></td>
			<td colspan="4"></td>
		</tr>
		@endfor
		@endif
		{{-- end gia dinh jp--}}
		</table>
		<style>
          .page-break {
            page-break-after: always;
          }
        </style>
        <div class="page-break"></div>
	</div>
	</div>
@endif
{{-- END TIENG NHAT --}}
{{-- DAO TAO --}}
<div class="ui bottom attached tab segment  @if(Auth::user()->can('diemdanh-create')) active @endif" data-tab="daotao">
	<style>
		#daotaostyle table,#daotaostyle th,#daotaostyle td {
			/* border: 1px solid black; */
			border-collapse: collapse;
			padding-left: 5px; font-weight: 700; font-size: 16px;
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
				case(1):  
					return 'Chưa đăng ký đơn hàng'; 
					break;
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
	<table style="width: 100%" id="daotaostyle">
		<tr>
			<th colspan="4" style="text-align: center; font-size: 30px;">{{$hocvien->hoten}}</th>
		</tr>
		<tr>
			<td style="width: 10%;">Ngày sinh</td>
			<td style="width: 50%;">{{newformat($hocvien->ngaysinh)}} </td>
			<td style="width: 10%;" >SĐT</td>
			<td style="width: 30%;">{{$hocvien->dienthoai}}</td>
		</tr>
		<tr>
			<td>Lớp</td>
			<td>{{$hocvien->ten_lop_hoc}}</td>
			<td>SĐT GĐ</td>
			<td>{{$hocvien->dtnguoithan}}</td>
		</tr>
		<tr>
			<td>Quê Quán</td>
			<td>{{$hocvien->noisinh}}</td>
			<td>Ngày nhập học</td>
			<td>
				{{-- {{newformat($hocvien->ngaydangky)}} --}}
				{{$hocvien->ngay_khai_giang}}
			</td>
		</tr>
		<tr>
			<td>Tình trạng</td>
			<td>{{tinhtrang($hocvien->tinhtrang)}}</td>
			<td>DKXC</td>
			<td> @if($hocvien->dukienxc) {{$hocvien->dukienxc}} @endif </td>
		</tr>
		<tr>
			<td>Ngày đậu PV</td>
			<td>{{$hocvien->ngaytuyenkt}}</td>
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
</div>
{{-- END DAO TAO --}}
</body>
<script type="text/javascript">
	$('.menu .item').tab();
</script>
<script type="text/javascript">
function In_Content(strid){   
    var prtContent = document.getElementById(strid);
    var WinPrint = window.open('','','letf=0,top=0,width=800,height=auto');
    WinPrint.document.write(prtContent.innerHTML);
    WinPrint.document.close();
    WinPrint.focus();
    WinPrint.print();
}
</script>


<script type="text/javascript">
	var tableToExcel = (function () {
    var uri = 'data:application/vnd.openxmlformats-officedocument.spreadsheetml.sheet;base64,',
        template = '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40"><head><!--[if gte mso 9]>'+
		''+
		'<xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>{worksheet}</x:Name>'+
		'<x:WorksheetOptions><x:DisplayGridlines/><x:Print><x:ValidPrinterInfo/><x:Scale>59</x:Scale><x:HorizontalResolution>4</x:HorizontalResolution><x:VerticalResolution>4</x:VerticalResolution></x:Print></x:WorksheetOptions>'+
		'</x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]-->'+
		'</head><body><table>{table}</table></body></html>',
        base64 = function (s) {
            return window.btoa(unescape(encodeURIComponent(s)))
        }, format = function (s, c) {
            return s.replace(/{(\w+)}/g, function (m, p) {
                return c[p];
            })
        }
    return function (table, name, filename) {
        if (!table.nodeType) table = document.getElementById(table)
        var ctx = {
            worksheet: name || 'Worksheet',
            table: table.innerHTML
        }
   document.getElementById("dlink").href = uri + base64(format(template, ctx));
            document.getElementById("dlink").download = filename;
            document.getElementById("dlink").click();
    }
})()
</script>

<style>#testTable{display: none;}</style>
<a id="dlink"  style="display:none;"></a>
<input class="ui green icon button" type="button" onclick="tableToExcel('testTable', '{{$hoso->hoten}}', '{{$hoso->hoten}}.xls')" value="Export to Excel">
@if($hosojp)
	<table id="testTable"  cellspacing=0>
		<tr>
			<td height="5" colspan="4" style="border-left: 1px solid black; text-align: left; border-top: 1px solid black;">&nbsp;</td>
			<td colspan="22" rowspan="3" width="800" style=" text-align: center; border-top: 1px solid black; border-right: 1px solid black; font-size: 32px; font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-weight: bold "> MIRAI HUMAN</td>
			<td colspan="5" width="150" style="border-right: 1px solid black; border-left: 1px solid black; text-align: left; border-top: 1px solid black;" >&nbsp;</td>
		</tr>
		<tr height="55">
			<td colspan="4" width="100" style="padding: 5px 5px; border-left: 1px solid black; text-align: left; ">&nbsp;<img src="{{url('')}}/hocviens/logo.png"></td>
			<td colspan="5" width="170" style=" text-align: left;  border-right: 1px solid black; font-size: 15px; font-family: 'Times New Roman', Times, serif; vertical-align:middle;">番号：</td>
		</tr>
		<tr>
			<td colspan="4" style="border-left: 1px solid black;">&nbsp;</td>
			<td colspan="5" rowspan="6" width="140" style="text-align: center; border: 1px solid black;">
				@if (($hoso->hinhanh != NULL) && (strlen($hoso->hinhanh) < 100))
					<img src="{{url('')}}/hocviens/{{$year_image}}/{{$month_image}}/{{$hoso->hinhanh}}" >
				@else
					<img src="{{$hoso->hinhanh}}">
				@endif
			</td>
		</tr>
		<tr height="55">
			<td colspan="26" style="padding: 5px 0px; text-align: center; border-left: 1px solid black; border-bottom: 1px solid black; border-top: 1px solid black; font-size: 23px; font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-weight: bold; background-color: #C0C0C0;">技能実習生履歴書</td>
		</tr>
		<tr >
			<td colspan="4" rowspan="2" style="padding: 5px 0px; text-align: center; border-left: 1px solid black; border-right: 1px dotted black; font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;">氏名</td>
			<td colspan="5" height="36" style="padding: 5px 0px; text-align: center; border-right: 1px dotted black; font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;">英字表記</td>
			<td colspan="17" style="padding: 10px 0px; text-align: center; font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 21px;text-transform: uppercase;">{{convert_hoten($hoso->hoten)}}</td>
		</tr>
		<tr>
			<td colspan="5" height="36" style="padding: 5px 0px; text-align: center;border-top: 1px dotted black; border-right: 1px dotted black; font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;">フリガナ</td>
			<td colspan="17" style="padding: 5px 0px; text-align: center; border-top: 1px dotted black; font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 21px;">{{$hosojp->hoten}}</td>
		</tr>
		<tr style="vertical-align:middle;">
			<td colspan="4"  height="36" style="padding: 5px 0px; text-align: center; border-top: 1px dotted black; border-right: 1px dotted black; border-left: 1px solid black; font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;">生年月日</td>
			<td colspan="10" height="36" style="padding: 5px 0px; text-align: center; border-top: 1px dotted black; border-right: 1px dotted black; font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;">{{date_format(date_create($hoso->ngaysinh),"Y年m月d日")}}</td>
			<td colspan="2"  height="36" style="padding: 5px 0px; text-align: center; border-top: 1px dotted black; border-right: 1px dotted black; font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;">年齢</td>
			<td colspan="2"  height="36" style="padding: 5px 0px; text-align: center; border-top: 1px dotted black; border-right: 1px dotted black; font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;">{{getAge(date_format(date_create($hoso->ngaysinh),"Y/m/d"))}}</td>
			<td colspan="2"  height="36" rowspan="2" style="padding: 5px 0px; text-align: center; border-top: 1px dotted black; border-right: 1px dotted black; font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;">利き手</td>
			<td colspan="2"  height="36" style="padding: 5px 0px; text-align: center; border-top: 1px dotted black; border-right: 1px dotted black; font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;">仕事</td>
			<td  height="36" style="padding: 5px 0px; text-align: center; border-top: 1px dotted black; border-right: 1px dotted black; font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;">@if($hoso->congviec == 0) 右 @else 左 @endif</td>
			<td  height="36" colspan="2" style="padding: 5px 0px; text-align: center; border-top: 1px dotted black; border-right: 1px dotted black; font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;">箸</td>
			<td  height="36" style="padding: 5px 0px; text-align: center; border-top: 1px dotted black; font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;">@if($hoso->dua == 0) 右 @else 左 @endif</td>
		</tr>
		<tr style="vertical-align:middle;">
			<td colspan="4"  height="36" style="padding: 5px 0px; border-left: 1px solid black; border-top: 1px dotted black; border-right: 1px dotted black; text-align: center; font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;">性別</td>
			<td colspan="10"  height="36" style="padding: 5px 0px; text-align: center; border-top: 1px dotted black; border-right: 1px dotted black; font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;">@if($hoso->gioitinh == 0) 女 @else 男 @endif</td>
			<td colspan="2"  height="36" rowspan="3" style="padding: 5px 0px; text-align: center; border-top: 1px dotted black; border-right: 1px dotted black; font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;">宗教</td>
			<td colspan="2"  height="36" rowspan="3" style="padding: 5px 0px; text-align: center; border-top: 1px dotted black; border-right: 1px dotted black; font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;">{{$hosojp->tongiao}}</td>
			<td colspan="2"  height="36" style="padding: 5px 0px; text-align: center; border-top: 1px dotted black; border-right: 1px dotted black; font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;">鋏</td>
			<td  height="36" style="padding: 5px 0px; text-align: center; border-top: 1px dotted black; border-right: 1px dotted black; font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;">@if($hoso->keo == 0) 右 @else 左 @endif</td>
			<td colspan="2"  height="36" style="padding: 5px 0px; text-align: center; border-top: 1px dotted black; border-right: 1px dotted black;  font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;">ペン</td>
			<td  height="36" style="padding: 5px 0px; text-align: center; border-top: 1px dotted black; border-bottom: 1px dotted black;  font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;">@if($hoso->viet == 0) 右 @else 左 @endif</td>
		</tr>
		<tr style="vertical-align:middle;">
			<td colspan="4"  height="36" style="padding: 5px 0px; text-align: center; border-top: 1px dotted black; border-right: 1px dotted black; border-left: 1px solid black; font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;">婚姻</td>
			<td colspan="10"  height="36" style="padding: 5px 0px; text-align: center; border-top: 1px dotted black; border-right: 1px dotted black; font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;">{{$hosojp->honnhan}}</td>
			<td colspan="4"  height="36" style="padding: 5px 0px; text-align: center; border-top: 1px dotted black; border-right: 1px dotted black; font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;">身長（センチ）</td>
			<td colspan="3"  height="36" style="padding: 5px 0px; text-align: center; border-top: 1px dotted black; border-right: 1px dotted black; font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;">{{$hoso->chieucao}}</td>
			<td colspan="3"  height="36" style="padding: 5px 0px; text-align: center; border-top: 1px dotted black; border-right: 1px dotted black; font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;">体重（キロ）</td>
			<td colspan="3"  height="36" style="padding: 5px 0px; text-align: center; border-top: 1px solid black; border-right: 1px solid black; font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;">{{$hoso->cannang}}</td>
		</tr>
		<tr style="vertical-align:middle;">
			<td colspan="4"  height="36" style="padding: 5px 0px; text-align: center; border-top: 1px dotted black; border-right: 1px dotted black; border-left: 1px solid black; font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;">病暦</td>
			<td colspan="10"  height="36" style="padding: 5px 0px; text-align: center; border-top: 1px dotted black; border-right: 1px dotted black; font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;">{{$hosojp->benhan}}</td>
			<td colspan="4"  height="36" style="padding: 5px 0px; text-align: center; border-top: 1px dotted black; border-right: 1px dotted black; font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;">血液</td>
			<td colspan="9"  height="36" style="padding: 5px 0px; text-align: center; border-top: 1px dotted black; border-right: 1px solid black; font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;">{{$hoso->nhommau}}</td>
		</tr>
		<tr style="vertical-align:middle;">
			<td colspan="4"  height="36" style="padding: 5px 0px; text-align: center; border-top: 1px dotted black; border-left: 1px solid black; font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;">出身地</td>
			<td colspan="10"  height="36" style="padding: 5px 0px; text-align: center; border-top: 1px dotted black; border-right: 1px dotted black; font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;">{{$hosojp->noisinh}}</td>
			<td colspan="2"  height="36" style="padding: 5px 0px; text-align: center; border-top: 1px dotted black; border-right: 1px dotted black; font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;">地方</td>
			<td colspan="2"  height="36" style="padding: 5px 0px; text-align: center; border-top: 1px dotted black; border-right: 1px dotted black; font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;">{{$hosojp->mien}}</td>
			<td colspan="2"  height="36" style="padding: 5px 0px; text-align: center; border-top: 1px dotted black; border-right: 1px dotted black; font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;">視カ</td>
			<td colspan="3"  height="36" style="padding: 5px 0px; text-align: center; border-top: 1px dotted black; border-right: 1px dotted black; font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;">左</td>
			<td colspan="3"  height="36" style="padding: 5px 0px; text-align: center; border-top: 1px dotted black; border-right: 1px dotted black; font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;">{{$hosojp->mattrai}}</td>
			<td colspan="3"  height="36" style="padding: 5px 0px; text-align: center; border-top: 1px dotted black; border-right: 1px dotted black; font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;">右</td>
			<td colspan="2"  height="36" style="padding: 5px 0px; border-top: 1px dotted black; border-right: 1px solid black; text-align: center; font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;">{{$hosojp->matphai}}</td>
		</tr>
		<tr style="height:5px;">
			<td colspan="31" style=" border: 1px solid black"></td>
		</tr>
		<tr style="vertical-align:middle">
			<td colspan="6" height="40" style=" padding: 5px 0px; border-right: 1px dotted black; border-left:1px solid black; text-align: center;font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;">戸籍住所</td>
			<td colspan="20" style=" padding: 5px 0px; border-right: 1px dotted black; text-align: center; font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;">
				@if ($hosojp->diachi)
					{{$hosojp->diachi}}
				@else
				@if($hosojp->dchk)
					@php $dchk = json_decode($hosojp->dchk);  echo $dchk->dchk_tinh." ".$dchk->dchk_tinh_plus." ".$dchk->dchk_huyen." ".$dchk->dchk_huyen_plus." ".$dchk->dchk_xa." ".
					$dchk->dchk_xa_plus." ".$dchk->dchk_dc." ".$dchk->dchk_dc_plus; @endphp
				@endif
				@endif
			</td>
			<td colspan="3" style=" padding: 5px 0px; border-right: 1px dotted black; text-align: center;font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;">地方</td>
			<td colspan="2" style=" padding: 5px 0px; border-right: 1px solid black; text-align: center;font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;">{{$hosojp->diachimien}}</td>
		</tr>
		<tr style="height:5px; ">
			<td colspan="31" style="border: 1px solid black;font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;"></td>
		</tr>
		@php
			$hoctap_excel_jp = json_decode($hosojp->hoctap);
		@endphp
		@if ($hoctap_excel_jp->thoigianbd[0])		
		<tr style="vertical-align:middle">
			<td colspan="4" rowspan="{{count($hoctap_excel_jp->thoigianbd)+1}}" style=" padding: 5px 0px; border-right: 1px dotted black; border-left:1px solid black; text-align: center; background-color:#C0C0C0;font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;">学歴</td>
			<td colspan="11" height="36" style=" padding: 5px 0px; border-right: 1px dotted black; text-align: center;font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;">期　間</td>
			<td colspan="11" style=" padding: 5px 0px; border-right: 1px dotted black; text-align: center;font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;">学 校 名　</td>
			<td colspan="5" style=" padding: 5px 0px; border-right: 1px solid black; text-align: center;font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;">学校所在地</td>
		</tr>
		@for($i_excel_jp = 0 ; $i_excel_jp < count($hoctap_excel_jp->thoigianbd); $i_excel_jp++)    
		<tr>
			@php
				$thangbd_excel_jp = substr( $hoctap_excel_jp->thoigianbd[$i_excel_jp],  0, 2);
				$nambd_excel_jp = substr( $hoctap_excel_jp->thoigianbd[$i_excel_jp],  3, 7);
				$thangkt_excel_jp = substr( $hoctap_excel_jp->thoigiankt[$i_excel_jp],  0, 2);
				$namkt_excel_jp = substr( $hoctap_excel_jp->thoigiankt[$i_excel_jp],  3, 7);
			@endphp
			@if (strlen($hoctap_excel_jp->thoigianbd[$i_excel_jp]) == 4)
				<td colspan="5" style=" padding: 5px 0px; border-top: 1px dotted black; text-align: center;font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;">{{$hoctap_excel_jp->thoigianbd[$i_excel_jp]}}年09月</td>
				<td style=" padding: 5px 0px; border-top: 1px dotted black; text-align: center;font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;">~</td>
				<td colspan="5" style=" padding: 5px 0px; border-top: 1px dotted black; border-right: 1px dotted black; text-align: center;font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;">{{$hoctap_excel_jp->thoigiankt[$i_excel_jp]}}年05月</td>
			@elseif( strlen($hoctap_excel_jp->thoigianbd[$i_excel_jp]) == 7)
			<td colspan="5" style=" padding: 5px 0px; border-top: 1px dotted black; text-align: center;font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;">{{$nambd_excel_jp}}年{{$thangbd_excel_jp}}月</td>
				<td style=" padding: 5px 0px; border-top: 1px dotted black; text-align: center;font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;">~</td>
				@if(strlen($hoctap_excel_jp->thoigiankt[$i_excel_jp]) == 7)
				<td colspan="5" style=" padding: 5px 0px; border-top: 1px dotted black; border-right: 1px dotted black; text-align: center;font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;">{{$namkt_excel_jp}}年{{$thangkt_excel_jp}}月</td>
				@else
				<td colspan="5" style=" padding: 5px 0px; border-top: 1px dotted black; border-right: 1px dotted black; text-align: center;font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;">{{$hoctap_excel_jp->thoigiankt[$i_excel_jp]}}</td>
				@endif
			@else
				<td colspan="5" style=" padding: 5px 0px; border-top: 1px dotted black; text-align: center;font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;"></td>
				<td style=" padding: 5px 0px; border-top: 1px dotted black; text-align: center;font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;"></td>
				<td colspan="5" style=" padding: 5px 0px; border-top: 1px dotted black; border-right: 1px dotted black; text-align: center;font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;"></td>
			@endif
		    
			@if ($i_excel_jp > 2)
				<td colspan="11" height="36" style=" padding: 5px 0px; border-top: 1px dotted black; border-right: 1px dotted black; text-align: center;font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;">{{$hoctap_excel_jp->tentruong[$i_excel_jp]}}</td>
			@else
				<td colspan="11" height="36" style=" padding: 5px 0px; border-top: 1px dotted black; border-right: 1px dotted black; text-align: center;font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;">{{$hoctap_excel_jp->tentruong[$i_excel_jp]}} @if (isset($arrhoctap[$i_excel_jp])) {{$arrhoctap[$i_excel_jp]}} @endif </td>			
			@endif
			<td colspan="5" style=" padding: 5px 0px; border-top: 1px dotted black; border-right: 1px solid black; text-align: center;font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;">{{$hoctap_excel_jp->diachitruong[$i_excel_jp]}}@if (isset($hoctap_excel_jp->dctinh)) {{$hoctap_excel_jp->dctinh[$i_excel_jp]}} @endif</td>
		</tr>
		@endfor 
		@else
		<tr style="vertical-align:middle">
			<td colspan="4" rowspan="6" style=" padding: 5px 0px; border-right: 1px dotted black; border-left:1px solid black; text-align: center; background-color:#C0C0C0;font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;">学歴</td>
			<td colspan="11" height="36" style=" padding: 5px 0px; border-right: 1px dotted black; text-align: center;font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;">期　間</td>
			<td colspan="11" style=" padding: 5px 0px; border-right: 1px dotted black; text-align: center;font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;">学 校 名　</td>
			<td colspan="5" style=" padding: 5px 0px; border-right: 1px solid black; text-align: center;font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;">学校所在地</td>
		</tr>
		@endif 			
		<tr style="height:5px; ">
			<td colspan="31" style="border: 1px solid black"></td>
		</tr>
		@php
			$lamviec_excel_jp = json_decode($hosojp->lamviec); 
		@endphp
		@if ($lamviec_excel_jp->thoigianbd[0])
			<tr style="vertical-align:middle">
				<td colspan="4" rowspan="3" style=" padding: 5px 0px; border-right: 1px dotted black; border-left:1px solid black; background-color:#C0C0C0; text-align: center;font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;">職歴</td>
				<td colspan="11" height="36" style=" padding: 5px 0px; border-right: 1px dotted black; text-align: center;font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;">期　間</td>
				<td colspan="11" style=" padding: 5px 0px; border-right: 1px dotted black; text-align: center;font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;">勤　務　先</td>
				<td colspan="5" style=" padding: 5px 0px; border-right: 1px solid black; text-align: center;font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;">職　種</td>
			</tr>
			@php 
				$subtractlv_excel_jp =( 2 - count($lamviec_excel_jp->thoigianbd)); 
			@endphp
			@if ($subtractlv_excel_jp <= 0)
				@for($i = 0 ; $i < 2; $i++)
				<tr style="vertical-align:middle">
					<td colspan="5" height="36" style=" padding: 5px 0px; border-top: 1px dotted black; text-align: center;font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;">
						{{substr($lamviec_excel_jp->thoigianbd[$i],3)."年"}}{{substr($lamviec_excel_jp->thoigianbd[$i],0,2)."月"}}
					</td>
					<td style=" padding: 5px 0px; border-top: 1px dotted black; text-align: center;font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;">~</td>
					<td colspan="5" style=" padding: 5px 0px;border-top: 1px dotted black; border-right: 1px dotted black; text-align: center;font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;">
						{{substr($lamviec_excel_jp->thoigiankt[$i],3)."年"}}{{substr($lamviec_excel_jp->thoigiankt[$i],0,2)."月"}}
					</td>
					<td colspan="11" style=" padding: 5px 0px;border-top: 1px dotted black; border-right: 1px dotted black; text-align: center;font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;">{{$lamviec_excel_jp->tencongty[$i]}}</td>
					<td colspan="5" style=" padding: 5px 0px;border-top: 1px dotted black; border-right: 1px solid black; text-align: center;font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;">{{$lamviec_excel_jp->ndcongviec[$i]}}</td>
				</tr>
				@endfor
			@else
				@for($i = 0 ; $i < count($lamviec_excel_jp->thoigianbd); $i++)
				<tr>
					<td colspan="5" height="36" style=" padding: 5px 0px; border-top: 1px dotted black; text-align: center;font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;">
						{{substr($lamviec_excel_jp->thoigianbd[$i],3)."年"}}{{substr($lamviec_excel_jp->thoigianbd[$i],0,2)."月"}}
					</td>
					<td style=" padding: 5px 0px; border-top: 1px dotted black; text-align: center;font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;">~</td>
					<td colspan="5" style=" padding: 5px 0px;border-top: 1px dotted black; border-right: 1px dotted black; text-align: center;font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;">
						{{substr($lamviec_excel_jp->thoigiankt[$i],3)."年"}}{{substr($lamviec_excel_jp->thoigiankt[$i],0,2)."月"}}
					</td>
					<td colspan="11" style=" padding: 5px 0px;border-top: 1px dotted black; border-right: 1px dotted black; text-align: center;font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;">{{$lamviec_excel_jp->tencongty[$i]}}</td>
					<td colspan="5" style=" padding: 5px 0px;border-top: 1px dotted black; border-right: 1px solid black; text-align: center;font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;">{{$lamviec_excel_jp->ndcongviec[$i]}}</td>
				</tr>
				@endfor
				@for ($lvijp = 0; $lvijp < $subtractlv_excel_jp; $lvijp++)
				<tr>
					<td colspan="5" height="36" style=" padding: 5px 0px; border-top: 1px dotted black; text-align: center;font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;">
					<td style=" padding: 5px 0px; border-top: 1px dotted black; text-align: center;font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;"></td>
					<td colspan="5" style=" padding: 5px 0px;border-top: 1px dotted black; border-right: 1px dotted black; text-align: center;font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;"></td>
					<td colspan="11" style=" padding: 5px 0px;border-top: 1px dotted black; border-right: 1px dotted black; text-align: center;font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;"></td>
					<td colspan="5" style=" padding: 5px 0px;border-top: 1px dotted black; border-right: 1px solid black; text-align: center;font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;"></td>
				</tr>
				@endfor
			@endif
		@else
			<tr style="vertical-align:middle">
				<td colspan="4" rowspan="3" width="100" style=" padding: 5px 0px; border-right: 1px dotted black; border-left:1px solid black; background-color:#C0C0C0; text-align: center;font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;">職歴</td>
				<td colspan="11" height="36" style=" padding: 5px 0px; border-right: 1px dotted black; text-align: center;font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;">期　間</td>
				<td colspan="11" style=" padding: 5px 0px; border-right: 1px dotted black; text-align: center;font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;">勤　務　先</td>
				<td colspan="5" style=" padding: 5px 0px; border-right: 1px solid black; text-align: center;font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;">職　種</td>
			</tr>
		@endif
		<tr style="height:5px; ">
			<td colspan="31" style="border: 1px solid black"></td>
		</tr>
		<tr style="vertical-align:middle">
			<td colspan="4" rowspan="4" style=" padding: 5px 0px; border-right: 1px dotted black; border-left:1px solid black; background-color:#C0C0C0; text-align: center;font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;">外国語</td>
			<td colspan="3" height="36" style=" padding: 5px 0px; border-right: 1px dotted black; text-align: center;font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;">英語</td>
			<td colspan="11" style=" padding: 5px 0px; border-right: 1px dotted black; text-align: center;font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;">
				@if($hoso->anhngu == 0)
	        	無
				@elseif($hoso->anhngu == 1)
					A
				@elseif($hoso->anhngu == 2)
					B
				@elseif($hoso->anhngu == 3)	
					C				    
				@endif
			</td>
			<td colspan="7" style=" padding: 5px 0px; border-right: 1px dotted black; background-color:#C0C0C0; text-align: center;font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;">訪日経験</td>
			<td colspan="6" style=" padding: 5px 0px; border-right: 1px solid black; text-align: center;font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;"> @if ($hoso->datungtoinhat == '1') 有 @else 無 @endif</td>
		</tr>
		<tr style="vertical-align:middle">
			<td colspan="3" rowspan="2" style=" padding: 50px 0px;border-top: 1px dotted black; border-right: 1px dotted black; text-align: center;font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;">日本語</td>
			<td colspan="11" rowspan="2" style=" padding: 5px 0px;border-top: 1px dotted black; border-right: 1px dotted black; text-align: center;font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;">{{$hosojp->nhatngu}}</td>
			<td colspan="7" height="36" style=" padding: 5px 0px;border-top: 1px dotted black; border-right: 1px dotted black; background-color:#C0C0C0; text-align: center;font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;">在日本親戚．知人</td>
			<td colspan="6" style=" padding: 5px 0px;border-top: 1px dotted black; border-right: 1px solid black; text-align: center;font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;">@if ($hoso->conguoithantainhat == '1') 有 @else 無 @endif </td>
		</tr>
		@php
		 	if ($hosojp->nguoithan) {
				$nguoithan = json_decode($hosojp->nguoithan);
				if ($nguoithan->hoten) {
					$subtractnt_excel_jp =( 2 - count($nguoithan->hoten));					
				}else{
					$subtractnt_excel_jp = 2;
				}
			}else {
				$nguoithan = json_decode('{"hoten":["",""],"tuoi":["",""],"quanhe":["",""]}');
				$subtractnt_excel_jp = 0;
			}
		@endphp
		@if ( $subtractnt_excel_jp < 2 )
			<tr style="vertical-align:middle">
				<td width="50" height="36" style=" padding: 5px 0px;border-top: 1px dotted black; border-right: 1px dotted black; text-align: center;font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;">氏名:</td>
				<td colspan="5" style=" padding: 5px 0px;border-top: 1px dotted black; border-right: 1px dotted black; text-align: center;font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;">{{$nguoithan->hoten[0]}}</td>
				<td width="50" style=" padding: 5px 0px;border-top: 1px dotted black; border-right: 1px dotted black; text-align: center;font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;">年齢:</td>
				<td colspan="2" style=" padding: 5px 5px;border-top: 1px dotted black; border-right: 1px dotted black; text-align: center;font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;">{{$nguoithan->tuoi[0]}} </td>
				<td colspan="2" style=" padding: 5px 0px;border-top: 1px dotted black; border-right: 1px dotted black; text-align: center;font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;">続柄: </td>
				<td colspan="2" style=" padding: 5px 0px;border-top: 1px dotted black; border-right: 1px solid black; text-align: center;font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;">{{$nguoithan->quanhe[0]}}</td>
			</tr>
		@else
			<tr style="vertical-align:middle">
				<td width="50" height="36" style=" padding: 5px 0px;border-top: 1px dotted black; border-right: 1px dotted black; text-align: center;font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;">氏名:</td>
				<td colspan="5" style=" padding: 5px 0px;border-top: 1px dotted black; border-right: 1px dotted black; text-align: center;font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;">&nbsp;</td>
				<td width="50" style=" padding: 5px 0px;border-top: 1px dotted black; border-right: 1px dotted black; text-align: center;font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;">年齢:</td>
				<td colspan="2" style=" padding: 5px 5px;border-top: 1px dotted black; border-right: 1px dotted black; text-align: center;font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;">&nbsp;</td>
				<td colspan="2" style=" padding: 5px 0px;border-top: 1px dotted black; border-right: 1px dotted black; text-align: center;font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;">続柄: </td>
				<td colspan="2" style=" padding: 5px 0px;border-top: 1px dotted black; border-right: 1px solid black; text-align: center;font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;">&nbsp;</td>
			</tr>
		@endif
	    <tr style="vertical-align:middle">
				<td colspan="3" style=" padding: 5px 0px;border-top: 1px dotted black; border-right: 1px dotted black; text-align: center;font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;">その他</td>
				<td colspan="11" style=" padding: 5px 0px;border-top: 1px dotted black; border-right: 1px dotted black; text-align: center;font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;">{{--$hoso->ngoaingukhac--}} 無</td>
			@if ( $subtractnt_excel_jp < 1 )
				<td width="50" height="36" style=" padding: 5px 0px;border-top: 1px dotted black; border-right: 1px dotted black; text-align: center;font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;">氏名:</td>
				<td colspan="5" style=" padding: 5px 0px;border-top: 1px dotted black; border-right: 1px dotted black; text-align: center;font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;">{{$nguoithan->hoten[1]}}</td>
				<td width="50" style=" padding: 5px 0px;border-top: 1px dotted black; border-right: 1px dotted black; text-align: center;font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;">年齢:</td>
				<td colspan="2" style=" padding: 5px 5px;border-top: 1px dotted black; border-right: 1px dotted black; text-align: center;font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;">{{$nguoithan->tuoi[1]}} </td>
				<td colspan="2" style=" padding: 5px 0px;border-top: 1px dotted black; border-right: 1px dotted black; text-align: center;font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;">続柄: </td>
				<td colspan="2" style=" padding: 5px 0px;border-top: 1px dotted black; border-right: 1px solid black; text-align: center;font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;">{{$nguoithan->quanhe[1]}}</td>
			@else
				<td width="50" height="36" style=" padding: 5px 0px;border-top: 1px dotted black; border-right: 1px dotted black; text-align: center;font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;">氏名:</td>
				<td colspan="5" style=" padding: 5px 0px;border-top: 1px dotted black; border-right: 1px dotted black; text-align: center;font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;">&nbsp;</td>
				<td width="50" style=" padding: 5px 0px;border-top: 1px dotted black; border-right: 1px dotted black; text-align: center;font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;">年齢:</td>
				<td colspan="2" style=" padding: 5px 5px;border-top: 1px dotted black; border-right: 1px dotted black; text-align: center;font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;">&nbsp;</td>
				<td colspan="2" style=" padding: 5px 0px;border-top: 1px dotted black; border-right: 1px dotted black; text-align: center;font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;">続柄: </td>
				<td colspan="2" style=" padding: 5px 0px;border-top: 1px dotted black; border-right: 1px solid black; text-align: center;font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;">&nbsp;</td>
			@endif
	    </tr>
		<tr style="height:5px;">
			<td colspan="31" style=" border: 1px solid black"></td>
		</tr>
		<tr style="vertical-align:middle">
			<td colspan="31" height="36" style=" padding: 5px 0px; border-right: 1px solid black; border-left:1px solid black; background-color:#C0C0C0; text-align: center;font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;">日本での技能実習について</td>
		</tr>
		<tr style="vertical-align:middle">
			<td colspan="10" height="36" style=" padding: 5px 0px;border-top: 1px dotted black; border-right: 1px dotted black; border-left:1px solid black; text-align: center;font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;">日本に行く目的</td>
			<td colspan="21" style=" padding: 5px 0px;border-top: 1px dotted black; border-right: 1px solid black; text-align: center;font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;">{{$hosojp->mucdich}}</td>
		</tr>
		<tr style="vertical-align:middle">
			<td colspan="10" height="50" style=" padding: 5px 0px;border-top: 1px dotted black; border-right: 1px dotted black; border-left:1px solid black; text-align: center;font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;">毎月の貯金</td>
			<td colspan="6" style=" padding: 5px 0px;border-top: 1px dotted black; border-right: 1px dotted black; text-align: center;font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;">{{$hoso->sotientrenthang}} ドン</td>
			<td colspan="9" style=" padding: 5px 0px;border-top: 1px dotted black; border-right: 1px dotted black; text-align: center;font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;">3年間の貯金</td>
			<td colspan="6" style=" padding: 5px 0px;border-top: 1px dotted black; border-right: 1px solid black; text-align: center;font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;">{{$hoso->sotientrennam}} ドン</td>
		</tr>
		<tr style="vertical-align:middle">
			<td colspan="10" height="36" style=" padding: 5px 0px;border-top: 1px dotted black; border-right: 1px dotted black; border-left:1px solid black; text-align: center;font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;">帰国後の目摽</td>
			<td colspan="21" style=" padding: 5px 0px;border-top: 1px dotted black; border-right: 1px solid black; text-align: center;font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;">{{$hosojp->muctieu}}</td>
		</tr>
		<tr style="height:5px;">
			<td colspan="31" style="border: 1px solid black"></td>
		</tr>
		<tr style="vertical-align:middle">
			<td colspan="31" height="36" style=" padding: 5px 0px; border-right: 1px solid black; border-left:1px solid black; background-color:#C0C0C0; text-align: center;font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;">その他</td>
		</tr>
		<tr style="vertical-align:middle">
			<td colspan="4" height="36" style=" padding: 5px 0px;border-top: 1px dotted black; border-right: 1px dotted black; border-left:1px solid black; text-align: center;font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;">免許</td>
			<td colspan="6" style=" padding: 5px 0px;border-top: 1px dotted black; border-right: 1px dotted black; text-align: center;font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;">@if($hoso->banglai == 1) 有 @else 無 @endif </td>
			<td colspan="2" style=" padding: 5px 0px;border-top: 1px dotted black; border-right: 1px dotted black; text-align: center;font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;">種類</td>
			<td colspan="19" style=" padding: 5px 0px;border-top: 1px dotted black; border-right: 1px solid black; text-align: center;font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;">
				&nbsp; @if($hoso->xemay == 1) &#9745; @else &#9744; @endif  バイク 
				&nbsp; @if($hoso->oto == 1) &#9745; @else &#9744; @endif 車  
				&nbsp; @if($hoso->xekhac != '') &#9745; @else &#9744; @endif その他(&ensp;&ensp;{{$hoso->xekhac}}&ensp;&ensp;)
			</td>
		</tr>
		<tr style="vertical-align:middle">
			<td colspan="4" height="36" style=" padding: 5px 0px;border-top: 1px dotted black; border-right: 1px dotted black; border-left:1px solid black; text-align: center;font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;">趣味</td>
			<td colspan="12" style=" padding: 5px 0px;border-top: 1px dotted black; border-right: 1px dotted black; text-align: center;font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;">{{$hosojp->sothich}}</td>
			<td colspan="4" style=" padding: 5px 0px;border-top: 1px dotted black; border-right: 1px dotted black; text-align: center;font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;">長所</td>
			<td colspan="11" style=" padding: 5px 0px;border-top: 1px dotted black; border-right: 1px solid black; text-align: center;font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;">{{$hosojp->diemmanh}}</td>
		</tr>
		<tr style="height:5px;">
			<td colspan="31" style=" border: 1px solid black"></td>
		</tr>
		@php
			$giadinh_excel_jp = json_decode($hosojp->giadinh);
		@endphp
		@if ($giadinh_excel_jp->quanhe[0])
			<tr style="vertical-align:middle">
				<td colspan="3" rowspan="8" style=" padding: 5px 0px; border-right: 1px dotted black; border-left:1px solid black; background-color:#C0C0C0; text-align: center;font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;">家族構成</td>
				<td colspan="3" height="36" style=" padding: 5px 0px; border-right: 1px dotted black; text-align: center;font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;">続柄</td>
				<td colspan="8" height="36" style=" padding: 5px 0px; border-right: 1px dotted black; text-align: center;font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;">氏名</td>		
				<td colspan="2" width="50" style=" padding: 5px 0px; border-right: 1px dotted black; text-align: center;font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;">年生</td>
				<td colspan="7" style=" padding: 5px 0px; border-right: 1px dotted black; text-align: center;font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;">職業</td>
				<td colspan="4" style=" padding: 5px 0px; border-right: 1px dotted black; text-align: center;font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;">就職先</td>
				<td colspan="4" style=" padding: 5px 0px;border-right: 1px solid black; text-align: center;font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;">月収</td>
			</tr>
			@php 
				$subtractgd_excel_jp =( 7 - count($giadinh_excel_jp->quanhe)); 
			@endphp
			@if ($subtractgd_excel_jp <= 0)
				@for($i = 0 ; $i < 7; $i++)
				<tr>
					<td colspan="3" height="36" style=" padding: 5px 0px;border-top: 1px dotted black; border-right: 1px dotted black; text-align: center;font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;">{{$giadinh_excel_jp->quanhe[$i]}}</td>
					<td colspan="8" style=" padding: 5px 0px;border-top: 1px dotted black; border-right: 1px dotted black; text-align: center;font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;">{{$giadinh_excel_jp->hoten[$i]}}</td>
					<td colspan="2" style=" padding: 5px 0px;border-top: 1px dotted black; border-right: 1px dotted black; text-align: center;font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;">{{$giadinh_excel_jp->namsinh[$i]}}</td>
					<td colspan="7" style=" padding: 5px 0px;border-top: 1px dotted black; border-right: 1px dotted black; text-align: center;font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;">{{$giadinh_excel_jp->congviec[$i]}}</td>
					<td colspan="4" style=" padding: 5px 0px;border-top: 1px dotted black; border-right: 1px dotted black; text-align: center;font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;">{{$giadinh_excel_jp->noilam[$i]}} @if (isset($giadinh_excel_jp->dctinh[$i])) {{$giadinh_excel_jp->dctinh[$i]}}  @endif</td>
					<td colspan="4" style=" padding: 5px 0px;border-top: 1px dotted black; border-right: 1px solid black; text-align: center;font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;">{{$giadinh_excel_jp->thunhap[$i]}} ドン</td>
				</tr>
				@endfor
			@else
				@for($i = 0 ; $i < count($giadinh_excel_jp->quanhe); $i++)
				<tr>
					<td colspan="3" height="36" style=" padding: 5px 0px;border-top: 1px dotted black; border-right: 1px dotted black; text-align: center;font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;">{{$giadinh_excel_jp->quanhe[$i]}}</td>
					<td colspan="8" style=" padding: 5px 0px;border-top: 1px dotted black; border-right: 1px dotted black; text-align: center;font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;">{{$giadinh_excel_jp->hoten[$i]}}</td>
					<td colspan="2" style=" padding: 5px 0px;border-top: 1px dotted black; border-right: 1px dotted black; text-align: center;font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;">{{$giadinh_excel_jp->namsinh[$i]}}</td>
					<td colspan="7" style=" padding: 5px 0px;border-top: 1px dotted black; border-right: 1px dotted black; text-align: center;font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;">{{$giadinh_excel_jp->congviec[$i]}}</td>
					<td colspan="4" style=" padding: 5px 0px;border-top: 1px dotted black; border-right: 1px dotted black; text-align: center;font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;">{{$giadinh_excel_jp->noilam[$i]}} @if (isset($giadinh_excel_jp->dctinh[$i])) {{$giadinh_excel_jp->dctinh[$i]}}  @endif</td>
					<td colspan="4" style=" padding: 5px 0px;border-top: 1px dotted black; border-right: 1px solid black; text-align: center;font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;">{{$giadinh_excel_jp->thunhap[$i]}} ドン</td>
				</tr>
				@endfor
				@for ($gdijp = 0; $gdijp < $subtractgd_excel_jp; $gdijp++)
				<tr>
					<td colspan="3" height="36" style=" padding: 5px 0px;border-top: 1px dotted black; border-right: 1px dotted black; text-align: center;font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;"></td>
					<td colspan="8" style=" padding: 5px 0px;border-top: 1px dotted black; border-right: 1px dotted black; text-align: center;font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;"></td>
					<td colspan="2" style=" padding: 5px 0px;border-top: 1px dotted black; border-right: 1px dotted black; text-align: center;font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;"></td>
					<td colspan="7" style=" padding: 5px 0px;border-top: 1px dotted black; border-right: 1px dotted black; text-align: center;font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;"></td>
					<td colspan="4" style=" padding: 5px 0px;border-top: 1px dotted black; border-right: 1px dotted black; text-align: center;font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;"></td>
					<td colspan="4" style=" padding: 5px 0px;border-top: 1px dotted black; border-right: 1px solid black; text-align: center;font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;"></td>
				</tr>
				@endfor
			@endif
		@else
			<tr style="vertical-align:middle">
				<td colspan="3" rowspan="8" style=" padding: 5px 0px; border-right: 1px dotted black; border-left:1px solid black; background-color:#C0C0C0; text-align: center;font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;">家族構成</td>
				<td colspan="3" height="36" style=" padding: 5px 0px; border-right: 1px dotted black; text-align: center;font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;">続柄</td>
				<td colspan="8" height="36" style=" padding: 5px 0px; border-right: 1px dotted black; text-align: center;font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;">氏名</td>		
				<td colspan="2" width="50" style=" padding: 5px 0px; border-right: 1px dotted black; text-align: center;font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;">年生</td>
				<td colspan="7" style=" padding: 5px 0px; border-right: 1px dotted black; text-align: center;font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;">職業</td>
				<td colspan="4" style=" padding: 5px 0px; border-right: 1px dotted black; text-align: center;font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;">就職先</td>
				<td colspan="4" style=" padding: 5px 0px;border-right: 1px solid black; text-align: center;font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;">月収</td>
			</tr>
			@for ($gdijp = 0; $gdijp < 7; $gdijp++)
			<tr>
				<td colspan="3" height="36" style=" padding: 5px 0px;border-top: 1px dotted black; border-right: 1px dotted black; text-align: center;font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;"></td>
				<td colspan="8" style=" padding: 5px 0px;border-top: 1px dotted black; border-right: 1px dotted black; text-align: center;font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;"></td>
				<td colspan="2" style=" padding: 5px 0px;border-top: 1px dotted black; border-right: 1px dotted black; text-align: center;font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;"></td>
				<td colspan="7" style=" padding: 5px 0px;border-top: 1px dotted black; border-right: 1px dotted black; text-align: center;font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;"></td>
				<td colspan="4" style=" padding: 5px 0px;border-top: 1px dotted black; border-right: 1px dotted black; text-align: center;font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;"></td>
				<td colspan="4" style=" padding: 5px 0px;border-top: 1px dotted black; border-right: 1px solid black; text-align: center;font-family: 'Times New Roman', Times, serif; vertical-align:middle; font-size: 13px;"></td>
			</tr>
			@endfor
		@endif		  
		<tr style="height:5px;">
			<td colspan="31" style="border: 0px ; border-top: 1px solid black"></td>
		</tr>
	</table>
@endif
@endsection