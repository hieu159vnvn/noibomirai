@extends('admin.master')
@section('title', 'Thêm Lịch Công Tác')
@section('PageContent')
	<div class="ui two column centered grid wrap-content-header">
		<h1 class="ui header centered page-title">THÊM LỊCH CÔNG TÁC </h1>
	</div>	

	<div class="ui two column centered grid main-content">	
		<div class="fifteen wide column">
			@if ($errors->any())
			    <div class="alert alert-danger">
			        <ul>
			            @foreach ($errors->all() as $error)
			                <li>{{ $error }}</li>
			            @endforeach
			        </ul>
			    </div>
			@endif
			<form class="ui form" action="{{action('LichcongtacController@addEvent')}}" method="post" name="form_1">
				{{ csrf_field() }}
				<div class="field thongtin">			
						<div class="two fields">
							<div class="field">
								<label>Tên sự kiện (*)</label>
								<div class="ui input left icon">							
								<i class="edit icon"></i>
								<input type="text" name="event_name" value="{{ old('event_name') }}" required>
								</div>
							</div>
							<div class="field">
								<label>Color</label>
								<div class="ui input left icon">							
								<i class="tint icon"></i>
								<input type="color" name="color" value="{{ old('color') }}" style="height:34.63px">
								</div>
							</div>
						</div>
						<div class="two fields">
							<div class="field">
								<label>Ngày bắt đầu</label>
								<div class="ui input left icon">							
								<i class="calendar icon"></i>
								<input type="datetime-local" name="start_date" value={{ date('m-d-Y H:i') }} required>
								</div>
							</div>
							<div class="field">
								<label>Ngày kết thúc</label>
								<div class="ui input left icon">							
								<i class="calendar icon"></i>
								<input type="datetime-local" name="end_date" value={{ date('m-d-Y H:i') }} required>
								</div>
							</div>
						</div>
					</div>		
				<div class="ui ">
					<div class="eight wide column">
						<a href="{{url('danhsachlich')}}" class="ui labeled icon button btn-align-left"><i class="arrow left icon"></i>Danh Sách</a>
						<button type="submit" class="ui labeled icon button blue btn-align-right-(//)"><i class="save icon"></i>Lưu</button>
					</div>
				</div>

				
			</form>
		</div>
	</div>
@endsection
@section('JsLibraries')
{{-- miraihuman --}}
<base href="{{asset('')}}">
<script src="tinymce/tinymce.min.js"></script>
<script src="tinymce/config_Tinymce.js"></script>
<script>
	$('.menu .item').tab();
</script>
<link rel="stylesheet" href="fancybox/jquery.fancybox.css">
<script src="fancybox/vhn_customs/preview-img.js"></script>
<link  href="fancybox/vhn_customs/preview-img.css">
<script src="fancybox/jquery.fancybox.pack.js"></script>
<script src="fancybox/vhn_customs/config_Fancybox.js"></script>
{{-- /miraihuman --}}
@endsection