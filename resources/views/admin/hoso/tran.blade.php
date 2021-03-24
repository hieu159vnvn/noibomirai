@extends('admin.master')
@section('title', 'Dịch sang tiếng Nhật')
@section('PageContent')
<link rel="stylesheet" type="text/css" href="{{url('libraries/croper/croppie.css')}}">
<script src="{{url('libraries/croper/croppie.js')}}"></script>
@php
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
    DỊCH THUẬT HỒ SƠ
    <div class="sub header">
      Dịch học viên : <span class="ui teal label">{{$hoso->hoten}}</span> sang tiếng Nhật
    </div>
    </h2>
    @if (session('error'))
	  	<div class="ui error message">
		  	<i class="close icon"></i>
		  	<div class="header">
		    	Thông Báo !
		  	</div>
		  	<p>{{ session('error') }}</p>
		</div>
	@else
		@if (session('status'))
		  	<div class="ui green message">
			  	<i class="close icon"></i>
			  	<div class="header">
			    	Thông Báo !
			  	</div>
			  	<p>{{ session('status') }}</p>
			</div>
		@endif
	@endif
	<form class="ui form" action="" method="post" name="form_1" autocomplete="off">
	{{ csrf_field() }}
		<div class="ui segments">
			<div class="ui segment">
				<div class="ui secondary menu">
					<div class="left menu">
						<a href="{{url('/hoso')}}" class="ui labeled icon button"><i class="arrow left icon"></i>Danh Sách</a>
					</div>
				</div>
			</div>
{{-- hinh anh  --}}
@php 
	$timestamp_image = strtotime($hoso->created_at);
	$year_image = date("Y", $timestamp_image);
	$month_image = date("m", $timestamp_image);
@endphp
@if (strlen($hoso->hinhanh) >= 100)
	<div class="ui steps">
		<div class="step">
			<img width="70" id="upload-demo-img" @if($hoso->hinhanh) src="{{$hoso->hinhanh}}" @else src="/images/admin/avatar.png"  @endif>
			<input type="hidden" id="feature-image" name="featureImage" value="{{$hoso->hinhanh}}">									
		</div>
	</div>
@else
	<div class="ui steps">
		<div class="step">
			<img width="70" id="upload-demo-img" @if($hoso->hinhanh) src="{{'/hocviens/'.$year_image.'/'.$month_image.'/'.$hoso->hinhanh}}" @else src="/images/admin/avatar.png"  @endif>
			<input type="hidden" id="feature-image" name="featureImage" value="{{$hoso->hinhanh}}">									
		</div>
	</div>
@endif
<div class="ui modal mini modal-img-upload">
	<div class="header">Thay ảnh đại diện</div>
	<div class="content">
		<div class="ui stackable grid">										
			<div id="upload-demo" style="width:350px;">	
				</div>									     
													
		</div>
		<input type="file" id="upload">
		</div>
		<div class="actions"> 							    
			<a class="ui labeled icon button blue done_image"><i class="check icon"></i>Đồng ý</a>
		<a class="ui labeled icon button cancle-image"><i class="x icon"></i>Hủy</a>
	</div>
</div>

	<script type="text/javascript">									
		$('#upload-demo-img').on('click',function(){
			$(".modal-img-upload").modal('show');
		});					   		
		$uploadCrop = $('#upload-demo').croppie({
		enableExif: false,
		viewport: {
			width:170,
			height:216,
			type:'square'
		},
		boundary:{
			width:250,
			height:250,
		}
	});
	$('.cr-image').attr('src','/images/admin/avatar.png');
	$('.cr-image').attr('width','250');
		$('#upload').on('change', function () { 
		var reader = new FileReader();
		reader.onload = function (e) {
			$uploadCrop.croppie('bind', {
				url: e.target.result
			}).then(function(){

			});									    	
		}
		reader.readAsDataURL(this.files[0]);	
	});
	$('.done_image').click(function(){
		var data = $uploadCrop.croppie('result', {
			type: 'canvas',
			size: 'viewport'
		}).then(function(response){
			$('#feature-image').attr('value',response);	
			$('#upload-demo-img').prop('src',response);	
			$(".modal-img-upload").modal('hide');

		});
	});
	$('.cancle-image').click(function(){
		$(".modal-img-upload").modal('hide');
	});
	</script>
