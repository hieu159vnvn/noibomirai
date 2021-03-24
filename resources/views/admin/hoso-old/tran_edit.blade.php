@extends('admin.master')
@section('title', 'Sửa Dịch sang tiếng Nhật')
@section('PageContent')
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
	     	<div class="ui segment">
				<div class="ui column centered main-content">	
					<div class="column">
							<div class="infohead">
								<p>
									<b>Ngày sinh: <span class="ui teal label">{{date_format(date_create($hoso->ngaysinh), "d-m-Y")}}</span></b> 
									<b>Điện thoại:  <span class="ui teal label">{{$hoso->dienthoai}}</span></b>
								</p>				
							</div>
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
										<div class="four wide field">
											<label>Địa chỉ hộ khẩu (*)</label>
											<div class="ui input left icon">
												<i class="map outline icon"></i>
												<input type="text" name="diachi" value="{{ khongdau($hosojp->diachi)}}" data-content="{{$hoso->diachi}}" >
											</div>
										</div>
										<div class="field">
											<label>Địa chỉ miền</label>
											<select name="diachimien" class="selection ui dropdown " >
												<option value="南部" @if ($hosojp->diachimien == "南部") selected @endif >南部</option> {{--miền nam--}}
												<option value="中部" @if ($hosojp->diachimien == "中部") selected @endif >中部</option>  {{--miền trung--}}
												<option value="北部" @if ($hosojp->diachimien == "北部") selected @endif >北部</option>  {{--miền bắc--}}
											</select>	
										</div>
									</div>
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
								{{-- ////////////////////// --}}
								@php									
									$j = 0;
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
								@foreach ($ehoctap as $item)
								<div class="three fields" style=" margin: 0em -0.5em;">
										<div class="field">
											<div class="two fields">
												<div class="field">
													<div class="ui calendar">
														<div class="ui input left icon">
														  <i class="calendar icon"></i>
														  <input type="text" name="thoigianhocbd[]"  value="{{$item->thoigianbd}}" @if ($j < $countehoctap) readonly @else class="thoigianhocbd"  @endif >
														</div>
													</div> 
												</div>								
					
												<div class="field">
													<div class="ui calendar">
														<div class="ui input left icon">
														  <i class="calendar icon"></i>
														  <input type="text" name="thoigianhockt[]" value="{{$item->thoigiankt}}" @if ($j < $countehoctap) readonly @endif>
														</div>
													</div> 
												</div>
							
											</div>
										</div>
						
										<div class="field">
											<div class="ui input left icon">
												<i class="building icon"></i>
												<input type="text" name="tentruong[]"  value="{{$hoctap->tentruong[$j]}}" @if ($j < $countehoctap) data-content="{{$item->tentruong}}" @endif>
											</div>	
										</div>							
										<div class="field">
											<div class="ui grid">
												<div class="twelve wide column">
													<div class="ui input left icon">
														<i class="map icon"></i>
														<input type="text" name="diachitruong[]" @if (isset($hoctap->diachitruong[$j])) value="{{khongdau($hoctap->diachitruong[$j])}}" @endif data-content="{{$item->diachi}}">
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
				<input type="text" name="tentruong[]" value="Miraihuman">
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

	{{-- /////////////////// --}}
								</div>

								<div class="ui grid">
									<div class="six wide column">
										{{-- nhat ngu --}}
										<h5 class="ui dividing header">NGOẠI NGỮ</h5>
										<div class="field">
											<label>NHẬT NGỮ</label>
											<div class="ui input left icon">
												<i class="heartbeat icon"></i>
												<input type="text" name="nhatngu" value="{{$hosojp->nhatngu}}"  placeholder="{{ $hoso->nhatngu }}" data-content="{{$hoso->nhatngu}}">
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
								<h4 class="ui dividing header centered">QUÁ TRÌNH LÀM VIỆC</h4>
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
														      <input type="text" name="thoigianlamviecbd[]" value="{{$elv->thoigianbd}}" readonly>
														    </div>
													    </div> 
												    </div>														
													<div class="field">
														<div class="ui calendar">
														    <div class="ui input left icon">
														      <i class="calendar icon"></i>
														      <input type="text" name="thoigianlamvieckt[]" value="{{$elv->thoigiankt}}" readonly>
														    </div>
													    </div> 
													</div>
												</div>
											</div>
											<div class="field">
												<div class="ui input left icon">
													<i class="building icon"></i>
													<input type="text" name="tencongty[]" value="{{khongdau($lamviec->tencongty[$sttlv])}}" 
													 data-content="{{$elv->tencongty}}">
												</div>
											</div>
											<div class="field">
												<div class="ui input left icon">
													<i class="briefcase icon"></i>
													<input type="text" name="ndcongviec[]" value="{{khongdau($lamviec->ndcongviec[$sttlv])}}"
													 data-content="{{$elv->congviec}}">
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
														      <input type="text" name="thoigianlamviecbd[]" value="{{$elv->thoigianbd}}" readonly>
														    </div>
													    </div> 
												    </div>														
													<div class="field">
														<div class="ui calendar">
														    <div class="ui input left icon">
														      <i class="calendar icon"></i>
														      <input type="text" name="thoigianlamvieckt[]"  value="{{$elv->thoigiankt}}" readonly>
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
	@if ($hoso->conguoithantainhat == "1" && $hosojp->nguoithan )
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
			<h4 class="ui dividing header centered">NGƯỜI THÂN TẠI NHẬT</h4>
			<div id="nguoithan" data-count="1">
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
				@foreach($enguoithan as $ent)
				
				@if($countnguoithan > $sttnt)
					<div class="three fields" style="margin:1em -0.5em;">
						<div class="field">	
							<div class="field">
								<div class="ui calendar">
									<div class="ui input left icon">
										<i class="calendar icon"></i>
										<input type="text" name="hotennguoithan[]"  value="{{khongdau($nguoithan->hoten[$sttnt])}}"
										data-content="{{$ent->hoten}}" > 
									</div>
								</div> 
							</div>														
						</div>
						<div class="field">
							<div class="ui input left icon">
								<i class="building icon"></i>
								<input type="text" name="tuoinguoithan[]" value="{{khongdau($nguoithan->tuoi[$sttnt])}}" 
									data-content="{{$ent->tuoi}}">
							</div>
						</div>
						<div class="field">
							<div class="ui input left icon">
								<i class="briefcase icon"></i>
								<input type="text" name="quanhenguoithan[]" value="{{khongdau($nguoithan->quanhe[$sttnt])}}"
									data-content="{{$ent->quanhe}}">
							</div>
						</div>
					</div>
					@else
					<div class="three fields" style="margin:1em -0.5em;">
						<div class="field">
							<div class="ui calendar">
								<div class="ui input left icon">
									<i class="calendar icon"></i>
									<input type="text" name="hotennguoithan[]" value="{{$ent->hoten}}" data-content="{{$ent->hoten}}">
								</div>
							</div> 
						</div>																
						<div class="field">
							<div class="ui input left icon">
								<i class="building icon"></i>
								<input type="text" name="tuoinguoithan[]" 
								value="{{khongdau($ent->tuoi)}}" data-content="{{$ent->tuoi}}">
							</div>
						</div>
						<div class="field">
							<div class="ui input left icon">
								<i class="briefcase icon"></i>
								<input type="text" name="quanhenguoithan[]" 
								value="{{khongdau($ent->quanhe)}}" data-content="{{$ent->quanhe}}">
							</div>
						</div>
					</div>
					@endif
					@php 
						++$sttnt;
					@endphp
				@endforeach
			</div>
			@endif
		{{-- ------------------- --}}
								<h4 class="ui dividing header centered">THỰC TẬP KỸ NĂNG Ở NHẬT</h4>
								<div class="two fields thuctap">
									<div class="field">
										<label>Mục đích đi Nhật</label>
										<textarea rows="3" name="mucdich" data-content="{{$hoso->mucdich}}" placeholder="{{khongdau($hoso->mucdich)}}">{{ $hosojp->mucdich }}</textarea>
									</div>
									<div class="field">
										<label>Mục tiêu sau khi về nước</label>
										<textarea rows="3" name="muctieu" data-content="{{$hoso->muctieu}}" placeholder="{{khongdau($hoso->muctieu)}}">{{ $hosojp->muctieu }}</textarea>
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
												      <input type="text" name="namsinhgiadinh[]" value="{{$egd->namsinh}}" readonly>
												</div>
											</div>
											<script type="text/javascript">	
												$("#namsinhgd").calendar({
												  type: 'year'
												});		
											</script>	
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
															</select>
														@endif

														</div>
												</div>
											</div>
											<div class="field two wide column">
												<input type="text" name="thunhapgiadinh[]" value="{{$egd->luong}}" readonly>
											</div>												
										</div>
										@else
										{{-- <div class="two fields" style="margin-top: 10px; margin-bottom: 10px">

											<div class="field two wide column">
												<input type="text" name="quanhegiadinh[]" value="{{$egd->quanhe}}" data-content="{{$egd->quanhe}}">	
											</div>
											<div class="field four wide column">
												<input type="text" name="hotengiadinh[]" value="{{khongdau($egd->hoten)}}" data-content="{{$egd->hoten}}">
											</div>
											<div class="field two wide column">									
												<div class="ui calendar" id="namsinhgd">
												      <input type="text" name="namsinhgiadinh[]" value="{{$egd->namsinh}}" readonly>
												</div>
											</div>
											<script type="text/javascript">	
												$("#namsinhgd").calendar({
												  type: 'year'
												});		
											</script>	
											<div class="field two wide column">
												<input type="text" name="congviecgiadinh[]" value="{{khongdau($egd->congviec)}}" data-content="{{$egd->congviec}}">
											</div>
											<div class="field three wide column">
												<input type="text" name="noilamviecgiadinh[]" value="{{khongdau($egd->noilamviec)}}" data-content="{{$egd->noilamviec}}">
											</div>
											<div class="field three wide column">
												<input type="text" name="thunhapgiadinh[]" value="{{$egd->luong}}" readonly>
											</div>												
										</div> --}}
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
	$(".thoigianhocbd,.thoigianhockt,.namsinhgiadinh").inputmask({ alias: "datetime", inputFormat: "mm-yyyy"});							
</script>
@endsection
@section('JsLibraries')
  {{-- <script src="{{url('js/admin/hoso/add_hoso.js')}}"></script> --}}
@endsection