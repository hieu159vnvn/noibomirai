@extends('admin.master')
@section('title', 'Thêm Chức vụ')
@section('PageContent')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdn.rawgit.com/mdehoog/Semantic-UI/6e6d051d47b598ebab05857545f242caf2b4b48c/dist/semantic.min.js"></script>


	<div class="ui two column centered grid wrap-content-header">
		<h1 class="ui header centered page-title">THÊM CHỨC VỤ</h1>
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
							<label>Tên chức vụ tiếng việt (*)</label>
							<div class="ui input left icon">							
							<i class="user icon"></i>
							<input type="text" name="chucvu_vn" value="{{ old('chucvu_vn') }}" required>
							</div>
						</div>
						<div class="field">
							<label>Tên chức vụ tiếng Nhật (*)</label>
							<div class="ui input left icon">							
							<i class="user icon"></i>
							<input type="text" name="chucvu_jp" value="{{ old('chucvu_jp') }}" required>
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
						<a href="{{url('chucvu')}}" class="ui labeled icon button btn-align-left"><i class="arrow left icon"></i>Danh Sách</a>
						<button type="submit" class="ui labeled icon button blue btn-align-right"><i class="save icon"></i>Lưu</button>
					</div>
				</div>
			</form>
		</div>
	</div>
@endsection
@section('JsLibraries')
  <script src="{{url('js/admin/chucvu/add_chucvu.js')}}"></script>
@endsection