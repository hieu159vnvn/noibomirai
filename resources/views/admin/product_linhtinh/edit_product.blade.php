@extends('admin.master')
@section('title', 'Sửa '. $product->product_title)
@section('PageContent')
	@php
		// require_once ($app['path.base'].'/vendor/facebook/graph-sdk/src/Facebook/autoload.php');
		// $fb = new \Facebook\Facebook(config('facebook'));
		// try {

		// 	$response = $fb->get('me/accounts', config('facebook.access_token'));
		// 	$response = $response->getDecodedBody();

		// } catch(Facebook\Exceptions\FacebookResponseException $e) {

		// 	echo 'Graph returned an error: ' . $e->getMessage();
		// 	exit;

		// } catch(Facebook\Exceptions\FacebookSDKException $e) {

		// 	echo 'Facebook SDK returned an error: ' . $e->getMessage();
		// 	exit;

		// }

		// Session::put('facebook_token',config('facebook.access_token'));
		// Session::put('facebook_body',$response);

		// //$arr = array('message' => 'Chuc ngay moi lam viec hieu qua.');
		// $data = Session::get('facebook_body')['data'];
		// //$res = $fb->post($data[0]['id'].'/feed/', $arr,	$data[0]['access_token']);
		// //echo "Xem facebook di ku";*/
	@endphp
	<div class="ui two column centered grid wrap-content-header">
		<div id="content-header" class="fifteen wide column">
			<div class="callback-link">
				<a href="{{url('admin-dashboard/products')}}" class="ui labeled icon button btn-align-left"><i class="arrow left icon"></i>Danh Sách</a>
			</div>
			<h1 class="ui header centered page-title">Sửa : {{$product->product_title}}</h1>
		</div>
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
			<form class="ui form" action="" method="post">
				{{ csrf_field() }}
				<div class="field">
					<label>Tên tiêu đề</label>
					<input type="text" id="category-name" name="productTitle" placeholder="Tên tiêu đề" value="{{$product->product_title}}" required>
				</div>
				<div class="field">
					<label>Slug (<span id="generate-slug">click để tự động tạo slug </span>)</label>
					<input type="text" id="category-slug" name="productSlug" placeholder="slug viết không dấu và các từ cách nhau bằng dấu - , ví dụ: san-pham-1,...." value="{{$product->product_slug}}" required>
				</div>
				<div class="field">
					<label>Danh Mục</label>
					<select name="productCategory" class="ui fluid search dropdown category-dropdown" required>
						{!!$optionDropdownCategories!!}
					</select>
				</div>
				<div style="display: none" class="field block-tag-dropdown" data-selected-tags="{{$tagIds}}">
					<label>Các Thẻ</label>
					<select class="ui fluid search dropdown tag-dropdown" name="productTags[]" multiple="" >
					@if(count($tags) > 0)
						@foreach($tags as $tag)
							<option value="{{$tag->id}}">{{$tag->tag_name}}</option>
						@endforeach
					@endif
					</select>
				</div>
				<div style="display: none" class="field">
					<label>Giá cũ:</label>
					<input type="text" id="category-old-price" name="productOldPrice" placeholder="Giá cũ của sản phẩm" value="{{$product->product_old_price}}">
				</div>
				<div class="field" style="display: none">
					<label>Giá:</label>
					<input type="text" id="category-new-price" name="productNewPrice" placeholder="Giá mới của sản phẩm" value="{{$product->product_new_price}}">
				</div>
				<div class="field">
					<label>Hình Đại Diện</label>
					<div class="ui action input">
						<input type="text" id="feature-image" name="featureImage" placeholder="Chọn hình đại diện...." readonly value="{{$product->product_feature_image}}">
						<button type="button" class="ui button btn-feature-image">Chọn hình</button>
					</div>
					<img id="show-feature-image" src="{{$product->product_feature_image}}"><i class="window close icon red remove-feature-image" @if($product->product_feature_image) style="display: inline-block;" @endif></i>
				</div>
				<div class="field">
					<label>Mô tả</label>
					<textarea rows="4" class="product-description" name="productDescription" placeholder="Mô tả ngắn về...">{{ $product->product_description }}</textarea>
				</div>
				<div class="field">
					<label>Nội dung</label>
					<textarea id="post-content" rows="50" class="product-content" name="productContent" placeholder="Nội dung chi tiết">{{ $product->product_content }}</textarea>
				</div>
				<div class="field" style="display: none">
					<div id="wrap-product-image" class="ui action input ten column" data-count-image="{{count($productImages)}}">
						<label>Thêm Hình Ảnh</label>
						<button type="button" class="ui button btn-product-image">Chọn hình</button>
						@if(count($productImages) > 0)
							@foreach($productImages as $productImage)
								<input type="hidden" class="product-image" name="productImage[]" id="product-image-{{$loop->index + 1}}" value="{{$productImage->image_url}}" readonly>
							@endforeach
						@endif
						<input type="hidden" id="selected-product-image" readonly>
					</div>
					@if(count($productImages) > 0)
						@foreach($productImages as $productImage)
							<img class="show-product-image" id="img-product-image-{{$loop->index + 1}}" src="{{$productImage->image_url}}"><i style="display:inline-block" class="window close icon red remove-product-image" data-count-image="{{$loop->index + 1}}"></i>
						@endforeach
					@endif
					<div id="product-image-mockup"></div>
				</div>
				<div class="field">
					<label>SEO Title (Tối đa nên ít hơn 80 ký tự)</label>
					<p class="seo-title-messager"></p>
					<input type="text" class="seo-title" name="seoTitle" value="{{ $product->product_seo_title }}" placeholder="SEO title">
				</div>
				<div class="field">
					<label>SEO Description  (Tối đa nên ít hơn 210 ký tự)</label>
					<p class="seo-description-messager"></p>
					<textarea rows="4" class="seo-description" name="seoDescription" placeholder="SEO description">{{ $product->product_seo_description }}</textarea>
				</div>
				<div class="field">
					<label>Thẻ H1</label>
					<input type="text" class="h1-tag" name="h1Tag" value="{{ $product->h1_tag }}" placeholder="Thẻ H1">
				</div>
				<div class="field">
					<label>Thẻ H2 (mỗi H2 cách nhau bằng dấu ',')</label>
					<textarea rows="2" class="h2-tag" name="h2Tag" placeholder="Các thẻ H2 cách nhau bằng dấu ,">{{ $product->h2_tag }}</textarea>
				</div>
				<div class="field">
					<label>Thẻ H3 (mỗi H3 cách nhau bằng dấu ',')</label>
					<textarea rows="2" class="h3-tag" name="h3Tag" placeholder="Các thẻ H3 cách nhau bằng dấu ,">{{ $product->h3_tag }}</textarea>
				</div>
				<div class="field">
					<label>Số Thứ Tự:</label>
					<input type="number" id="stt" name="stt" placeholder="Số tứ tự hiển thị" value="{{ $product->stt }}">
				</div>
				<div class="field">
					<div class="ui toggle checkbox">
						<input type="checkbox" id="post-status" name="status" @if($product->product_status == 1) checked @endif>
						<label>Hiển Thị</label>
					</div>
				</div>
				<div class="ui two column centered grid">
					<div class="eight wide column">
						<a href="{{url('admin-dashboard/products')}}" class="ui labeled icon button btn-align-left"><i class="arrow left icon"></i>Danh Sách</a>
						<button type="submit" class="ui labeled icon button blue btn-align-right"><i class="download icon"></i>Lưu thay đổi</button>
					</div>
				</div>
			</form>
		</div>
	</div>
	<div class="ui large image-modal modal">
		<div class="header">
			Chọn hình đại diện
		</div>
		<div class="content">
			<iframe width="100%" height="500" src="{!!url('/filemanager/dialog.php?type=1&field_id=feature-image&fldr=')!!}" frameborder="0" ></iframe>
		</div>	
	</div>
	<div class="ui large product-image-modal modal">
		<div class="header">
			Chọn hình ảnh
		</div>
		<div class="content">
			<iframe width="100%" height="500" src="{!!url('/filemanager/dialog.php?type=1&field_id=selected-product-image&fldr=')!!}" frameborder="0" ></iframe>
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
			if(field_id ==  "feature-image"){
				$('#show-feature-image').attr('src', url);
				$('.remove-feature-image').css('display', 'inline-block');
			}else{
				var countImage = parseInt($('#wrap-product-image').attr('data-count-image')) + 1;
				$('#wrap-product-image').attr('data-count-image', countImage);

				var inputHtml = '<input type="hidden" class="product-image" name="productImage[]"' + 'id="product-image-'+ countImage + '" value="' + url + '" readonly>';
				$('#selected-product-image').before(inputHtml);

				var imgHtml = '<img class="show-product-image" id="img-product-image-'+ countImage +'" src="'+url+'"><i style="display:inline-block" class="window close icon red remove-product-image"'+' data-count-image="' + countImage +'"></i>';
				$('#product-image-mockup').before(imgHtml);
			}
		}
	</script>
	<input type="hidden" class="product-image" name="productImage[]" readonly>
	<img class="show-product-image" src=""><i class="window close icon red remove-product-image"></i>
@endsection
@section('JsLibraries')
  <script src="{{url('js/admin/product/edit_product.js')}}"></script>
@endsection