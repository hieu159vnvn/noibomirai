@extends('admin.master')
@section('title', 'Điểm danh')
@section('PageContent')
@php
	function yearmonth($created_at){
		$timestamp = strtotime(date("Y-m-d H:i:s"));
    	$year = date("Y", $timestamp);
		$month = date("m", $timestamp);
		return $year."/".$month;
	}
	
@endphp
<h2 class="ui header center aligned">
ĐIỂM DANH  
<div class="sub header">
	<h3>Lớp Học : {{$lop->ten_lop_hoc}}</h3>
</div>
</h2>
<h4>GIÁO VIÊN: <img src="{{$lop->hinhanh}}" alt="" style="height: 40px;"> {{$lop->hoten}}</h4> 
@if (session('status'))
<div class="ui message">
<i class="close icon"></i>
<div class="header">
  Thông Báo !
</div>
<p>{{ session('status') }}</p>
</div>
@endif	
<form class="ui form" action="" method="post" name="form_1" enctype="multipart/form-data">
	{{ csrf_field() }}	
	<div class="field">
	@if(!$dbcheck || ($dbcheck == null))
	{{-- add --}}
		<table id="data-table" class="ui selectable celled striped table">
			<thead class="full-width" style="text-align: left;">
				<tr>
					<th class="td collapsing">TÊN HỌC VIÊN</th>
					<th class="collapsing">HIỆN DIỆN</th>
					<th class="collapsing">NGHỈ PHÉP</th>
					<th>LÝ DO</th>
				</tr>
			</thead>
			<tbody style="text-align: left;">
				@foreach($hocvien as $hv)
					<input type="hidden" name="id_hocvien[]" value="{{$hv->id}}">
					<tr class="diemdanh">
						<td class="collapsing"><h4>{{$hv->hoten}}</h4></td>
						<td class="collapsing vangmat">
							<div class="ui toggle checkbox">
								<input type="checkbox"  class="checked" name="vang[]" value="{{$hv->id}}">
								<label>vắng mặt</label>
							</div>
						</td>
						<td class="collapsing phep">
							<span class="container">
								<div class="ui toggle checkbox">
									<input type="checkbox"  class="checked" name="phep[]" value="{{$hv->id}}">
									<label>Có phép</label>
								</div> &nbsp;
								<div class="ui toggle checkbox">
									<input type="checkbox"  class="checkedtre" name="tre[]" value="{{$hv->id}}">
									<label>Đi Trễ</label>
								</div>
							</span>
						</td>
						<td class="lydo">
							<div class="ui form">
								<div class="inline fields">
									<div class="field">
										<div class="container_field">
											<label for="file-{{$hv->id_hocvien}}" class="ui icon button">
												<i class="cloud icon"></i> Phép
											</label>
											<input type="file" name="donphep[]" class="imageUpload" accept=".png, .jpg, .jpeg" id="file-{{$hv->id_hocvien}}" style="display: none">
										</div>
									</div>
									<div class="field">
										<div class="container_close">
											<div class="closed" ><i class="large icon"></i></div>
										</div>
									</div>
									<div class="field">
										<div class="container_preview">
											<img class="imagePreview" src="" alt="" height="35px">
										</div>
									</div>
									<div class="ten wide field">
										<input type="text" class="container" name="lydo[]" value="" placeholder="Lý do">
									</div>
									<div class="field">
										<select name="tiet[]" class="ui dropdown containertre" >
											<option value="">Chọn Tiết</option>
											@for( $i = 1; $i < 8; $i++ )
												<option value="{{$i}}">Tiết {{$i}}</option>
											@endfor
										</select>
									</div>
								</div>
							</div>
						</td>
					</tr>
				@endforeach       
			</tbody>
		</table>					
	@else
		<input type="hidden" name="id_lop" value="{{$dbcheck->id_lop}}">
	{{-- edit --}}
		<table id="data-table" class="ui selectable celled striped table">
			<thead class="full-width" style="text-align: left;">
				<tr >
					<th class="collapsing">TÊN HỌC VIÊN</th>
					<th class="collapsing">HIỆN DIỆN</th>
					<th class="collapsing">NGHỈ PHÉP</th>
					<th>LÝ DO</th>					          
				</tr>
			</thead>
			<tbody style="text-align: left;">
				@foreach ($hocvien as $hv)
				<input type="hidden" name="id_hocvien[]" value="{{$hv->id_hocvien}}">
				<input type="hidden" name="id_diemdanh[]" value="{{$hv->id_diemdanh}}">
				<input type="hidden" name="id[]" value="{{$hv->id}}">
				<input type="hidden" class="duyet" name="duyet[]" value="{{$hv->duyet}}">
				<tr class="diemdanh">
					<td class="collapsing">
						{{$hv->hoten}}
					</td>
					<td class="collapsing vangmat ">
						<div class="ui toggle checkbox">
						  <input type="checkbox" class="checked" @if($hv->vang == 1) checked @endif name="vang[]" value="{{$hv->id_hocvien}}">
						  <label>Vắng mặt</label>
						</div>
					</td>
					<td class="collapsing phep">
						<div class="container">
							<div class="ui toggle checkbox">
								<input type="checkbox" class="checked" @if($hv->phep == 1) checked @endif name="phep[]" value="{{$hv->id_hocvien}}">
								<label>Có phép</label>
							</div>&nbsp;
							<div class="ui toggle checkbox">
								<input type="checkbox" @if($hv->tre == 1) checked @endif  class="checkedtre" name="tre[]" value="{{$hv->id_hocvien}}">
							 	<label>Đi Trễ</label>
							</div>
						</div>
					</td>
					<td class="lydo">
						<div class="ui form">
							<div class="inline fields">
								<div class="field">
									<div class="container_field">
										<label for="file-{{$hv->id_hocvien}}" class="ui icon button">
											<i class="cloud icon"></i>
										</label>
										<input type="file" name="donphep[]" class="imageUpload" accept=".png, .jpg, .jpeg" id="file-{{$hv->id_hocvien}}" style="display: none">
										<input type="hidden" name="donphephide[]" class="filehide" value="{{$hv->donphep}}">
									</div>
								</div>
								<div class="field">
									<div class="container_close">
										@if ($hv->donphep)
											<div class="closed"><i class="large icon close gray"></i></div>
										@else
											<div class="closed" ><i class="large icon"></i></div>
										@endif
									</div>
								</div>
								<div class="field">
									<div class="container_preview">
										@if ($hv->donphep)
											<a href="{{url('uploads/daotao/phep')}}/{{yearmonth($hv->created_at)}}/{{$hv->donphep}}?v={{time()}}">
												<img class="imagePreview" src="{{url('uploads/daotao/phep')}}/{{yearmonth($hv->created_at)}}/{{$hv->donphep}}?v={{time()}}" height="35px">
											</a>
										@else							
											<img class="imagePreview" src="" alt="" height="35px">
										@endif
									</div>
								</div>
								<div class="ten wide field">
									<input type="text" class="container" name="lydo[]" value="{{$hv->lydo}}" placeholder="Lý do">
								</div>
								<div class="field">
									<select name="tiet[]" class="ui dropdown containertre" >
										<option value="">Chọn Tiết</option>
										@for( $i = 1; $i < 8; $i++ )
											<option @if($hv->tiet == $i) selected @endif value="{{$i}}">Tiết {{$i}}</option>
										@endfor
									</select>
								</div>
							</div>
						</div>

					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
		
	@endif
	<p class="p"></p>
	<div class="ui two column  grid">
		<div class="eight wide column">
			@if($dbcheck || ($dbcheck != null))
				@if($dbcheck->khoaduyet == 1 )
					<div class="ui labeled icon button red"><i class="circle icon"></i>Đã khóa</div>
					@if (Auth::user()->hasRole('Đào Tạo'))
						<button class="ui labeled icon button blue  checkk"><i class="save icon"></i>Đồng ý </button> (trường bộ phận đào tạo có quyền sửa)
					@else
						<div class="ui labeled icon button red checkk"><i class="save icon"></i>Đồng ý</div>
					@endif
				@else
					<button class="ui labeled icon button blue  checkk"><i class="save icon"></i>Đồng ý</button>
				@endif
			@else
				<button class="ui labeled icon button blue  checkk"><i class="save icon"></i>Đồng ý</button>
			@endif
		</div>
	</div>
	<br>
	{{-- result --}}
	@if($dbcheck || ($dbcheck != null))
		<h3 class="ui red label">Kết quả điểm danh ngày {{date("d-m-Y")}}</h3>
		<table  class="ui selectable celled striped table">
			<thead class="full-width" style="text-align: left;">
				<tr>
					<th>TÊN HỌC VIÊN</th>
					<th>ĐIỂM DANH</th>
					<th>LÝ DO</th>
					<th>DUYỆT</th>					          
				</tr>
			</thead>
			<tbody style="text-align: left;">
				@foreach ($hocvien as $hv) 
				<tr>
					<td>
						{{$hv->hoten}}
					</td>
					<td>
						@if ($hv->vang != 1)
							<span class="ui blue basic label"><i class="small checkmark icon blue"></i> CÓ MẶT </span>
						@else
							@if ($hv->tre == 1)
								<span class="ui yellow basic label">
									<i class="large close icon red"></i> TRỄ </label>
								</span>
								<div class="ui left pointing black label"> Tiết {{$hv->tiet}}</div>	
							@else
								@if ($hv->phep == 1)
									<span class="ui orange basic label"><i class="large icon close red"></i> CÓ PHÉP </span>
								@else
									<span class="ui red basic label"><i class="large icon close red"></i> KHÔNG PHÉP </span>
								@endif
							@endif
						@endif
					</td>
					<td>
						@if($hv->lydo)
							<label>Lý do: {{$hv->lydo}}</label>
						@endif
					</td>
					<td>
						@if ($hv->duyet || ($dbcheck->khoaduyet == 1)) 
							<span class="ui blue label"> <i class="icon check red"></i> Đã xác nhận</span>
						@else
							<span class="ui red label"> <i class="icon close red"></i> Chưa xác nhận</span>
						@endif
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	@endif
</form>
	{{-- test --}}
