@extends('admin.master')
@section('title', 'Thêm Thẻ Mới')
@section('PageContent')
	<div class="ui two column centered grid wrap-content-header">
		<div id="content-header" class="thirteen wide column">
			<div class="callback-link">
				<a href="{{url('admin-dashboard/posttags')}}" class="ui labeled icon button btn-align-left"><i class="arrow left icon"></i>Danh Sách Thẻ</a>
			</div>
			<h1 class="ui header centered page-title">Thêm Thẻ Mới</h1>
		</div>
	</div>
	<div class="ui two column centered grid">	
		<div class="thirteen wide column">
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
					<label>Tên Thẻ</label>
					<input type="text" id="tag-name" name="tagName" placeholder="Tên Thẻ" value="{{ old('tagName') }}" required>
				</div>
				<div class="field">
					<label>Slug (<span id="generate-slug">click để tự động tạo slug theo tên thẻ</span>)</label>
					<input type="text" id="tag-slug" name="tagSlug" placeholder="slug viết không dấu và các từ cách nhau bằng dấu - , ví dụ: tieu-de-the-1,...." value="{{ old('tagSlug') }}" required>
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
				<a href="{{url('admin-dashboard/posttags')}}" class="ui labeled icon button btn-align-left"><i class="arrow left icon"></i>Danh Sách Thẻ</a>
				<button type="submit" class="ui labeled icon button blue btn-align-right"><i class="plus circle icon"></i>Thêm Thẻ</button>
			</form>
		</div>
	</div>
	
@endsection
@section('JsLibraries')
  <script src="{{url('js/admin/post/tag/edit_tag.js')}}"></script>
@endsection