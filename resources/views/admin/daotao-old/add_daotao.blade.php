@extends('admin.master')
@section('title', 'Thêm Lớp Học')
@section('PageContent')
	@php
		function ym($time) {
			$timestamp = strtotime($time);
			$year = date("Y", $timestamp);
			$month = date("m", $timestamp);
			return $year.'/'.$month;
		}
	@endphp
	<div class="ui two column centered grid wrap-content-header">
		<h1 class="ui header centered page-title">THÊM LỚP HỌC</h1>
	</div>
	@if (session('status'))
		<div class="alert alert-success">
			{{ session('status') }}
		</div>
	@endif	
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
			<form class="ui form" action="" method="post" name="form_1" autocomplete="off">
				{{ csrf_field() }}
				<div class="field thongtin">			
					<div class="two fields">
						<div class="field">
							<label>Tên lớp học (*)</label>
							<div class="ui input left icon">							
							<i class="user icon"></i>
							<input type="text" name="ten_lop_hoc" value="{{ old('ten_lop_hoc') }}" required>
							</div>
						</div>
						<div class="field">
							<label>Ngày khai giảng (*)</label>
							<div class="ui calendar" id="date-only">
							    <div class="ui input left icon">
							      <i class="calendar icon"></i>
							      <input type="text" name="ngay_khai_giang" value="{{ old('ngay_khai_giang') }}" required >
							    </div>
							    <div class="ngay-sinh">	
							    </div>
							</div>
						</div>
					</div>
					<div class="two fields">
						<div class="field">
							<label>Giáo viên chủ nhiệm (*)</label>
							<div class="ui fluid search normal selection dropdown">
						        <input type="hidden" name="gvcn" value="">
						        <i class="dropdown icon"></i>
						        <input class="search" autocomplete="off" tabindex="0"><span class="sizer" style=""></span><div class="default text">Chọn giáo viên</div>
						        <div class="menu transition hidden" tabindex="-1">
						        	@foreach($giaovien as $gv)
											<div class="item" data-value="{{$gv->id}}">
								        		<img src="{{$gv->hinhanh}}"> {{$gv->hoten}}
									        </div>
									        <option value="{{$gv->id}}"></option>
						            @endforeach					        
		      					</div>
							</div>
						</div>
						<div class="field">
							<label>Cơ sở (*)</label>
							<select name="coso">
								{{-- <option value="1">Cơ sở 1</option>
								<option value="2">Cơ sở 2</option> --}}
								<option value="3">Phòng Đào Tạo</option>
							</select>
						</div>
						
					</div>	
				<div class="field">
					<label>Danh sách học viên</label>

					<style type="text/css">
						.item img {
							font-size: 33px;
						}
					</style>
					<div class="ui fluid multiple search normal selection dropdown">
				        <input type="hidden" name="dshv" value="">
				        <i class="dropdown icon"></i>
				        <input class="search" autocomplete="off" tabindex="0"><span class="sizer" style=""></span><div class="default text">Chọn học viên</div>
				        <div class="menu transition hidden" tabindex="-1">
				        
				        @foreach($hocvien as $hv)
				        	<div class="item" data-value="{{$hv->id}}">
					        	@if($hv->hinhanh)
									<img src="{{url('')}}/hocviens/{{ym($hv->created_at)}}/{{$hv->hinhanh}}">
								@else 
									<i class="user icon"></i> 
								@endif  
								{{$hv->hoten}}
					        </div>
					        <option value="{{$hv->id}}"></option>
					    @endforeach
      				</div>
      			</div>
      
				</div>
				<div class="inline field">
					<label>(*) Trường bắt buộc phải nhập</label>
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
<script type="text/javascript">
	$('.ui.dropdown').dropdown();
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