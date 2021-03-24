@extends('admin.master')
@section('title', 'Sửa địa chỉ liên hệ')
@section('PageContent')
	<div class="ui two column centered grid wrap-content-header">
		<h1 class="ui header centered page-title">SỬA ĐỊA CHỈ LIÊN HỆ</h1>
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
					<a href="{{url('dclienhe/add')}}" class="ui labeled icon button"><i class="plus circle icon"></i>Thêm mới</a>
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
							<label>Tên chi nhánh (*)</label>
							<div class="ui input left icon">							
							<i class="edit icon"></i>
							<input type="text" name="ten" value="{{$dclienhe->ten}}" required>
							</div>
						</div>
						<div class="field">
							<label>slug chi nhánh (*)</label>
							<div class="ui input left icon">							
							<i class="edit icon"></i>
							<input type="text" name="slug" value="{{$dclienhe->slug}}">
							</div>
						</div>
						<div class="field">
							<label>Tên chi nhánh tiếng Nhật</label>
							<div class="ui input left icon">							
							<i class="language icon"></i>
							<input type="text" name="tenjp" value="{{ $dclienhe->tenjp }}">
							</div>
						</div>
					</div>
					<div class="two fields">
						<div class="field">
							<label>Địa chỉ </label>
							<div class="ui input left icon">							
							<i class="building outline icon"></i>
							<input type="text" name="diachi" value="{{ $dclienhe->diachi }}">
							</div>
						</div>
						<div class="field">
							<label>Địa chỉ tiếng Nhật </label>
							<div class="ui input left icon">							
							<i class="language icon"></i>
							<input type="text" name="diachijp" value="{{ $dclienhe->diachijp }}" >
							</div>
						</div>
					</div>
					<div class="four fields">
						<div class="field">
							<label>Điện thoại </label>
							<div class="ui input left icon">
								<i class="mobile alternate icon"></i>
								<input type="text" name="dienthoai" value="{{ $dclienhe->dienthoai }}">
							</div>
						</div>
						<div class="field">
							<label>Email </label>
							<div class="ui input left icon">							
							<i class="envelope outline icon"></i>
							<input type="email" name="email" value="{{ $dclienhe->email }}" >
							</div>
						</div>
						<div class="field">
							<label>Fax </label>
							<div class="ui input left icon">							
							<i class="fax icon"></i>
							<input type="text" name="fax" value="{{ $dclienhe->fax }}" >
							</div>
						</div>
						<div class="field">
							<label>Website </label>
							<div class="ui input left icon">							
							<i class="globe icon"></i>
							<input type="text" name="website" value="{{ $dclienhe->website }}" >
							</div>
						</div>
					</div>
					<div class="field">
						<label>ID Bản đồ </label>
						<div class="ui input left icon">							
						<i class="map icon"></i>
						<input type="text" name="bando" value="{{ $dclienhe->bando }}" >
						</div>
					</div>
					<div class="four fields">
						<div class="field">
							<label>Sắp xếp </label>
							<div class="ui input left icon">							
							<i class="sort icon"></i>
							<input type="number" name="sapxep" value="{{ $dclienhe->sapxep }}" >
							</div>
						</div>
					</div>
					<div class="field">
						<div class="ui form">
							<div class="inline field">
								<div class="ui toggle checkbox">
									<input name="stt" type="checkbox" @if ($dclienhe->stt == 1) checked @endif >
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
						<a href="{{url('dclienhe')}}" class="ui labeled icon button btn-align-left"><i class="arrow left icon"></i>Danh Sách</a>
						<button type="submit" class="ui labeled icon button blue btn-align-right-(//)"><i class="save icon"></i>Lưu</button>
					</div>
				</div>

				
			</form>
		</div>
	</div>
@endsection
@section('JsLibraries')
{{-- miraihuman --}}
{{-- <base href="{{asset('')}}">
<script src="tinymce/tinymce.min.js"></script>
<script src="tinymce/config_Tinymce.js"></script>
<link rel="stylesheet" href="fancybox/jquery.fancybox.css">
<script src="fancybox/vhn_customs/preview-img.js"></script>
<link  href="fancybox/vhn_customs/preview-img.css">
<script src="fancybox/jquery.fancybox.pack.js"></script>
<script src="fancybox/vhn_customs/config_Fancybox.js"></script> --}}
{{-- /miraihuman --}}

@endsection