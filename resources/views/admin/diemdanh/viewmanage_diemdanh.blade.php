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
<div class="ui two column centered grid wrap-content-header">
	<h1 class="ui header centered page-title">QUẢN LÝ ĐIỂM DANH</h1>
</div>

@if (session('status'))
<div class="ui message">
<i class="close icon"></i>
<div class="header">
  Thông Báo !
</div>
<p>{{ session('status') }}</p>
</div>
@endif	
<div class="ajax-messenger"></div>
<div class="ui two column centered grid main-content">
	<div class="fifteen wide column">
		<form class="ui form" action="" method="post" name="form_1">
			{{ csrf_field() }}	
			<div class="field"></div>
			<div class="ui two column centered grid">
				<h2 class="ui header centered ">Ngày {{date_format(date_create($mdate),"d - m - Y")}}</h2>	
			</div>
			@foreach($database as $key => $dbs)
				<h3><span class="ui basic label">LỚP {{$dbs[0]->ten_lop_hoc}}</span> - Phòng đạo tạo 
					<a class="ui label basic blue" href="{{url('diemdanh/'.$key.'/add')}}"> Cập nhật </a>
						@if(in_array($key,$khoaduyet)) 
							<i class="small check icon blue"></i> <span class="ui red header"> Đã duyệt </span>
							<div class="ui toggle checkbox" style="background: #ededed; margin-top: 10px; padding: 5px 10px; border-radius: 30px">
								<input type="checkbox" name="huykhoaduyet[]" value="{{$key}}" >
								<label><i class="small circle icon red"></i> Hủy khóa (Bật lại tính năng điểm danh ngày cho giáo viên</label>
							</div>
						@else
							<div class="ui toggle checkbox" style="background: #ededed; margin-top: 10px; padding: 5px 10px; border-radius: 30px">
								<input type="checkbox" name="khoaduyet[]" checked value="{{$key}}" >
								<label>Khóa duyệt (không cho giáo viên điểm danh lại)</label>
							</div>
						@endif						
				</h3>
				
				<table id="data-table" class="ui selectable celled striped table" >
					{{-- <input type="text" class="mkey" name="mkey" value="{{$hv->id_lop}}"> --}}
					<thead class="full-width">
						<tr style="text-align: left;">
							<th>TÊN HỌC VIÊN</th>
							<th>ĐIỂM DANH</th>
							<th>LÝ DO</th>
							<th>DUYỆT</th>					          
						</tr>
					</thead>
					<tbody style="text-align: left;">
						@foreach($dbs as $hv)
						<tr class="diemdanh">
							<td class="@if(in_array($key,$khoaduyet)) gray1 @endif">
								{{$hv->hotenhv}}
							</td>
							<td class="@if(in_array($key,$khoaduyet)) gray1 @endif">
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
							<td class="@if(in_array($key,$khoaduyet)) gray1 @endif">
								@if($hv->lydo)
									<label>Lý do: {{$hv->lydo}}</label>
								@endif
								@if($hv->donphep)
									<a href="{{url('uploads/daotao/phep')}}/{{yearmonth($hv->created_at)}}/{{$hv->donphep}}">
										<img class="imgshow" src="{{url('uploads/daotao/phep')}}/{{yearmonth($hv->created_at)}}/{{$hv->donphep}}" height="35px">
									</a>	
								@endif
							</td>
							<td class="duyet">
								@if ($hv->duyet == 1)
									<div class="ui toggle checkbox" style="background: #dea9a9; padding: 5px 10px; border-radius: 30px">
										<input type="checkbox" class="huychecked" name="huyduyet[{{$hv->id_diemdanh}}][]" value="{{$hv->id_hocvien}}">
										<label><i class="small check icon red"></i> HỦY DUYỆT </label>
									</div>
								@else
									@if ($hv->vang != 1)
										<div class="ui toggle checkbox">
											<input type="checkbox" class="checked" checked name="duyet[{{$hv->id_diemdanh}}][]" value="{{$hv->id_hocvien}}">
											<label><i class="small circle icon red"></i> DUYỆT </label>
										</div>
									@else
										<div class="ui toggle checkbox">
											<input type="checkbox" class="checked" name="duyet[{{$hv->id_diemdanh}}][]" value="{{$hv->id_hocvien}}">
											<label><i class="small circle icon blue"></i> DUYỆT </label>
										</div>
									@endif
								@endif
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>
				<div class="ui toggle checkbox" style="background: #ededed; margin-top: 10px; padding: 5px 10px; border-radius: 30px">
					<input type="checkbox" class="checkedall" >
					<label>Duyệt tất cả</label>
				</div>
				
				<div class="ui toggle checkbox" style="background: #dea9a9; margin-top: 10px; padding: 5px 10px; border-radius: 30px">
					<input type="checkbox" class="huycheckedall" >
					<label>Hủy Duyệt tất cả</label>
				</div>
				<hr>
			@endforeach	
	<p class="p"></p>
	<div class="ui two column centered grid">
		<div class="eight wide column">
			<a href="{{url('diemdanh/manage')}}" class="ui labeled icon button btn-align-left"><i class="arrow left icon"></i>Danh Sách</a>
			<button type="submit" class="ui labeled icon button green nutluu"><i class="save icon"></i>Xác nhận</button>
		</div>
	</div>
</form>
</div>
<script type="text/javascript">
	$(document).ready(function(){
		var imgshow = $('.imgshow').length;
		// console.log();
		for (var i = 0; i < imgshow; i++) {
			popupimg(i);
		}
		function popupimg(i) {
			$('.imgshow:eq('+i+')').popup();
		}
		var length = $('.checkedall').length;
		for (let i = 0; i < length; i++) {
			$(".checkedall:eq("+i+")").click(function(){
				var checked = $(".checkedall:eq("+i+")").is(":checked");
				if (checked == true) {
					$('.table:eq('+i+') .checked').prop( "checked", true );
				}
				if (checked == false) {
					$('.table:eq('+i+') .checked').prop( "checked", false );
				}
			});
		}

		var huylength = $('.huycheckedall').length;
		for (let i = 0; i < length; i++) {
			$(".huycheckedall:eq("+i+")").click(function(){
				var checked = $(".huycheckedall:eq("+i+")").is(":checked");
				if (checked == true) {
					$('.table:eq('+i+') .huychecked').prop( "checked", true );
				}
				if (checked == false) {
					$('.table:eq('+i+') .huychecked').prop( "checked", false );
				}
			});
		}
		
	});
</script>
</div>
@endsection
@section('JsLibraries')
<style>
	.gray1{
		background: gray !important;
	}
</style>
{{-- <script src="{{url('js/admin/hoso/add_hoso.js')}}"></script> --}}
@endsection