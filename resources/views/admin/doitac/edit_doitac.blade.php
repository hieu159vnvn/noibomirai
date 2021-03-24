@extends('admin.master')
@section('title', 'SỬA ĐỐI TÁC')
@section('PageContent')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdn.rawgit.com/mdehoog/Semantic-UI/6e6d051d47b598ebab05857545f242caf2b4b48c/dist/semantic.min.js"></script>


	<div class="ui two column centered grid wrap-content-header">
		<h1 class="ui header centered page-title">SỬA CÔNG TY</h1>
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
			@if (session('error'))
			<div class="ui red message">
				<i class="close icon"></i>
				<div class="header">
				Thông Báo !
				</div>
				<p>{{ session('error') }}</p>
			</div>
			@endif
			@if (session('status'))
			<div class="ui message">
				<i class="close icon"></i>
				<div class="header">
				Thông Báo !
				</div>
				<p>{{ session('status') }}</p>
			</div>
			@endif
			<form class="ui form" action="" method="post" name="form_1" autocomplete="off">
				{{ csrf_field() }}
				<div class="field thongtin">			
					<div class="two fields">
						{{-- <div class="field">
							<label>Tên công ty (*)</label>
							<div class="ui input left icon">							
							<i class="user icon"></i>
							<input type="text" name="tencongty" value="{{ $doitac->tencongty }}" required>
							</div>
						</div> --}}
						
						<div class="field">
							<label>Tên công ty (*)</label>
							<input type="hidden" name="tencongtyhide" value="{{$doitac->tencongty}}">
							<div class="ui fluid search selection dropdown">
								
								<i class="dropdown icon"></i>
								<input class="search tencongty" name="tencongty" value="{{$doitac->tencongty}}">
								<div class="default text">{{$doitac->tencongty}}</div>
								<div class="menu">
									@foreach ($doitacs as $item)
										<div class="item itemred">{{$item->tencongty}}</div>
									@endforeach
								</div>
							</div>
						</div>
						<div class="field">
							<label>Tên Nghiệp đoàn (*)</label>
							<select name="nghiepdoan" class="ui search dropdown">
								 @foreach($nghiepdoan as $nd)
					                 @if($doitac->id_nghiepdoan == $nd->id) 
					                      <option value="{{$nd->id}}">{{$nd->tennghiepdoan}}</option>
					                 @endif 
					              @endforeach
								@foreach($nghiepdoan as $nd)
					      			<option value="{{$nd->id}}">{{$nd->tennghiepdoan}}</option>
					      		@endforeach						      	
							</select>
						</div>
						
						<div class="field">
							<label>Địa chỉ (*)</label>
							<div class="ui input left icon">							
							<i class="user icon"></i>
							<input type="text" name="diachi" value="{{ $doitac->diachi }}" required>
							</div>
						</div>
					</div>
					<div class="three fields">
						<div class="field">
							<label>Người đại diện (*)</label>
							<div class="ui input left icon">							
							<i class="user icon"></i>
							<input type="text" name="nguoidaidien" value="{{ $doitac->nguoidaidien }}" required>
							</div>
						</div>
						{{-- <div class="field">
							<label>Ngành nghề</label>
							<div class="ui input left icon">							
							<i class="user icon"></i>
							<input type="text" name="dienthoai" value="{{ $doitac->dienthoai }}">
							</div>
						</div> --}}
						<div class="field">
							<label>Ngành nghề</label>
							<select class="ui fluid search dropdown" multiple="" name="nganhnghe[]">
								@foreach ($nganhnghe as $item)
									<option value="{{$item->id}}">{{$item->nganhnghe_vn}} - "{{$item->nganhnghe_jp}}"</option>
								@endforeach
								@if ($nganhnghearray)
									@foreach ($nganhnghearray as $item)
										<option selected value="{{$item->id}}">{{$item->nganhnghe_vn}} - "{{$item->nganhnghe_jp}}"</option>
									@endforeach
								@endif
								
							</select>
						</div>
						<div class="field">
							<label>Email</label>
							<div class="ui input left icon">							
							<i class="user icon"></i>
							<input type="text" name="email" value="{{ $doitac->email }}">
							</div>
						</div>
					</div>
					<div class="field">
						<label>Ghi chú (Nếu có)</label>
						<textarea rows="10" name="ghichu" placeholder="Nội dung...">{{ $doitac->ghichu }}</textarea>
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
$('.ui.selection.dropdown').dropdown();
</script>
  {{-- <script src="{{url('js/admin/doitac/add_doitac.js')}}"></script> --}}
@endsection