<script type="text/javascript">
$('.ui.dropdown').dropdown();
	function readURL(input, previewId) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();
			reader.onload = function(e) {
				$(previewId).attr('src',e.target.result)
				$(previewId).hide();
				$(previewId).fadeIn(650);
			}
			reader.readAsDataURL(input.files[0]);
		}
	}
	
	$(document).ready(function(){
		$('.nutluu').hide();
		var length = $( '.diemdanh').length;
		var i;
			
		$('.phep .container').hide();
		$('.lydo .container').hide();
		$('.lydo .containertre').hide();
		$('.lydo .container_field').hide();
		for (i = 0; i < length; i++) {
			checked(i);
			image(i);
			closed(i);
			popupimg(i);
		}
		function image(i) {
			$(".imageUpload:eq("+i+")").change(function() {
				readURL(this, '.imagePreview:eq('+i+')');
				$(".closed:eq("+i+")").remove();
				$(".container_close:eq("+i+")").append('<div class="closed"><i class="large icon close gray"></i></div>');
			});  
		}
		function closed(i) {
			$("#data-table").on("click",".closed:eq("+i+")",function() {
				$(".imageUpload:eq("+i+")").val('');
				$(".filehide:eq("+i+")").val('');
				$(this).remove();
				$(".imagePreview:eq("+i+")").attr('src','');		
			});  
		}
		function popupimg(i) {
			$('.imagePreview:eq('+i+')').popup();
		}
		function checked(i){
			$('.vangmat .checked:eq('+ i +')').click(function(){
				$('.phep .checked:eq('+ i +')').prop( "checked", false);
				$('.phep .checkedtre:eq('+ i +')').prop( "checked", false);
				var checked = $('.vangmat .checked:eq('+ i +')').is(":checked");
				if (checked == true) {
					$('.phep .container:eq('+ i +')  ').show();
					$('.lydo .container:eq('+ i +')  ').hide();
					$('.lydo .containertre:eq('+ i +')  ').hide();
				}else {
					$('.phep .container:eq('+ i +')  ').hide();
					$('.lydo .container:eq('+ i +')  ').hide();
					$('.lydo .containertre:eq('+ i +')  ').hide();
					$('.lydo .container_field:eq('+ i +')  ').hide();
					$('.lydo .container_preview:eq('+ i +')  ').hide();
					$('.lydo .container_close:eq('+ i +')  ').hide();
					$(".filehide:eq("+i+")").val('');
					$('.lydo .container:eq('+ i +')  ').val('');

				}
			});
			$('.phep .checked:eq('+ i +')').click(function(){
				$('.vangmat .checked:eq('+ i +')').prop( "checked", true );
				$('.phep .checkedtre:eq('+ i +')').prop( "checked", false);
				var checked = $('.phep .checked:eq('+ i +')').is(":checked");
				if (checked == true) {
					$('.lydo .container:eq('+ i +')  ').show();
					$('.lydo .containertre:eq('+ i +')  ').hide();
					$('.lydo .container_field:eq('+ i +')  ').show();
				}else {
					$('.lydo .container:eq('+ i +')  ').hide();
					$('.lydo .container:eq('+ i +')  ').val('');
					$('.lydo .container_field:eq('+ i +')  ').hide();
					$('.lydo .container_preview:eq('+ i +')  ').hide();
					$('.lydo .container_close:eq('+ i +')  ').hide();
				}
			});
			$('.phep .checkedtre:eq('+ i +')').click(function(){
				$('.vangmat .checked:eq('+ i +')').prop( "checked", true );
				$('.phep .checked:eq('+ i +')').prop( "checked", false);
				var checked = $('.phep .checkedtre:eq('+ i +')').is(":checked");
				if (checked == true) {
					$('.lydo .containertre:eq('+ i +')  ').show();
					$('.lydo .container:eq('+ i +')  ').show();
					$('.lydo .container_field:eq('+ i +')  ').show();
				}else {
					$('.lydo .containertre:eq('+ i +')  ').hide();
					$('.lydo .container:eq('+ i +')  ').hide();
					$('.lydo .container:eq('+ i +')  ').val('');
					$('.lydo .container_field:eq('+ i +')  ').hide();
					$('.lydo .container_preview:eq('+ i +')  ').hide();
					$('.lydo .container_close:eq('+ i +')  ').hide();
					// $('.lydo .containertre:eq('+ i +')').prop('selected', function() {
					// 	return this.defaultSelected;
					// });
					$('.lydo .containertre:eq('+ i +')  ').val('');
				}
			});
			if ($('.vangmat .checked:eq('+ i +')').is(":checked") == true) {
				$('.phep .container:eq('+ i +')  ').show();
				$('.lydo .container:eq('+ i +')  ').hide();
			}else {
				$('.phep .container:eq('+ i +')  ').hide();
				$('.lydo .container:eq('+ i +')  ').hide();
				$('.lydo .containertre:eq('+ i +')  ').hide();
			}
			if ($('.phep .checked:eq('+ i +')').is(":checked") == true) {
				$('.lydo .container:eq('+ i +')  ').show();
				$('.lydo .container_field:eq('+ i +')  ').show();
			}
			if ($('.phep .checkedtre:eq('+ i +')').is(":checked") == true) {
				$('.lydo .containertre:eq('+ i +')  ').show();
				$('.lydo .container:eq('+ i +')  ').show();
				$('.lydo .container_field:eq('+ i +')  ').show();
			}
		}
	});
</script>
	{{-- /test --}}
@endsection
@section('JsLibraries')
<style>
	.gray1{
		background: gray !important;
	}
</style>
  {{-- <script src="{{url('js/admin/diemdanh/add-diemdanh.js')}}"></script> --}}
@endsection