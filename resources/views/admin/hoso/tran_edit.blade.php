@extends('admin.master')
@section('title', 'Sửa Dịch sang tiếng Nhật')
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
    CHỈNH SỬA DỊCH THUẬT
    <div class="sub header">
      Cập nhật học viên : <span class="ui teal label">{{$hoso->hoten}} </span> sang tiếng Nhật
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
		  	<div class="ui message">
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
												<input type="text" name="hoten" value="{{$hosojp->hoten}}" data-content="{{$hoso->hoten}}">
											</div>
										</div>
										@php
										if ( strstr($hosojp->noisinh,"省")) {
											$strs = "省";
										}elseif (strstr($hosojp->noisinh,"市")) {
											$strs = "市";
										}else{
											$strs = "null";
										}
										@endphp
										<div class="three wide field">		
											<label>Nơi sinh (*)</label>
											<div class="ui input left icon">
												<i class="map marker alternate icon"></i>
												<input type="text" name="noisinh" value="{{rtrim($hosojp->noisinh,$strs)}}" data-content="{{$hoso->noisinh}}" >
											</div>
										</div>
										<div class="field">
											<label>Tỉnh/thành</label>
											<select name="noisinhplus" class=" selection ui dropdown " >
												<option value="省" @if ($strs == "省") selected @endif>省</option> {{--tỉnh--}}
												<option value="市" @if ($strs == "市") selected @endif>市</option>  {{--thành phố--}}
												<option value="" @if ($strs == "") selected @endif></option>
											</select>
										</div>
										<div class="field">
											<label>Miền ({{$hoso->mien}})</label>
											<select name="mien" class="selection ui dropdown " >
												<option value="">{{$hoso->mien}}</option>
												<option value="南部" @if ($hosojp->mien == "南部") selected @endif >南部</option> {{--miền nam--}}
												<option value="中部" @if ($hosojp->mien == "中部") selected @endif >中部</option>  {{--miền trung--}}
												<option value="北部" @if ($hosojp->mien == "北部") selected @endif >北部</option>  {{--miền bắc--}}
											</select>	
										</div>
										
									</div>
									
									@if ($hoso->diachi)
									
									<div class="fields">
										<div class="twelve wide field">
											<label>Địa chỉ hộ khẩu (*)</label>
											<div class="ui input left icon">
												<i class="map outline icon"></i>
												<input type="text" name="diachi" value="{{ khongdau($hosojp->diachi)}}" data-content="{{$hoso->diachi}}" >
											</div>
										</div>
										<div class="field">
											<label>Đ/c miền</label>
											<select name="diachimien" class="selection dropdown " >
												<option value="南部" @if ($hosojp->diachimien == "南部") selected @endif >南部</option> 
												<option value="中部" @if ($hosojp->diachimien == "中部") selected @endif >中部</option> 
												<option value="北部" @if ($hosojp->diachimien == "北部") selected @endif >北部</option> 
												<option value=""> </option>
											</select>	
										</div>
									</div>
									@else
									@php
										$dchk = json_decode($hosojp->dchk);
									@endphp
									@if ($dchk)
									<div class="fields">
										<div class="three wide field">
											<label>Địa chỉ (ấp/khu phố)</label>
											<div class="ui input left icon">
												<i class="map outline icon"></i>
												<input type="text" name="dchk_dc"  value="{{$dchk->dchk_dc}}" data-content="{{$hoso->dchk_dc}}" >
											</div>
										</div>
										<div class="one wide field">
											<label>--</label>
											<select name="dchk_dc_plus"  >
												<option value="村" @if ($dchk->dchk_dc_plus == "村") selected @endif >村</option>
												<option value="" @if ($dchk->dchk_dc_plus == "") selected @endif> </option>
											</select>
										</div>
										<div class="three wide field">
											<label>Phường/xã</label>
											<div class="ui input left icon">
												<i class="map outline icon"></i>
												<input type="text" name="dchk_xa" value="{{khongdau($dchk->dchk_xa)}}" data-content="{{$hoso->dchk_xa}}" >
											</div>
										</div>
										<div class="one wide field">
											<label>--</label>
											<select name="dchk_xa_plus"  >
												<option value="町" @if ($dchk->dchk_xa_plus == "町") selected @endif >町</option>
												<option value="" @if ($dchk->dchk_xa_plus == "") selected @endif> </option>
											</select>
										</div>
										<div class="three wide field">
											<label>Quận/huyện</label>
											<div class="ui input left icon">
												<i class="map outline icon"></i>
												<input type="text" name="dchk_huyen" value="{{ khongdau($dchk->dchk_huyen)}}" data-content="{{$hoso->dchk_huyen}}" >
											</div>
										</div>
										<div class="one wide field">
											<label>--</label>
											<select name="dchk_huyen_plus"  >
												<option value="区" @if ($dchk->dchk_huyen_plus == "区") selected @endif >区</option>
												<option value="" @if ($dchk->dchk_huyen_plus == "") selected @endif>  </option>
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
												<option value="省" @if ($dchk->dchk_tinh_plus == "省") selected @endif>省</option> {{--tỉnh--}}
												<option value="市" @if ($dchk->dchk_tinh_plus == "市") selected @endif>市</option>  {{--thành phố--}}
												<option value=""> </option>
											</select>
										</div>
										<div class="field">
											<label>Đ/c miền</label>
											<select name="diachimien" class="selection dropdown " >
												<option value="南部" @if ($hosojp->diachimien == "南部") selected @endif >南部</option> 
												<option value="中部" @if ($hosojp->diachimien == "中部") selected @endif >中部</option> 
												<option value="北部" @if ($hosojp->diachimien == "北部") selected @endif >北部</option> 
												<option value=""> </option>
											</select>	
										</div>				
									</div>
									@endif
									@endif
								</div>
								<div class="three fields">
									<div class="field honnhan">
										<label><i class="balance scale icon"></i> Hôn nhân - "{{$hoso->honnhan}}"
											<a class="honnhannutnhap"><i class="pencil alternate icon"></i>nhập tay</a>
											<a class="honnhannutchon"><i class="thumbtack icon"></i>chọn sẵn</a>
										</label>
										<select name="honnhan" class="honnhanchon selection ui dropdown " >
											<option value="">{{$hoso->honnhan}}</option>
											<option value="独身" @if ($hosojp->honnhan == "独身") selected @endif>独身</option> {{--độc thân--}}
											<option value="既婚" @if ($hosojp->honnhan == "既婚") selected @endif>既婚</option>  {{--kết hôn--}}
											<option value="離婚" @if ($hosojp->honnhan == "離婚") selected @endif>離婚</option>  {{--ly hôn--}}
										</select>
										<div  class="honnhannhap">
											<input type="hidden" class="honnhanhidden" value="{{$hosojp->honnhan}}">
										</div>
									</div>
									<div class="field ">
										<label>Bệnh án ({{$hoso->benhan}})</label>
										<select name="benhan" class="selection ui dropdown " >
											<option value="">{{$hoso->benhan}}</option>
											<option value="無" @if ($hosojp->benhan == "無") selected @endif >無</option> {{--không--}}
											<option value="有" @if ($hosojp->benhan == "有") selected @endif >有</option> {{--có--}}
										</select>
									</div>

									<div class="field tongiao">
										<label><i class="balance scale icon"></i> Tôn giáo - "{{$hoso->tongiao}}"
											<a class="tongiaonutnhap"><i class="pencil alternate icon"></i>nhập tay</a>
											<a class="tongiaonutchon"><i class="thumbtack icon"></i>chọn sẵn</a>
										</label>
										<select name="tongiao" class="tongiaochon selection ui dropdown " >
											<option value="">{{$hoso->tongiao}}</option>
											<option value="無" @if ($hosojp->tongiao == "無") selected @endif>無</option> {{--không--}}
											<option value="仏教" @if ($hosojp->tongiao == "仏教") selected @endif>仏教</option>  {{--phật--}}
											<option value="キリスト教" @if ($hosojp->tongiao == "キリスト教") selected @endif>キリスト教</option>  {{--thiên chúa--}}
										</select>
										<div  class="tongiaonhap">
											<input type="hidden" class="tongiaohidden" value="{{$hosojp->tongiao}}">
				
										</div>
									</div>
									<div class="field">
										<label>Mắt trái</label>
										<div class="ui input left icon">
											<i class="eye icon"></i>
											<input type="text" name="mattrai" value="{{$hosojp->mattrai}}" placeholder="{{ $hosojp->mattrai }}" data-content="{{$hoso->mattrai}}">
										</div>
									</div>
									<div class="field">
										<label>Mắt phải</label>
										<div class="ui input left icon">
											<i class="eye scale icon"></i>
											<input type="text" name="matphai" value="{{$hosojp->matphai}}" placeholder="{{ $hosojp->matphai }}" data-content="{{$hoso->matphai}}">
										</div>
									</div>
								</div>
							</div>	
							@php
								$sttht = 0;
								$hoctap = json_decode($hosojp->hoctap);
								if (isset($hoctap->thoigianbd) && $hoctap->thoigianbd != null) {
									$counthoctap = count($hoctap->thoigianbd);	
								}else{
									$counthoctap = 0;
								}
								if ($ehoctap) {
									$ehoctap = $ehoctap;
									$countehoctap = count($ehoctap);
								}else{
									$ehoctap = null;
									$countehoctap = 0;
								}	
								$j = 0;
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

								<h4 class="ui dividing header centered">QUÁ TRÌNH HỌC TẬP</h4>
								<div id="hoctap" data-count="1">
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
								@foreach ($ehoctap as $item)
								@if(($counthoctap -1) > $j)
									<div class="three fields" style=" margin: 0em -0.5em;">
										<div class="field">
											<div class="two fields">
												<div class="field">
													<div class="ui calendar">
														<div class="ui input left icon">
														  <i class="calendar icon"></i>
														  
														  @php
														  $vthoigianbd = "";
															  if(isset($hoctap->thoigianbd[$j]) && strlen($hoctap->thoigianbd[$j]) == 4){
																  $vthoigianbd = "09-".$hoctap->thoigianbd[$j];
															  }else{
																$vthoigianbd = $hoctap->thoigianbd[$j];
															  }
														  @endphp
														  <input type="text" name="thoigianhocbd[]"  @if (isset($hoctap->thoigianbd[$j])) value="{{$vthoigianbd}}"  @endif class="thoigianhocbd"  data-content="{{$item->thoigianbd}}" >
														</div>
													</div> 
												</div>								
					
												<div class="field">
													<div class="ui calendar">
														<div class="ui input left icon">
														  <i class="calendar icon"></i>

														  @php
														  $vthoigiankt = "";
															  if(isset($hoctap->thoigiankt[$j]) && strlen($hoctap->thoigiankt[$j]) == 4){
																  $vthoigiankt = "05-".$hoctap->thoigiankt[$j];
															  }else{
																$vthoigiankt = $hoctap->thoigiankt[$j];
															  }
														  @endphp
														  <input type="text" name="thoigianhockt[]"  @if (isset($hoctap->thoigiankt[$j])) value="{{$vthoigiankt}}"  @endif class="thoigianhockt" data-content="{{$item->thoigiankt}}">
														</div>
													</div> 
												</div>
							
											</div>
										</div>
										<div class="field">
											<div class="ui input left icon">
												<i class="building icon"></i>
												<input type="text" name="tentruong[]" @if (isset($hoctap->tentruong[$j])) value="{{khongdau($hoctap->tentruong[$j])}}"  @endif data-content="{{$item->tentruong}}">
											</div>	
										</div>							
										<div class="field">
											<div class="ui grid">
												<div class="twelve wide column">
													<div class="ui input left icon">
														<i class="map icon"></i>
														<input type="text" name="diachitruong[]" @if (isset($hoctap->diachitruong[$j])) value="{{khongdau($hoctap->diachitruong[$j])}}" @else value="{{khongdau($item->diachi)}}" @endif data-content="{{$item->diachi}}">
													</div>
												</div>
												<div class="four wide column">
													<select name="dctinh[]" class=" dc selection dropdown " >
														@if (isset($hoctap->dctinh[$j]))
															<option value="省" @if ($hoctap->dctinh[$j] == "省") selected @endif >省</option> 
															<option value="市" @if ($hoctap->dctinh[$j] == "市") selected @endif >市</option> 
															<option value=""></option> 
														@else
															<option value=""></option>
															<option value="省" >省</option> 
															<option value="市" >市</option>  
														@endif					
													</select>									
												</div>
											</div>
										</div>
									</div>
								@else
									<div class="three fields" style=" margin: 0em -0.5em;">
										<div class="field">
											<div class="two fields">
												<div class="field">
													<div class="ui calendar">
														<div class="ui input left icon">
														<i class="calendar icon"></i>
														<input type="text" name="thoigianhocbd[]"  value="09-{{$item->thoigianbd}}"  class="thoigianhocbd" data-content="{{$item->thoigianbd}}" >
														</div>
													</div> 
												</div>								
					
												<div class="field">
													<div class="ui calendar">
														<div class="ui input left icon">
														<i class="calendar icon"></i>
														<input type="text" name="thoigianhockt[]" value="05-{{$item->thoigiankt}}" class="thoigianhockt" data-content="{{$item->thoigiankt}}">
														</div>
													</div> 
												</div>
							
											</div>
										</div>
						
										<div class="field">
											<div class="ui input left icon">
												<i class="building icon"></i>
												@if ($j > 2) 
													<input type="text" name="tentruong[]" value="{{khongdau($item->tentruong)}}"  data-content="{{$item->tentruong}}">
												@else
													<input type="text" name="tentruong[]"  value="{{replace(khongdau($item->tentruong))}}" data-content="{{$item->tentruong}}">
												@endif
												
											</div>	
										</div>							
										<div class="field">
											<div class="ui grid">
												<div class="twelve wide column">
													<div class="ui input left icon">
														<i class="map icon"></i>
														<input type="text" name="diachitruong[]" @if (isset($hoctap->diachitruong[$j])) value="{{khongdau($hoctap->diachitruong[$j])}}" @else value="{{khongdau($item->diachi)}}" @endif data-content="{{$item->diachi}}">
													</div>
												</div>
												<div class="four wide column">
													<select name="dctinh[]" class=" dc selection dropdown " >
														@if (isset($hoctap->dctinh[$j]))
															<option value="省" @if ($hoctap->dctinh[$j] == "省") selected @endif >省</option> 
															<option value="市" @if ($hoctap->dctinh[$j] == "市") selected @endif >市</option> 
															<option value=""></option> 
														@else
															<option value=""></option>
															<option value="省" >省</option> 
															<option value="市" >市</option>  
														@endif					
													</select>									
												</div>
											</div>
										</div>
									</div>
								@endif
								@php
									$j++;
								@endphp
								@endforeach
									
									{{-- ///////////////////////// --}}
@if ($counthoctap > $countehoctap)
<div class="three fields" style=" margin: 0em -0.5em;">
		<div class="field">
			<div class="two fields">
				<div class="field">
					<div class="ui calendar" >
						<div class="ui input left icon">
						  <i class="calendar icon"></i>
						  <input type="text" class="thoigianhocbd" name="thoigianhocbd[]" value="{{$hoctap->thoigianbd[$counthoctap -1] }}" >
						</div>
					</div> 
				</div>								

				<div class="field">
					<div class="ui calendar" >
						<div class="ui input left icon">
						  <i class="calendar icon"></i>
						  <input type="text" name="thoigianhockt[]" value="{{$hoctap->thoigiankt[$counthoctap -1] }}" >
						</div>
					</div> 
				</div>
			</div>
		</div>
{{--  日本語教育センター --}}
		<div class="field">
			<div class="ui input left icon">
				<i class="building icon"></i>
				<input type="text" name="tentruong[]" value="{{$hoctap->tentruong[$counthoctap -1] }}">
			</div>	
		</div>							
		<div class="field">
			<div class="ui grid">
				<div class="twelve wide column">
					<div class="ui input left icon">
						<i class="map icon"></i>
						<input type="text" name="diachitruong[]" value="{{$hoctap->diachitruong[$counthoctap -1] }}">
					</div>
				</div>
				<div class="four wide column">
					
						<select name="dctinh[]" class=" dc selection dropdown " >
							<option value="市">市</option>  
							<option value="省">省</option> 
							<option value=""></option> 
						</select>							
				</div>
			</div>
		</div>
	</div>
@else
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
						  <input type="text" name="thoigianhockt[]" value="現在に至る">
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
							<option value=""></option> 
						</select>							
				</div>
			</div>
		</div>
	</div>
@endif
</div>
	{{-- /////////////////// --}}
								

<div class="ui grid">
	<div class="six wide column">
		{{-- nhat ngu --}}
		<h5 class="ui dividing header">NGOẠI NGỮ</h5>
		<div class="two fields">
		<div class="field">
			<label >CHỌN BÀI HỌC</label>
			<div class="ui input left icon select_nhatngu">
				<select name="" id="select_nhatngu" class="ui selection dropdown">
					<option value=" "></option>
					<option value="みんなの日本語 [カナ]">みんなの日本語 [カナ]</option>
					<option value="みんなの日本語 [第5課]">みんなの日本語 [第5課]</option>
				</select>
			</div>
		</div>
		<div class=" field">
			<label>NHẬT NGỮ</label>
			<div class="ui input left icon">
				<i class="language icon"></i>
				<input type="text" id="show_nhatngu" name="nhatngu" value="{{$hosojp->nhatngu}}"  data-content="{{$hoso->nhatngu}}">
			</div>
		</div>
		</div>
	</div>
	<div class="ten wide column">
		<h5 class="ui dividing header">Điểm IQ</h5>
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

{{-- --------------- --}}
								
<h4 class="ui dividing header centered">QUÁ TRÌNH LÀM VIỆC</h4>
@php
	$sttlv = 0;
	$lamviec = json_decode($hosojp->lamviec);
	if ($lamviec->thoigianbd != null) {
		$countlamviec = count($lamviec->thoigianbd);
	}else{
		$countlamviec = 0;
	}
	if ($elamviec) {
		$elamviec = $elamviec;
		$countelamviec = count($elamviec);
	}else{
		$elamviec = null;
		$countelamviec = 0;
	}		
@endphp
<div id="congviec" data-count="1">
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
	@foreach($elamviec as $elv)
	
	@if($countlamviec > $sttlv)
		<div class="three fields" style="margin:0em -0.5em;">
			<div class="field">	
				<div class="two fields">
					<div class="field">
						<div class="ui calendar">
							<div class="ui input left icon">
								<i class="calendar icon"></i>
								<input type="text" name="thoigianlamviecbd[]" value="{{$elv->thoigianbd}}"  >
							</div>
						</div> 
					</div>														
					<div class="field">
						<div class="ui calendar">
							<div class="ui input left icon">
								<i class="calendar icon"></i>
								<input type="text" name="thoigianlamvieckt[]" value="{{$elv->thoigiankt}}"  >
							</div>
						</div> 
					</div>
				</div>
			</div>
			<div class="field">
				<div class="ui input left icon">
					<i class="building icon"></i>
					<input type="text" name="tencongty[]" value="{{khongdau($lamviec->tencongty[$sttlv])}}" data-content="{{$elv->tencongty}}">
				</div>
			</div>
			<div class="field">
				<div class="ui input left icon">
					<i class="briefcase icon"></i>
					<input type="text" name="ndcongviec[]" value="{{khongdau($lamviec->ndcongviec[$sttlv])}}" data-content="{{$elv->congviec}}">
				</div>
			</div>
		</div>
		@else
		<div class="three fields" style="margin:0em -0.5em;">
			<div class="field">	
				<div class="two fields">
					<div class="field">
						<div class="ui calendar">
							<div class="ui input left icon">
								<i class="calendar icon"></i>
								<input type="text" name="thoigianlamviecbd[]" value="{{$elv->thoigianbd}}" data-content="{{$elv->thoigianbd}}" >
							</div>
						</div> 
					</div>														
					<div class="field">
						<div class="ui calendar">
							<div class="ui input left icon">
								<i class="calendar icon"></i>
								<input type="text" name="thoigianlamvieckt[]"  value="{{$elv->thoigiankt}}" data-content="{{$elv->thoigiankt}}" >
							</div>
						</div> 
					</div>
				</div>
			</div>
			<div class="field">
				<div class="ui input left icon">
					<i class="building icon"></i>
					<input type="text" name="tencongty[]" 
					value="{{khongdau($elv->tencongty)}}" data-content="{{$elv->tencongty}}">
				</div>
			</div>
			<div class="field">
				<div class="ui input left icon">
					<i class="briefcase icon"></i>
					<input type="text" name="ndcongviec[]" 
					value="{{khongdau($elv->congviec)}}" data-content="{{$elv->congviec}}">
				</div>
			</div>
		</div>
		@endif
		@php 
			++$sttlv;
		@endphp
	@endforeach
</div>
{{-- ------------------- --}}

<h4 class="ui dividing header centered">NGƯỜI THÂN TẠI NHẬT <i class="plus icon blue add_plus"></i></h4>
	<div id="ttnguoithan" data-count="1" > 			
	@if ($hosojp->nguoithan )
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
	@php
		$sttnt = 0;
		$nguoithan = json_decode($hosojp->nguoithan);
		if ($nguoithan->hoten != null) {
			$countnguoithan = count($nguoithan->hoten);
		}else{
			$countnguoithan = 0;
		}
		if ($enguoithan) {
			$enguoithan = $enguoithan;
			$countenguoithan = count($enguoithan);
		}else{
			$enguoithan = null;
			$countenguoithan = 0;
		}		
	@endphp
		
			
			
			@for ($sttnt = 0; $sttnt < $countnguoithan; $sttnt++)
				
			@if ($nguoithan->hoten[$sttnt] != null)
				
			
				<div class="three fields" style="margin:1em -0.5em;">
					<div class="field">	
						<div class="field">
							<div class="ui calendar">
								<div class="ui input left icon">
									<i class="calendar icon"></i>
									<input type="text" name="hotennguoithan[]"  value="{{khongdau($nguoithan->hoten[$sttnt])}}"
										> 
								</div>
							</div> 
						</div>														
					</div>
					<div class="field">
						<div class="ui input left icon">
							<i class="building icon"></i>
							<input type="text" name="tuoinguoithan[]" value="{{khongdau($nguoithan->tuoi[$sttnt])}}" 
								>
						</div>
					</div>
					<div class="field">
						<div class="ui input left icon">
							<i class="briefcase icon"></i>
							<input type="text" name="quanhenguoithan[]" value="{{khongdau($nguoithan->quanhe[$sttnt])}}"
							>
						</div>
					</div>
				</div>
				@endif
				@endfor
		
		@else			
			<div id="ttnguoithan-1" class="three fields">
				<div class="field">
					<label>Họ và Tên</label>
				</div>
				<div class="field">
					<label>Tuổi</label>
				</div>
				<div class="field">
					<label>Quan hệ</label>
				</div>
			</div>
		@endif
	</div>
		
			
	
		{{-- ------------------- --}}
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
			<textarea rows="3" name="mucdich" id="show_mucdich" data-content="{{$hoso->mucdich}}" placeholder="{{khongdau($hoso->mucdich)}}">{{ $hosojp->mucdich }}</textarea>
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
			<textarea rows="3" name="muctieu" id="show_muctieu" data-content="{{$hoso->muctieu}}" placeholder="{{khongdau($hoso->muctieu)}}">{{ $hosojp->muctieu }}</textarea>
		</div>
	</div>
	<h4 class="ui dividing header centered">KHÁC</h4>
	<div class="two fields">
		<div class="field">
			<label>Sở thích</label>
			<textarea rows="3" name="sothich" placeholder="Nội dung..." data-content="{{$hoso->sothich}}">{{ $hosojp->sothich}}</textarea>
		</div>
		<div class="field">
			<label>Điểm mạnh</label>
			<textarea rows="3" name="diemmanh" placeholder="Nội dung..." data-content="{{$hoso->diemmanh}}">{{ $hosojp->diemmanh }}</textarea>
		</div>
	</div>
	@php									 
		$sttgd = 0;
		$giadinh = json_decode($hosojp->giadinh);
		if ($giadinh->quanhe != null) {
			$countgiadinh = count($giadinh->quanhe);
		}else{
			$countgiadinh = 0;
		}
		if ($egiadinh) {
			$egiadinh = $egiadinh;
			$countegiadinh = count($egiadinh);
		}else{
			$egiadinh = null;
			$countegiadinh = 0;
		}		
	@endphp
	
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

		@foreach($egiadinh as $egd)
		@if($countgiadinh > $sttgd)
			<div class="three fields" style="margin-top: 10px; margin-bottom: 10px;">
				<div class="field two wide column">
					<input type="text" name="quanhegiadinh[]" value="{{$giadinh->quanhe[$sttgd]}}" data-content="{{$egd->quanhe}}">	
				</div>
				<div class="field four wide column">
					<input type="text" name="hotengiadinh[]" value="{{khongdau($giadinh->hoten[$sttgd])}}" data-content="{{$egd->hoten}}">
				</div>
				<div class="field two wide column">									
					<div class="ui calendar" id="namsinhgd">
							<input type="text" class="namsinhgiadinh" name="namsinhgiadinh[]" value="{{khongdau($giadinh->namsinh[$sttgd])}}" data-content="{{$egd->namsinh}}">
					</div>
				</div>
				<div class="field two wide column">
					<input type="text" name="congviecgiadinh[]" value="{{khongdau($giadinh->congviec[$sttgd])}}" data-content="{{$egd->congviec}}">
				</div>
				<div class="field four wide column">
					<div class="ui grid">
						<div class="ten wide column">
							<input type="text" name="noilamviecgiadinh[]" value="{{$giadinh->noilam[$sttgd]}}" data-content="{{$egd->noilamviec}}">
						</div>
						<div class="six wide column">
						@if (isset($giadinh->dctinh[$sttgd]))
							<select name="gdtinhplus[]" class=" gd selection dropdown " >
								<option value="省" @if ($giadinh->dctinh[$sttgd] == "省") selected @endif>省</option> 
								<option value="市" @if ($giadinh->dctinh[$sttgd] == "市") selected @endif>市</option>  
								<option value=""></option>
							</select>
						@else
							<select name="gdtinhplus[]" class=" gd selection dropdown " >
								<option value=""></option>
								<option value="省">省</option> 
								<option value="市">市</option>  
								<option value=""></option>  
							</select>
						@endif
						</div>
					</div>
				</div>
				<div class="field two wide column">
					<input type="text" class="thunhap" name="thunhapgiadinh[]" value="{{$giadinh->thunhap[$sttgd]}}" data-content="{{$egd->luong}}">
				</div>												
			</div>
		@else
			<div class="three fields" style="margin-top: 10px; margin-bottom: 10px">
				<div class="field two wide column">
					<input type="text" name="quanhegiadinh[]" value="{{$egd->quanhe}}" data-content="{{$egd->quanhe}}">	
				</div>
				<div class="field four wide column">
					<input type="text" name="hotengiadinh[]" value="{{khongdau($egd->hoten)}}" data-content="{{$egd->hoten}}">
				</div>
				<div class="field two wide column">									
					<div class="ui calendar" id="namsinhgd">
						<input type="text" class="namsinhgiadinh" name="namsinhgiadinh[]" value="{{$egd->namsinh}}" data-content="{{$egd->namsinh}}">
					</div>
				</div>										
				<div class="field two wide column">
					<input type="text" name="congviecgiadinh[]" value="{{khongdau($egd->congviec)}}" data-content="{{$egd->congviec}}">
				</div>
				<div class="field four wide column">
					<div class="ui grid">
						<div class="ten wide column">
							<input type="text" name="noilamviecgiadinh[]" value="{{khongdau($egd->noilamviec)}}" data-content="{{$egd->noilamviec}}">
						</div>
						<div class="six wide column">
							<select name="gdtinhplus[]" class=" gd selection dropdown " >
								<option value=""></option>
								<option value="省">省</option> 
								<option value="市">市</option>  
								<option value=""></option>  
							</select>
						</div>
					</div>
				</div>
				<div class="field two wide column">
					<input type="text" class="thunhap" name="thunhapgiadinh[]" value="{{$egd->luong}}" data-content="{{$egd->luong}}">
				</div>												
			</div>
		@endif
		@php 
			++$sttgd;
		@endphp
		@endforeach
	</div>			
	<div class="inline field">
		<label>(*) Vui lòng nhập đầy đủ thông tin</label>
	</div>
</div>

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
	$("#namsinhgd").calendar({
		type: 'year'
	});		
</script>	
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
// $(".honnhannutchon").hide();
$(".honnhan").on('click','.honnhannutnhap',function(e){
	$('.honnhannhap').html('<input type="text" name="honnhan" placeholder="Hôn nhân">');
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
var valuehonnhan = $(".honnhanhidden").val();
if ((valuehonnhan == "独身") || (valuehonnhan == "既婚") || (valuehonnhan == "離婚") ) {
	$('.honnhannhap').empty();
	$(".honnhanchon").show();
	$(".honnhannutchon").hide();
	$(".honnhannutnhap").show();
}else{
	$('.honnhannhap').html('<input type="text" name="honnhan" placeholder="Hôn nhân" value="'+valuehonnhan+'">');
	$(".honnhanchon").hide();
	$(".honnhannutnhap").hide();
	$(".honnhannutchon").show();
}
//独身, 既婚, 離婚 => doc than, ket hon, ly hon
// nhập liệu tôn giáo
//$(".tongiaonutchon").hide();
$(".tongiao").on('click','.tongiaonutnhap',function(e){
	$('.tongiaonhap').html('<input type="text" name="tongiao" placeholder="Tôn giáo">');
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
var valuetongiao = $(".tongiaohidden").val();
if ((valuetongiao == "無") || (valuetongiao == "仏教") || (valuetongiao == "キリスト教") ) {
	$('.tongiaonhap').empty();
	$(".tongiaochon").show();
	$(".tongiaonutchon").hide();
	$(".tongiaonutnhap").show();
}else{
	$('.tongiaonhap').html('<input type="text" name="tongiao" placeholder="Tôn giáo" value="'+valuetongiao+'">');
	$(".tongiaochon").hide();
	$(".tongiaonutnhap").hide();
	$(".tongiaonutchon").show();
}
// 無, 仏教, キリスト教 => không, phật, thiên chúa

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
$(".namsinhgiadinh").inputmask({ alias: "datetime", inputFormat: "yyyy"});		
$(".thunhap").inputmask("numeric", { radixPoint: ".", groupSeparator: ",",digits: 2, autoGroup: true, rightAlign: false,oncleared: function () { self.Value(''); }});					
</script>
@endsection
@section('JsLibraries')
  <script src="{{url('js/admin/hoso/add_hoso.js')}}"></script>
@endsection