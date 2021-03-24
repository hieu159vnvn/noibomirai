@extends('admin.master')
@section('title', 'Thêm Bài Viết Mới')
@section('PageContent')


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
			<form class="ui form" action="" method="post">
				{{ csrf_field() }}
				<div class="field">
					<label>Tiêu Đề Bài Viết</label>
					<input type="text" id="category-name" name="postTitle" placeholder="Tên Thẻ" value="{{ old('categoryName') }}" required>
				</div>
				<div class="field">
					<label>Slug (<span id="generate-slug">click để tự động tạo slug theo tiêu đề bài viết</span>)</label>
					<input type="text" id="category-slug" name="postSlug" placeholder="slug viết không dấu và các từ cách nhau bằng dấu - , ví dụ: bai-viet-1,...." value="{{ old('categorySlug') }}" required>
				</div>
				<div class="field">
					<label>Chuyên Mục</label>
					<select name="postCategory" class="ui fluid search dropdown category-dropdown" required>
						{!!$optionDropdownCategories!!}
					</select>
				</div>
				<div style="display: none" class="field">
					<label>Tags</label>
					<select class="ui fluid search dropdown tag-dropdown" name="postTags[]" multiple="">
					@if(count($tags) > 0)
						@foreach($tags as $tag)
							<option value="{{$tag->id}}">{{$tag->tag_name}}</option>
						@endforeach
					@endif
					</select>
				</div>
				<div class="field">
					<label>Mô tả</label>
					<textarea rows="4" class="post-description" name="postDescription" placeholder="Mô tả ngắn về bài viết...">{{ old('postDescription') }}</textarea>
				</div>
				<div class="field">
					<label>Nội dung</label>
					<textarea id="post-content" rows="50" class="post-content" name="postContent" placeholder="Nội dung bài viết">{{ old('postContent') }}</textarea>
				</div>
				<div class="field">
					<label>Hình Đại Diện</label>
					<div class="ui action input ten column">
						<input type="text" id="feature-image" name="featureImage" placeholder="Chọn hình đại diện...." readonly>
						<button type="button" class="ui button btn-feature-image">Chọn hình</button>
					</div>
					<img id="show-feature-image" src=""><i class="window close icon red remove-feature-image"></i>
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
				<div class="field">
					<label>Thẻ H1</label>
					<input type="text" class="h1-tag" name="h1Tag" value="{{ old('h1Tag') }}" placeholder="Thẻ H1">
				</div>
				<div class="field">
					<label>Thẻ H2 (mỗi H2 cách nhau bằng dấu ',')</label>
					<textarea rows="2" class="h2-tag" name="h2Tag" placeholder="Các thẻ H2 cách nhau bằng dấu ,">{{ old('h2Tag') }}</textarea>
				</div>
				<div class="field">
					<label>Thẻ H3 (mỗi H3 cách nhau bằng dấu ',')</label>
					<textarea rows="2" class="h3-tag" name="h3Tag" placeholder="Các thẻ H3 cách nhau bằng dấu ,">{{ old('h3Tag') }}</textarea>
				</div>
				<div class="field">
					<div class="ui toggle checkbox">
						<input type="checkbox" id="post-status" name="status" checked>
						<label>Hiển Thị</label>
					</div>
				</div>
				<div class="ui two column centered grid">
					<div class="six wide column">
						<a href="{{url('admin-dashboard/posts')}}" class="ui labeled icon button btn-align-left"><i class="arrow left icon"></i>Danh Sách Bài Viết</a>
						<button type="submit" class="ui labeled icon button blue btn-align-right"><i class="plus circle icon"></i>Thêm Bài Viết</button>
					</div>
				</div>
			</form>
		</div>
	</div>
	<div class="ui large image-modal modal">
		<div class="header">
			Chọn hình đại diện cho bài viết
		</div>
		<div class="content">
			<iframe width="100%" height="500" src="{!!url('filemanager/dialog.php?type=1&field_id=feature-image&fldr=')!!}" frameborder="0" ></iframe>
		</div>	
	</div>

	<script type="text/javascript">
        // Replace the <textarea id="editor1"> with a CKEditor
        // instance, using default configuration.
        CKEDITOR.replace( 'post-content', {
		    filebrowserBrowseUrl : '{!!url("filemanager/dialog.php?type=2&editor=ckeditor&fldr=")!!}',
			filebrowserUploadUrl : '{!!url("filemanager/dialog.php?type=2&editor=ckeditor&fldr=")!!}',
			filebrowserImageBrowseUrl : '{!!url("filemanager/dialog.php?type=1&editor=ckeditor&fldr=")!!}'
		});
		
		//trigger for: if click add image button then add select() for image input
		function responsive_filemanager_callback(field_id){
			var url=jQuery('#'+field_id).val();
			$('#show-feature-image').attr('src', url);
			$('.remove-feature-image').css('display', 'inline-block');
		}
	</script>
@endsection
@section('JsLibraries')
  <script src="{{url('js/admin/post/add_post.js')}}"></script>
@endsection