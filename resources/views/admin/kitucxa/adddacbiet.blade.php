@extends('admin.master')
@section('title', 'Thêm ký túc xá')
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
		<h1 class="ui header centered page-title">THÊM KÝ TÚC XÁ</h1>
	</div>
	
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
			@if (session('status'))
				<div class="ui positive message">
				<i class="close icon"></i>
				<div class="header">
					Thông Báo !
				</div>
				<p>{{ session('status') }}</p>
				</div>
			@endif
			@if (session('error'))
				<div class="ui negative message">
				<i class="close icon"></i>
				<div class="header">
					Thông Báo !
				</div>
				<p>{{ session('error') }}</p>
				</div>
			@endif
			<form class="ui form" action="" method="post" name="form_1" id="form" data_id="add" autocomplete="off">
				{{ csrf_field() }}
				<div class="field thongtin">			
					<div class="field">
						<label>Tên phòng (*)</label>
						<div class="ui input left icon">							
						<i class="home icon"></i>
						<input type="text" name="tenphong" value="{{ old('tenphong') }}" required>
						</div>
					</div>
					<div class="field">
						<label>Số học viên tối đa (*)</label>
						<div class="ui input left icon">							
						<i class="user icon"></i>
						<input type="number" name="sohocvien" value="{{ old('sohocvien') }}" required>
						</div>
					</div>
				</div>
				<div class="inline field">
					<label>(*) Trường bắt buộc phải nhập</label>
				</div>	
				<div class="ui two column centered grid">
					<div class="eight wide column">
						<a href="{{url('/kitucxa/danhsachphong')}}" class="ui labeled icon button btn-align-left"><i class="arrow left icon"></i>Danh Sách</a>
						<button type="submit" class="ui labeled icon button blue btn-align-right"><i class="save icon"></i>Lưu</button>
					</div>
				</div>
			</form>
		</div>
	</div>
@endsection
@section('JsLibraries')
@endsection