@extends('admin.master')
@section('title', 'Thêm Nghiệp Đoàn')
@section('PageContent')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdn.rawgit.com/mdehoog/Semantic-UI/6e6d051d47b598ebab05857545f242caf2b4b48c/dist/semantic.min.js"></script>


	<div class="ui two column centered grid wrap-content-header">
		<h1 class="ui header centered page-title">THÊM NGHIỆP ĐOÀN</h1>
	</div>	

	<div class="ui two column centered grid main-content">	
		<div class="fifteen wide column">
			@if ($errors->any())
				<div class="ui red message">
					<i class="close icon"></i>
					<div class="header">
						@foreach ($errors->all() as $error)
			                <li>{{ $error }}</li>
			            @endforeach
					</div>
				</div>
			@endif
			<form class="ui form" action="" method="post" name="form_1">
				{{ csrf_field() }}
				<div class="field thongtin">
									
					<div class="two fields">
						<div class="field">
							<label>Tên nghiệp đoàn (*)</label>
							<div class="ui fluid search selection dropdown">
								{{-- <input type="hidden" name="tennghiepdoan" value=""> --}}
								<i class="dropdown icon"></i>
								<input class="search tennghiepdoan" name="tennghiepdoan">
								<div class="default text">Nhập tên nghiệp đoàn</div>
								<div class="menu">
									@foreach ($nghiepdoan as $item)
										<div class="item">{{$item->tennghiepdoan}}</div>
									@endforeach
								</div>
							</div>
						</div>
						<div class="field">
							<label>Địa chỉ (*)</label>
							<div class="ui input left icon">							
							<i class="map icon"></i>
							<input type="text" name="diachi" value="{{ old('diachi') }}" required>
							</div>
						</div>
					</div>
					<div class="three fields">
						<div class="field">
							<label>Người đại diện (*)</label>
							<div class="ui input left icon">							
							<i class="user icon"></i>
							<input type="text" name="nguoidaidien" value="{{ old('nguoidaidien') }}" required>
							</div>
						</div>
						<div class="field">
							<label>Số điện thoại</label>
							<div class="ui input left icon">							
							<i class="mobile icon"></i>
							<input type="text" name="dienthoai" value="{{ old('dienthoai') }}">
							</div>
						</div>
						<div class="field">
							<label>Email</label>
							<div class="ui input left icon">							
							<i class="mail icon"></i>
							<input type="text" name="email" value="{{ old('email') }}">
							</div>
						</div>
					</div>
					<div class="field">
						<label>Ghi chú (Nếu có)</label>
						<textarea rows="10" name="ghichu" placeholder="Nội dung...">{{ old('ghichu') }}</textarea>
					</div>
					<div class="inline field">
					<label>(*) Trường bắt buộc phải nhập</label>
					</div>		
				</div>	

				<div class="ui two column centered grid">
					<div class="eight wide column">
						<a href="{{url('nghiepdoan')}}" class="ui labeled icon button btn-align-left"><i class="arrow left icon"></i>Danh Sách</a>
						<button type="submit" class="ui labeled icon button blue btn-align-right"><i class="save icon"></i>Lưu</button>
					</div>
				</div>
			</form>
		</div>
	</div>
@endsection
@section('JsLibraries')
<script>
	$('.ui.selection.dropdown').dropdown({clearable: true});
</script>
  {{-- <script src="{{url('js/admin/nghiepdoan/add_nghiepdoan.js')}}"></script> --}}
@endsection