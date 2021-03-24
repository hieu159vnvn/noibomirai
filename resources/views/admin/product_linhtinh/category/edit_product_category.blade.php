@extends('admin.master')
@section('title', 'Sửa Danh Mục Sản Phẩm')
@section('PageContent')
	
	<div class="ui two column centered grid wrap-content-header">
		<div id="content-header" class="thirteen wide column">
			<div class="callback-link">
				<a href="{{url('admin-dashboard/productcategories')}}" class="ui labeled icon button btn-align-left"><i class="arrow left icon"></i>Danh Sách Danh Mục</a>
			</div>
			<h1 class="ui header centered page-title">Sửa Danh Mục: {{$category->product_category_name}}</h1>
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
					<label>Tên Danh Mục</label>
					<input type="text" id="category-name" name="categoryName" placeholder="Tên chuyên mục" value="{{ $category->product_category_name }}" required>
				</div>
				<div class="field">
					<label>Slug (<span id="generate-slug">click để tự động tạo slug theo tên danh mục</span>)</label>
					<input type="text" id="category-slug" name="categorySlug" placeholder="slug viết không dấu và các từ cách nhau bằng dấu - , ví dụ: danh-muc-1,...." value="{{ $category->product_category_slug }}" required>
				</div>
				<div class="field">
					<label>Danh Mục Cha</label>
					<select name="categoryParent" required>
						<option value="0">Không có cha</option>
						{!!$optionDropdownCategories!!}
					</select>
				</div>
				<div style="display: none" class="field">
					<label>Giá trên m2:</label>
					<input type="text" id="category-price" name="categoryPrice" placeholder="Giá trên m2" value="{{ $category->product_category_price }}">
				</div>
				<div class="field">
					<label>Hình Đại Diện</label>
					<div class="ui action input ten column">
						<input type="text" id="feature-image" name="featureImage" placeholder="Chọn hình đại diện...." readonly value="{{$category->product_category_image}}">
						<button type="button" class="ui button btn-feature-image">Chọn hình</button>
					</div>
					<img id="show-feature-image" src="{{$category->product_category_image}}"><i class="window close icon red remove-feature-image" @if($category->product_category_image) style="display: inline" @endif></i>
				</div>
				<div class="field">
					<label>Mô Tả Của Danh Mục</label>
					<textarea rows="4" id="product-description" name="productDescription" placeholder="Mô tả của danh mục">{{$category->product_category_description}}</textarea>
				</div>
				<div class="field">
					<label>SEO Title (Tối đa nên ít hơn 80 ký tự)</label>
					<p class="seo-title-messager"></p>
					<input type="text" class="seo-title" name="seoTitle" value="{{ $category->product_category_seo_title }}" placeholder="SEO title">
				</div>
				<div class="field">
					<label>SEO Description (Tối đa nên ít hơn 210 ký tự)</label>
					<p class="seo-description-messager"></p>
					<textarea rows="4" class="seo-description" name="seoDescription" placeholder="SEO description">{{ $category->product_category_seo_description }}</textarea>
				</div>
				<a href="{{url('admin-dashboard/productcategories')}}" class="ui labeled icon button btn-align-left"><i class="arrow left icon"></i>Danh Sách Danh Mục</a>
				<button type="submit" class="ui labeled icon button blue btn-align-right"><i class="download icon"></i>Lưu thay đổi</button>
			</form>
		</div>
	</div>
	<div class="ui large image-modal modal">
		<div class="header">
			Chọn hình đại diện cho danh mục sản phẩm
		</div>
		<div class="content">
			<iframe width="100%" height="500" src="{!!url('/filemanager/dialog.php?type=1&field_id=feature-image&fldr=')!!}" frameborder="0" ></iframe>
		</div>	
	</div>
	<script type="text/javascript">
		// Replace the <textarea id="editor1"> with a CKEditor
        // instance, using default configuration.
        CKEDITOR.replace( 'product-description', {
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
  <script src="{{url('js/admin/product/category/edit_product_category.js')}}"></script>
@endsection