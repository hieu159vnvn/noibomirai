@extends('admin.master')
@section('title', 'Thêm hỏi đáp')
@section('PageContent')
	<div class="ui two column centered grid wrap-content-header">
		<h1 class="ui header centered page-title">THÊM LOẠI HỎI ĐÁP (tối đa 5 loại)</h1>
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
			<form class="ui form" action="loaihoidap/store" method="post" name="form_1">
				{{ csrf_field() }}
				<div class="two fields thongtin">			
							<div class="field">
								<strong>Loại câu hỏi:</strong>
								<div class="ui input left icon">							
								<i class="edit icon"></i>
								<input type="text" name="tenloai" value="{{ old('tenloai') }}" required>
								</div>
							</div>
							<div class="field">
								<strong>Loại câu hỏi JP:</strong>
								<div class="ui input left icon">							
								<i class="edit icon"></i>
								<input type="text" name="tenloaijp" value="{{ old('tenloaijp') }}" required>
								</div>
							</div>
						<div class="inline field">
						<label>(*) Trường bắt buộc phải nhập</label>
						</div>		
					</div>		
				<div class="ui ">
					<div class="eight wide column">
						<a href="{{url('loaihoidap')}}" class="ui labeled icon button btn-align-left"><i class="arrow left icon"></i>Danh Sách</a>
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