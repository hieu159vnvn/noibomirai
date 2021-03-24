@extends('admin.master')
@section('title', 'Tạo Đơn Hàng')
@section('PageContent')
	<div class="ui two column centered grid wrap-content-header">
		<h1 class="ui header centered page-title">TẠO ĐƠN HÀNG</h1>
	</div>	
	@if ($errors->any())
		<div class="ui red message">
			<ul>
				@foreach ($errors->all() as $error)
					<li>{{ $error }}</li>
				@endforeach
			</ul>
		</div>
	@endif
	@if (session('status'))
		<div class="ui positive message">
			<i class="close icon"></i>
			<div class="header">
				Thông Báo !
			</div>
			<p>{{ session('status') }}</p>
		</div>
	@endif
	<form class="ui form" action="" method="post" name="form_1" autocomplete="off" enctype="multipart/form-data">
	<div class="ui two column centered grid main-content">	
		<div class="fifteen wide column">
			<div class="ui segments">
		        <div class="ui segment">
		         	<div class="ui secondary menu">		         		
		                <div class="right menu">
		              	<a href="{{url('donhang')}}" class="ui labeled icon button btn-align-left"><i class="arrow left icon"></i>Danh Sách</a>
						<button type="submit" class="ui labeled icon button green btn-align-right"><i class="save icon"></i>Lưu</button>
		              </div>
		            </div>
				 </div>

     			<div class="ui segment">					
						{{ csrf_field() }}
						<div class="field thongtin">
							<div class="field">
								<h2>Thông báo đơn hàng</h2>			
							</div>
							<div class="three fields">
								<div class="field">
									<label>Đơn hàng</label>
									<select name="tendonhang" class="ui search dropdown">					 
							      		<option value="THỰC TẬP SINH">THỰC TẬP SINH</option>
							      		<option value="KỸ SƯ">KỸ SƯ</option>
							      		<option value="ĐIỀU DƯỠNG">ĐIỀU DƯỠNG</option>				      	
								    </select>
								</div>
								<div class="field">
									<label>Tên công ty tiếp nhận (JP *)</label>
									<select name="doitac" class="ui search dropdown">
										@foreach($doitac as $dt)
							      			<option value="{{$dt->id}}">{{$dt->tencongty}}</option>
							      		@endforeach						      	
								    </select>
								</div>
								<div class="field">
									<label>Tên công ty tiếp nhận (VN)</label>
									<input type="text" name="doitacvn" value="{{ old('doitacvn') }}" placeholder="Tên công ty tiếp nhận (vn)">
								</div>
							</div>
							<div class="two fields">
								<div class="field">
									<label>Địa chỉ </label>
									<input type="text" name="diachi" value="{{ old('diachi') }}" placeholder="địa chỉ làm việc">
								</div>
								<div class="field">
									<label>Ngành nghề</label>
									<select name="congviec" class="ui search dropdown">
										@foreach($nganhnghe as $nn)
							      			<option value="{{$nn->id}}">{{$nn->nganhnghe_vn}}</option>
							      		@endforeach						      	
								    </select>
								</div>
							</div>
							<div class="two fields">
								<div class="field">
									<label>Nội dung công việc</label>
									<input type="text" name="tieudethem" value="{{ old('tieudethem') }}" placeholder="Nội dung công việc tiếng Việt">
								</div>
								<div class="field">
									<label>Nội dung công việc JP</label>
									<input type="text" name="tieudethemjp" value="{{ old('tieudethemjp') }}" placeholder="Nội dung công việc tiếng Nhật">
								</div>
							</div>
							<div class="three fields">
								<div class="field">
									<label>Nơi làm việc</label>
									<input type="text" name="noilamviec" value="{{ old('noilamviec') }}" placeholder="nơi làm việc">
								</div>
								<div class="field">
									<label>Thời gian làm việc</label>
									<input type="text" name="thoigian" value="{{ old('thoigian') }}" placeholder="6h-18h" >
								</div>
								<div class="field">
									<label>Lương cơ bản</label>
									<input type="text" name="luongcoban" value="{{ old('luongcoban') }}" placeholder="Yên" >
								</div>
							</div>
							<div class="four fields">
								{{-- <div class="field">
									<label>Thuế</label>
									<input type="number" name="thue" value="{{ old('thue') }}" placeholder="Yên" required>
								</div>
								<div class="field">
									<label>Bảo hiểm</label>
									<input type="number" name="baohiem" value="{{ old('baohiem') }}" placeholder="Yên" required>
								</div>
								<div class="field">
									<label>Tiền nhà</label>
									<input type="number" name="tiennha" value="{{ old('tiennha') }}" placeholder="Yên" required>
								</div> --}}
								<div class="field twelve wide column">
									<label>Các khoản khấu trừ (thuế, bảo hiểm, tiền nhà)</label>
									<textarea rows="3" name="khautru" placeholder="thuế: 100 yên + bảo hiểm: 100 yên + tiền nhà: 100 yên ">{{ old('khautru') }}</textarea>
								</div>
								<div class="field four wide column">
									<label>Lương thực lãnh</label>
									<input type="text" name="luongthuclanh" value="{{ old('luongthuclanh') }}" placeholder="Yên" >
								</div>
							</div>
							<div class="four fields">
								<div class="field">
									<label>Số lượng trúng tuyển</label>
									<input type="text" name="soluongtuyen" value="{{ old('soluongtuyen') }}" placeholder="10 nữ">
								</div>
								<div class="field">
									<label>Số lượng trúng tuyển JP</label>
									<input type="text" name="soluongtuyenjp" value="{{ old('soluongtuyenjp') }}" placeholder="10 nữ (tiếng Nhật) ">
								</div>
								<div class="field">
									<label>Tổng số lượng ứng viên</label>
									<input type="text" name="soluongungvien" value="{{ old('soluongungvien') }}" placeholder="20 nữ ">
								</div>
								<div class="field">
									<label>Tổng số lượng ứng viên JP</label>
									<input type="text" name="soluongungvienjp" value="{{ old('soluongungvienjp') }}" placeholder="20 nữ (tiếng Nhật) ">
								</div>
							</div>
							<div class="two fields">
								<div class="field">
									<label>Dự kiến Xuất cảnh</label>
									<div class="ui calendar" >
										<div class="ui input left icon">
											<i class="calendar icon"></i>
											<input type="text" class="date-dukien" name="dukienxc" value="{{ old('dukienxc') }}" >
										</div>
									</div>
								</div>
								<div class="field">
									<label>Trình độ</label>
									<input type="text" name="trinhdo" value="{{ old('trinhdo') }}" placeholder="Cao Đẵng / Đại Học" >
								</div>
								<div class="field">
									<label>Nơi thi</label>
									<input type="text" name="noithi" value="{{ old('noithi') }}"  >
								</div>
							</div>
							<div class="two fields">
								<div class="field">
									<label>Ngày tuyển bắt đầu (*)</label>
									<div class="ui calendar">
									    <div class="ui input left icon">
									      <i class="calendar icon"></i>
									      <input type="text" class="date-bd" name="ngaytuyenbd" value="{{ old('ngaytuyenbd') }}" >
									    </div>
									</div>
								</div>
								<div class="field">
									<label>Ngày tuyển kết thúc (*)</label>
									<div class="ui calendar">
									    <div class="ui input left icon">
									      <i class="calendar icon"></i>
									      <input type="text" class="date-kt" name="ngaytuyenkt" value="{{ old('ngaytuyenkt') }}" >
									    </div>
									</div>
								</div>	
							</div>
							<div class="field">
								<label>Yêu cầu khác</label>
								<textarea rows="5" name="yeucau">{{ old('yeucau') }}</textarea>
							</div>
							<div class="field">
								<h3>Thông tin đơn hàng</h3>
							</div>
							<div class="two fields">
								<div class="field">
									<label>Người quản lý đơn hàng</label>
									<input type="text" name="nguoiqldh" value="{{ old('nguoiqldh') }}" placeholder="Người quản lý đơn hàng">
								</div>
								<div class="field">
									<label>Người quản lý đơn hàng JP</label>
									<input type="text" name="nguoiqldhjp" value="{{ old('nguoiqldhjp') }}" placeholder="Người quản lý đơn hàng tiếng nhật">
								</div>
							</div>
							<div class="two fields">
								<div class="field">
									<label>Ngày phỏng vấn</label>
									<div class="ui calendar">
										<div class="ui input left icon">
											<i class="calendar icon"></i>
											<input type="text" class="date-pv" name="ngaypv" value="{{ old('ngaypv') }}" >
										</div>
									</div>
								</div>
								<div class="field">
									<label>Ngày gửi lý lịch</label>
									<div class="ui calendar">
										<div class="ui input left icon">
											<i class="calendar icon"></i>
											<input type="text" class="date-guill" name="ngayguill" value="{{ old('ngayguill') }}" >
										</div>
									</div>
								</div>
							</div>
							<div class="field">
								<h3>Đính kèm file</h3>
								<div class="ui fluid ">
									<input type="hidden" name="file_hc_hidden" value="create">
									<label for="hc-file" class="ui white basic right button custom-file-upload" style="text-align: left;">
										<i class="ui upload icon"></i> <b> Tải Lên File</b> ( PDF, DOC, DOCX)
									  </label>
									  <input id="hc-file" name='hc_file[]' type="file" style="display:none;" multiple>
								</div>
							</div>
							<div class="inline field">
							<label>(*) Trường bắt buộc phải nhập</label>
							</div>		
						</div>	
					</div>
					<div class="ui segment">
			         	<div class="ui secondary menu">
			              <div class="right menu">
			              	<a href="{{url('donhang')}}" class="ui labeled icon button btn-align-left"><i class="arrow left icon"></i>Danh Sách</a>
							<button type="submit" class="ui labeled icon button green btn-align-right"><i class="save icon"></i>Lưu</button>
			              </div>
			            </div>
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
	  label {
	  font-weight: bold !important;
	  color: cadetblue;
  }
  </style>
  <script type="text/javascript">
	$(".date-dukien").inputmask({ alias: "datetime", inputFormat: "dd/mm/yyyy"});
	$(".date-bd").inputmask({ alias: "datetime", inputFormat: "dd/mm/yyyy"});
	$(".date-kt").inputmask({ alias: "datetime", inputFormat: "dd/mm/yyyy"});
	$(".date-pv").inputmask({ alias: "datetime", inputFormat: "dd-mm-yyyy"});
	$(".date-guill").inputmask({ alias: "datetime", inputFormat: "dd/mm/yyyy"});
</script>
  <script type="text/javascript">
	//    $('#cmnd-file').change(function() {
	// 	  var i = $(this).prev('label').clone();
	// 	  var file = $('#cmnd-file')[0].files[0].name;
	// 	  $(this).prev('label').text(file);
	//   });
	  $('#hc-file').change(function() {
		  var i = $(this).prev('label').clone();
		  var file = $('#hc-file')[0].files[0].name;
		  $(this).prev('label').text(file);
	  });
	//   $('#vs-file').change(function() {
	// 	  var i = $(this).prev('label').clone();
	// 	  var file = $('#vs-file')[0].files[0].name;
	// 	  $(this).prev('label').text(file);
	//   });
	//   $('#ll-file').change(function() {
	// 	  var i = $(this).prev('label').clone();
	// 	  var file = $('#ll-file')[0].files[0].name;
	// 	  $(this).prev('label').text(file);
	//   });
  </script>
<script>
	$('.ui.search.dropdown').dropdown({clearable: true});
</script>
@endsection
@section('JsLibraries')
  {{-- <script src="{{url('js/admin/chucvu/add_chucvu.js')}}"></script> --}}
@endsection