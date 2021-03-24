@extends('admin.master')
@section('title', 'Sửa cảm nhận')
@section('PageContent')
	<div class="ui two column centered grid wrap-content-header">
		<h1 class="ui header centered page-title">SỬA CẢM NHẬN</h1>
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
				<div class="right menu">
					<div class="item">
					<a href="{{url('camnhan/add')}}" class="ui labeled icon button"><i class="plus circle icon"></i>Thêm mới</a>
					</div>
				</div>
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
							<label>Tên học viên</label>
							<div class="ui input left icon">							
							<i class="edit icon"></i>
							<input type="text" name="tenhocvien" value="{{$camnhan->tenhocvien}}" required>
							</div>
						</div>
						<div class="field">
							<label>Ngành nghề</label>
							<div class="ui input left icon">							
							<i class="edit icon"></i>
							<input type="text" name="nganhnghe" value="{{$camnhan->nganhnghe}}" required>
							</div>
						</div>
						<div class="field">
							<label>Ngành nghề JP</label>
							<div class="ui input left icon">							
							<i class="edit icon"></i>
							<input type="text" name="nganhnghejp" value="{{$camnhan->nganhnghejp}} ">
							</div>
						</div>
						
					</div>
					<div class="field">
						<label>Nội dung</label>
						<div class="ui input left icon">							
						<i class="language "></i>
						<textarea name="noidung" value="{{$camnhan->noidung}}" required>{{$camnhan->noidung}}</textarea>
						</div>
					</div>
					<div class="field">
						<label>Nội dung JP</label>
						<div class="ui input left icon">							
						<i class="language "></i>
						<textarea name="noidungjp" value="{{$camnhan->noidungjp}}">{{$camnhan->noidung}}</textarea>
						</div>
					</div>
					<div class="field">
						<label>Thumb</label>
						<div class="ui medium icon buttons">
							<a class="ui secondary button iframe-btn fancy" href="tinymce/filemanager/dialog.php?type=0&field_id=none_img" data-fancybox-type="iframe"><i class="upload icon"></i> Tải Ảnh Thumb</a>
							<div class="ui button" onclick="clear_img()"><i class="cancel icon"> </i> HỦY</div>
						</div>
						<br>
						@if ($camnhan->image)
							<img src="{{url($camnhan->image)}}" alt="" id="prev_img" class="medium  ui image bordered img-thumbnail">
						@else
							<img src="{{url('uploads/no-image.jpg')}}" alt="" id="prev_img" class="medium ui image bordered img-thumbnail ">
						@endif						
							<input name="image" type="hidden" value="{{$camnhan->image}}" id="none_img" class="form-control">
					</div>
	
				</div>		
				<div class="ui ">
					<div class="eight wide column">
						<a href="{{url('camnhan')}}" class="ui labeled icon button btn-align-left"><i class="arrow left icon"></i>Danh Sách</a>
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