@extends('admin.master')
@section('title', 'Sửa Lịch Công Tác')
@section('PageContent')
	<div class="ui two column centered grid wrap-content-header">
		<h1 class="ui header centered page-title">SỬA LỊCH CÔNG TÁC</h1>
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
			<div class="ui secondary menu">
				{{-- @permission('logo-create') --}}
				{{-- <div class="right menu">
					<div class="item">
					<a href="{{url('gioithieu/add')}}" class="ui labeled icon button"><i class="plus circle icon"></i>Thêm mới</a>
					</div>
				</div> --}}
				{{-- @endpermission --}}
			</div> 
			@if (session('status'))
				<div class="ui positive message">
					<i class="close icon"></i>
					<div class="header">
						Thông Báo !
					</div>
					<p>{{ session('status') }}</p>
				</div>
			@endif
			<form class="ui form" action="" method="post" name="form_1">
				{{ csrf_field() }}
				<div class="field thongtin">			
					<div class="two fields">
						<div class="field">
							<label>Tên sự kiện (*)</label>
							<div class="ui input left icon">							
							<i class="edit icon"></i>
							<input type="text" name="event_name" value="{{$item->event_name}}" required>
							</div>
						</div>
						<div class="field">
							<label>Color</label>
							<div class="ui input left icon">							
							<i class="edit icon"></i>
							<input type="color" name="color" value="{{$item->color}}" required style="height:34.63px">
							</div>
						</div>
					
					</div>
					<div class="two fields">
						<div class="field">
							<label>Ngày bắt đầu</label>
							<div class="ui input left icon">							
							<i class="edit icon"></i>
							<input type="text" name="start_date" value="{{$item->start_date}}" required>
							</div>
						</div>
						<div class="field">
							<label>Ngày kết thúc</label>
							<div class="ui input left icon">							
							<i class="edit icon"></i>
							<input type="text" name="end_date" value="{{$item->end_date}}" required>
							</div>
						</div>
					</div>
					{{-- <div class="four fields">
						<div class="field">
							<label>Sắp xếp </label>
							<div class="ui input left icon">							
							<i class="sort icon"></i>
							<input type="number" name="sapxep" value="{{ $gioithieu->sapxep }}" >
							</div>
						</div>
					</div> --}}
					
					<div class="inline field">
					<label>(*) Trường bắt buộc phải nhập</label>
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
{{-- <link rel="stylesheet" href="fancybox/jquery.fancybox.css">
<script src="fancybox/vhn_customs/preview-img.js"></script>
<link  href="fancybox/vhn_customs/preview-img.css">
<script src="fancybox/jquery.fancybox.pack.js"></script>
<script src="fancybox/vhn_customs/config_Fancybox.js"></script> --}}
{{-- /miraihuman --}}

@endsection