@extends('admin.master')
@section('title', 'Thêm Logo')
@section('PageContent')
	<div class="ui two column centered grid wrap-content-header">
		<h1 class="ui header centered page-title">THÊM LOGO</h1>
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
			<form class="ui form" action="" method="post" name="form_1">
				{{ csrf_field() }}

				<div class="field thongtin">			
					<div class="field">
						<div class="ui medium icon buttons">
							<a class="ui secondary button iframe-btn fancy" href="tinymce/filemanager/dialog.php?type=0&field_id=none_img" data-fancybox-type="iframe"><i class="upload icon"></i> Tải Ảnh Logo</a>
							<div class="ui button" onclick="clear_img()"><i class="cancel icon"> </i> HỦY</div>
						</div>
						<br>
						<img src="{{url('uploads/no-image.jpg')}}" alt="" id="prev_img" class=" medium ui image bordered img-thumbnail ">
						<input name="image" type="hidden" value="" id="none_img" class="form-control">
					</div>
					<div class="field">
						<div class="ui form">
							<div class="inline field">
								<div class="ui toggle checkbox">
									<input name="stt" type="checkbox" tabindex="0" checked>
									<label>Phát hành</label>
								</div>
							</div>
						</div>
					</div>		
				</div>	
				<div class="ui ">
					<div class="eight wide column">
						<a href="{{url('logo')}}" class="ui labeled icon button btn-align-left"><i class="arrow left icon"></i>Danh Sách</a>
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
<link rel="stylesheet" href="fancybox/jquery.fancybox.css">
<script src="fancybox/vhn_customs/preview-img.js"></script>
<link  href="fancybox/vhn_customs/preview-img.css">
<script src="fancybox/jquery.fancybox.pack.js"></script>
<script src="fancybox/vhn_customs/config_Fancybox.js"></script>
{{-- /miraihuman --}}
<script src="{{url('js/admin/logo/add_logo.js')}}"></script>
@endsection