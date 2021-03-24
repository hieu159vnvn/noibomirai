@extends('admin.master')
@section('title', 'Sửa Đơn Hàng')
@section('PageContent')
<script src="https://cdn.rawgit.com/mdehoog/Semantic-UI/6e6d051d47b598ebab05857545f242caf2b4b48c/dist/semantic.min.js"></script>
	<div class="ui two column centered grid wrap-content-header">
		<h1 class="ui header centered page-title">SỬA ĐƠN HÀNG DH-0{{$donhang->id}}</h1>
	</div>	

	<div class="ui two column centered grid main-content">	
		<div class="fifteen wide column">
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
				{{ csrf_field() }}
				<div class="field thongtin">
					<input type="hidden" name="hocvien_id" value="{{ $donhang->hocvien_id }}">	
					<div class="field">
						<h2>Thông báo đơn hàng</h2>
					</div>		
					<div class="three fields">
						<div class="field">
							<label>Đơn hàng</label>
							<select name="tendonhang" class="ui search dropdown">					 
					      		<option value="THỰC TẬP SINH" @if ($donhang->tendonhang == 'THỰC TẬP SINH') selected @endif>THỰC TẬP SINH</option>
					      		<option value="KỸ SƯ" @if ($donhang->tendonhang == 'KỸ SƯ') selected @endif>KỸ SƯ</option>
					      		<option value="ĐIỀU DƯỠNG" @if ($donhang->tendonhang == 'ĐIỀU DƯỠNG') selected @endif>ĐIỀU DƯỠNG</option>	
					      		<option value="ĐẶC ĐỊNH" @if ($donhang->tendonhang == 'ĐẶC ĐỊNH') selected @endif>ĐẶC ĐỊNH</option>				      	
						    </select>
						</div>

						{{-- nghiep doan --}}
						<div class="field nghiepdoan">
							<label>Tên nghiệp đoàn</label>
							<select name="nghiepdoan" id="nghiepdoan" class="ui search dropdown">
								<option value="">ALL</option>
								@foreach($nghiepdoans as $nd)
									  <option value="{{$nd->id}}" @if ($nghiepdoan->id == $nd->id) selected @endif >{{$nd->tennghiepdoan}}</option>
								  @endforeach						      	
							</select>
						</div>

						<div class="field">
							<label>Tên công ty tiếp nhận (*)</label>
							@php
								$doitacs = DB::table('doitacs')->where('id_nghiepdoan',$nghiepdoan->id)->get();
							@endphp
							<select name="doitac" id="doitac" class="ui search dropdown">	
					      		@foreach($doitacs as $dt)
					      			<option value="{{$dt->id}}" @if($dt->id == $donhang->doitac_id) selected @endif >{{$dt->tencongty}}</option>
					      		@endforeach						      	
						    </select>
						</div>
						<div class="field">
							<label>Tên công ty tiếp nhận (VN)</label>
							<input type="text" name="doitacvn" value="{{ $donhang->doitacvn }}" >
						</div>
					</div>
					<div class="three fields">
						<div class="field">
							<label>Địa chỉ</label>
							<input type="text" name="diachi" value="{{ $donhang->diachi }}" >
						</div>
						<div class="field">
							<label>Chọn Ngành nghề</label>
							{{-- <select name="congviec" class="ui search dropdown">		 --}}
							<select name="congviec" id="nganhnghe" class="ui search dropdown">		      			
								@foreach($nganhnghe_dt as $nn)
									<option value="{{$nn->id}}" @if ($nn->id == $donhang->nganhnghe_id) selected @endif >{{$nn->nganhnghe_vn}} / {{$nn->nganhnghe_jp}}</option>
								@endforeach				      	
							</select>
						</div>

