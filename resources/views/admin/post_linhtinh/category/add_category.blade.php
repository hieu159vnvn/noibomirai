@extends('admin.master')
@section('title', 'Thêm Chuyên Mục Mới')
@section('PageContent')
	
	<div class="ui two column centered grid wrap-content-header">
		<div id="content-header" class="fourteen wide column">
			<div class="callback-link">
				<a href="{{url('admin-dashboard/postcategories')}}" class="ui labeled icon button btn-align-left"><i class="arrow left icon"></i>Danh Sách Chuyên Mục</a>
			</div>
			<h1 class="ui header centered page-title">Thêm Chuyên Mục Mới</h1>
		</div>
	</div>
	<div class="ui two column centered grid">	
		<div class="fourteen wide column">
			@if ($errors->any())
			    <div class="alert alert-danger">
			        <ul>
			            @foreach ($errors->all() as $error)
			                <li>{{ $error }}</li>
			            @endforeach
			        </ul>
			    </div>
			@endif
			<form class="ui form" action="" method="post">
				{{ csrf_field() }}
				<div class="field">
					<label>Tên Chuyên Mục</label>
					<input type="text" id="category-name" name="categoryName" placeholder="Tên chuyên mục" value="{{ old('categoryName') }}" required>
				</div>
				<div class="field">
					<label>Slug (<span id="generate-slug">click để tự động tạo slug theo tên chuyên mục</span>)</label>
					<input type="text" id="category-slug" name="categorySlug" placeholder="slug viết không dấu và các từ cách nhau bằng dấu - , ví dụ: chuyen-muc-1,...." value="{{ old('categorySlug') }}" required>
				</div>
				<div style="display: none" class="field">
					<label>Chuyên Mục Cha</label>
					<select name="categoryParent" required>
						<option value="0" selected>Không có cha</option>
						{!!$optionDropdownCategories!!}
					</select>
				</div>
				<div class="field">
					<label>SEO Title (Tối đa nên ít hơn 80 ký tự)</label>
					<p class="seo-title-messager"></p>
					<input type="text" class="seo-title" name="seoTitle" value="{{ old('seoTitle') }}" placeholder="SEO title">
				</div>
				<div class="field">
					<label>SEO Description  (Tối đa nên ít hơn 210 ký tự)</label>
					<p class="seo-description-messager"></p>
					<textarea rows="4" class="seo-description" name="seoDescription" placeholder="SEO description">{{ old('seoDescription') }}</textarea>
				</div>
				<a href="{{url('admin-dashboard/postcategories')}}" class="ui labeled icon button btn-align-left"><i class="arrow left icon"></i>Danh Sách Chuyên Mục</a>
				<button type="submit" class="ui labeled icon button blue btn-align-right"><i class="plus circle icon"></i>Thêm Chuyên Mục</button>
			</form>
		</div>
	</div>
	
@endsection
@section('JsLibraries')
  <script src="{{url('js/admin/post/category/edit_category.js')}}"></script>
@endsection