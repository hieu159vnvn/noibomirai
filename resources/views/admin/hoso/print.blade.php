@extends('admin.master')
@section('title', 'In Hồ Sơ')
@section('PageContent')
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
@endphp
<center style="margin-bottom: 20px;"><a href="javascript:void(0)" onclick="In_Content('intiengnhat')" >
    <div class="ui red icon button">
     <i class="print icon"></i> IN LIST TIẾNG NHẬT
    </div>
  </a>
</center>
{{-- TIENG NHAT --}}
<div id="intiengnhat">
	<style type="text/css">
		body {
			background: #EBECED;
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
@foreach ($hosojps as $hosojp)
    
	<table width="794" cellspacing="0" border="1" style="border: 2px solid black">
	  <tr class="logo-form">
	    <td colspan="26" style="  border: none;border-bottom: 1px solid" >
	        <span class="span-logo"><img src="/uploads/source/Logo/logo.png" width="50" ></span>
	        <h2>MIRAI HUMAN </h2>
	    </td>
	    <td colspan="5" rowspan="6" style="text-align: center; border: none; border-left: 1px solid;border-bottom: 1px solid">
	        <p style="text-align: left; font-weight: bold;"> 番号：{{$hosojp->stt}}</p>
            {{-- @if($hosojp->hinhanh) <img src="{{$hosojp->hinhanh}}" width="100%"> @endif --}}
            @php
				$timestamp_image = strtotime($hosojp->created_at);
				$year_image = date("Y", $timestamp_image);
				$month_image = date("m", $timestamp_image);
			@endphp
			@if (($hosojp->hinhanh != NULL) && (strlen($hosojp->hinhanh) < 100))
				<img src="{{url('')}}/hocviens/{{$year_image}}/{{$month_image}}/{{$hosojp->hinhanh}}" width="100%">
			@else
				<img src="{{$hosojp->hinhanh}}" width="100%">
			@endif
	    </td>
	  </tr>
	  
	  <tr>
	    <td colspan="26" class="none-border-t" style="font-size:24px;background-color:#C0C0C0;font-weight:bold; border-top: none; border-left: none;">技能実習生履歴書</td>
	  </tr>
	  
	  <tr>
	    <td colspan="4" rowspan="2" style="border-left: none; width: 100px; ">氏名</td>
		<td colspan="3">英字表記</td>
	    <td colspan="19" style="font-size:20px;font-weight:bold; text-transform: uppercase;">{{convert_hoten($hosojp->hotenvn)}}</td>
	   
	  </tr>
	  <tr>
	    <td colspan="3">フリガナ</td>
	    <td colspan="19" style="font-size:20px;">{{$hosojp->hoten}}</td>
	  </tr>
	  <tr>
	    <td colspan="4" style="border-left: none;">生年月日</td>
	    <td colspan="10">{{date_format(date_create($hosojp->ngaysinh),"Y年m月d日")}}</td>
	    <td colspan="2">年齢</td>
	    <td colspan="2">{{getAge(date_format(date_create($hosojp->ngaysinh),"Y/m/d"))}}</td>
	    <td colspan="2" rowspan="2" style="width: 70px">利き手 </td>
	    <td colspan="2">仕事</td>
	    <td style="min-width: 50px">@if($hosojp->congviec == 0) 右 @else 左 @endif</td>
	    <td colspan="2" style="min-width: 50px">箸</td>
	    <td style="min-width: 50px">@if($hosojp->dua == 0) 右 @else 左 @endif</td>
	  </tr>
	  <tr>
	    <td colspan="4" style="border-left: none;">性別</td>
	    <td colspan="10">@if($hosojp->gioitinh == 0) 女 @else 男 @endif</td>
	    <td colspan="2" rowspan="3">宗教</td>
	    <td colspan="2" rowspan="3">{{$hosojp->tongiao}}</td>
	    <td colspan="2" style="min-width: 50px">鋏</td>
	    <td style="min-width: 50px">@if($hosojp->keo == 0) 右 @else 左 @endif</td>
	    <td colspan="2">ペン</td>
	    <td style="min-width: 50px">@if($hosojp->viet == 0) 右 @else 左 @endif</td>
	  </tr>
	  <tr>
	    <td colspan="4" style="border-left: none;">婚姻</td>
	    <td colspan="10">{{$hosojp->honnhan}}</td>
	    <td colspan="4">身長（センチ)</td>
	    <td colspan="3">{{$hosojp->chieucao}}</td>
	    <td colspan="3">体重（キロ)</td>
	    <td colspan="3">{{$hosojp->cannang}}</td>
	  </tr>
	  <tr>
	    <td colspan="4" style="border-left: none;">病暦</td>
	    <td colspan="10">{{$hosojp->benhan}}</td>
	    <td colspan="4">血液</td>
	    <td colspan="9">{{$hosojp->nhommau}}</td>
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
			$hoctap = DB::table('hoso_hocviens')->join('hoctaps','hoso_hocviens.id','=','hoctaps.hocvien_id')
        ->select('hoctaps.*')->where('hoctaps.hocvien_id', $hosojp->id_hocvien)->get();
			
		@endphp
		{{-- hoc tap jp --}}
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
// $arrhoctap = array("小学校", "中学校", "高等学校");
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
		{{-- <td colspan="5" style="border-left: none;">{{$hoctap->thoigiankt[$i]}}</td> --}}
	@else
		<td colspan="5"></td>
		<td style="border-left: none;"></td>
		<td colspan="5" style="border-left: none;"></td>
	@endif