{{-- //////////////////////////////////////// --}}
						<div class="field">
							<label>Thêm Ngành nghề - Công ty</label>
							<input type="hidden" id="iddoitac" value="{{$donhang->doitac_id}}">
							<select class="ui fluid search dropdown" multiple="" id="nganhnghe_dt" name="nganhnghe_dt[]">
								@foreach ($nganhnghes as $item)
									<option value="{{$item->id}}">{{$item->nganhnghe_vn}} - "{{$item->nganhnghe_jp}}"</option>
								@endforeach
								@if ($nganhnghe_dt)
									@foreach ($nganhnghe_dt as $item)
										<option selected value="{{$item->id}}">{{$item->nganhnghe_vn}} - "{{$item->nganhnghe_jp}}"</option>
									@endforeach
								@endif
								
							</select>
						</div>

					</div>
					<div class="two fields">
						<div class="field">
							<label>Nội dung công việc</label>
							<input type="text" name="tieudethem" value="{{ $donhang->tieudethem }}" >
						</div>
						<div class="field">
							<label>Nội dung công việc JP</label>
							<input type="text" name="tieudethemjp" value="{{ $donhang->tieudethemjp }}" >
						</div>
					</div>
					<div class="three fields">
						<div class="field">
							<label>Nơi làm việc</label>
							<input type="text" name="noilamviec" value="{{ $donhang->noilamviec }}">
						</div>
						<div class="field">
							<label>Thời gian làm việc</label>
							<input type="text" name="thoigian" value="{{ $donhang->thoigian }}">
						</div>
						<div class="field">
							<label>Lương cơ bản</label>
							<input type="text" name="luongcoban" value="{{ $donhang->luongcoban }}">
						</div>
					</div>
					<div class="four fields">
						
						{{-- <div class="field">
							<label>Thuế</label>
							<input type="number" name="thue" value="{{ $donhang->thue }}" >
						</div>
						<div class="field">
							<label>Bảo hiểm</label>
							<input type="number" name="baohiem" value="{{ $donhang->baohiem }}" >
						</div>
						<div class="field">
							<label>Tiền nhà</label>
							<input type="number" name="tiennha" value="{{ $donhang->tiennha }}" >
						</div> --}}
						<div class="field twelve wide column">
							<label>Các khoản khấu trừ</label>
							<textarea rows="3" name="khautru" placeholder="thuế: 100 yên + bảo hiểm: 100 yên + tiền nhà: 100 yên ">{{ $donhang->khautru }}</textarea>
						</div>
						<div class="field four wide column">
							<label>Lương thực lãnh</label>
							<input type="text" name="luongthuclanh" value="{{ $donhang->luongthuclanh }}" >
						</div>
					</div>
					<div class="four fields">
						<div class="field">
							<label>Số lượng trúng tuyển</label>
							<input type="text" name="soluongtuyen" value="{{ $donhang->soluongtuyen }}" >
						</div>
						<div class="field">
							<label>Số lượng trúng tuyển JP</label>
							<input type="text" name="soluongtuyenjp" value="{{ $donhang->soluongtuyenjp }}" >
						</div>
						<div class="field">
							<label>Tổng số lượng ứng viên</label>
							<input type="text" name="soluongungvien" value="{{ $donhang->soluongungvien }}" >
						</div>
						<div class="field">
							<label>Tổng số lượng ứng viên JP</label>
							<input type="text" name="soluongungvienjp" value="{{ $donhang->soluongungvienjp }}" >
						</div>
					</div>
					<div class="two fields">
						<div class="field">
							<label>Dự kiến Xuất cảnh</label>
							<div class="ui calendar">
								<div class="ui input left icon">
									<i class="calendar icon"></i>
									<input type="text" class="date-dukien" name="dukienxc" value="{{ $donhang->dukienxc}}" >
								</div>
							</div>
						</div>
						<div class="field">
							<label>Trình độ</label>
							<input type="text" name="trinhdo" value="{{ $donhang->trinhdo }}" >
						</div>
						<div class="field">
							<label>Nơi thi</label>
							<input type="text" name="noithi" value="{{ $donhang->noithi }}" >
						</div>
					</div>
					<div class="two fields">
						<div class="field">
							<label>Ngày tuyển bắt đầu (*)</label>
							<div class="ui calendar">
							    <div class="ui input left icon">
							      <i class="calendar icon"></i>
							      <input type="text" class="date-bd" name="ngaytuyenbd" value="{{ $donhang->ngaytuyenbd }}" >
							    </div>
							</div>
						</div>
						<div class="field">
							<label>Ngày tuyển kết thúc (*)</label>
							<div class="ui calendar" >
							    <div class="ui input left icon">
							      	<i class="calendar icon"></i>
							      	<input type="text" class="date-kt" name="ngaytuyenkt" value="{{ $donhang->ngaytuyenkt }}" >
							    </div>
							</div>
						</div>
					</div>
					<div class="field">
							<label>Yêu cầu khác</label>
							<textarea rows="5" name="yeucau">{{ $donhang->yeucau }}</textarea>
						</div>
					<div class="field">
						<h2>Thông tin đơn hàng</h2>
						
					</div>	
					<div class="two fields">
						<div class="field">
							<label>Người quản lý đơn hàng</label>
							<input type="text" name="nguoiqldh" value="{{ $donhang->nguoiqldh }}">
						</div>
						<div class="field">
							<label>Người quản lý đơn hàng JP</label>
							<input type="text" name="nguoiqldhjp" value="{{ $donhang->nguoiqldhjp }}">
						</div>
					</div>
					<div class="two fields">
							<div class="field">
								<label>Ngày phỏng vấn</label>
								<div class="ui calendar">
									<div class="ui input left icon">
										@php
											$LogintDate = strtotime($donhang->ngaypv);
            								$ngaypv = date('d-m-Y', $LogintDate);
										@endphp
										<i class="calendar icon"></i>
										<input type="text" class="date-pv" name="ngaypv" value="{{ $ngaypv }}" >
									</div>
								</div>
							</div>
							<div class="field">
								<label>Ngày gửi lý lịch</label>
								<div class="ui calendar">
									<div class="ui input left icon">
										<i class="calendar icon"></i>
										<input type="text" class="date-guill" name="ngayguill" value="{{ $donhang->ngayguill }}" >
									</div>
								</div>
							</div>
						</div>					
					<div class="field ">
						<h3>Đính kèm file</h3>
						<input type="hidden" name="file_hc_hidden" value="{{$donhang->hc_file}}">
						<label for="hc-file" class="ui white basic right button custom-file-upload" style="text-align: left;">
							<i class="ui upload icon"></i> <b> Tải Lên File </b>  ( PDF, DOC, DOCX ) 
						  </label>
						  <input id="hc-file" name='hc_file[]' value="{{$donhang->hc_file}}" type="file" style="display:none;" multiple>
						  @php 
							  $timestamp = strtotime($donhang->created_at);
							$year = date("Y", $timestamp);
							$month = date("m", $timestamp);
						  @endphp
						  @if($donhang->hc_file)
						  @php 
							  $hc_file = json_decode($donhang->hc_file); 
						  @endphp
						  @foreach($hc_file as $hc)
						  <label class="ui white basic field " style="text-align: left;">
							  <i class="ui download icon"></i>
							  <a href="{{url('/uploads/donhangpdfs/'.$year.'/'.$month.'/'.$donhang->id.'/hc/'.$hc)}}" target="_blank">{{$hc}}</a>
							  <i class="ui trash icon red right removefile" datatype="hc" datafile="{{$hc}}"></i>
						  </label>
						  @endforeach
						  @endif
					</div>
					<div class="inline field">
					<label>(*) Trường bắt buộc phải nhập</label>
					</div>		
				</div>	

				<div class="ui two column centered grid">
					<div class="eight wide column">
						<a href="{{url('donhang')}}" class="ui labeled icon button btn-align-left"><i class="arrow left icon"></i>Danh Sách</a>
						<button type="submit" class="ui labeled icon button blue btn-align-right"><i class="save icon"></i>Lưu</button>
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
				
			</form>
		</div>
	</div>
<script type="text/javascript">
	// $(".date-dukien").inputmask({ alias: "datetime", inputFormat: "dd/mm/yyyy"});
	// $(".date-bd").inputmask({ alias: "datetime", inputFormat: "dd/mm/yyyy"});
	// $(".date-kt").inputmask({ alias: "datetime", inputFormat: "dd/mm/yyyy"});
	// $(".date-pv").inputmask({ alias: "datetime", inputFormat: "dd-mm-yyyy"});
	// $(".date-guill").inputmask({ alias: "datetime", inputFormat: "dd/mm/yyyy"});
	$(".date-dukien").inputmask("99/99/9999");
	$(".date-bd").inputmask("99/99/9999");
	$(".date-kt").inputmask("99/99/9999");
	$(".date-pv").inputmask("99/99/9999");
	$(".date-guill").inputmask("99/99/9999");
</script>
<script>
	$('.ui.search.dropdown').dropdown({clearable: true});
	$('.ui.selection.dropdown').dropdown();
</script>

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
  $('#hc-file').change(function() {
	  var i = $(this).prev('label').clone();
	  var file = $('#hc-file')[0].files[0].name;
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
<script>
	 $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
$("#nganhnghe_dt").on("change", function() {
		var nganhnghe = $(this).val();
		var id = $('#iddoitac').val();
		console.log(id);
		console.log(nganhnghe);
		$.post("/donhang/nganhnghe-dt/"+id+"/ajax",
        {
            nganhnghe: nganhnghe
        },
        function(data){
			$("#nganhnghe").empty();
			function printContentArray(array){
				array.forEach(function print(element){
					$("#nganhnghe").append("<option value='"+element.id+"'>"+element.nganhnghe_vn+" / "+element.nganhnghe_jp+"</option>");		
				});
			}
			printContentArray(data);	
			console.log(data);
      });
	});


	$("#nghiepdoan").on("change", function() {
		var id = $(this).val();
		$.get("/donhang/nghiepdoan/"+id+"/ajax", function(data, status){
			$("#doitac").empty();
			$("#doitac").append("<option value=''>ALL</option>");
			function printContentArray(array){
				array.forEach(function print(element){
					$("#doitac").append("<option value='"+element.id+"'>"+element.tencongty+"</option>");		
				});
			}
			printContentArray(data);	
		});	
	});
	$("#doitac").on("change", function() {
		var id = $(this).val();

		$.get("/donhang/doitac/"+id+"/ajax", function(data, status){
			$("#nganhnghe").empty();
			function printContentArray(array){
				array.forEach(function print(element){
					$("#nganhnghe").append("<option value='"+element.id+"'>"+element.nganhnghe_vn+" / "+element.nganhnghe_jp+"</option>");		
				});
			}
			printContentArray(data);	
			console.log(data);
		});	
	});



</script>

@endsection