<div class="infohead">
	<p>
		<b>Ngày post: <span class="ui teal label">{{date_format(date_create($hoso->created_at), "d-m-Y")}}</span></b> 
	</p>
	<p>
		<b>Người Tư Vấn:  <span class="ui teal label">@if(isset($user->name)){{$user->name}}@endif</span></b>
	</p>
	<p>
		<b>Người phụ trách:  <span class="ui teal label">{{$hoso->nguoiphutrach}}</span></b>
	</p>
	<p>
		<b>Ngày sinh: <span class="ui teal label">{{date_format(date_create($hoso->ngaysinh), "d-m-Y")}}</span></b> 
	</p>	
	<p>	
		<b>Điện thoại:  <span class="ui teal label">{{$hoso->dienthoai}}</span></b>
	</p>				
</div>

	     	<div class="ui segment">
				<div class="ui column centered main-content">	
					<div class="column">

					<div class="ui top attached tabular menu">
							<a class="item active" data-tab="soyeulylich">Tiếng Nhật</a>	
							<a class="item" data-tab="scan">Scan file</a>						  
						  </div>
						  <div class="ui bottom attached tab segment " data-tab="scan">
							  @php 
								  $timestamp = strtotime($hoso->created_at);
									$year = date("Y", $timestamp);
									$month = date("m", $timestamp);
							  @endphp
								  <h3 class="ui header">File scan</h3>
								  <div class="field">
									 <div class="field ">
										   @if($hoso->scan_file)
										   @php 
											   $scan_file = json_decode($hoso->scan_file); 
										   @endphp
										   @foreach($scan_file as $scan)
												<object style="width: 100%; min-height: 1000px;" data="{{url('/uploads/pdfs/'.$year.'/'.$month.'/'.$hoso->id.'/scan/'.$scan)}}" type="application/pdf">
												  <embed src="{{url('/uploads/pdfs/'.$year.'/'.$month.'/'.$hoso->id.'/scan/'.$scan)}}" type="application/pdf" />
											  </object>
										   @endforeach
										   @endif
									 </div>
								 </div>
						  </div>
						<div class="ui bottom attached tab segment active" data-tab="soyeulylich">			
								<h3 class="ui header centered blue"></h3>
								<h4 class="ui dividing header centered">THÔNG TIN CÁ NHÂN</h4>
								<div class="field thongtin">
								<input type="hidden" name="id_hocvien" value="{{$hoso->id}}">	
								<div class="ui form">
										<div class=" fields">
											<div class="four wide field">
												<label>Họ và tên (*)</label>
												<div class="ui input left icon">							
													<i class="user icon"></i>
													<input type="text" name="hoten" placeholder="{{$hoso->hoten}}" data-content="{{$hoso->hoten}}" required>
												</div>
											</div>							
											<div class="three wide field">		
												<label>Nơi sinh (*)</label>
												<div class="ui input left icon">
													<i class="map marker alternate icon"></i>
													<input type="text" name="noisinh" value="{{khongdau($hoso->noisinh)}}" data-content="{{$hoso->noisinh}}" >
												</div>
											</div>
											<div class="field">
												<label>Tỉnh/thành</label>
												<select name="noisinhplus" class=" selection ui dropdown " >
													<option value="省">省</option> {{--tỉnh--}}
													<option value="市">市</option>  {{--thành phố--}}
												</select>
											</div>
											<div class="field">
												<label>Miền ({{$hoso->mien}})</label>
												<select name="mien" class="selection ui dropdown " >
													<option value="">{{$hoso->mien}}</option>
													<option value="南部" >南部</option> {{--miền nam--}}
													<option value="中部" >中部</option>  {{--miền trung--}}
													<option value="北部" >北部</option>  {{--miền bắc--}}
												</select>	
											</div>
										</div>
										<div class="fields">					
											@if ($hoso->diachi)
											<div class="twelve wide field">
												<label>Địa chỉ hộ khẩu (*)</label>
												<div class="ui input left icon">
													<i class="map outline icon"></i>
													<input type="text" name="diachi" placeholder="{{ khongdau($hoso->diachi)}}" value="" data-content="{{$hoso->diachi}}" >
												</div>
											</div>
											@else
											<div class="three wide field">
												<label>Địa chỉ (ấp/khu phố)</label>
												<div class="ui input left icon">
													<i class="map outline icon"></i>
													<input type="text" name="dchk_dc" placeholder="{{ khongdau($hoso->dchk_dc)}}" value="{{ khongdau($hoso->dchk_dc)}}" data-content="{{$hoso->dchk_dc}}" >
												</div>
											</div>
											<div class="one wide field">
												<label>--</label>
												<select name="dchk_dc_plus"  >
													<option value="村" >村</option>
													<option value=""> </option>
												</select>
											</div>
											<div class="three wide field">
												<label>Phường/xã</label>
												<div class="ui input left icon">
													<i class="map outline icon"></i>
													<input type="text" name="dchk_xa" placeholder="{{khongdau($hoso->dchk_xa)}}" value="{{khongdau($hoso->dchk_xa)}}" data-content="{{$hoso->dchk_xa}}" >
												</div>
											</div>
											<div class="one wide field">
												<label>--</label>
												<select name="dchk_xa_plus"  >
													<option value="町" >町</option>										
													<option value=""> </option>
												</select>
											</div>
											<div class="three wide field">
												<label>Quận/huyện</label>
												<div class="ui input left icon">
													<i class="map outline icon"></i>
													<input type="text" name="dchk_huyen" placeholder="{{ khongdau($hoso->dchk_huyen)}}" value="{{ khongdau($hoso->dchk_huyen)}}" data-content="{{$hoso->dchk_huyen}}" >
												</div>
											</div>
											<div class="one wide field">
												<label>--</label>
												<select name="dchk_huyen_plus"  >
													<option value="区">区</option>
													<option value=""> </option>
												</select>
											</div>
											<div class="two wide field">
												<label>Tỉnh/thành</label>
												<div class="ui input left icon">
													<i class="map outline icon"></i>
													<input type="text" name="dchk_tinh" placeholder="{{ strtoupper(khongdau($city->ten))}}" value="{{ strtoupper(khongdau($city->ten))}}" data-content="{{$city->ten}}" >
												</div>
											</div>
											<div class="one wide field">
												<label>--</label>
												<select name="dchk_tinh_plus" class=" selection dropdown " >
													<option value="省">省</option> {{--tỉnh--}}
													<option value="市">市</option>  {{--thành phố--}}
												</select>
											</div>
											@endif
											
											<div class="field">
												<label>Đ/c miền</label>
												<select name="diachimien" class="selection dropdown " >
													<option value="南部"  >南部</option> {{--miền nam--}}
													<option value="中部"  >中部</option>  {{--miền trung--}}
													<option value="北部"  >北部</option>  {{--miền bắc--}}
													<option value=""></option>
												</select>	
											</div>					
										</div>
									</div>
							
								<div class="five fields">
									<div class="field honnhan">
										<label><i class="balance scale icon"></i> Hôn nhân - "{{$hoso->honnhan}}"
											<a class="honnhannutnhap"><i class="pencil alternate icon"></i>nhập tay</a>
											<a class="honnhannutchon"><i class="thumbtack icon"></i>chọn sẵn</a>
										</label>
										<select name="honnhan" class="honnhanchon selection ui dropdown " >
											<option value="">{{$hoso->honnhan}}</option>
											<option value="独身">独身</option> {{--độc thân--}}
											<option value="既婚">既婚</option>  {{--kết hôn--}}
											<option value="離婚">離婚</option>  {{--ly hôn--}}
										</select>
										<div  class="honnhannhap">
										</div>
									</div>
									<div class="field ">
										<label>Bệnh án ({{$hoso->benhan}})</label>
										<select name="benhan" class="selection ui dropdown " >
											<option value="">{{$hoso->benhan}}</option>
											<option value="無" >無</option> {{--không--}}
											<option value="有" >有</option> {{--có--}}
										</select>
									</div>
									<div class="field tongiao">
										<label><i class="balance scale icon"></i> Tôn giáo - "{{$hoso->tongiao}}"
											<a class="tongiaonutnhap"><i class="pencil alternate icon"></i>nhập tay</a>
											<a class="tongiaonutchon"><i class="thumbtack icon"></i>chọn sẵn</a>
										</label>
										<select name="tongiao" class="tongiaochon selection ui dropdown " >
											<option value="">{{$hoso->tongiao}}</option>
											<option value="無">無</option> {{--không--}}
											<option value="仏教">仏教</option>  {{--phật--}}
											<option value="キリスト教">キリスト教</option>  {{--thiên chúa--}}
										</select>
										<div  class="tongiaonhap">
										</div>
									</div>
									<div class="field">
										<label>Mắt trái</label>
										<div class="ui input left icon">
											<i class="eye icon"></i>
											<input type="text" name="mattrai" placeholder="{{ $hoso->mattrai }}" data-content="{{$hoso->mattrai}}">
										</div>
									</div>
									<div class="field">
										<label>Mắt phải</label>
										<div class="ui input left icon">
											<i class="eye scale icon"></i>
											<input type="text" name="matphai" placeholder="{{ $hoso->matphai }}" data-content="{{$hoso->matphai}}">
										</div>
									</div>
								</div>
							</div>	
				
								<h4 class="ui dividing header centered">QUÁ TRÌNH HỌC TẬP</h4>
								<div id="hoctap">
								<div class="three fields">
									<div class="field">
										<label>Thời gian học</label>
									</div>
									<div class="field">
										<label>Tên trường</label>
									</div>
									<div class="field">
										<label>Địa chỉ trường</label>
									</div>
								</div>
								@php 
									$numhoctap = 0; 
									$arrhoctap = array("小学校", "中学校", "高等学校");
									// ['cap 1','cap 2', 'cap 3']
									function replace($text){
										$arrayText = array('TRUONG TIEU HOC','TRUONG THCS', 'TRUONG THPT');
										$str = "";
										for ($i=0; $i < 3 ; $i++) { 
											if (strpos($text, $arrayText[$i]) !== false) {
												$str = str_replace($arrayText[$i],"",$text);
											}
										}
										return $str;
									}
								@endphp

								@foreach($hoctap as $key => $ht)
								<div id="hoctap" class="three fields" style=" margin: 0em -0.5em;">
									<div class="field">
										<div class="two fields">
											<div class="field">
												<div class="ui calendar">
												    <div class="ui input left icon">
												      <i class="calendar icon"></i>
													<input type="text" name="thoigianhocbd[]" value="09-{{$ht->thoigianbd}}" class="thoigianhocbd" data-content="{{$ht->thoigianbd}}">
												    </div>
											    </div> 
										    </div>													
											<div class="field">
												<div class="ui calendar">
												    <div class="ui input left icon">
												      <i class="calendar icon"></i>
												      <input type="text" name="thoigianhockt[]" value="05-{{$ht->thoigiankt}}" class="thoigianhockt" data-content="{{$ht->thoigiankt}}">
												    </div>
											    </div> 
											</div>
										</div>
									</div>
									<div class="field">
										<div class="ui input left icon">
											<i class="building icon"></i>
											@if ($numhoctap > 2) 
												<input type="text" name="tentruong[]" value="{{khongdau($ht->tentruong)}}"  placeholder="{{$ht->tentruong}}" data-content="{{$ht->tentruong}}">
											@else
												<input type="text" name="tentruong[]"  value="{{replace(khongdau($ht->tentruong))}}"   placeholder="{{$arrhoctap[$numhoctap]}}" data-content="{{$ht->tentruong}}">
											@endif
											
										</div>	
									</div>
									<div class="field">
										<div class="ui grid">
											<div class="twelve wide column">
												<div class="ui input left icon">
													<i class="map icon"></i>
													<input type="text" name="diachitruong[]" value="{{khongdau($ht->diachi)}}"  placeholder="{{$ht->diachi}}" data-content="{{$ht->diachi}}">
												</div>
											</div>
											<div class="four wide column">
												<select name="dctinh[]" class=" dc selection dropdown " >
													<option value="省">省</option> {{--tỉnh--}}
													<option value="市">市</option>  {{--thành phố--}}
												</select>
											</div>
										</div>
									</div>
								</div>
								@php $numhoctap++; @endphp
								@endforeach

