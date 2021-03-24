@extends('admin.master')
@section('title', 'Thêm dịch vụ')
@section('PageContent')
	<div class="ui two column centered grid wrap-content-header">
		<h1 class="ui header centered page-title">THÊM DỊCH VỤ </h1>
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
								<strong>Tên tiêu đề (*)</strong>
								<div class="ui input left icon">							
								<i class="edit icon"></i>
								<input type="text" name="ten" value="{{ old('ten') }}" required>
								</div>
							</div>
							<div class="field">
								<strong>Tên tiêu đề (tiếng Nhật)</strong>
								<div class="ui input left icon">							
								<i class="language icon"></i>
								<input type="text" name="tenjp" value="{{ old('tenjp') }}">
								</div>
							</div>
						</div>
						<div class="three fields">
							<div class="field">
								<strong>Danh mục dịch vụ (*)</strong>
								<select name="dichvu_id" id="">
									@foreach ($dichvucat as $item)
										<option value="{{$item->id}}">{{$item->ten}}</option>	
									@endforeach
								</select>
							</div>
						</div>
						<div class="field">
							<div class="ui top attached tabular menu">
								<a class="item active" data-tab="first"><label><i class="edit icon"></i> Nội dung </label></a>
								<a class="item" data-tab="second"><label><i class="language icon"></i> Nội dung (tiếng Nhật) </label></a>
								
							</div>
							<div class="ui bottom attached tab segment active" data-tab="first">
								<textarea name="noidung" class="textarea-400"></textarea>
							</div>
							<div class="ui bottom attached tab segment" data-tab="second">
								<textarea name="noidungjp" class="textarea-400"></textarea>
							</div>
						</div>
						<div class="four fields">
							<div class="field">
								<strong>Sắp xếp </strong>
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
						<strong>(*) Trường bắt buộc phải nhập</strong>
						</div>		
					</div>		
				<div class="ui ">
					<div class="eight wide column">
						<a href="{{url('dichvucat')}}" class="ui labeled icon button btn-align-left"><i class="arrow left icon"></i>Danh Sách</a>
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