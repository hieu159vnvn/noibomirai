@extends('admin.master')
@section('title', 'Sửa Lớp Học')
@section('PageContent')
@php
	function ym($time) {
		$timestamp = strtotime($time);
		$year = date("Y", $timestamp);
		$month = date("m", $timestamp);
		return $year.'/'.$month;
	}
@endphp
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdn.rawgit.com/mdehoog/Semantic-UI/6e6d051d47b598ebab05857545f242caf2b4b48c/dist/semantic.min.js"></script>
<div class="ui two column centered grid wrap-content-header">
	<h1 class="ui header centered page-title">SỬA LỚP HỌC</h1>
</div>	
@if ($errors->any())
<div class="alert alert-danger">
	<ul>
		@foreach ($errors->all() as $error)
		<li>{{ $error }}</li>
		@endforeach
	</ul>
</div>
@endif	

<div class="ajax-messenger"></div>
<div class="ui two column centered grid main-content">	
	<div class="fifteen wide column">
		<form class="ui form" action="" method="post" name="form_1">
			{{ csrf_field() }}
			<div class="field thongtin">			
				<div class="two fields">
					<div class="field">
						<label>Tên lớp học (*)</label>
						<div class="ui input left icon">							
							<i class="user icon"></i>
							<input type="text" name="ten_lop_hoc" value="{{$dt->ten_lop_hoc}}" required>
						</div>
					</div>
					<div class="field">
						<label>Ngày khai giảng (*)</label>
						
						<div class="ui calendar" id="date-only">
					    <div class="ui input left icon">
					      <i class="calendar icon"></i>
					      <input type="text" name="ngay_khai_giang" value="{{ $dt->ngay_khai_giang }}" required>
					    </div>
					    <div class="ngay-sinh">	
					    </div>
					</div>
					</div>
				</div>
				<div class="two fields">
					<div class="field">
						<label>Giáo viên chủ nhiệm (*)</label>
						<select name="gvcn">
							<option value="0">Chọn giáo viên</option>
							@foreach($giaovien as $gv)
								@if($gv->id == $dt->gvcn)
									<option selected value="{{$gv->id}}">{{$gv->hoten}}</option>
								@else	
									<option value="{{$gv->id}}">{{$gv->hoten}}</option>
								@endif
							@endforeach
						</select>
					</div>
					<div class="field">
							<label>Cơ sở (*)</label>
							<select name="coso">
							{{-- 	<option @if($dt->coso == 1) selected @endif value="1">cơ sở 1</option>
								<option @if($dt->coso == 2) selected @endif value="2">cơ sở 2</option> --}}
								<option @if($dt->coso == 3) selected @endif value="3">Phòng đào tạo</option>
							</select>
						</div>
				</div>

				<div class="field">
					<label>Danh sách học viên</label>
					
				<div class="ui fluid multiple search normal selection dropdown">
					<input type="hidden" name="dshv" value="">
					<i class="dropdown icon"></i>
					{{--  --}}
					<input class="search" autocomplete="off" tabindex="0"><span class="sizer" style=""></span><div class="default text">Chọn học viên</div>
					<div class="menu transition hidden" tabindex="-1">
						@foreach($hocvien as $hv)
							<div class='item item1 ' data-value="{{$hv->id}}">
								@if($hv->hinhanh)
									<img src="{{url('')}}/hocviens/{{ym($hv->created_at)}}/{{$hv->hinhanh}}">
								@else 
									<i class="user icon"></i> 
								@endif 
								{{$hv->hoten}}
							</div>
							<option  value="{{$hv->id}}"> </option>
						@endforeach
						@foreach ($dshv as  $selected)
							<div class='item item1 ' data-value="{{$selected->id}}">
								@if($selected->hinhanh)
									<img src="{{url('')}}/hocviens/{{ym($selected->created_at)}}/{{$selected->hinhanh}}">
								@else 
									<i class="user icon"></i> 
								@endif 
								{{$selected->hoten}}
							</div>
							<option selected  value="{{$selected->id}}"> </option>
						@endforeach
					</div>
				</div>
			

		</div>

		<div class="inline field">
			<label>(*) Trường bắt buộc phải nhập</label>
		</div>		
	</div>	

	<div class="ui two column centered grid">
		<div class="eight wide column">
			<a href="{{url('daotao')}}" class="ui labeled icon button btn-align-left"><i class="arrow left icon"></i>Danh Sách</a>
			<button type="submit" class="ui labeled icon button blue btn-align-right"><i class="save icon"></i>Lưu</button>
		</div>
	</div>
</form>
</div>
</div>
@endsection
@section('JsLibraries')
<style type="text/css">
	.item img {
		font-size: 33px;
	}
</style>
<script type="text/javascript">
	$('.ui.dropdown').dropdown('show');
	$(document).ready(function(){
		var length = $('.selection option').length;
		var i;
		for (i = 0; i < length; i++) {
			var selected = $('.selection option:eq("'+i+'")').is(':selected');
			if( selected == true){
				$('.item1 :eq("'+i+'")').trigger('click');
			};
		}
	});
	var calendarOpts = {
		type: 'date',
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
				// return year + '-' + month + '-' + day;
				return day + '-' + month + '-' + year;
			}
		}
	};
	$('#date-only').calendar(calendarOpts);
</script>

{{-- <script src="{{url('js/admin/hoso/add_hoso.js')}}"></script> --}}
@endsection