@extends('admin.master')
@section('title', 'In Đơn Hàng')
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
        if ($n > $bits[$i]) {
            ++$age;
            break;
        }
    }
    return $age;
}
function stringtodate($var) {
	$date = str_replace('/', '-', $var);
	return date('Y-m-d', strtotime($date));
}
function khongdau($str) {
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
	  return $str;
	}
@endphp
	<h2 class="ui header center aligned">
    	ĐƠN HÀNG - {{$donhang->tendonhang}}    
	    <div class="sub header">
	      	Công ty <strong>{{$doitac->tencongty}}</strong>. Nghiệp đoàn <strong>{{$nghiepdoan->tennghiepdoan}}</strong>.
	    </div>
 	</h2>

	<div class="ui grid right aligned">
		<div class="column">
			<a href="{{url('donhang')}}" class="ui labeled icon button"><i class="arrow left icon"></i>Danh Sách</a>
			@if(count($hoso)>0)
				<a class="ui labeled icon red button" href="javascript:void(0)" onclick="In_Content('listorder')"><i class="save icon"></i>IN DANH SÁCH</a>
				<a class="ui labeled icon red button" href="javascript:void(0)" onclick="In_Content('resultorder')"><i class="save icon"></i>IN KẾT QUẢ PHỎNG VẤN</a>
				<a class="ui labeled icon red button" href="javascript:void(0)" onclick="In_Content('coverorder')"><i class="save icon"></i>IN BÌA</a>	
				<a class="ui labeled icon green button" id="print" href=""> <i class="print icon"></i>in</a>
			@else
				@permission('donhang-show')
	            <a href="{{url('donhang/' . $donhang->id . '/create')}}" class="ui labeled icon blue button" title="Ghép đơn hàng"><i class="plus icon"></i>GHÉP ĐƠN HÀNG</a>
	            @endpermission
            @endif
		</div>
	</div>
	<div class="ui segments">
		<div class="ui segment">
			<div class="ui two column main-content">	
				<div class="fifteen wide column">
					<form class="ui form" action="" method="post" name="form_1">
						{{ csrf_field() }}
						<div class="field thongtin">
							@if(count($hoso)>0)
							 <table id="data-table" class="ui selectable celled striped table">
							      <thead class="full-width">
							        <tr>
							          <th>SỐ THỨ TỰ</th>
							          <th>ẢNH</th>
							          <th>HỌ TÊN</th>
							          <th>NGÀY SINH</th>
							          <th>ĐIỆN THOẠI</th>
									  @permission('donhang-check')
							          <th>ĐẬU - RỚT</th>
									  @endpermission
							        </tr>
							      </thead>
							      <tbody>
							        @foreach($hoso as $key => $hs)
							            <tr>
								            <td><input style="width: 70px" type="number" class="change-stt" name="stt" value="{{$hs->stt}}" data-id="{{$hs->id}}"></td>
											<td>
												{{-- <img width="50px" src="{{$hs->hinhanh}}"> --}}
												@php
													$timestamp_image = strtotime($hs->created_at);
													$year_image = date("Y", $timestamp_image);
													$month_image = date("m", $timestamp_image);
												@endphp
												@if (($hs->hinhanh != NULL) && (strlen($hs->hinhanh) < 100))
													<img src="{{url('')}}/hocviens/{{$year_image}}/{{$month_image}}/{{$hs->hinhanh}}" width="50px">
												@else
													<img src="{{$hs->hinhanh}}" width="50px">
												@endif
											</td>
											<td>
												<a href="{{url('hoso/' . $hs->id . '/show')}}">{{$hs->hoten}}</a>
												<a href="{{url('hoso/'.$hs->id.'/tran')}}" class="mini ui icon @if($hs->id_hocvien) yellow @else blue @endif  button" title="Dịch"><i class="language icon"></i></a>
												<div class="ui checkbox print"><input type="checkbox" class="printcheck" name="print" print="{{$hs->id}}"><label>IN</label></div>
											</td>
								            <td>{{$hs->ngaysinh}}</td>
								            <td>{{$hs->dienthoai}}</td>
											@permission('donhang-check')
								            <td>
								            	<div class="ui mini buttons">
												  <div class="ui button pvdau @if($hs->tinhtrang == 2) green @endif " data-id="{{$hs->id}}">Đậu</div>
												  <div class="or"></div>
												  <div class="ui button pvrot @if($hs->tinhtrang == 4) red @endif" data-id="{{$hs->id}}">Rớt</div>
												</div>
								            </td>
											@endpermission
							         	</tr>
							        @endforeach
							      </tbody>
							      <tfoot class="full-width"></tfoot>
							  </table>
							@endif

				            <h3 class="ui header">THÔNG TIN ĐƠN HÀNG</h3>
							<div class="three fields">
								<div class="field">
									<label>Tên công ty tiếp nhận (*)</label>
									<input name="doitac" value="{{$doitac->tencongty}}" readonly="">						
								</div>
								<div class="field">
									<label>Công việc (Ngành nghề)</label>
									<input name="congviec" value="{{$nganhnghe->nganhnghe_vn}}" readonly="">
								</div>
								<div class="field">
									<label>Thời gian làm việc</label>
									<input type="text" name="thoigian" value="{{ $donhang->thoigian }}" readonly="">
								</div>
								
							</div>
							<div class="three fields">
								<div class="field">
									<textarea rows="3" readonly=""> {{$donhang->khautru}}</textarea>
								</div>
								<div class="field">
									<label>Lương cơ bản</label>
									<input type="text" name="luongcoban" value="{{ $donhang->luongcoban }}" readonly="">
								</div>
								<div class="field">
									<label>Lương thực lãnh</label>
									<input name="luongthuclanh" value="{{ $donhang->luongthuclanh }}" readonly="" >
								</div>
							</div>
							<div class="four fields">
								<div class="field">
									<label>Số lượng tuyển</label>
									<input name="soluongtuyen" value="{{ $donhang->soluongtuyen }}" readonly="" >
								</div>
								<div class="field">
									<label>Dự kiến Xuất cảnh</label>
									<div class="ui calendar">
									    <div class="ui input left icon">
									      <i class="calendar icon"></i>
									      <input type="text" name="dukienxc" value="{{ $donhang->dukienxc}}" readonly="">
									    </div>
									</div>
								</div>
								<div class="field">
									<label>Trình độ</label>
									<input type="text" name="trinhdo" value="{{ $donhang->trinhdo }}" readonly="">
								</div>
								<div class="field">
									<label>Nơi thi</label>
									<input type="text" name="noithi" value="{{ $donhang->noithi }}" readonly="" >
								</div>
							</div>
							<div class="two fields">
								<div class="field">
									<label>Ngày tuyển bắt đầu (*)</label>
									<div class="ui calendar">
									    <div class="ui input left icon">
									      <i class="calendar icon"></i>
									      <input type="text" name="ngaytuyenbd" value="{{ $donhang->ngaytuyenbd }}" readonly="">
									    </div>
									</div>
								</div>
								<div class="field">
									<label>Ngày tuyển kết thúc (*)</label>
									<div class="ui calendar">
									    <div class="ui input left icon">
									      <i class="calendar icon"></i>
									      <input type="text" name="ngaytuyenkt" value="{{ $donhang->ngaytuyenkt }}" readonly="">
									    </div>
									</div>
								</div>
							</div>
							<div class="field">
								<label>Yêu cầu khác</label>
								<textarea rows="5" name="yeucau" readonly="">{{ $donhang->yeucau }}</textarea>
							</div>

							<div class="inline field">
							<label>(*) Trường bắt buộc phải nhập</label>
							</div>		
						</div>	
					</form>
				</div>
			</div>
		</div>
	</div>
{{-- list order --}}
<div id="listorder" style="display: none;">
	<style type="text/css">
		.body {
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
			border-left:1px solid;
			border-top: none;
			border-bottom: 1px solid;
			border-right: none;
			border-color:#000000;
		}
		h2 {
		    padding: 0px;
		    margin: 15px;
		    font-size: 30px;
		}

		p{margin: 2px;}
	</style>
	<div class="body">
		<table width="1125" border="1" cellspacing="0" style="border: 1px solid black; border-top: 2px solid black; border-right: 2px solid black">
		  <tr>
		    <td colspan="20">
		      <span style="float: left;"><img src="{{url('images/admin/logo.png')}}" width="100" ></span>
		        <h2>実習生の面接リスト</h2>
		    </td>
		  </tr>
		  <tr>
		    <td colspan="3" style="font-weight: bold;">会社名</td>
		    <td colspan="7">{{$doitac->tencongty}}</td>
		    <td colspan="4" style="font-weight: bold;">協同組合名</td>
		    <td colspan="8">{{$nghiepdoan->tennghiepdoan}}</td>
		  </tr>
		  <tr>
		    <td colspan="3" style="font-weight: bold;">会社住所</td>
		    <td colspan="7">{{$doitac->diachi}}</td>
		    <td colspan="4" style="font-weight: bold;">組合の住所</td>
		    <td colspan="8">{{$nghiepdoan->diachi}}</td>
		  </tr>
		  <tr>
		    <td colspan="3" style="font-weight: bold;">代表者</td>
		    <td colspan="7">{{$doitac->nguoidaidien}}</td>
		    <td colspan="4" style="font-weight: bold;">代表者</td>
		    <td colspan="8">{{$nghiepdoan->nguoidaidien}}</td>
		  </tr>
		  <tr>
			<td colspan="3" style="font-weight: bold;">面接日</td>
		    <td colspan="7">@if($donhang->ngaypv){{date_format(date_create(stringtodate($donhang->ngaypv)),"Y年m月d日")}} @endif </td>
		    <td colspan="4" style="font-weight: bold;">入国予定日</td>
			<td colspan="8">@if($donhang->dukienxc) {{date_format(date_create(stringtodate($donhang->dukienxc)),"Y年m月d日")}} @endif</td>
		  </tr>
		  <tr>
		    <td colspan="3" style="font-weight: bold;">職種名</td>
		    <td colspan="7">{{$nganhnghe->nganhnghe_jp}}</td>
		    <td colspan="4" style="font-weight: bold;">作業名</td>
		    <td colspan="8">{{$donhang->tieudethemjp}}</td>
		  </tr>

		  <tr>
		    <td colspan="20" style="font-weight: bold;">
		    <p>学歴</p>
		    <p>Ｓ：中学校卒業　Ｈ：高等学校卒業　Ｖ：専門学校・職業訓練学校卒業　 Ｕ：大学卒業</p>
		    </td>
		  </tr>
		  <tr>
		    <td width="40" style="font-weight: bold;">番号</td>
		    <td width="200" style="font-weight: bold;">氏名</td>
		    <td width="35" style="font-weight: bold;">写真</td>
		    <td width="30" style="font-weight: bold;">年齢</td>
		    <td width="100" style="font-weight: bold;">生年月日</td>
		    <td width="80" style="font-weight: bold;">出身地</td>
		    <td width="50" style="font-weight: bold;">身長</td>
		    <td width="50" style="font-weight: bold;">体重</td>
		    <td width="75" style="font-weight: bold;">婚姻</td>
		    <td width="71" style="font-weight: bold;">血液型</td>
		    <td width="27" style="font-weight: bold;">学歴</td>
		    <td colspan="6" style="font-weight: bold;">IQ テスト</td>
		    {{-- <td width="105" style="font-weight: bold;">職歴</td> --}}
		    <td width="105" style="font-weight: bold;">面接</td>
		    <td width="105" style="font-weight: bold;">その他</td>
		  </tr>
		  <tr>
		    <td>No</td>
		    <td>Full Name </td>
		    <td>Photo</td>
		    <td>Age</td>
		    <td>D.O.B</td>
		    <td>Place of birth </td>
		    <td><p>Heigh (cm)</p>    </td>
		    <td><p>Weight (kg)</p>    </td>
		    <td>Marital status </td>
		    <td>Blood Group </td>
		    <td>EDU</td>
		    <td width="27">M1 (10) </td>
		    <td width="27">M2 (10) </td>
		    <td width="27">M3 (10) </td>
		    <td width="27">M4 (10) </td>
		    <td width="27">M5 (10) </td>
		    <td width="21">IQ (50) </td>
		    {{-- <td>Working Experience </td> --}}
		    <td>Interview</td>
		    <td>Remark</td>
		  </tr>
		  
		  	@foreach($hoso as $key => $hs)
		  	<tr>
				@if($hs->iq == null)
					@php
					$x = '{"m1":"0","m2":"0","m3":"0","m4":"0","m5":"0"}';
					$iq = json_decode($x);
					@endphp
				@else
					@php
					$iq = json_decode($hs->iq);
					@endphp
				@endif		
				@php
					$timestamp_image = strtotime($hs->created_at);
					$year_image = date("Y", $timestamp_image);
					$month_image = date("m", $timestamp_image);
				@endphp		        
			    <td>{{$hs->stt}}</td>
				<td>{{khongdau($hs->hoten)}} <br> {{$hs->hotenjp}}</td>
			    <td style="text-align: center;"><img src="{{url('')}}/hocviens/{{$year_image}}/{{$month_image}}/{{$hs->hinhanh}}" height="50"></td>
			    <td>{{getAge(date_format(date_create($hs->ngaysinh), "Y/m/d"))}}</td>
			    <td>{{date_format(date_create($hs->ngaysinh),"Y年m月d日")}}</td>
				<td>{{$hs->noisinhjp}}</td>
			    <td>{{$hs->chieucao}}</td>
			    <td>{{$hs->cannang}}</td>
			    <td>{{$hs->honnhanjp}}</td>
			    <td>{{$hs->nhommau}}</td>
			    <td></td>
			    <td>{{$iq->m1}}</td>
			    <td>{{$iq->m2}}</td>
			    <td>{{$iq->m3}}</td>
			    <td>{{$iq->m4}}</td>
			    <td>{{$iq->m5}}</td>
			    <td>{{$iq->m1 + $iq->m2 + $iq->m3 + $iq->m4 + $iq->m5}}</td>
			    {{-- <td>ワーカー</td> --}}
			    <td></td>
			    <td></td>
		    </tr>
		    @endforeach
		  
		</table>
	</div>
