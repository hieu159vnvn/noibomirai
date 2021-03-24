@extends('admin.master')
@section('title', 'Thêm Học Viên Mới')
@section('PageContent')

<link rel="stylesheet" type="text/css" href="{{url('libraries/croper/croppie.css')}}">
<script src="{{url('libraries/croper/croppie.js')}}"></script>

	<div class="ui two column centered grid wrap-content-header">
		<h1 class="ui header centered page-title">THÊM NHÂN VIÊN</h1>
	</div>

	<form class="ui form" action="" method="post" name="form_1">
	{{ csrf_field() }}
	<div class="ui segments">
        <div class="ui segment">
          <div class="ui secondary menu">
              <div class="right menu">
		        <a href="{{url('nhanvien')}}" class="ui labeled icon button btn-align-left"><i class="arrow left icon"></i>Danh Sách</a>
				<button type="submit" class="ui labeled icon button blue"><i class="save icon"></i>Lưu</button>
              </div>
            </div>
     	</div>
		<div class="ui segment">
					<div class="ui two column centered grid main-content">	
							<div class="fifteen wide column">
				{{-- TIENG VIET --}}

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
												      <input class="ngaysinh" type="text" name="namsinh" required>
												    </div>
												</div>
											</div>
											<div class="field">
												<label>Điện thoại (*)</label>
												<div class="ui input left icon">
													<i class="mobile alternate icon"></i>
													<input class="dienthoai" type="text" name="dienthoai" value="{{ old('dienthoai') }}" required>
												</div>
											</div>
											
											<div class="field">
												<label>Giới tính</label>
											    <select name="gioitinh">
											     	<option value="1">Nam</option>
											     	<option value="0">Nữ</option>
											    </select>						    
											</div>
											<div class="field">
												<label>Hôn nhân</label>
												<select name="honnhan">
													<option value="Chưa kết hôn">Chưa kết hôn</option>
													<option value="Đã kết hôn">Đã kết hôn</option>
													<option value="Ly hôn">Ly hôn</option>
												</select>
											</div>
										</div>
										<div class="three fields">
											<div class="field">
												<label>Chức vụ</label>
												 <select name="chucvu">
											      @foreach($chucvu as $cv)
											      		<option value="{{$cv->id}}">{{$cv->chucvu_vn}}</option>
											      	@endforeach
											    </select>
											</div>
											<div class="field">
												<label>Email (*)</label>
												<div class="ui input left icon">
													<i class="map mail icon"></i>
													<input type="text" name="email" value="{{ old('email') }}" required>
												</div>
											</div>
											<div class="field">
												<label>Địa chỉ hộ khẩu (*)</label>
												<div class="ui input left icon">
													<i class="map outline icon"></i>
													<input type="text" name="diachi" value="{{ old('diachi') }}" required>
												</div>
											</div>
											<div class="field">
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
												<label>Trình độ</label>
												 <div class="ui input left icon">
													<i class="graduation cap icon"></i>
													<input type="text" name="trinhdo" value="{{ old('trinhdo') }}">
												</div>
											</div>
											<div class="field">
												<label>Chuyên môn</label>
												<div class="ui input left icon">
													<input type="text" name="chuyenmon" value="{{ old('chuyenmon') }}">
												</div>
											</div>
											<div class="field">
												<label>Ngoại ngữ</label>
												<div class="ui input left icon">
													<i class="language icon"></i>
													<input type="text" name="ngoaingu" value="{{ old('ngoaingu') }}" >
												</div>
											</div>
											<div class="field">
												<label>Ngày làm việc chính thức (*)</label>
												<div class="ui calendar" >
												    <div class="ui input left icon">
													  <i class="calendar icon"></i>
													  <input class="ngayvaolam"  type="text" name="ngayvaolam" value="{{ old('ngayvaolam') }}" required>
												    </div>
												</div>
											</div>
										</div>					
									</div>	
									<div class="two fields">
										<div class="field">
											<label>Kinh nghiệm làm việc</label>
											<textarea rows="10" name="kinhnghiem" placeholder="Nội dung...">{{ old('kinhnghiem') }}</textarea>
										</div>
										<div class="field">
											<label>Ghi chú (Nếu có)</label>
											<textarea rows="10" name="ghichu" placeholder="Nội dung...">{{ old('ghichu') }}</textarea>
										</div>
									</div>
									<div class="inline field">
										<label>(*) Trường bắt buộc phải nhập</label>
									</div>

				{{-- END TIENG VIET --}}
							</div>
					</div>
		</div>
		<div class="ui segment">
          <div class="ui secondary menu">
              <div class="right menu">
		        <a href="{{url('nhanvien')}}" class="ui labeled icon button btn-align-left"><i class="arrow left icon"></i>Danh Sách</a>
				<button type="submit" class="ui labeled icon button blue"><i class="save icon"></i>Lưu</button>
              </div>
            </div>
     	</div>
	</div>
	</form>
	<script type="text/javascript">
		$(document).ready(function(){
		  $(".ngaysinh").inputmask({ alias: "datetime", inputFormat: "dd-mm-yyyy"});
		  $('.dienthoai').inputmask({ mask: "9999.999.999"});
		  $(".ngayvaolam").inputmask({ alias: "datetime", inputFormat: "dd-mm-yyyy"});
		  
		});
	</script>
<script type="text/javascript">
	var calendarOpts = {
	    type: 'date',
	    text: {
			days: ['T2', 'T3', 'T4', 'T5', 'T6', 'T7', 'CN'],
			months: ['Tháng 1', 'Tháng 2', 'Tháng 3', 'Tháng 4', 'Tháng 5', 'Tháng 6', 'Tháng 7', 'Tháng 8', 'Tháng 9', 'Tháng 10', 'Tháng 11', 'Tháng 12'],
			monthsShort: ['Th1', 'Th2', 'Th3', 'Th4', 'Th5', 'Th6', 'Th7', 'Th8', 'Th9', 'Th10', 'Th11', 'Th12'],
			today: 'Hôm nay',
			now: 'Bây giờ',
			am: 'AM',
			pm: 'PM'
		}, 
	    formatter: {
	        date: function (date, settings) {
	            if (!date) return '';
	            var day = date.getDate() + '';
	            if (day.length < 2) {
	                day = '0' + day;
	            }
	            var month = (date.getMonth() + 1) + '';
	            if (month.length < 2) {
	                month = '0' + month;
	            }
	            var year = date.getFullYear();
	            return day + '/' + month + '/' + year;
	        }
	    }
	};
	$('#date-vaolam').calendar(calendarOpts);
</script>	
@endsection
@section('JsLibraries')
  <script src="{{url('js/admin/nhanvien/add_nhanvien.js')}}"></script>
@endsection