<div class="three fields" style=" margin: 0em -0.5em;">
	<div class="field">
		<div class="two fields">
			<div class="field">
				<div class="ui calendar" >
					<div class="ui input left icon">
						<i class="calendar icon"></i>
						<input type="text" class="thoigianhocbd" name="thoigianhocbd[]">
					</div>
				</div> 
			</div>								

			<div class="field">
				<div class="ui calendar" >
					<div class="ui input left icon">
						<i class="calendar icon"></i>
						<input type="text"  name="thoigianhockt[]" value="現在に至る" >
					</div>
				</div> 
			</div>
		</div>
	</div>
	<div class="field">
		<div class="ui input left icon">
			<i class="building icon"></i>
			<input type="text" name="tentruong[]" value="MIRAI HUMAN 日本語教育センター">
		</div>	
	</div>							
	<div class="field">
		<div class="ui grid">
			<div class="twelve wide column">
				<div class="ui input left icon">
					<i class="map icon"></i>
					<input type="text" name="diachitruong[]" value="HO CHI MINH">
				</div>
			</div>
			<div class="four wide column">
				
					<select name="dctinh[]" class=" dc selection dropdown " >
						<option value="市">市</option>  
						<option value="省">省</option>
						<option value="" ></option>   
					</select>							
			</div>
		</div>
	</div>
