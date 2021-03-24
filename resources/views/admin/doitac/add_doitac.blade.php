@extends('admin.master')
@section('title', 'Thêm Đối Tác ')
@section('PageContent')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdn.rawgit.com/mdehoog/Semantic-UI/6e6d051d47b598ebab05857545f242caf2b4b48c/dist/semantic.min.js"></script>


	<div class="ui two column centered grid wrap-content-header">
		<h1 class="ui header centered page-title">THÊM CÔNG TY</h1>
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
			@if (session('error'))
			<div class="ui red message">
				<i class="close icon"></i>
				<div class="header">
				Thông Báo !
				</div>
				<p>{{ session('error') }}</p>
			</div>
			@endif
			
			<form class="ui form" action="" method="post" name="form_1" autocomplete="off">
				{{ csrf_field() }}
				<div class="field thongtin">			
					<div class="two fields">
						<div class="field">
							<label>Tên công ty (*)</label>
							<div class="ui fluid search selection dropdown">
								<i class="dropdown icon"></i>
								<input class="search tencongty" name="tencongty">
								<div class="default text">Nhập tên công ty</div>
								<div class="menu">
									@foreach ($doitac as $item)
										<div class="item itemred">{{$item->tencongty}}</div>
									@endforeach
								</div>
							</div>
						</div>
						<div class="field">
							<label>Tên Nghiệp đoàn (*)</label>
							<select name="nghiepdoan" class="ui search dropdown">
								@foreach($nghiepdoan as $nd)
									<option value="{{$nd->id}}">{{$nd->tennghiepdoan}}</option>
								@endforeach						      	
							</select>
						</div>
						<div class="field">
							<label>Địa chỉ (*)</label>
							<div class="ui input left icon">							
							<i class="user icon"></i>
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
						{{-- <div class="field">
							<label>Ngành nghề</label>
							<div class="ui input left icon">							
							<i class="user icon"></i>
							<input type="text" name="dienthoai" value="{{ old('dienthoai') }}">
							</div>
						</div> --}}
						<div class="field">
							<label>Ngành nghề</label>
							<select class="ui fluid search dropdown" multiple="" name="nganhnghe[]">
								@foreach ($nganhnghe as $item)
									<option value="{{$item->id}}">{{$item->nganhnghe_vn}} - "{{$item->nganhnghe_jp}}"</option>
								@endforeach
							</select>
						</div>
						<div class="field">
							<label>Email</label>
							<div class="ui input left icon">							
							<i class="user icon"></i>
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
						<a href="{{url('doitac')}}" class="ui labeled icon button btn-align-left"><i class="arrow left icon"></i>Danh Sách</a>
						<button type="submit" class="ui labeled icon button blue btn-align-right"><i class="save icon"></i>Lưu</button>
					</div>
				</div>
			</form>
		</div>
	</div>
@endsection
@section('JsLibraries')
<style>
.ui.dropdown .menu>.itemred {
	color: red !important;
}
</style>
<script>
$('.ui.search.dropdown').dropdown({clearable: true});
$('.ui.selection.dropdown').dropdown({clearable: true});
</script>
  {{-- <script src="{{url('js/admin/doitac/add_doitac.js')}}"></script> --}}
@endsection