</div>

{{-- result order ---------------------------------------------------------- --}}
<div id="resultorder" style="display: none;">
	<style type="text/css">
		.body {
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
			border-left:1px solid;
			border-top: none;
			border-bottom: 1px solid;
			border-right: none;
			border-color:#000000;
		}
		h2 {
		    padding: 0px;
		    margin: 15px;
		    font-size: 30px;
		}

		p{margin: 2px;}
	</style>
	<div class="body">
		<table width="1125" cellspacing="0" style="border: 1px solid black; border-top: 2px solid black; border-right: 2px solid black">
		  <tr>
		    <td colspan="7">
		      <span style="float: left;"><img src="{{url('images/admin/logo.png')}}" width="100" ></span>
		        <h2>面接結果</h2>
		    </td>
		  </tr>
		  <tr>
		    <td colspan="1" style="font-weight: bold;" width="100">会社名</td>
		    <td colspan="3" style="font-weight: bold;" width="450">{{$doitac->tencongty}}</td>
		    <td colspan="1" style="font-weight: bold; ">協同組合名</td>
		    <td colspan="2" style="font-weight: bold;" width="450" >{{$nghiepdoan->tennghiepdoan}}</td>
		  </tr>
		  <tr>
		    <td colspan="1" style="font-weight: bold;">会社住所</td>
		    <td colspan="3">{{$doitac->diachi}}</td>
		    <td colspan="1" style="font-weight: bold;">組合の住所</td>
		    <td colspan="2">{{$nghiepdoan->diachi}}</td>
		  </tr>
		  <tr>
		    <td colspan="1" style="font-weight: bold;">代表者</td>
		    <td colspan="3">{{$doitac->nguoidaidien}}</td>
		    <td colspan="1" style="font-weight: bold;">代表者</td>
		    <td colspan="2">{{$nghiepdoan->nguoidaidien}}</td>
		  </tr>
		  <tr>
		    <td colspan="1" style="font-weight: bold;">面接日</td>
		    <td colspan="3">@if($donhang->ngaypv) {{date_format(date_create(stringtodate($donhang->ngaypv)),"Y年m月d日")}} @endif </td>
		    <td colspan="1" style="font-weight: bold;">入国予定日</td>
		    <td colspan="2">@if($donhang->dukienxc) {{date_format(date_create(stringtodate($donhang->dukienxc)),"Y年m月d日")}} @endif</td>
		  </tr>
		  <tr>
		    <td colspan="1" style="font-weight: bold;">職種名</td>
		    <td colspan="3">{{$nganhnghe->nganhnghe_jp}}</td>
		    <td colspan="1" style="font-weight: bold;">作業名</td>
		    <td colspan="2">{{$donhang->tieudethemjp}}</td>
		  </tr>

		  <tr>
		    <td  style="font-weight: bold;">番号</td>
		    <td  style="font-weight: bold;">氏名</td>
		    <td style="font-weight: bold;">年齢</td>
		    <td  style="font-weight: bold;">生年月日</td>
		    <td  style="font-weight: bold; width:200px">出身地</td>
		    <td style="font-weight: bold;">サイン</td>
		    <td  style="font-weight: bold;">その他</td>
		  </tr>
		  <tr>
		    <td>No</td>
		    <td>Full Name </td>
		    <td>Age</td>
		    <td>D.O.B</td>
		    <td>Place of birth </td>
		    <td>SIGN</td>
		    <td>Remark</td>
		  </tr>
		  
		  	@foreach($hoso as $key => $hs)
		  	<tr>			        
				<td>{{$hs->stt}}</td>
				<td>{{khongdau($hs->hoten)}} <br> {{$hs->hotenjp}}</td>
				<td>{{getAge(date_format(date_create($hs->ngaysinh), "Y/m/d"))}}</td>
				<td>{{date_format(date_create($hs->ngaysinh),"Y年m月d日")}}</td>
				<td>{{$hs->noisinhjp}}</td>
				<td></td>
				<td></td>
		    </tr>
		    @endforeach
			<tr>
				<td colspan="7" style="text-align: left; padding: 5px; font-weight: bold">
					<div style="font-size: 16px;"><span > &#9711; : </span> 合格 </div> <br>
					<div style="font-size: 16px;"><span style="font-size: 20px;"> &#9651; : </span> 補欠 </div>
				</td>
			</tr>
			<tr>
				<td colspan="7" style="text-align: left; padding: 5px; font-size: 20px; font-weight: bold">
					署名：	
				</td>
			</tr>
		</table>
	</div>