</div>

</div>

								<div class="ui grid">
									<div class="six wide column">
										{{-- nhat ngu --}}
										<h3 class="ui dividing header">NGOẠI NGỮ</h3>
										<div class="two fields">
											<div class="field">
												<label >CHỌN BÀI HỌC</label>
												<div class="ui input left icon select_nhatngu">
													<select name="" id="select_nhatngu" class="ui selection dropdown">
														<option value=" "></option>
														<option value="N1">N1</option>
														<option value="N2">N2</option>
														<option value="N3">N3</option>
														<option value="N4">N4</option>
														<option value="N5">N5</option>
													</select>
												</div>
											</div>
											<div class="field">
												<label>NHẬT NGỮ</label>
												<div class="ui input left icon">
													<i class="heartbeat icon"></i>
													<input type="text" name="nhatngu" id="show_nhatngu" placeholder="{{ $hoso->nhatngu }}" data-content="{{$hoso->nhatngu}}">
												</div>
											</div>
											</div>
										
									</div>
									<div class="ten wide column">
										<h3 class="ui dividing header">Điểm IQ</h3>
									<div class="five fields">
										@if($hoso->iq == null)
											@php
											$x = '{"m1":"","m2":"","m3":"","m4":"","m5":""}';
											$iq = json_decode($x);
											@endphp
										@else
											@php
											$iq = json_decode($hoso->iq);
											@endphp
										@endif
										<div class="field">
											<label>M1</label>
											<div class="ui input left icon">							
											<i class="pencil alternate icon"></i>
											<input type="text" name="m1" value="{{$iq->m1}}" >
											</div>
										</div>
										<div class="field">
											<label>M2</label>
											<div class="ui input left icon">							
											<i class="pencil alternate icon"></i>
											<input type="text" name="m2" value="{{$iq->m2}}" >
											</div>
										</div>
										<div class="field">
											<label>M3</label>
											<div class="ui input left icon">							
											<i class="pencil alternate icon"></i>
											<input type="text" name="m3" value="{{$iq->m3}}" >
											</div>
										</div>
										<div class="field">
											<label>M4</label>
											<div class="ui input left icon">							
											<i class="pencil alternate icon"></i>
											<input type="text" name="m4" value="{{$iq->m4}}" >
											</div>
										</div>
										<div class="field">
											<label>M5</label>
											<div class="ui input left icon">							
											<i class="pencil alternateer icon"></i>
											<input type="text" name="m5" value="{{$iq->m5}}">
											</div>
										</div>
									</div>
								</div>
							</div>

								<h4 class="ui dividing header centered">QUÁ TRÌNH LÀM VIỆC</h4>
								<div id="congviec">
									<div class="three fields">
										<div class="field">
											<label>Thời gian làm việc</label>
										</div>
										<div class="field">
											<label>Tên công ty</label>
										</div>
										<div class="field">
											<label>Nội dung công việc</label>
										</div>
									</div> 
									@foreach($lamviec as $key => $lv)
										<div id="congviec" class="three fields" style=" margin: 0em -0.5em;">
											<div class="field">	
												<div class="two fields">
													<div class="field">
														<div class="ui calendar">
														    <div class="ui input left icon">
														      <i class="calendar icon"></i>
														      <input type="text" name="thoigianlamviecbd[]" value="{{$lv->thoigianbd}}" class="thoigianhocbd" data-content="{{$lv->thoigianbd}}">
														    </div>
													    </div> 
												    </div>														
													<div class="field">
														<div class="ui calendar">
														    <div class="ui input left icon">
														      <i class="calendar icon"></i>
														      <input type="text" name="thoigianlamvieckt[]" value="{{$lv->thoigiankt}}" class="thoigianhockt" data-content="{{$lv->thoigiankt}}">
														    </div>
													    </div> 
													</div>
												</div>
											</div>
											<div class="field">
												<div class="ui input left icon">
													<i class="building icon"></i>
													<input type="text" name="tencongty[]" value="{{khongdau($lv->tencongty)}}" placeholder="{{$lv->tencongty}}" data-content="{{$lv->tencongty}}">
												</div>
											</div>
											<div class="field">
												<div class="ui input left icon">
													<i class="briefcase icon"></i>
													<input type="text" name="ndcongviec[]" {{-- value="{{khongdau($lv->congviec)}}" --}} placeholder="{{$lv->congviec}}" data-content="{{$lv->congviec}}">
												</div>
											</div>
										</div>
									@endforeach
								</div>
{{-- -------------------------------- --}}


