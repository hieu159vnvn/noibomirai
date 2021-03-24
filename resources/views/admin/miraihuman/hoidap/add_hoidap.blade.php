@extends('admin.master')
@section('title', 'Thêm hỏi đáp')
@section('PageContent')
	<div class="ui two column centered grid wrap-content-header">
		<h1 class="ui header centered page-title">THÊM HỎI ĐÁP </h1>
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
						<div class="two fields">
							<div class="field">
								<strong>Tiêu đề hỏi (*)</strong>
								<div class="ui input left icon">							
								<i class="edit icon"></i>
								<input type="text" name="hoi" value="{{ old('hoi') }}" required>
								</div>
							</div>
							<div class="field">
								<strong>Tiêu đề hỏi (tiếng Nhật)</strong>
								<div class="ui input left icon">							
								<i class="language icon"></i>
								<input type="text" name="hoijp" value="{{ old('hoijp') }}">
								</div>
							</div>
							<div class="field">
								<strong>Loại câu hỏi</strong>
								<div class="ui input left icon">
								<i class="edit icon"></i>
								<select name="id_loaicauhoi" class="ui search dropdown">
									@foreach($loaihoidap as $item)
										<option value="{{$item->id}}">{{$item->tenloai}}</option>
									@endforeach						      	
								</select>
								</div>
							</div>
						</div>
						<div class="two fields">
							<div class="field">
								<strong>Đáp </strong>
								<div class="ui input left icon">							
								<i class="edit "></i>
								<textarea  name="dap" value="{{ old('dap') }}"></textarea> 
								</div>
							</div>
							<div class="field">
								<strong>Đáp (tiếng Nhật)</strong>
								<div class="ui input left icon">							
								<i class="language "></i>
								<textarea  name="dapjp" value="{{ old('dapjp') }}"></textarea> 
								</div>
							</div>
						</div>
						<div class="four fields">
							<div class="field">
								<label>Sắp xếp </label>
								<div class="ui input left icon">							
								<i class="sort icon"></i>
								<input type="number" name="sapxep" value="{{ old('sapxep') }}" >
								</div>
							</div>
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
						<div class="inline field">
						<label>(*) Trường bắt buộc phải nhập</label>
						</div>		
					</div>		
				<div class="ui ">
					<div class="eight wide column">
						<a href="{{url('hoidap')}}" class="ui labeled icon button btn-align-left"><i class="arrow left icon"></i>Danh Sách</a>
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