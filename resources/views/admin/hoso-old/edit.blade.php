@extends('admin.master')
@section('title', 'Sửa Học Viên')
@section('PageContent')
<link rel="stylesheet" type="text/css" href="{{url('libraries/croper/croppie.css')}}">
<script src="{{url('libraries/croper/croppie.js')}}"></script>

	<h2 class="ui header center aligned">
    HỒ SƠ HỌC VIÊN 
    <div class="sub header">
      Chỉnh sửa : {{$hoso->hoten}}
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
	<form class="ui form" action="" method="post" name="form_1" autocomplete="off" enctype="multipart/form-data">
	{{ csrf_field() }}
		<div class="ui segments">
	        <div class="ui segment">

	          <div class="ui secondary menu">
	          	<div class="left menu">
					<a class="item">
                    <a href="{{url('/hoso/testmiss')}}" class="ui labeled icon red button"><i class="arrow left icon"></i>Kiểm Tra</a>
                  </a>
	          	</div>
	              <div class="right menu">
			        <a href="{{url('/hoso')}}" class="ui labeled icon button"><i class="arrow left icon"></i>Danh Sách</a>
				<button type="submit" class="ui labeled icon button green"><i class="save icon"></i>Lưu</button>
	              </div>
	            </div>
	     	</div>
	     	<div class="ui segment">
				<div class="ui column centered main-content">	
					<div class="column">
						<div class="ui top attached tabular menu">
						  <a class="item active" data-tab="soyeulylich">Sơ yếu lý lịch</a>						  
						  <a class="item" data-tab="thongtin">Thông tin bổ sung</a>
						</div>
			{{-- TIENG VIET --}}
						<div class="ui bottom attached tab segment active" data-tab="soyeulylich">			
							
								<h3 class="ui header centered blue">SƠ YẾU LÝ LỊCH</h3>

								<div class="ui steps">
								    <div class="step">
									    <img width="70" id="upload-demo-img" @if($hoso->hinhanh) src="{{$hoso->hinhanh}}" @else src="/images/admin/avatar.png"  @endif>
										<input type="hidden" id="feature-image" name="featureImage" value="{{$hoso->hinhanh}}">									
								    </div>
								</div>	
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
								<h4 class="ui dividing header centered">THÔNG TIN CÁ NHÂN</h4>
								<div class="field thongtin">			
								<div class="four fields">
									<div class="field">
										<label>Họ và tên (*)</label>
										<div class="ui input left icon">							
										<i class="user icon"></i>
										<input type="text" name="hoten" value="{{$hoso->hoten}}" required>
										</div>
									</div>
									<div class="field">
										<label>Ngày sinh (*)</label>
										<div class="ui calendar">
										    <div class="ui input left icon">
										      <i class="calendar icon"></i>
										      <input id="ngaysinh" type="text" name="ngaysinh" value="{{date_format(date_create($hoso->ngaysinh), "d-m-Y")}}" required>
										    </div>
										</div>
									</div>
									
									<div class="field @if($hoso->dienthoai == null) error @endif">
										<label>Điện thoại (*)</label>
										<div class="ui input left icon">
											<i class="mobile alternate icon"></i>
											<input type="text" id="phone" name="dienthoai" value="{{$hoso->dienthoai }}">
										</div>
									</div>
									<div class="field @if($hoso->dtnguoithan == null) error @endif">
										<label>ĐT người thân</label>
										<div class="ui input left icon">
											<i class="mobile alternate icon"></i>
											<input type="text" id="phone1" name="dtnguoithan" value="{{$hoso->dtnguoithan}}">
										</div>
									</div>
								</div>
								<div class="three fields">
									<div class="field">
										<div class="two fields">
											<div class="eleven wide field  @if($hoso->noisinh == null) error @endif">
												<label>Nơi sinh (*)</label>
												<div class="ui input left icon">
													<i class="map marker alternate icon"></i>
													<input type="text" name="noisinh" value="{{$hoso->noisinh}}">
												</div>
											</div>
											<div class="five wide field  @if($hoso->mien == null) error @endif">
												<label>Miền</label>
												 <select name="mien">
												 	<option value="{{$hoso->mien}}">{{$hoso->mien}}</option>						 
										      		<option value="Bắc">Bắc</option>
										      		<option value="Trung">Trung</option>
										      		<option value="Nam">Nam</option>						      	
											    </select>
											</div>
										</div>
									</div>
									<div class="seven wide field  @if($hoso->diachi == null) error @endif">
										<label>Địa chỉ hộ khẩu (*)</label>
										<div class="ui input left icon">
											<i class="map outline icon"></i>
											<input type="text" name="diachi" value="{{ $hoso->diachi }}">
										</div>
									</div>
									<div class="four wide field">
										<label>Tình thành</label>
										 <select name="tinhthanh">
									      	@foreach($city as $ct)
									      		@if($ct->id == $hoso->tinhthanh)
									      		<option value="{{$ct->id}}">{{$ct->ten}}</option>
									      		@endif
									      	@endforeach
									      	@foreach($city as $ct)
									      		<option value="{{$ct->id}}">{{$ct->ten}}</option>
									      	@endforeach
									    </select>
									</div>
								</div>
								
								<div class="four fields">
									<div class="field ">
										<label>Giới tính</label>
									    <select name="gioitinh">
									    	@if($hoso->gioitinh == 0)
									    		<option value="0">Nữ</option>
									    	@else	
									    		<option value="1">Nam</option>
									    	@endif
										     	<option value="1">Nam</option>
										     	<option value="0">Nữ</option>
									    </select>						    
									</div>
									<div class="field @if($hoso->honnhan == null) error @endif">
										<label>Hôn nhân</label>
										<div class="ui input left icon">
											<i class="heart icon"></i>
											<input type="text" name="honnhan" value="{{ $hoso->honnhan }}">
										</div>
									</div>
									<div class="field @if($hoso->benhan == null) error @endif">
										<label>Bệnh án</label>
										<div class="ui input left icon">
											<i class="heartbeat icon"></i>
											<input type="text" name="benhan" value="{{ $hoso->benhan }}">
										</div>
									</div>
									<div class="field @if($hoso->tongiao == null) error @endif">
										<label>Tôn giáo</label>
										<div class="ui input left icon">
											<i class="balance scale icon"></i>
											<input type="text" name="tongiao" value="{{ $hoso->tongiao }}">
										</div>
									</div>
								</div>
								<div class="five fields">
									<div class="field @if($hoso->chieucao == null) error @endif">
										<label>Chiều cao</label>						
										<div class="ui right labeled input">
											<input type="number" name="chieucao" value="{{ $hoso->chieucao }}">
											<div class="ui basic label">
										    cm
										  	</div>
									 	</div>
									</div>
									<div class="field @if($hoso->cannang == null) error @endif">
										<label>Cân nặng</label>
										<div class="ui right labeled input">
											<input type="number" name="cannang" value="{{ $hoso->cannang }}">
											<div class="ui basic label">
										    kg
										  	</div>
									 	</div>						
									</div>	
									<div class="field @if($hoso->nhommau == null) error @endif">
										<label>Nhóm máu</label>
										<select name="nhommau">
											@if($hoso->nhommau == 'A')
												<option value="A">A</option>
											@elseif($hoso->nhommau == 'B')
												<option value="B">B</option>
											@elseif($hoso->nhommau == 'AB')
												<option value="AB">AB</option>
											@elseif($hoso->nhommau == 'O')
												<option value="O">O</option>
											@endif
											<option value=""></option>											
											<option value="A">A</option>
											<option value="B">B</option>
											<option value="AB">AB</option>
											<option value="O">O</option>
										</select>
									</div>				
									<div class="field @if($hoso->mattrai == null) error @endif">
										<label>Thị lực (trái)</label>
										<div class="ui input left icon">
											<i class="eye icon"></i>
											<input type="text" name="mattrai" value="{{ $hoso->mattrai }}">
										</div>
									</div>
									<div class="field @if($hoso->matphai == null) error @endif">
										<label>Thị lực (phải)</label>
										<div class="ui input left icon">
											<i class="eye icon"></i>
											<input type="text" name="matphai" value="{{ $hoso->matphai }}">
										</div>
									</div>
								</div>
							</div>	
								<h4 class="ui dividing header centered">TAY THUẬN</h4>
								<div class="four fields taythuan">
								    <div class="field">
								    	<div class="ui labeled input">
											  <div class="ui label">
											  Công việc
											  </div>
									        <select name="congviec">
									        	@if($hoso->congviec == 0)
									        		<option value="0">Phải</option>
									        	@else
									        		<option value="1">Trái</option>
									        	@endif
										        <option value="0">Phải</option>
										        <option value="1">Trái</option>
										    </select>
										</div>
								    </div>
								    <div class="field">
								    	<div class="ui labeled input">
											<div class="ui label">
											Đũa
											</div>
									        <select name="dua">
									        	@if($hoso->dua == 0)
									        		<option value="0">Phải</option>
									        	@else
									        		<option value="1">Trái</option>
									        	@endif
										        <option value="0">Phải</option>
										        <option value="1">Trái</option>
										    </select>
										</div>
								    </div>
								    <div class="field">
								    	<div class="ui labeled input">
											<div class="ui label">
											  Kéo
											</div>
									        <select name="keo">
									        	@if($hoso->keo == 0)
									        		<option value="0">Phải</option>
									        	@else
									        		<option value="1">Trái</option>
									        	@endif
										        <option value="0">Phải</option>
										        <option value="1">Trái</option>
										    </select>
										</div>
								    </div>
								    <div class="field">
								    	<div class="ui labeled input">
											<div class="ui label">
											Viết
											</div>
									        <select name="viet">
									        	@if($hoso->viet == 0)
									        		<option value="0">Phải</option>
									        	@else
									        		<option value="1">Trái</option>
									        	@endif
										        <option value="0">Phải</option>
										        <option value="1">Trái</option>
										    </select>
										</div>
								    </div>
								</div>
								<h4 class="ui dividing header centered">QUÁ TRÌNH HỌC TẬP</h4>
								<div id="hoctap" data-count="{{count($hoctap)+1}}">
								<div class="three fields " >
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
								@foreach($hoctap as $key => $ht)
								<div id="hoctap-{{$key+1}}" class="three fields " style=" margin: 0em -0.5em;">
									<div class="field ">
										<div class="two fields">
											<div class="field">
												<div class="ui calendar">
												    <div class="ui input left icon">
												      <i class="calendar icon"></i>
												      <input class="thoigianhocbd" type="text"  name="thoigianhocbd[]" value="{{$ht->thoigianbd}}" >
												    </div>
											    </div> 
										    </div>												
											<div class="field">
												<div class="ui calendar" id="thoigiankt">
												    <div class="ui input left icon">
												      <i class="calendar icon"></i>
												      <input type="text" class="thoigianhockt" name="thoigianhockt[]" value="{{$ht->thoigiankt}}">
												    </div>
											    </div> 
											</div>
										</div>
									</div>
									<div class="field">
										<div class="ui input left icon">
											<i class="building icon"></i>
											<input type="text" name="tentruong[]" value="{{$ht->tentruong}}">
										</div>	
									</div>
									<div class="field">
										<div class="ui input left icon">
											<i class="map icon"></i>
											<input type="text" name="diachitruong[]" value="{{$ht->diachi}}">
										</div>
									</div>
									<i class="trash alternate icon red trash_hoctap"></i>

								</div>
								@endforeach
								<div id="hoctap-{{count($hoctap) + 1}}" class="three fields @if(count($hoctap)<=0) error @endif" style=" margin: 0em -0.5em;">
									<div class="field ">	
										<div class="two fields">
											<div class="field">
												<div class="ui calendar" class="thoigianbd">
												    <div class="ui input left icon">
												      <i class="calendar icon"></i>
												      <input type="text" class="thoigianhocbd" name="thoigianhocbd[]">
												    </div>
											    </div> 
										    </div>													
											<div class="field">
												<div class="ui calendar" id="thoigiankt">
												    <div class="ui input left icon">
												      <i class="calendar icon"></i>
												      <input type="text" class="thoigianhockt" name="thoigianhockt[]">
												    </div>
											    </div> 
											</div>
										</div>
									</div>
									<div class="field">
										<div class="ui input left icon">
											<i class="building icon"></i>
											<input type="text" name="tentruong[]">
										</div>	
									</div>
									<div class="field">
										<div class="ui input left icon">
											<i class="map icon"></i>
											<input type="text" name="diachitruong[]">
										</div>
									</div>
									<i class="plus icon blue add_truong"></i>
								</div> 
								</div>
								<h4 class="ui dividing header centered">QUÁ TRÌNH LÀM VIỆC</h4>
								<div id="congviec" data-count="{{count($lamviec)}}">
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
										<div id="congviec-{{$key+1}}" class="three fields" style=" margin: 0em -0.5em;">
											<div class="field">	
												<div class="two fields">
													<div class="field">
														<div class="ui calendar" id="thoigianlamviecbd-{{$key+1}}">
														    <div class="ui input left icon">
														      <i class="calendar icon"></i>
														      <input type="text" class="thoigianlamviecbd" name="thoigianlamviecbd[]" value="{{$lv->thoigianbd}}">
														    </div>
													    </div> 
												    </div>														
													<div class="field">
														<div class="ui calendar" id="thoigianlamvieckt-{{$key+1}}">
														    <div class="ui input left icon">
														      <i class="calendar icon"></i>
														      <input type="text" class="thoigianlamvieckt" name="thoigianlamvieckt[]" value="{{$lv->thoigiankt}}">
														    </div>
													    </div> 
													</div>
												</div>
											</div>
											<div class="field">
												<div class="ui input left icon">
													<i class="building icon"></i>
													<input type="text" name="tencongty[]" value="{{$lv->tencongty}}">
												</div>
											</div>
											<div class="field">
												<div class="ui input left icon">
													<i class="briefcase icon"></i>
													<input type="text" name="ndcongviec[]" value="{{$lv->congviec}}">
												</div>
											</div>
											<i class="trash alternate icon red trash_congviec"></i>
										</div>

									@endforeach
										<div id="congviec-{{count($lamviec)+1}}" class="three fields  @if(count($lamviec) <=0) error @endif" style=" margin: 0em -0.5em;">
											<div class="field">	
												<div class="two fields">
													<div class="field">
														<div class="ui calendar" id="thoigianlamviecbd-{{count($lamviec)+1}}">
														    <div class="ui input left icon">
														      <i class="calendar icon"></i>
														      <input type="text" class="thoigianlamviecbd" name="thoigianlamviecbd[]">
														    </div>
													    </div> 
												    </div>														
													<div class="field">
														<div class="ui calendar" id="thoigianlamvieckt-{{count($lamviec)+1}}">
														    <div class="ui input left icon">
														      <i class="calendar icon"></i>
														      <input type="text" class="thoigianlamvieckt" name="thoigianlamvieckt[]">
														    </div>
													    </div> 
													</div>
												</div>
											</div>
											<div class="field">
												<div class="ui input left icon">
													<i class="building icon"></i>
													<input type="text" name="tencongty[]">
												</div>
											</div>
											<div class="field">
												<div class="ui input left icon">
													<i class="briefcase icon"></i>
													<input type="text" name="ndcongviec[]">
												</div>
											</div>
											<i class="plus icon blue add_congviec"></i>
										</div>
								</div>

								<h4 class="ui dividing header centered">NGOẠI NGỮ</h4>
								<div class="three fields ngoaingu">
								    <div class="field">
								    	<label>Anh ngữ</label>
								        <select name="anhngu">
								        	@if($hoso->anhngu == 0)
									        	<option value="0">Không</option>
											@elseif($hoso->anhngu == 1)
									        	<option value="1">Bằng A</option>
									        @elseif($hoso->anhngu == 2)
									        	<option value="2">Bằng B</option>
									        @elseif($hoso->anhngu == 3)	
									        	<option value="3">Bằng C</option>						    
									        @endif
									        <option value="0">Không</option>
											<option value="1">Bằng A</option>
											<option value="2">Bằng B</option>
											<option value="3">Bằng C</option>
										</select>
								    </div>
								    <div class="field  @if($hoso->nhatngu == null) error @endif">
								    	<label>Nhật ngữ</label>
								        <input type="text" name="nhatngu" value="{{ $hoso->nhatngu }}">
								    </div>
								    <div class="field">
								    	<label>Khác</label>
								    	<div class="ui input left icon">
								    		<i class="language icon"></i>
								        	<input type="text" name="ngoaingukhac" value="{{ $hoso->ngoaingukhac }}">
								        </div>
								    </div>
								</div>
								<div class="inline fields">
								    <label>Đã từng đi tới Nhật:</label>
								    <div class="field">
								      <div class="ui radio checkbox">
								        <input type="radio" name="datungtoinhat" value="1" @if($hoso->datungtoinhat == 1) checked @endif >
								        <label><i class="check green icon"></i> Có</label>
								      </div>
								    </div>
								    <div class="field">
								      <div class="ui radio checkbox">
								        <input type="radio" name="datungtoinhat" value="0" @if($hoso->datungtoinhat == 0) checked @endif >
								        <label><i class="close red icon"></i> Không</label>
								      </div>
								    </div>
								    <div class="field"></div>
								</div>
								{{-- -------------------------------------- --}}
								<div class="inline fields">
									<label>Có người thân tại Nhật:</label>
								    <div class="field">
								      <div class="ui radio checkbox">
								        <input id="conguoithan" type="radio" name="conguoithantainhat" value="1" @if($hoso->conguoithantainhat == 1) checked @endif>
								        <label><i class="check green icon"></i> Có</label>
								      </div>
								    </div>
								    <div class="field">
								      <div class="ui radio checkbox">
								        <input id="konguoithan" type="radio" name="conguoithantainhat" value="0" @if($hoso->conguoithantainhat == 0) checked @endif>
								        <label><i class="close red icon"></i> Không</label>
								      </div>
								    </div>
								</div>
								<div id="ttnguoithan" data-count="{{count($nguoithan) + 1}}" @if (count($nguoithan) <= 0) style="display: none" @endif>
									
									@foreach($nguoithan as $key => $nt)
										<div id="ttnguoithan-{{$key + 1}}" class="three fields">
											<div class="field">
												<input type="text" name="hotennguoithan[]" value="{{ $nt->hoten}}">
											</div>
											<div class="field">
												<input type="text" name="tuoinguoithan[]" value="{{ $nt->tuoi}}">
											</div>
											<div class="field">
												<input type="text" name="quanhenguoithan[]" value="{{ $nt->quanhe}}">
											</div>
											<i class="trash alternate icon red trash_icon"></i>
										</div>
									@endforeach
									<div id="ttnguoithan-{{count($nguoithan) + 1}}" class="three fields">
										<div class="field">
											<label>Họ tên</label>
											<input type="text" name="hotennguoithan[]" value="{{ old('hotennguoithan') }}">
										</div>
										<div class="field">
											<label>Tuổi</label>
											<input type="text" name="tuoinguoithan[]" value="{{ old('tuoinguoithan') }}" >
										</div>
										<div class="field">
											<label>Quan hệ</label>
											<input type="text" name="quanhenguoithan[]" value="{{ old('tuoinguoithan') }}" >
										</div>
										<div class="icon_action">
											<i class="plus icon blue add_plus"></i>
										</div>
									</div>
									
								</div>
								<h4 class="ui dividing header centered">THỰC TẬP KỸ NĂNG Ở NHẬT</h4>
								<div class="two fields thuctap">
									<div class="field  @if($hoso->mucdich == null) error @endif">
										<label>Mục đích đi Nhật</label>
										<textarea rows="3" name="mucdich">{{ $hoso->mucdich }}</textarea>
									</div>
									<div class="field  @if($hoso->muctieu == null) error @endif">
										<label>Mục tiêu sau khi về nước</label>
										<textarea rows="3" name="muctieu">{{ $hoso->muctieu }}</textarea>
									</div>
								</div>
								<div class="two fields">
									<div class="field @if($hoso->sotientrenthang == null) error @endif">
										<label>Số tiện dự định tiết kiệm mỗi tháng tại Nhật</label>
										<div class="ui right labeled input">
											<label for="amount" class="ui label">$</label>
												<input type="text" id="sotienthang" name="sotientrenthang" value="{{$hoso->sotientrenthang}}">	
											<div class="ui dropdown label">
											    <div class="text">VNĐ</div>
											</div>
									 	</div>	
									</div>
									<div class="field @if($hoso->sotientrennam == null) error @endif">
										<label>Số tiền dự định tiết kiệm 3 năm tại Nhật</label>							
										<div class="ui right labeled input">
												<label for="amount" class="ui label">$</label>									
												<input id="sotiennam" type="text" name="sotientrennam" value="{{$hoso->sotientrennam}}">
											<div class="ui dropdown label">
											    <div class="text">VNĐ</div>
											</div>
									 	</div>	
									</div>
								</div>
								<h4 class="ui dividing header centered">KHÁC</h4>
								<div class="two fields khac">
									<div class="field">
										<div class="inline fields">
											<label>Bằng lái:</label>
										    <div class="field">
										      <div class="ui radio checkbox">
										        <input type="radio" name="banglai" value="1" @if($hoso->banglai == 1) checked @endif> 
										        <label><i class="check green icon"></i> Có</label>
										      </div>
										    </div>							   
										    <div class="field">
										      <div class="ui radio checkbox">
										        <input type="radio" name="banglai" value="0" @if($hoso->banglai == 0) checked @endif>
										        <label><i class="close red icon"></i> Không</label>
										      </div>
										    </div>
										</div>
									</div>
									<div class="field">
										<div class="inline fields">
											<label>Loại xe:</label>
											<div class="field">
											    <div class="ui checkbox">
												  <input type="checkbox" name="xemay" @if($hoso->xemay == 1) checked @endif>
												  <label><i class="motorcycle icon"></i> Xe máy</label>
												</div>							
												<div class="ui checkbox">
												  <input type="checkbox" name="oto" @if($hoso->oto == 1) checked @endif>
												  <label><i class="car icon"></i> Ôtô</label>
												</div>								
												<div class="ui checkbox">
												  <input type="checkbox" id="xekhac" name="khac" @if($hoso->xekhac != '' || $hoso->xekhac != null) checked @endif>
												  <label> Khác</label>
												</div>
												<input style="width: 130px;" type="text" name="xekhac" value="{{$hoso->xekhac}}">
											</div>
										</div>
									</div>
									<script type="text/javascript">
											var xekhac =  document.getElementById('xekhac');
											if(xekhac.checked){
												 $("input[name='xekhac']").css('display','inline-block');
											}
											else{
							                    $("input[name='xekhac']").css('display','none');
							                    $("input[name='xekhac']").val('');
							                }
										document.getElementById('xekhac').onclick = function(e){
							                if (this.checked){
							                    $("input[name='xekhac']").css('display','inline-block');
							                }
							                else{
							                    $("input[name='xekhac']").css('display','none');
							                    $("input[name='xekhac']").val('');
							                }
							            };
									</script>
								</div>
								<div class="two fields">
									<div class="field @if($hoso->sothich == null) error @endif">
										<label>Sở thích</label>
										<textarea rows="3" name="sothich" placeholder="Nội dung...">{{ $hoso->sothich}}</textarea>
									</div>
									<div class="field @if($hoso->diemmanh == null) error @endif">
										<label>Điểm mạnh</label>
										<textarea rows="3" name="diemmanh" placeholder="Nội dung...">{{ $hoso->diemmanh }}</textarea>
									</div>
								</div>
								<h4 class="ui dividing header centered">GIA ĐÌNH</h4>
								<div id="giadinh" data-count="{{count($giadinh) + 1}}"> 
										<div class="fields">	 								
										<div class="field two wide column">
											<label>Quan hệ</label>
																		
										</div>
										<div class="field three wide column">
											<label>Họ tên</label>

										</div>
										<div class="field two wide column">
											<label>Năm sinh</label>									
											
										</div>

										<div class="field three  wide column">
											<label>Công việc</label>

										</div>
										<div class="field three wide column">
											<label>Nơi làm việc</label>

										</div>
										<div class="field three wide column">
											<label>Thu nhập</label>

										</div>
								    </div>
									@foreach($giadinh as $key => $gd)
										<div id="giadinh-{{$key + 1}}">
											<div class="fields">	 								
												<div class="field two wide column">
													<input type="text" name="quanhegiadinh[]" value="{{$gd->quanhe}}">									
												</div>
												<div class="field three wide column">
													<input type="text" name="hotengiadinh[]" value="{{$gd->hoten}}">
												</div>
												<div class="field two wide column">									
													<div class="ui calendar" id="namsinhgd">
													      <input type="text" class="namsinhgiadinh" name="namsinhgiadinh[]" value="{{ $gd->namsinh }}">
													</div>
												</div>
				
												<div class="field three wide column">
													<input type="text" name="congviecgiadinh[]" value="{{$gd->congviec}}">
												</div>
												<div class="field three wide column">
													<input type="text" name="noilamviecgiadinh[]" value="{{$gd->noilamviec}}">
												</div>
												<div class="field three wide column">
													<input type="text" name="thunhapgiadinh[]" value="{{$gd->luong}}" placeholder="VNĐ">
												</div>
												<i class="trash alternate icon red trash_giadinh"></i>
											</div> 	
										</div>
									@endforeach
									<div id="giadinh-{{count($giadinh) + 1}}">
										<div class="fields @if(count($giadinh) <=0) error @endif">	 								
											<div class="field two wide column @if($giadinh == null) error @endif">
												<input type="text" name="quanhegiadinh[]">									
											</div>
											<div class="field three wide column">
												<input type="text" name="hotengiadinh[]">
											</div>
											<div class="field two wide column">									
												<div class="ui calendar" id="namsinhgd">
												      <input type="text" class="namsinhgiadinh" name="namsinhgiadinh[]" value="{{ old('namsinhgiadinh') }}">
												</div>
											</div>
											<div class="field three wide column">
												<input type="text" name="congviecgiadinh[]">
											</div>
											<div class="field three wide column">
												<input type="text" name="noilamviecgiadinh[]">
											</div>
											<div class="field three wide column">
												<input type="text" id="thunhap" name="thunhapgiadinh[]" placeholder="VNĐ">
											</div>
											<i class="plus icon blue add_giadinh"></i>
										</div>
									</div>
								</div>
								<div class="three fields">
									<div class="field">
										<label>Đăng ký ngày</label>
										<div class="ui calendar">
										    <div class="ui input left icon">
										      <i class="calendar icon"></i>
										      <input id="ngaydangky" name="ngaydangky" value="{{date_format(date_create($hoso->ngaydangky), "d-m-Y")}}">
										    </div>
										</div>
									</div>
									<div class="field @if($hoso->nguoiphutrach == null) error @endif">
										<label>Người phụ trách</label>
										<input type="text" name="nguoiphutrach" value="{{$hoso->nguoiphutrach}}">
									</div>
									<div class="field @if($hoso->nguoigioithieu == null) error @endif">
										<label>Người giới thiệu</label>
										<input type="text" name="nguoigioithieu" value="{{$hoso->nguoigioithieu}}">
									</div>
								</div>

								<div class="inline field">
									<label>(*) Trường bắt buộc phải nhập</label>
								</div>
						</div>
			{{-- END TIENG VIET --}}
			{{-- SUC KHOE --}}
						<div class="ui bottom attached tab segment" data-tab="thongtin">
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
							<h3 class="ui dividing header">Tình trạng sức khỏe</h3>
							<div class="six fields">
								<div class="field">
									<label>Uống rượu</label>
									<select name="sk_uongruou">
										<option value="0" @if($hoso->sk_uongruou == 0) selected @endif>Không</option>
										<option value="1" @if($hoso->sk_uongruou == 1) selected @endif>Có</option>
									</select>
								</div>
								<div class="field">
									<label>Hút thuốc</label>
									<select name="sk_hutthuoc">
										<option value="0" @if($hoso->sk_hutthuoc == 0) selected @endif >Không</option>
										<option value="1" @if($hoso->sk_hutthuoc == 1) selected @endif>Có</option>
									</select>
								</div>
								<div class="field">
									<label>Mù màu</label>
									<select name="sk_mumau">
										<option value="0" @if($hoso->sk_mumau == 0) selected @endif>Không</option>
										<option value="1" @if($hoso->sk_mumau == 1) selected @endif>Có</option>
									</select>
								</div>
								<div class="field">
									<label>Có dị tật</label>
									<select name="sk_ditat">
										<option value="0" @if($hoso->sk_ditat == 0) selected @endif>Không</option>
										<option value="1" @if($hoso->sk_ditat == 1) selected @endif>Có</option>
									</select>
								</div>
								<div class="field">
									<label>Hình xăm</label>
									<select name="sk_hinhxam">
										<option value="0" @if($hoso->sk_hinhxam == 0) selected @endif>Không</option>
										<option value="1" @if($hoso->sk_hinhxam == 1) selected @endif>Có</option>
									</select>
								</div>
								<div class="field">
									<label>Mắt đeo kính</label>
									<select name="sk_deokinh">
										<option value="0" @if($hoso->sk_deokinh == 0) selected @endif>Không</option>
										<option value="1" @if($hoso->sk_deokinh == 1) selected @endif>Có</option>
									</select>
								</div>				
							</div>
							
							
							<h3 class="ui header dividing">Hộ chiếu</h3>
							<div class="four fields">
								<div class="field">
									<div class="field">
										<label>Số hộ chiếu</label>
										<input type="text" name="hc_sohochieu" value="{{ $hoso->hc_sohochieu }}">
									</div>
									<div class="field">
										<label>Nơi cấp</label>
										<input type="text" name="hc_noicap" value="{{ $hoso->hc_noicap }}">
									</div>
								</div>
								<div class="field">
									<div class="field">
										<label>Ngày cấp</label>
										<div class="ui calendar" id="date-hc-ngaycap">
										    <div class="ui input left icon">
										      <i class="calendar icon"></i>
										      <input type="text" id="hc_ngaycap" name="hc_ngaycap"  value="{{$hoso->hc_ngaycap}}">
										    </div>
										</div>
									</div>	
									<div class="field">
										<label>Ngày hết hạn</label>
										<div class="ui calendar" id="date-hc-ngayhethan">
										    <div class="ui input left icon">
										      <i class="calendar icon"></i>
										      <input type="text" id="hc_ngayhethan" name="hc_ngayhethan"  value="{{$hoso->hc_ngayhethan}}">
										    </div>
										</div>
									</div>
								</div>
								<div class="field">	
									<div class="field">
										<label>Ngày nhận</label>
										<div class="ui calendar" id="date-hc-ngaynhan">
										    <div class="ui input left icon">
										      <i class="calendar icon"></i>
										      <input type="text" id="hc_ngaynhan" name="hc_ngaynhan"  value="{{$hoso->hc_ngaynhan}}">
										    </div>
										</div>
									</div>
								</div>
								<div class="field ">
									<label>Đính kèm file</label>
									<input type="hidden" name="file_hc_hidden" value="{{$hoso->hc_file}}">
									<label for="hc-file" class="ui white basic right button custom-file-upload" style="text-align: left;">
    									<i class="ui upload icon"></i> <b> Tải Lên File </b> <p> ( PDF, DOC, DOCX ) </p>
  									</label>
  									<input id="hc-file" name='hc_file[]' value="{{$hoso->hc_file}}" type="file" style="display:none;" multiple>
  									@php 
  										$timestamp = strtotime($hoso->created_at);
        								$year = date("Y", $timestamp);
        								$month = date("m", $timestamp);
  									@endphp
  									@if($hoso->hc_file)
  									@php 
  										$hc_file = json_decode($hoso->hc_file); 
  									@endphp
  									@foreach($hc_file as $hc)
  									<label class="ui white basic field " style="text-align: left;">
  										<i class="ui download icon"></i>
  										<a href="{{url('/uploads/pdfs/'.$year.'/'.$month.'/'.$hoso->id.'/hc/'.$hc)}}" target="_blank">{{$hc}}</a>
  										<i class="ui trash icon red right removefile" datatype="hc" datafile="{{$hc}}"></i>
  									</label>
  									@endforeach
  									@endif
								</div>
							</div>
		
							<h3 class="ui header dividing">Chứng minh nhân dân</h3>
							<div class="three fields">
								<div class="field">
									<div class="field">
										<label>Số CMND</label>
										<input type="text" name="cmnd_socmnd" value="{{$hoso->cmnd_socmnd}}">
									</div>
								</div>
								<div class="field">
									<div class="field">
										<label>Nơi cấp</label>
										<input type="text" name="cmnd_noicap" value="{{$hoso->cmnd_noicap}}">
									</div>
								</div>
								<div class="field">
									<div class="field">
										<label>Ngày cấp</label>
										<div class="ui calendar" id="date-cmnd-ngaycap">
										    <div class="ui input left icon">
										      <i class="calendar icon"></i>
										      <input type="text" id="cmnd_ngaycap" name="cmnd_ngaycap" value="{{$hoso->cmnd_ngaycap}}">
										    </div>
										</div>
									</div>
								</div>
								<div class="field">
									<div class="field ">
										<label>Đính kèm file</label>
										<input type="hidden" name="file_cmnd_hidden" value="{{$hoso->cmnd_file}}">
										<label for="cmnd-file" class="ui white basic right button custom-file-upload" style="text-align: left;">
	    									<i class="ui upload icon"></i> <b> Tải Lên File </b> <p> ( PDF, DOC, DOCX ) </p>
	  									</label>
	  									<input id="cmnd-file" name='cmnd_file[]' value="{{$hoso->cmnd_file}}" type="file" style="display:none;" multiple>
	  									@if($hoso->cmnd_file)
	  									@php 
	  										$cmnd_file = json_decode($hoso->cmnd_file); 
	  									@endphp
	  									@foreach($cmnd_file as $cmnd)
	  									<label class="ui white basic field " style="text-align: left;">
	  										<i class="ui download icon"></i>
	  										<a href="{{url('/uploads/pdfs/'.$year.'/'.$month.'/'.$hoso->id.'/cmnd/'.$cmnd)}}" target="_blank">{{$cmnd}}</a>
	  										<i class="ui trash icon red right removefile" datatype="cmnd" datafile="{{$cmnd}}"></i>
	  									</label>
	  									@endforeach
	  									@endif
									</div>
								</div>
							</div>

							<h3 class="ui header dividing">Lý lịch tư pháp</h3>
							<div class="four fields">
								<div class="field">
									<div class="field">
										<label>Ngày cấp</label>
										<div class="ui calendar" id="date-ll-ngaycap">
										    <div class="ui input left icon">
										      <i class="calendar icon"></i>
										      <input type="text" id="ll_ngaycap" name="ll_ngaycap"  value="{{$hoso->ll_ngaycap}}">
										    </div>
										</div>
									</div>
								</div>
								<div class="field">
									<div class="field">
										<label>Ngày có hiệu lực</label>
										<div class="ui calendar" id="date-ll-ngaycohieuluc">
										    <div class="ui input left icon">
										      <i class="calendar icon"></i>
										      <input type="text" id="ll_ngaycohieuluc" name="ll_ngaycohieuluc"  value="{{$hoso->ll_ngaycohieuluc}}">
										    </div>
										</div>
									</div>
								</div>
								<div class="field">
									<div class="field">
										<label>Ngày hết hiệu lực</label>
										<div class="ui calendar" id="date-ll-hethan">
										    <div class="ui input left icon">
										      <i class="calendar icon"></i>
										      <input type="text" id="ll_hethan" name="ll_hethan"  value="{{$hoso->ll_hethan}}">
										    </div>
										</div>
									</div>
								</div>
								<div class="field">
									<div class="field ">
										<label>Đính kèm file</label>
										<input type="hidden" name="file_ll_hidden" value="{{$hoso->ll_file}}">
										<label for="ll-file" class="ui white basic right button custom-file-upload" style="text-align: left;">
	    									<i class="ui upload icon"></i> <b> Tải Lên File </b> <p> ( PDF, DOC, DOCX ) </p>
	  									</label>
	  									<input id="ll-file" name='ll_file[]' value="{{$hoso->ll_file}}" type="file" style="display:none;" multiple>
	  									@if($hoso->ll_file)
	  									@php 
	  										$ll_file = json_decode($hoso->ll_file); 
	  									@endphp
	  									@foreach($ll_file as $ll)
	  									<label class="ui white basic field " style="text-align: left;">
	  										<i class="ui download icon"></i>
	  										<a href="{{url('/uploads/pdfs/'.$year.'/'.$month.'/'.$hoso->id.'/ll/'.$ll)}}" target="_blank">{{$ll}}</a>
	  										<i class="ui trash icon red right removefile" datatype="ll" datafile="{{$ll}}"></i>
	  									</label>
	  									@endforeach
	  									@endif
									</div>
								</div>

							</div>
							
							<h3 class="ui header dividing">Thông tin VISA</h3>
							<div class="four fields">
								<div class="field">
									<div class="field">
										<label>Số hiệu</label>
										<input type="text" name="vs_sohieu" value="{{ $hoso->vs_sohieu }}">
									</div>
									<div class="field">
										<label>Ngày cấp</label>
										<div class="ui calendar" id="date-vs-ngaycap">
										    <div class="ui input left icon">
										      <i class="calendar icon"></i>
										      <input type="text" id="vs_ngaycap" name="vs_ngaycap"  value="{{$hoso->vs_ngaycap}}">
										    </div>
										</div>
									</div>
								</div>
								<div class="field">
									<div class="field">
										<label>Ngày đăng ký</label>
										<div class="ui calendar" id="date-vs-ngaydangky">
										    <div class="ui input left icon">
										      <i class="calendar icon"></i>
										      <input type="text" id="vs_ngaydangky" name="vs_ngaydangky"  value="{{$hoso->vs_ngaydangky}}">
										    </div>
										</div>
									</div>
								</div>
								<div class="field">
									<div class="field">
										<label>Ngày hết hạn</label>
										<div class="ui calendar" id="date-vs-ngayhethan">
										    <div class="ui input left icon">
										      <i class="calendar icon"></i>
										      <input type="text" id="vs_ngayhethan" name="vs_ngayhethan"  value="{{$hoso->vs_ngayhethan}}">
										    </div>
										</div>
									</div>
								</div>
								<div class="field">
									<div class="field ">
										<label>Đính kèm file</label>
										<input type="hidden" name="file_vs_hidden" value="{{$hoso->vs_file}}">
										<label for="vs-file" class="ui white basic right button custom-file-upload" style="text-align: left;">
	    									<i class="ui upload icon"></i> <b> Tải Lên File </b> <p> ( PDF, DOC, DOCX ) </p>
	  									</label>
	  									<input id="vs-file" name='vs_file[]' value="{{$hoso->vs_file}}" type="file" style="display:none;" multiple>
	  									@if($hoso->vs_file)
	  									@php 
	  										$vs_file = json_decode($hoso->vs_file); 
	  									@endphp
	  									@foreach($vs_file as $vs)
	  									<label class="ui white basic field " style="text-align: left;">
	  										<i class="ui download icon"></i>
	  										<a href="{{url('/uploads/pdfs/'.$year.'/'.$month.'/'.$hoso->id.'/vs/'.$vs)}}" target="_blank">{{$vs}}</a>
	  										<i class="ui trash icon red right removefile" datatype="vs" datafile="{{$vs}}"></i>
	  									</label>
	  									@endforeach
	  									@endif
									</div>
								</div>
							</div>
							
							<h3 class="ui header dividing">Khác</h3>
							<div class="field">
						          <label>Giấy tờ bổ sung</label>
						          <div class="wrap-giayto-dropdown" data-item-selected="{{$hoso->tt_giayto}}">
						            <div class="ui fluid multiple search selection dropdown giayto-dropdown">
						              <input name="tt_giayto" type="hidden">
						              <i class="dropdown icon"></i>
						              <div class="default text">Chọn loại giấy tờ</div>
						              <div class="menu">
						                  <div class="item" data-value="1">Chứng minh nhân dân</div>
						                  <div class="item" data-value="2">Sơ yếu lý lịch</div>
						                  <div class="item" data-value="3">Hộ chiếu cũ, thẻ cư chú</div>
						                  <div class="item" data-value="4">Giấy khai sinh</div>
						                  <div class="item" data-value="5">Sổ hộ khẩu</div>
						                  <div class="item" data-value="6">Bằng tốt nghiệp</div>
						                  <div class="item" data-value="7">Giấy kết hôn</div>
						                  <div class="item" data-value="8">Giấy xuất ngũ</div>
						              </div>
						            </div>
						          </div>
							 </div>
							
						     <script type="text/javascript">
						     	     $(document).ready(function($) {   
								        var giayto = $('.wrap-giayto-dropdown').attr('data-item-selected').split(",");
								        $('.giayto-dropdown').dropdown('set selected',giayto);
								    });  
						     </script>
							<div class="field">
								<label>Loại khác</label>
								<textarea name="tt_loaikhac" rows="5">{{$hoso->tt_loaikhac}}</textarea>
							</div>
							<div class="field">
								<label>Ghi chú thêm</label>
								<textarea name="tt_ghichu" rows="5">{{$hoso->tt_ghichu}}</textarea>
							</div>
							<h3 class="ui header">File scan</h3>
							<div class="field">
							   <div class="field ">
								   <input type="hidden" name="file_scan_hidden" value="{{$hoso->scan_file}}">
								   <label for="scan-file" class="ui white basic right button custom-file-upload" style="text-align: left;">
									   <i class="ui upload icon"></i> <b> Tải Lên File  ( PDF, DOC, DOCX ) </b>
									 </label>
									 <input id="scan-file" accept="application/pdf" name='scan_file[]' value="{{$hoso->scan_file}}" type="file" style="display:none;" multiple>
									 @if($hoso->scan_file)
									 @php 
										 $scan_file = json_decode($hoso->scan_file); 
									 @endphp
									 @foreach($scan_file as $scan)
									 <label class="ui white basic field " style="text-align: left;">
										 <i class="ui download icon"></i>
										 <a href="{{url('/uploads/pdfs/'.$year.'/'.$month.'/'.$hoso->id.'/scan/'.$scan)}}" target="_blank">{{$scan}}</a>
										 <i class="ui trash icon red right removefile" datatype="scan" datafile="{{$scan}}"></i>
									 </label>
									 @endforeach
									 @endif
							   </div>
						   </div>
							{{-- module --}}
							<div class="ui modal tiny test">
							  	<div class="header">Xóa File </div>
							  	<div class="content">
							    	<p><b>Lưu ý:</b> file sẽ bị xóa vĩnh viễn khỏi hệ thống</p>
							  	</div>
							  	<div class="actions">
							    	<div class="ui approve button green approve-delete"> <i class="icon check"></i> OK</div>
							    	<div class="ui cancel button red temp-delete"> <i class="icon linkify"></i>Thêm file xóa</div>
							    	<div class="ui cancel button red cancel-delete"> <i class="icon refresh"></i> Hủy</div>
							  	</div>
							</div>
							{{-- end module --}}
							<script type="text/javascript">
								$(document).ready(function(){
								  	$("#ngaysinh,#ngaydangky,#hc_ngaycap,#hc_ngayhethan,#hc_ngaynhan,#cmnd_ngaycap,#ll_hethan,#ll_ngaycohieuluc,#ll_ngaycap,#vs_ngayhethan,#vs_ngaycap,#vs_ngaydangky").inputmask({ alias: "datetime", inputFormat: "dd-mm-yyyy"});
									$(".thoigianhocbd,.thoigianhockt,.namsinhgiadinh").inputmask({ alias: "datetime", inputFormat: "yyyy"});
									$(".thoigianlamviecbd,.thoigianlamvieckt").inputmask({ alias: "datetime", inputFormat: "mm-yyyy"});

								  $('#phone,#phone1').inputmask({ mask: "0999.999.999"});
								  $("#thunhap").inputmask("numeric", {
										radixPoint: ".",
										groupSeparator: ",",
										digits: 2,
										autoGroup: true,
										rightAlign: false,
										oncleared: function () { self.Value(''); }
									});	
								});
							</script>
							<script type="text/javascript">
								$('.ui.dropdown').dropdown('show')
							</script>
							<script type="text/javascript">
							$('.menu .item')
							  .tab()
							;
						</script>
						</div>
			{{-- END SUC KHOE --}}

					</div>
				</div>
			</div>					
	        <div class="ui segment">
	          <div class="ui secondary menu">
	          	<div class="left menu">
					<a class="item">
                    <a href="{{url('/hoso/testmiss')}}" class="ui labeled icon red button"><i class="arrow left icon"></i>Kiểm Tra</a>
                  </a>
	          	</div>
	              <div class="right menu">
			        <a href="{{url('/hoso')}}" class="ui labeled icon button"><i class="arrow left icon"></i>Danh Sách</a>
				<button type="submit" class="ui labeled icon button green"><i class="save icon"></i>Lưu</button>
	              </div>
	            </div>
	     	</div>
		</div>	     	
	</form>
	<style type="text/css">
	  	.custom-file-upload {
			border: 1px solid #ccc;
			display: inline-block;
			padding: 6px 12px;
			cursor: pointer;
			margin: 10px;
		}
	</style>
	<script type="text/javascript">
		$('#hc-file').change(function() {
			var i = $(this).prev('label').clone();
			var file = $('#hc-file')[0].files[0].name;
			$(this).prev('label').text(file);
		});
	 	$('#cmnd-file').change(function() {
			var i = $(this).prev('label').clone();
			var file = $('#cmnd-file')[0].files[0].name;
			$(this).prev('label').text(file);
		});
		$('#vs-file').change(function() {
			var i = $(this).prev('label').clone();
			var file = $('#vs-file')[0].files[0].name;
			$(this).prev('label').text(file);
		});
		$('#ll-file').change(function() {
			var i = $(this).prev('label').clone();
			var file = $('#ll-file')[0].files[0].name;
			$(this).prev('label').text(file);
		});
		$('#scan-file').change(function() {
			var i = $(this).prev('label').clone();
			var file = $('#scan-file')[0].files[0].name;
			$(this).prev('label').text(file);
		});
	</script>
	<script>
	$(document).ready(function(){
		$(".removefile").click(function(){
			$(".test").modal('show');
			var ifile =  $(this).attr("datafile");
			var typefile =  $(this).attr("datatype");
			$(".test .header").append("<b>"+ifile+",</b>");
			$(".approve-delete").click(function(){
			    $.get((ifile + "/" + typefile + "/removefile"), function(data, status){
			      location.reload();
			    });
			});
			$(".cancel-delete").click(function(){
				location.reload();
			});
		});
	});
	</script>
@endsection
@section('JsLibraries')
  <script src="{{url('js/admin/hoso/add_hoso.js')}}"></script>
@endsection