<h4 class="ui dividing header centered">NGƯỜI THÂN ĐI NHẬT <i class="plus icon blue add_plus"></i></h4>
<div id="ttnguoithan" data-count="1" > 		
		<div class="three fields">
			<div class="field">
				<label>Họ tên</label>
			</div>
			<div class="field">
				<label>Tuổi</label>
			</div>
			<div class="field">
				<label>Quan hệ</label>
			</div>
		</div> 
		@foreach($nguoithan as $key => $nt)
			<div id="congviec" class="three fields" style=" margin: 1em -0.5em;">
				<div class="field">	
					<div class="field">
						<div class="ui calendar">
							<div class="ui input left icon">
								<i class="calendar icon"></i>
								<input type="text" name="hotennguoithan[]" value="{{khongdau($nt->hoten)}}" data-content="{{$nt->hoten}}">
							</div>
						</div> 
					</div>
				</div>
				<div class="field">
					<div class="ui input left icon">
						<i class="building icon"></i>
						<input type="text" name="tuoinguoithan[]"  placeholder="{{khongdau($nt->tuoi)}}" value="{{khongdau($nt->tuoi)}}" data-content="{{$nt->tuoi}}">
					</div>
				</div>
				<div class="field">
					<div class="ui input left icon">
						<i class="briefcase icon"></i>
						<input type="text" name="quanhenguoithan[]" value="{{khongdau($nt->quanhe)}}" placeholder="{{$nt->quanhe}}" data-content="{{$nt->quanhe}}">
					</div>
				</div>
			</div>
		@endforeach
	</div>
		