@if ($i > 2)
	<td colspan="11">{{$hoctap->tentruong[$i]}}</td>
@else
	{{-- <td colspan="11">{{$hoctap->tentruong[$i]}} @if( strlen($hoctap->thoigianbd[$i]) == 4){{$arrhoctap[$i]}} @endif</td> --}}
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
		{{-- end lam viec jp--}}
		<tr style="height:5px;">
		    <td colspan="31" style="border-bottom: none; border-top: 1px solid; border-left: none;"></td>
		</tr>
	    <tr>
	    <td colspan="4" rowspan="4" style="background-color:#C0C0C0;font-weight:bold;border-bottom: 1px solid;border-top: 1px solid; border-left: none;">外 国 語</td>
	    <td colspan="3" style="border-top: 1px solid;">英語</td>
	    <td colspan="11" style="border-top: 1px solid;">
	    	@if($hosojp->anhngu == 0)
	        	無
			@elseif($hosojp->anhngu == 1)
	        	A
	        @elseif($hosojp->anhngu == 2)
	        	B
	        @elseif($hosojp->anhngu == 3)	
	        	C				    
	        @endif
		</td>
	    <td colspan="7" style="background-color:#C0C0C0;font-weight:bold;border-top: 1px solid;">訪 日 経 験</td>
	    <td colspan="6" style="border-top: 1px solid;"> 無 </td>
		</tr>
		<tr>
	    <td colspan="3" rowspan="2">日本語</td>
	    <td colspan="11" rowspan="2">
			{{$hosojp->nhatngu}}
	    </td>
	    <td colspan="7" style="background-color:#C0C0C0;font-weight:bold;">在日本親戚．知人</td>
	    <td colspan="6"> 無 </td>
	 	</tr>
	    <tr>
	    <td style="">氏名:</td>
	    <td colspan="5">&nbsp;</td>
	    <td>年齢:</td>
	    <td colspan="2">&nbsp;</td>
	    <td colspan="2">続柄: </td>
	    <td colspan="2">&nbsp;</td>
	    </tr>
	    <tr>
	    <td colspan="3" style="border-bottom: 1px solid;">その他</td>
	    <td colspan="11" style="border-bottom: 1px solid;">無</td>
	    <td style="border-bottom: 1px solid;">氏名:</td>
	    <td colspan="5" style="border-bottom: 1px solid;">&nbsp;</td>
	    <td style="border-bottom: 1px solid;">年齢:</td>
	    <td colspan="2" style="border-bottom: 1px solid;">&nbsp;</td>
	    <td colspan="2" style="border-bottom: 1px solid;">続柄: </td>
	    <td colspan="2" style="border-bottom: 1px solid;">&nbsp;</td>
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
	    <td colspan="8">{{$hosojp->sotientrenthang}} ドン</td>
	    <td colspan="7">3年間の貯金</td>
	    <td colspan="6">{{$hosojp->sotientrennam}} ドン</td>
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
	    <td colspan="6">@if($hosojp->banglai == 1) はい @else 無 @endif </td>
	    <td colspan="2"> 種類 </td>
        <td colspan="19" style="text-align: left;">&nbsp; 
            @if($hosojp->xemay == 1) &#9745; @else &#9744; @endif  バイク  
				&nbsp; @if($hosojp->oto == 1) &#9745; @else &#9744; @endif 車
			&nbsp; @if($hosojp->xekhac != '') &#9745; @else &#9744; @endif その他 (&ensp;&ensp;{{$hosojp->xekhac}}&ensp;&ensp;)
						    
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
		{{-- start gia dinh jp--}}
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
			<td colspan="2" rowspan="" style="background-color:#C0C0C0;font-weight:bold; border-top: 1px solid; border-left:none;">家族構成</td>
			<td colspan="3" style="border-top: 1px solid;">続柄</td>
			<td colspan="8" style="border-top: 1px solid;">氏名</td>
			
			<td colspan="2" style="border-top: 1px solid">年生</td>
			<td colspan="7" style="border-top: 1px solid">職業</td>
			<td colspan="4" style="border-top: 1px solid">就職先</td>
			<td colspan="4" style="border-top: 1px solid">月収</td>
		</tr>
		@endif
		{{-- end gia dinh jp--}}
		</table>
		<style>
          .page-break {
            margin-top: 50px;
            page-break-after: always;
          }
        </style>
        <div class="page-break"></div>
	@endforeach
</div>
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
{{-- END TIENG NHAT --}}
@endsection