</div>

{{-- cover order ----------------------------------------------------------- --}}
<div id="coverorder" style="display: none">
		<style type="text/css">
		  .body1 {
			-webkit-print-color-adjust:exact;
		  }
		  .body1 table{
			  margin: auto;
				background-color: white;
				 border:1px solid black;
				 font-weight: bold;
		  }
		  .body1 tr td {
			  font-weight: bold;
			  padding: 5px;
			  font-size: 16px;
		  }
		 
			</style>
		<div class="body1">
  <!-- 794 -->
		<table class="in" width="794" cellspacing="0"  >
			<tr>
			  <td colspan="11" style="text-align: center; padding: 10px; font-size: 25px;">MIRAI HUMAN送り出し機関</td>
		  </tr>
		  <tr>
			  <td colspan="11"></td>
		  </tr>
		  <tr>
			  <td colspan="11" style="text-align: center; padding: 10px; font-size: 25px;">ベトナム人候補者名簿</td>
		  </tr>
		  <tr>
			  <td colspan="11" style="text-align: center; padding: 10px; font-size: 25px;">DANH SÁCH ỨNG  CỬ VIÊN DỰ TUYỂN</td>
		  </tr>
		  <tr>
			  <td colspan="11"></td>
		  </tr>
		  <tr>
			  <td colspan="11" style="text-align: center; padding: 10px; font-size: 20px;">選定日（Ngày tuyển):  @if($donhang->ngaytuyenbd){{date_format(date_create(stringtodate($donhang->ngaytuyenbd)),"Y年m月d日")}} @endif</td>
		  </tr>
		  <tr>
			  <td colspan="11"></td>
		  </tr>
		  <tr>
			  <td colspan="2">受入企業名</td>
			  <td colspan="1"></td>
			  <td colspan="1">:</td>
			  <td rowspan="2" colspan="3">{{$doitac->tencongty}}</td>
			  <td colspan="2">候補者人数  </td>
			  <td colspan="1">: </td>
		  <td colspan="1">{{$donhang->soluongungvienjp}}</td>
		  </tr>
		  <tr>
			  <td colspan="3">Xí nghiệp tiếp nhận</td>
			  <td colspan="1">:</td>
			  <td colspan="2">Tổng số ứng viên</td>
			  <td colspan="1">:</td>
			  <td colspan="1">{{$donhang->soluongungvien}}</td>
		  </tr>
		  <tr>
			  <td colspan="3">職種（仕事の内容）</td>
			  <td colspan="1">:</td>
		  	  <td colspan="3">{{$donhang->tieudethemjp}}</td>
			  <td colspan="2">合格人数　</td>
			  <td colspan="1">:</td>
		  	  <td colspan="1">{{$donhang->soluongtuyenjp}}</td>
			  {{-- 15名 --}}
		  </tr>
		  <tr>
			  <td colspan="3">Nội dung công việc</td>
			  <td colspan="1">:</td>
			  <td colspan="3">{{$donhang->tieudethem}}</td>
			  <td colspan="2">Trúng tuyển</td>
			  <td colspan="1">:</td>
			  <td colspan="1">{{$donhang->soluongtuyen}} </td>
		  </tr>
		  <tr>
			  <td colspan="3">選考コード </td>
			  <td colspan="1">:</td>
		  	  <td colspan="3">
					@if($donhang->tendonhang == 'THỰC TẬP SINH') 
						実習生
					@elseif($donhang->tendonhang == 'KỸ SƯ')
						工程师
					@elseif($donhang->tendonhang == 'ĐIỀU DƯỠNG')
						看護
					@endif
				</td>
			  {{-- 実習生 - thực tập sinh --}}
			  <td colspan="2">履歴書担当者</td>
			  <td colspan="1">:</td>
			  <td colspan="1">{{$donhang->nguoiqldhjp}}</td>
		  </tr>
		  <tr>
			  <td colspan="3">Kỳ thi tuyển </td>
			  <td colspan="1">:</td>
			  <td colspan="3">{{$donhang->tendonhang}}</td>
			  <td colspan="2">Phụ trách lý lịch</td>
			  <td colspan="1">:</td>
		  	  <td colspan="1">{{$donhang->nguoiqldh}}</td>
		  </tr>
		</table>
		</body>
	  </div>
<script>
//////////////////////////
var list = [];
  $("body").on('click','tr .printcheck',function(e){
    var id = $(this).attr('print');
    
    
    var includeId = list.includes(id);
    if (includeId == false) {
      list.push(id);
    }
    else{
      var i = list.indexOf(id);
      if (i != -1) {
        list.splice(i,1);
      }
    }
    console.log(list);
    var liststring = list.toString();
    var listlink = liststring.replace(/,/g, '-');
    $("#print").attr("href", "/hoso/print/"+listlink);	
  });
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
@endsection
@section('JsLibraries')
  <script src="{{url('js/admin/donhang/show_donhang.js')}}"></script>
@endsection