{{-- -------------------------------- --}}
	<h4 class="ui dividing header centered">THỰC TẬP KỸ NĂNG Ở NHẬT</h4>
	<div class="two fields thuctap">
		<div class="field">
			<label>Mục đích đi Nhật</label>
			<div class=" select_mucdich">
				<select name="" id="select_mucdich" class="selection dropdown">
					<option value=" "></option>
					<option value="家族のためにお金を稼ぎ、日本人の働き方を学ぶこと">家族のためにお金を稼ぎ、日本人の働き方を学ぶこと</option>
					<option value="家族のためにお金を稼ぎ、日本語や日本人の働き方等を学ぶこと">家族のためにお金を稼ぎ、日本語や日本人の働き方等を学ぶこと</option>
					<option value="家族を経済的に支援し、日本人の働き方や日本文化等を学ぶこと">家族を経済的に支援し、日本人の働き方や日本文化等を学ぶこと</option>
					<option value="家族のためお金を稼ぎ、日本語や知識等を積み重ねること">家族のためお金を稼ぎ、日本語や知識等を積み重ねること</option>
					<option value="家族を経済的に支援し、職業経験を積み重ねること">家族を経済的に支援し、職業経験を積み重ねること</option>
				</select>
			</div>
			<label></label>
			<textarea rows="3" name="mucdich" id="show_mucdich" placeholder="{{$hoso->mucdich}}"  data-content="{{$hoso->mucdich}}">{{-- {{khongdau($hoso->mucdich) }} --}}</textarea>
		</div>
		<div class="field">
			<label>Mục tiêu sau khi về nước</label>
			<div class=" select_muctieu">
				<select name="" id="select_muctieu" class="selection dropdown">
					<option value=" "></option>
					<option value="日本語能力認定書N2を取得して日本語の教師になること">日本語能力認定書N2を取得して日本語の教師になること</option>
					<option value="日本語能力認定書N2を取得してベトナムにおける日系企業に勤めること">日本語能力認定書N2を取得してベトナムにおける日系企業に勤めること</option>
					<option value="日本語能力認定書N2を取得して日系企業に通訳者として勤めること">日本語能力認定書N2を取得して日系企業に通訳者として勤めること</option>
					<option value="日本での職業経験を活かしてベトナムにおける日系企業に管理者として勤めること">日本での職業経験を活かしてベトナムにおける日系企業に管理者として勤めること</option>
					<option value="日本での職業経験を活かしてベトナムにおける日系企業に勤めること">日本での職業経験を活かしてベトナムにおける日系企業に勤めること</option>
					<option value="貯金を利用して自分の飲食店を造ること">貯金を利用して自分の飲食店を造ること</option>
					<option value="N2を修得し日本での職業経験を生かして日系企業に管理者として勤めること。">N2を修得し日本での職業経験を生かして日系企業に管理者として勤めること。</option>
					<option value="身に付けた経験を活かして、ベトナムにおける日系企業で働くことです。">身に付けた経験を活かして、ベトナムにおける日系企業で働くことです。</option>
				</select>
			</div>
			<label></label>
			<textarea rows="3" name="muctieu" id="show_muctieu" placeholder="{{$hoso->muctieu}}" data-content="{{$hoso->muctieu}}">{{-- {{ khongdau($hoso->muctieu) }} --}}</textarea>
		</div>
	</div>
{{-- -------------------------------- --}}
								<h4 class="ui dividing header centered">KHÁC</h4>
								<div class="two fields">
									<div class="field">
										<label>Sở thích</label>
										<textarea rows="3" name="sothich" placeholder="{{$hoso->sothich}}" data-content="{{$hoso->sothich}}">{{-- {{ khongdau($hoso->sothich)}} --}}</textarea>
									</div>
									<div class="field">
										<label>Điểm mạnh</label>
										<textarea rows="3" name="diemmanh" placeholder="{{$hoso->diemmanh}}" data-content="{{$hoso->diemmanh}}">{{-- {{ khongdau($hoso->diemmanh) }} --}}</textarea>
									</div>
								</div>
								<h4 class="ui dividing header centered">GIA ĐÌNH</h4>
								<div id="giadinh" data-count="1"> 
									<div class="fields">	 								
										<div class="field two wide column">
												<label>Quan hệ</label>
																			
											</div>
											<div class="field four wide column">
												<label>Họ tên</label>
	
											</div>
											<div class="field two wide column">
												<label>Năm sinh</label>						
											</div>
	
											<div class="field two wide column">
												<label>Công việc</label>
	
											</div>
											<div class="field four wide column">
												<label>Nơi làm việc</label>
	
											</div>
											<div class="field two wide column">
												<label>Thu nhập</label>
	
											</div>
								    </div>
									@foreach($giadinh as $key => $gd)
										<div id="giadinh">
											<div class="fields">	 								
												<div class="field two wide column">
													<input type="text" name="quanhegiadinh[]" {{-- value="{{khongdau($gd->quanhe)}}" --}} placeholder="{{$gd->quanhe}}" data-content="{{$gd->quanhe}}">									
												</div>
												<div class="field four wide column">
													<input type="text" name="hotengiadinh[]" value="{{khongdau($gd->hoten)}}" data-content="{{$gd->hoten}}">
												</div>
												<div class="field two wide column">									
													<div class="ui calendar">
													      <input type="text" name="namsinhgiadinh[]" value="{{ $gd->namsinh }}" data-content="{{$gd->namsinh}}" class="namsinh">
													</div>
												</div>
												<div class="field two wide column">
													<input type="text" name="congviecgiadinh[]" {{-- value="{{khongdau($gd->congviec)}}" --}} placeholder="{{$gd->congviec}}" data-content="{{$gd->congviec}}">
												</div>
						
												<div class="field four wide column">
													<div class="ui grid">
														<div class="ten wide column">
															<input type="text" name="noilamviecgiadinh[]" value="{{khongdau($gd->noilamviec)}}" placeholder="{{$gd->noilamviec}}" data-content="{{$gd->noilamviec}}">
														</div>
														<div class="six wide column">
															<select name="gdtinhplus[]" class=" gd selection dropdown " >
																<option value="省">省</option> 
																<option value="市">市</option>  
															</select>
														</div>
													</div>
												</div>
												<div class="field two wide column">
													<input type="text" name="thunhapgiadinh[]" value="{{$gd->luong}}" data-content="{{$gd->luong}}" class="thunhap">
												</div>
											</div> 	
										</div>
									@endforeach
								</div>
								
								<div class="inline field">
									<label>(*) Vui lòng dịch đầy đủ thông tin </label>
								</div>
						</div>


						{{-- ////////////////////////////////// --}}
					</div>
				</div>
			</div>					
	        <div class="ui segment">
	          <div class="ui secondary menu">
	              <div class="right menu">
						<div id="re_edit" class="ui labeled icon button @if($hoso->re_edit == 1) red  @endif  " 
							id_re_edit="{{$hoso->id}}" re_edit="{{$hoso->re_edit}}">
							@if($hoso->re_edit == 1) <i class="check icon"></i>Đã yêu cầu sửa 
							@else <i class="check icon"></i>Yêu cầu sửa  
							@endif 
						</div>
						<button type="submit" class="ui labeled icon button green"><i class="save icon"></i>Lưu</button>
	              </div>
	            </div>
	     	</div>
		</div>	     	
	</form>
	<style>
		.infohead{position: absolute; z-index: 100000; top: 1px; right: 30px;}
	</style>
	<script type="text/javascript">
	$.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
	});
	$("#re_edit").click(function(){
		var id = $(this).attr('id_re_edit');
		var re_edit = $(this).attr('re_edit');
		$.post("/hoso/"+"re-edit/"+id,
		{
		re_edit: re_edit
		},
		function(result){
			if (result == 'success') {
				location.reload();	
			}
		});
	});
		$('.menu .item').tab();
		$('.ui.selection.dropdown').dropdown({clearable: true});
		$('input').popup({on: 'click'});
		$('input').popup({on: 'focus'});
		$('textarea').popup({ on: 'click'});
		$('textarea').popup({on: 'focus'});
		// nhập liệu hôn nhân
		$(".honnhannutchon").hide();
		$(".honnhan").on('click','.honnhannutnhap',function(e){
			$('.honnhannhap').html('<input type="text" name="honnhan" placeholder="hôn nhân">');
			$(".honnhanchon").hide();
			$(".honnhannutnhap").hide();
			$(".honnhannutchon").show();
		});
		$(".honnhan").on('click','.honnhannutchon',function(e){
			$('.honnhannhap').empty();
			$(".honnhanchon").show();
			$(".honnhannutchon").hide();
			$(".honnhannutnhap").show();
		});
		// nhập liệu tôn giáo
		$(".tongiaonutchon").hide();
		$(".tongiao").on('click','.tongiaonutnhap',function(e){
			$('.tongiaonhap').html('<input type="text" name="tongiao" placeholder="tôn giáo">');
			$(".tongiaochon").hide();
			$(".tongiaonutnhap").hide();
			$(".tongiaonutchon").show();
		});
		$(".tongiao").on('click','.tongiaonutchon',function(e){
			$('.tongiaonhap').empty();
			$(".tongiaochon").show();
			$(".tongiaonutchon").hide();
			$(".tongiaonutnhap").show();
		});

		// $(".thoigianhocbd,.thoigianhockt,.namsinhgiadinh").inputmask({ alias: "datetime", inputFormat: "mm-yyyy"});
// nhat ngu
$(".select_nhatngu").on('change','#select_nhatngu',function(e){
	var a = $(this).val();
	$('#show_nhatngu').val(a);
});

// muc dich di nhat
$(".select_mucdich").on('change','#select_mucdich',function(e){
	var a = $(this).val();
	$('#show_mucdich').val(a);
});
// muc tieu ve nuoc
$(".select_muctieu").on('change','#select_muctieu',function(e){
	var a = $(this).val();
	$('#show_muctieu').val(a);
});

$(".thoigianhocbd,.thoigianhockt").inputmask({ alias: "datetime", inputFormat: "mm-yyyy"});		
$(".namsinh").inputmask({ alias: "datetime", inputFormat: "yyyy"});		
$(".namsinhgiadinh").inputmask({ alias: "datetime", inputFormat: "yyyy"});		
$(".thunhap").inputmask("numeric", { radixPoint: ".", groupSeparator: ",",digits: 2, autoGroup: true, rightAlign: false,oncleared: function () { self.Value(''); }});
</script>
@endsection
@section('JsLibraries')
  <script src="{{url('js/admin/hoso/add_hoso.js')}}"></script>
@endsection