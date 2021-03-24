@extends('admin.master')
@section('title', 'Thêm Học Viên Mới')
@section('PageContent')
<link rel="stylesheet" type="text/css" href="{{url('libraries/croper/croppie.css')}}">
<script src="{{url('libraries/croper/croppie.js')}}"></script>

<h2 class="ui header center aligned">
    THÊM HỌC VIÊN MỚI 
</h2>
@if (session('status'))
  	<div class="ui message">
	  	<i class="close icon"></i>
	  	<div class="header">
	    	Thông Báo !
	  	</div>
	  	<p>{{ session('status') }}</p>
	</div>
@endif
@if (session('error'))
  	<div class="ui error message">
	  	<i class="close icon"></i>
	  	<div class="header">
	    	Thông Báo !
	  	</div>
	  	<p>{{ session('error') }}</p>
	</div>
@endif
<form class="ui form" action="" method="post" name="form_1" autocomplete="off" enctype="multipart/form-data">
	{{ csrf_field() }}
	<div class="ui segments">
        <div class="ui segment">
          <div class="ui secondary menu">
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
						  <a class="item" data-tab="thongtin">Thông tin bỗ sung</a>
						</div>
			{{-- TIENG VIET --}}
						<div class="ui bottom attached tab segment active" data-tab="soyeulylich">
								<div class="ui steps">
								    <div class="step">
									    <img width="50" id="upload-demo-img" src="/images/admin/avatar.png">
										<input type="hidden" id="feature-image" name="featureImage">									
								    </div>
								</div>	
								<div class="ui modal mini modal-img-upload">
									<div class="header">Thay ảnh đại diện</div>
								    <div class="content">
								    	<div class="ui stackable grid">											
										    <div id="upload-demo" style="width:350px;">	
										   	</div>									     
																				 
										</div>
										<input type="file" id="upload" accept="image/*">
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
										<input type="text" id="hoten" name="hoten" value="{{ old('hoten') }}" required>
										</div>
									</div>
									<div class="field">
										<label>Ngày sinh (*)</label>
										<div class="ui calendar">
										    <div class="ui input left icon">
										      <i class="calendar icon"></i>
										      <input id="ngaysinh" name="ngaysinh" value="{{ old('ngaysinh') }}" required>
										    </div>
										</div>										
										    
									</div>
									
									<div class="field">
										<label>Điện thoại (*)</label>
										<div class="ui input left icon">
											<i class="mobile alternate icon"></i>
											<input type="tel" id="phone" name="dienthoai" value="{{ old('dienthoai') }}">
										</div>
									</div>
									<div class="field">
										<label>ĐT người thân</label>
										<div class="ui input left icon">
											<i class="mobile alternate icon"></i>
											<input type="tel" id="phone1" name="dtnguoithan" value="{{ old('dtnguoithan') }}">
										</div>
									</div>
								</div>
								<div class="three fields">
									<div class="field">
										<div class="two fields">
											<div class="eleven wide field">
												<label>Nơi sinh (*)</label>
												<div class="ui input left icon">
													<i class="map marker alternate icon"></i>
													<input type="text" name="noisinh">
												</div>
											</div>
											<div class="five wide field">
												<label>Miền</label>
												 <select id="select-mien" name="mien">
												 	<option value=""></option>						 
										      		<option value="BẮC">BẮC</option>
										      		<option value="TRUNG">TRUNG</option>
										      		<option value="NAM">NAM</option>						      	
											    </select>
											</div>
										</div>
									</div>
									{{-- <div class="seven wide field">
										<label>Địa chỉ hộ khẩu (*)</label>
										<div class="ui input left icon">
											<i class="map outline icon"></i>
											<input type="text" name="diachi" value="{{ old('diachi') }}">
										</div>
									</div>			 --}}
								</div>
								<div class="four fields">
									<div class="four wide field">
										<label>Địa chỉ hộ khẩu (ấp/khu phố)</label>
										<div class="ui input left icon">
											<i class="map outline icon"></i>
											<input type="text" name="dchk_dc" value="{{ old('dchk_dc') }}">
										</div>
									</div>
									<div class="four wide field">
										<label>Phường/Xã</label>
										<div class="ui input left icon">
											<i class="map outline icon"></i>
											<input type="text" name="dchk_xa" value="{{ old('dchk_xa') }}">
										</div>
									</div>
									<div class="four wide field">
										<label>Quận/Huyện</label>
										<div class="ui input left icon">
											<i class="map outline icon"></i>
											<input type="text" name="dchk_huyen" value="{{ old('dchk_huyen') }}">
										</div>
									</div>
									<div class="four wide field">
										<label>Tình thành</label>
										 <select name="tinhthanh">
									      @foreach($city as $ct)
									      		<option value="{{$ct->id}}">{{$ct->ten}}</option>
									      	@endforeach
									    </select>
									</div>
								</div>
								<div class="four fields">
									<div class="field">
										<label>Giới tính</label>
									    <select name="gioitinh">
									    	<option value=""></option>
									     	<option value="1">NAM</option>
									     	<option value="0">NỮ</option>
									    </select>
									    
									</div>
									<div class="field">
										<label>Hôn nhân</label>
										<div class="ui input left icon">
											<i class="heart icon"></i>
											<input type="text" name="honnhan" value="{{ old('honnhan') }}">
										</div>
									</div>
									<div class="field">
										<label>Bệnh án</label>
										<div class="ui input left icon">
											<i class="heartbeat icon"></i>
											<input type="text" name="benhan" value="{{ old('benhan') }}">
										</div>
									</div>
									<div class="field">
										<label>Tôn giáo</label>
										<div class="ui input left icon">
											<i class="balance scale icon"></i>
											<input type="text" name="tongiao" value="{{ old('tongiao') }}">
										</div>
									</div>
								</div>
								<div class="five fields">
									<div class="field">
										<label>Chiều cao</label>						
										<div class="ui right labeled input">
												<input type="number" name="chieucao" value="{{ old('chieucao') }}">
											<div class="ui basic label">
										    cm
										  	</div>
									 	</div>
									</div>
									<div class="field">
										<label>Cân nặng</label>
										<div class="ui right labeled input">
												<input type="number" name="cannang" value="{{ old('cannang') }}">
											<div class="ui basic label">
										    kg
										  	</div>
									 	</div>						
									</div>	
									<div class="field">
										<label>Nhóm máu</label>
										<select name="nhommau">
											<option value=""></option>
											<option value="A">A</option>
											<option value="B">B</option>
											<option value="AB">AB</option>
											<option value="O">O</option>
										</select>
									</div>				
									<div class="field">
										<label>Thị lực (trái)</label>
										<div class="ui input left icon">
											<i class="eye icon"></i>
											<input type="text" name="mattrai" value="{{ old('mattrai') }}">
										</div>
									</div>
									<div class="field">
										<label>Thị lực (phải)</label>
										<div class="ui input left icon">
											<i class="eye icon"></i>
											<input type="text" name="matphai" value="{{ old('matphai') }}">
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
									        	<option value=""></option>
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
									        	<option value=""></option>
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
									        	<option value=""></option>
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
									        	<option value=""></option>
										        <option value="0">Phải</option>
										        <option value="1">Trái</option>
										    </select>
										</div>
								    </div>
								</div>
								<h4 class="ui dividing header centered">QUÁ TRÌNH HỌC TẬP</h4>
								<div id="hoctap" data-count="4"> 
								<div id="hoctap-1" class="three fields" style="margin: 0em -0.5em;">
									<div class="field">
									<label>Thời gian học</label>	
										<div class="two fields">
											<div class="field">
												<div class="ui calendar" id="thoigianbd-1">
												    <div class="ui input left icon">
												      <i class="calendar icon"></i>
												      <input type="text" class="thoigianhocbd" name="thoigianhocbd[]">
												    </div>
											    </div> 
										    </div>													
											<div class="field">
												<div class="ui calendar" id="thoigiankt-1">
												    <div class="ui input left icon">
												      <i class="calendar icon"></i>
												      <input type="text" class="thoigianhockt" name="thoigianhockt[]">
												    </div>
											    </div> 
											</div>
										</div>
									</div>
									<div class="field">
										<label>Tên trường</label>
										<div class="ui input left icon">
											<i class="building icon"></i>
											<input type="text" name="tentruong[]" value="TRƯỜNG TIỂU HỌC">
										</div>	
									</div>
									<div class="field">
										<label>Địa chỉ trường</label>
										<div class="ui input left icon">
											<i class="map icon"></i>
											<input type="text" name="diachitruong[]">
										</div>
									</div>
									<div class="icon_action">
										<i class="trash alternate icon red trash_hoctap"></i>
									</div>										
								</div>
								<div id="hoctap-2" class="three fields" style="margin: 0em -0.5em;">
									<div class="field">	
										<div class="two fields">
											<div class="field">
												<div class="ui calendar" id="thoigianbd-2">
												    <div class="ui input left icon">
												      <i class="calendar icon"></i>
												      <input type="text" class="thoigianhocbd" name="thoigianhocbd[]">
												    </div>
											    </div> 
										    </div>													
											<div class="field">
												<div class="ui calendar" id="thoigiankt-2">
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
											<input type="text" name="tentruong[]" value="TRƯỜNG THCS">
										</div>	
									</div>
									<div class="field">
										<div class="ui input left icon">
											<i class="map icon"></i>
											<input type="text" name="diachitruong[]">
										</div>
									</div>
									<i class="trash alternate icon red trash_hoctap"></i>
								</div>
								<div id="hoctap-3" class="three fields" style="margin: 0em -0.5em;">
									<div class="field">	
										<div class="two fields">
											<div class="field">
												<div class="ui calendar" id="thoigianbd-3">
												    <div class="ui input left icon">
												      <i class="calendar icon"></i>
												      <input type="text" class="thoigianhocbd" name="thoigianhocbd[]">
												    </div>
											    </div> 
										    </div>													
											<div class="field">
												<div class="ui calendar" id="thoigiankt-3">
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
											<input type="text" name="tentruong[]" value="TRƯỜNG THPT">
										</div>	
									</div>
									<div class="field">
										<div class="ui input left icon">
											<i class="map icon"></i>
											<input type="text" name="diachitruong[]">
										</div>
									</div>																			
									<i class="trash alternate icon red trash_hoctap"></i>
								</div>
								<div id="hoctap-4" class="three fields" style="margin: 0em -0.5em;">
									<div class="field">	
										<div class="two fields">
											<div class="field">
												<div class="ui calendar" id="thoigianbd-4">
												    <div class="ui input left icon">
												      <i class="calendar icon"></i>
												      <input type="text" class="thoigianhocbd" name="thoigianhocbd[]">
												    </div>
											    </div> 
										    </div>													
											<div class="field">
												<div class="ui calendar" id="thoigiankt-4">
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
								<div id="congviec" data-count="1"> 
								<div id="congviec-1" class="three fields">
									<div class="field">
									<label>Thời gian làm việc</label>	
										<div class="two fields">
											<div class="field">
												<div class="ui calendar" id="thoigianlamviecbd">
												    <div class="ui input left icon">
												      <i class="calendar icon"></i>
												      <input type="text" class="thoigianlamviecbd" name="thoigianlamviecbd[]">
												    </div>
											    </div> 
										    </div>														
											<div class="field">
												<div class="ui calendar" id="thoigianlamvieckt">
												    <div class="ui input left icon">
												      <i class="calendar icon"></i>
												      <input type="text" class="thoigianlamvieckt" name="thoigianlamvieckt[]">
												    </div>
											    </div> 
											</div>
										</div>
									</div>
									<div class="field">
										<label>Tên công ty</label>
										<div class="ui input left icon">
											<i class="building icon"></i>
											<input type="text" name="tencongty[]">
										</div>
									</div>
									<div class="field">
										<label>Nôi dung công việc</label>
										<div class="ui input left icon">
											<i class="briefcase icon"></i>
											<input type="text" name="ndcongviec[]">
										</div>
									</div>
									<div class="icon_action">
											<i class="plus icon blue add_congviec"></i>
									</div>

								</div>
								
								</div>
								<h4 class="ui dividing header centered">NGOẠI NGỮ</h4>
								<div class="three fields ngoaingu">
								    <div class="field">
								    	<label>Anh ngữ</label>
								        <select name="anhngu">
								        	<option value=""></option>
											<option value="0">Không</option>
											<option value="1">Bằng A</option>
											<option value="2">Bằng B</option>
											<option value="3">Bằng C</option>
										</select>
								    </div>
								    <div class="field">
								    	<label>Nhật ngữ</label>
								        <input type="text" name="nhatngu" value="{{ old('nhatngu') }}">
								    </div>
								    <div class="field">
								    	<label>Khác</label>
								    	<div class="ui input left icon">
								    		<i class="language icon"></i>
								        	<input type="text" name="ngoaingukhac" value="{{ old('ngoaingukhac') }}">
								        </div>
								    </div>
								</div>
								<div class="inline fields">
								    <label>Đã từng đi tới Nhật:</label>
								    <div class="field">
								      <div class="ui radio checkbox">
								        <input type="radio" name="datungtoinhat" value="1" >
								        <label><i class="check green icon"></i> Có</label>
								      </div>
								    </div>
								    <div class="field">
								      <div class="ui radio checkbox">
								        <input type="radio" name="datungtoinhat" value="0" >
								        <label><i class="close red icon"></i> Không</label>
								      </div>
								    </div>
								    <div class="field"></div>
								</div>
								<div class="inline fields">
									<label>Có người thân tại Nhật:</label>
								    <div class="field">
								      <div class="ui radio checkbox">
								        <input id="conguoithan" type="radio" name="conguoithantainhat" value="1" >
								        <label><i class="check green icon"></i> Có</label>
								      </div>
								    </div>
								    <div class="field">
								      <div class="ui radio checkbox">
								        <input id="konguoithan" type="radio" name="conguoithantainhat" value="0">
								        <label><i class="close red icon"></i> Không</label>
								      </div>
								    </div>
								</div>
								<div id="ttnguoithan" data-count="1" style="display: none">
									<div id="ttnguoithan-1" class="three fields">
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
											<input type="text" name="quanhenguoithan[]" value="{{ old('quanhenguoithan') }}" >
										</div>
										<div class="icon_action">
											<i class="plus icon blue add_plus"></i>
										</div>
									</div>
								</div>
								<h4 class="ui dividing header centered">THỰC TẬP KỸ NĂNG Ở NHẬT</h4>
								<div class="two fields thuctap">
									<div class="field">
										<label>Mục đích đi Nhật</label>
										<textarea rows="3" name="mucdich" placeholder="Nội dung">{{ old('mucdich') }}</textarea>
									</div>
									<div class="field">
										<label>Mục tiêu sau khi về nước</label>
										<textarea rows="3" name="muctieu" placeholder="Nội dung">{{ old('muctieu') }}</textarea>
									</div>
								</div>
								<div class="two fields">
									<div class="field">
										<label>Số tiện dự định tiết kiệm mỗi tháng tại Nhật</label>
										<div class="ui right labeled input">
											<label for="amount" class="ui label">$</label>
												<input id="sotienthang" type="text" name="sotientrenthang">	
											<div class="ui dropdown label">
											    <div class="text">VNĐ</div>
											</div>
									 	</div>	
									</div>
									<div class="field">
										<label>Số tiền dự định tiết kiệm 3 năm tại Nhật</label>							
										<div class="ui right labeled input">
												<label for="amount" class="ui label">$</label>									
												<input id="sotiennam" type="text" name="sotientrennam" >
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
										        <input type="radio" name="banglai" value="1" >
										        <label><i class="check green icon"></i> Có</label>
										      </div>
										    </div>							   
										    <div class="field">
										      <div class="ui radio checkbox">
										        <input type="radio" name="banglai" value="0">
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
												  <input type="checkbox" name="xemay">
												  <label><i class="motorcycle icon"></i> Xe máy</label>
												</div>							
												<div class="ui checkbox">
												  <input type="checkbox" name="oto">
												  <label><i class="car icon"></i> Ôtô</label>
												</div>								
												<div class="ui checkbox">
												  <input id="xekhac" type="checkbox" name="khac">
												  <label> Khác</label>
												</div>
												<input style="display: none; width: 130px;" type="text" name="loaixe_khac">
											</div>
										</div>
									</div>
								</div>
								<script type="text/javascript">
									document.getElementById('xekhac').onclick = function(e){
						                if (this.checked){
						                    $("input[name='loaixe_khac']").css('display','inline-block');
						                }
						                else{
						                    $("input[name='loaixe_khac']").css('display','none');
						                }
						            };
								</script>
								<div class="two fields">
									<div class="field">
										<label>Sở thích</label>
										<textarea rows="3" name="sothich" placeholder="Nội dung...">{{ old('sothich') }}</textarea>
									</div>
									<div class="field">
										<label>Điểm mạnh</label>
										<textarea rows="3" name="diemmanh" placeholder="Nội dung...">{{ old('diemmanh') }}</textarea>
									</div>
								</div>
								<h4 class="ui dividing header centered">GIA ĐÌNH</h4>
								<div class="fields">	 								
									<div class="field two wide column">
										<label>Quan hệ</label>
										<input type="text" name="quanhegiadinh[]">									
									</div>
									<div class="field three wide column">
										<label>Họ tên</label>
										<input type="text" name="hotengiadinh[]">
									</div>
									<div class="field two wide column">
										<label>Năm sinh</label>									
										<div class="ui calendar" id="namsinhgd">
										      <input type="text" class="namsinhgiadinh" name="namsinhgiadinh[]" value="{{ old('namsinhgiadinh') }}">
										</div>
									</div>
									{{-- <script type="text/javascript">	
										$("#namsinhgd").calendar({
										  type: 'year'
										});		
									</script> --}}
									<div class="field three wide column">
										<label>Công việc</label>
										<input type="text" name="congviecgiadinh[]">
									</div>
									<div class="field three wide column">
										<label>Nơi làm việc</label>
										<input type="text" name="noilamviecgiadinh[]">
									</div>
									<div class="field three wide column">
										<label>Thu nhập</label>
										<input type="text" id="thunhap" name="thunhapgiadinh[]">
									</div>
									<div class="icon_action">
										<i class="plus icon blue add_giadinh"></i>
									</div>
								</div>

								<div id="giadinh" data-count="1"> 						
								</div>

								<div class="three fields">
									<div class="field">
										<label>Đăng ký ngày</label>
										<div class="ui calendar" id="date-only-1">
										    <div class="ui input left icon">
										      <i class="calendar icon"></i>
										      <input type="text" id="ngaydangky" name="ngaydangky">
										    </div>
										</div>
									</div>
								<script type="text/javascript">
									$('#date-only-1').calendar(calendarOpts);
								</script>
									<div class="field">
										<label>Người phụ trách</label>
										<input type="text" name="nguoiphutrach">
									</div>
									<div class="field">
										<label>Người giới thiệu</label>
										<input type="text" name="nguoigioithieu">
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
								<div class="field">
									<label>M1</label>
									<div class="ui input left icon">							
									<i class="pencil alternate icon"></i>
									<input type="number" name="m1" min="0" max="10">
									</div>
								</div>
								<div class="field">
									<label>M2</label>
									<div class="ui input left icon">							
									<i class="pencil alternate icon"></i>
									<input type="number" name="m2" min="0" max="10">
									</div>
								</div>
								<div class="field">
									<label>M3</label>
									<div class="ui input left icon">							
									<i class="pencil alternate icon"></i>
									<input type="number" name="m3" min="0" max="10">
									</div>
								</div>
								<div class="field">
									<label>M4</label>
									<div class="ui input left icon">							
									<i class="pencil alternate icon"></i>
									<input type="number" name="m4" min="0" max="10">
									</div>
								</div>
								<div class="field">
									<label>M5</label>
									<div class="ui input left icon">							
									<i class="pencil alternateer icon"></i>
									<input type="number" name="m5" min="0" max="10">
									</div>
								</div>
							</div>	
							<h3 class="ui dividing header">Tình trạng sức khỏe</h3>
							<div class="six fields">
								<div class="field">
									<label>Uống rượu</label>
									<select name="sk_uongruou">
										<option value="0">Không</option>
										<option value="1">Có</option>
									</select>
								</div>
								<div class="field">
									<label>Hút thuốc</label>
									<select name="sk_hutthuoc">
										<option value="0">Không</option>
										<option value="1">Có</option>
									</select>
								</div>
								<div class="field">
									<label>Mù màu</label>
									<select name="sk_mumau">
										<option value="0">Không</option>
										<option value="1">Có</option>
									</select>
								</div>
								<div class="field">
									<label>Có dị tật</label>
									<select name="sk_ditat">
										<option value="0">Không</option>
										<option value="1">Có</option>
									</select>
								</div>
								<div class="field">
									<label>Hình xăm</label>
									<select name="sk_hinhxam">
										<option value="0">Không</option>
										<option value="1">Có</option>
									</select>
								</div>
								<div class="field">
									<label>Mắt phải đeo kính</label>
									<select name="sk_deokinh">
										<option value="0">Không</option>
										<option value="1">Có</option>
									</select>
								</div>
							</div>
							<h3 class="ui header dividing">Hộ chiếu</h3>
							<div class="four fields">
								<div class="field">
									<div class="field">
										<label>Số hộ chiếu</label>
										<input type="text" name="hc_sohochieu">
									</div>
									<div class="field">
										<label>Nơi cấp</label>
										<input type="text" name="hc_noicap">
									</div>
								</div>
								<div class="field">
									<div class="field">
										<label>Ngày cấp</label>
										<div class="ui calendar" id="date-hc-ngaycap">
										    <div class="ui input left icon">
										      <i class="calendar icon"></i>
										      <input type="text" id="hc_ngaycap" name="hc_ngaycap">
										    </div>
										</div>
									</div>
									<div class="field">
										<label>Ngày hết hạn</label>
										<div class="ui calendar" id="date-hc-ngayhethan">
										    <div class="ui input left icon">
										      <i class="calendar icon"></i>
										      <input type="text" id="hc_ngayhethan" name="hc_ngayhethan">
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
										      <input type="text" id="hc_ngaynhan" name="hc_ngaynhan">
										    </div>
										</div>
									</div>
								</div>
								<div class="field">
									<label>Đính kèm file</label>
									<div class="ui fluid ">
										<input type="hidden" name="file_hc_hidden" value="create">
										<label for="hc-file" class="ui white basic right button custom-file-upload" style="text-align: left;">
	    									<i class="ui upload icon"></i> <b> Tải Lên File</b> <p> ( PDF, DOC, DOCX) </p>
	  									</label>
	  									<input id="hc-file" name='hc_file[]' type="file" style="display:none;" multiple>
									</div>
								</div>
							</div>

							
							<h3 class="ui header dividing">Chứng minh nhân dân</h3>
							<div class="four fields">
								<div class="field">
									<div class="field">
										<label>Số CMND</label>
										<input type="text" name="cmnd_socmnd">
									</div>		
								</div>
								<div class="field">
									<div class="field">
										<label>Nơi cấp</label>
										<input type="text" name="cmnd_noicap">
									</div>	
								</div>
								<div class="field">
									<div class="field">
										<label>Ngày cấp</label>
										<div class="ui calendar" id="date-cmnd-ngaycap">
										    <div class="ui input left icon">
										      <i class="calendar icon"></i>
										      <input type="text" id="cmnd_ngaycap" name="cmnd_ngaycap">
										    </div>
										</div>
									</div>
								</div>
								<div class="field">
									<label>Đính kèm file</label>
									<div class="ui fluid ">
										<input type="hidden" name="file_cmnd_hidden" value="create">
										<label for="cmnd-file" class="ui white basic right button custom-file-upload" style="text-align: left;">
	    									<i class="ui upload icon"></i> <b> Tải Lên File</b> <p> ( PDF, DOC, DOCX) </p>
	  									</label>
	  									<input id="cmnd-file" name='cmnd_file[]' type="file" style="display:none;" multiple>
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
										      <input type="text" id="ll_ngaycap" name="ll_ngaycap">
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
										      <input type="text" id="ll_ngaycohieuluc" name="ll_ngaycohieuluc">
										    </div>
										</div>
									</div>
								</div>
								<div class="field">
									<div class="field">
										<label>Ngày hết hiệu lục</label>
										<div class="ui calendar" id="date-ll-hethan">
										    <div class="ui input left icon">
										      <i class="calendar icon"></i>
										      <input type="text" id="ll_hethan" name="ll_hethan">
										    </div>
										</div>
									</div>
								</div>
								<div class="field">
									<label>Đính kèm file</label>
									<div class="ui fluid ">
										<input type="hidden" name="file_ll_hidden" value="create">
										<label for="ll-file" class="ui white basic right button custom-file-upload" style="text-align: left;">
	    									<i class="ui upload icon"></i> <b> Tải Lên File</b> <p> ( PDF, DOC, DOCX) </p>
	  									</label>
	  									<input id="ll-file" name='ll_file[]' type="file" style="display:none;" multiple>
									</div>
								</div>								
							</div>
							
							<h3 class="ui header dividing">Thông tin VISA</h3>
							<div class="three fields">
								<div class="field">
									<div class="field">
										<label>Số hiệu</label>
										<input type="text" name="vs_sohieu">
									</div>	
									<div class="field">
										<label>Ngày đăng ký</label>
										<div class="ui calendar" id="date-vs-ngaydangky">
										    <div class="ui input left icon">
										      <i class="calendar icon"></i>
										      <input type="text" id="vs_ngaydangky" name="vs_ngaydangky">
										    </div>
										</div>
									</div>								
								</div>
								<div class="field">
									<div class="field">
										<label>Ngày cấp</label>
										<div class="ui calendar" id="date-vs-ngaycap">
										    <div class="ui input left icon">
										      <i class="calendar icon"></i>
										      <input type="text" id="vs_ngaycap" name="vs_ngaycap">
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
										      <input type="text" id="vs_ngayhethan" name="vs_ngayhethan">
										    </div>
										</div>
									</div>
								</div>
								<div class="field">
									<label>Đính kèm file</label>
									<div class="ui fluid ">
										<input type="hidden" name="file_vs_hidden" value="create">
										<label for="vs-file" class="ui white basic right button custom-file-upload" style="text-align: left;">
	    									<i class="ui upload icon"></i> <b> Tải Lên File</b> <p> ( PDF, DOC, DOCX) </p>
	  									</label>
	  									<input id="vs-file" name='vs_file[]' type="file" style="display:none;" multiple>
									</div>
								</div>
							</div>
							
							<h3 class="ui header dividing">Khác</h3>
							<div class="field">
						          <label>Giấy tờ bổ sung</label>
						          <div class="wrap-giayto-dropdown" data-item-selected="">
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
								<textarea name="tt_lọakhac" rows="5"></textarea>
							</div>
							<div class="field">
								<label>Ghi chú thêm</label>
								<textarea name="tt_ghichu" rows="5"></textarea>
							</div>
							<h3 class="ui header">Scan file</h3>
							 <div class="field">
								<div class="ui fluid ">
									<input type="hidden" name="file_scan_hidden" value="create">
									<label for="scan-file" class="ui white basic right button custom-file-upload" style="text-align: left;">
										<i class="ui upload icon"></i> <b> Tải Lên File ( PDF, DOC, DOCX) </b>
									  </label>
									  <input id="scan-file" accept="application/pdf" name='scan_file[]' type="file" style="display:none;" multiple>
								</div>
							</div>
							
						</div>
						<script type="text/javascript">
							$(document).ready(function(){
							  	$("#ngaysinh,#ngaydangky,#hc_ngaycap,#hc_ngayhethan,#hc_ngaynhan,#cmnd_ngaycap,#ll_hethan,#ll_ngaycohieuluc,#ll_ngaycap,#vs_ngayhethan,#vs_ngaycap,#vs_ngaydangky").inputmask({ alias: "datetime", inputFormat: "dd-mm-yyyy"});
								$(".thoigianhocbd,.thoigianhockt,.namsinhgiadinh").inputmask({ alias: "datetime", inputFormat: "yyyy"});
								$(".thoigianlamviecbd,.thoigianlamvieckt").inputmask({ alias: "datetime", inputFormat: "mm-yyyy"});
							  $('#phone,#phone1').inputmask({ mask: "9999.999.999"});
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
							$('.menu .item')
							  .tab()
							;
							$('.ui.dropdown').dropdown('show');
						</script>
					</div>
				</div>
		</div> {{-- END SEGEMENT MAIN--}}
        <div class="ui segment">
          <div class="ui secondary menu">
              <div class="right menu">
		        <a href="{{url('hoso')}}" class="ui labeled icon button"><i class="arrow left icon"></i>Danh Sách</a>
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
 	$('#cmnd-file').change(function() {
		var i = $(this).prev('label').clone();
		var file = $('#cmnd-file')[0].files[0].name;
		$(this).prev('label').text(file);
	});
	$('#hc-file').change(function() {
		var i = $(this).prev('label').clone();
		var file = $('#hc-file')[0].files[0].name;
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
@endsection
@section('JsLibraries')
  <script src="{{url('js/admin/hoso/add_hoso.js')}}"></script>
@endsection