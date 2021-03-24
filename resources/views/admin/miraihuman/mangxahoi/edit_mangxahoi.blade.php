@extends('admin.master')
@section('title', 'Sửa mạng xã hội')
@section('PageContent')
	<div class="ui two column centered grid wrap-content-header">
		<h1 class="ui header centered page-title">SỬA MẠNG XÃ HỘI</h1>
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
					<a href="{{url('mangxahoi/add')}}" class="ui labeled icon button"><i class="plus circle icon"></i>Thêm mới</a>
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
							<strong>Tên tiêu đề (*)</strong>
							<div class="ui input left icon">							
							<i class="edit icon"></i>
							<input type="text" name="ten" value="{{$mangxahoi->ten}}" required>
							</div>
						</div>
						<div class="field">
							<strong>Link</strong>
							<div class="ui input left icon">							
							<i class="language icon"></i>
							<input type="text" name="link" value="{{ $mangxahoi->link }}">
							</div>
						</div>
					</div>
					<div class="field">
						<label>Thumb</label>
						<div class="ui medium  basic icon buttons">
							<a class="ui button iframe-btn fancy" href="tinymce/filemanager/dialog.php?type=0&field_id=none_img" data-fancybox-type="iframe"><i class="upload icon"></i> Tải Ảnh Thumb</a>
							<div class="ui button" onclick="clear_img()"><i class="cancel icon"> </i> HỦY</div>
						</div>
						<br>
						@if ($mangxahoi->image)
							<img src="{{url($mangxahoi->image)}}" alt="" id="prev_img" class="medium  ui image bordered img-thumbnail">
						@else
							<img src="{{url('uploads/no-image.jpg')}}" alt="" id="prev_img" class="medium ui image bordered img-thumbnail ">
						@endif						
							<input name="image" type="hidden" value="{{$mangxahoi->image}}" id="none_img" class="form-control">
					</div>
					<div class="four fields">
						<div class="field">
							<label>Sắp xếp </label>
							<div class="ui input left icon">							
							<i class="sort icon"></i>
							<input type="number" name="sapxep" value="{{ $mangxahoi->sapxep }}" >
							</div>
						</div>
					</div>
					<div class="field">
						<div class="ui form">
							<div class="inline field">
								<div class="ui toggle checkbox">
									<input name="stt" type="checkbox" @if ($mangxahoi->stt == 1) checked @endif >
									<label>Phát hành</label>
								</div>
							</div>
						</div>
					</div>
					<div class="inline field">
					<label>(*) Trường bắt buộc phải nhập</label>
					</div>		
				</div>		
				<div class="ui ">
					<div class="eight wide column">
						<a href="{{url('mangxahoi')}}" class="ui labeled icon button btn-align-left"><i class="arrow left icon"></i>Danh Sách</a>
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