@extends('admin.master')
@section('title', 'Trang Chủ')
@section('PageContent')
  <div class="ui two column centered grid wrap-content-header">
    <div id="content-header" class="thirteen wide column">
      <h1 class="ui header centered page-title">Cấu Hình Trang Chủ</h1>
      <div class="link-page">
        Đường link: <a href="{{url('/')}}" target="_blank">{{url('/')}}</a>
      </div>
    </div>
  </div>
  <div class="ui two column centered grid add-edit-page"> 
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
      @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
      @endif
      <form class="ui form" action="" method="post">
        {{ csrf_field() }}
        {{-- <div class="field block-category-dropdown" data-selected-cats="{{$selectedIds}}">
          <label>Block danh mục sản phẩm tự chọn</label>
          <select class="ui fluid search dropdown category-dropdown" name="productCategories[]" multiple>
          @if(count($categories) > 0)
            @foreach($categories as $category)
              <option value="{{$category->id}}">{{$category->product_category_name}}</option>
            @endforeach
          @endif
          </select>
        </div> --}}
        <div class="field">
          <div id="wrap-product-image" class="ui action input ten column" data-count-image="{{count($links)}}">
            <label>Thêm Slide (1349x435px)</label>
            <button type="button" class="ui button btn-product-image">Chọn hình</button>
            @if(count($links) > 0)
              @foreach($links as $link)
                <input type="hidden" class="product-image" name="productImage[]" id="product-image-{{$loop->index}}" value="{{$link}}" readonly>
              @endforeach
            @endif
            <input type="hidden" id="selected-product-image" readonly>
          </div>
          @if(count($links) > 0)
            @foreach($links as $link)
              <img class="show-product-image" id="img-product-image-{{$loop->index}}" src="{{$link}}"><i style="display:inline-block" class="window close icon red remove-product-image" data-count-image="{{$loop->index}}"></i>
            @endforeach
          @endif
          <div id="product-image-mockup"></div>
        </div>

          <div class="ui large product-image-modal modal">
          <div class="header">
            Chọn hình ảnh cho sản phẩm
          </div>
          <div class="content">
            <iframe width="100%" height="500" src="{!!url('/filemanager/dialog.php?type=1&field_id=selected-product-image&fldr=')!!}" frameborder="0" ></iframe>
          </div>  
        </div>      


        <div class="field">
          <label>Thẻ H1</label>
          <input type="text" class="h1-tag" name="h1Tag" value="{{ $home_page->h1_tag }}" placeholder="Thẻ H1">
        </div>
        <div class="field">
          <label>Thẻ H2 (mỗi H2 cách nhau bằng dấu ',')</label>
          <textarea rows="2" class="h2-tag" name="h2Tag" placeholder="Các thẻ H2 cách nhau bằng dấu ,">{{ $home_page->h2_tag }}</textarea>
        </div>
        <div class="field">
          <label>Thẻ H3 (mỗi H3 cách nhau bằng dấu ',')</label>
          <textarea rows="2" class="h3-tag" name="h3Tag" placeholder="Các thẻ H3 cách nhau bằng dấu ,">{{ $home_page->h3_tag }}</textarea>
        </div>
        <div class="field">
          <label>SEO Title (Tối đa nên ít hơn 80 ký tự)</label>
          <p class="seo-title-messager"></p>
          <input type="text" class="seo-title" name="seoTitle" value="{{ $home_page->seo_title }}" placeholder="SEO title">
        </div>
        <div class="field">
          <label>SEO Description  (Tối đa nên ít hơn 210 ký tự)</label>
          <p class="seo-description-messager"></p>
          <textarea rows="4" class="seo-description" name="seoDescription" placeholder="SEO description">{{ $home_page->seo_description }}</textarea>
        </div>
        <button type="submit" class="ui labeled icon button blue btn-align-right"><i class="download icon"></i>Lưu</button>
      </form>
    </div>
  </div>
  
  <script type="text/javascript">
    $('.ui.category-dropdown').dropdown();
    var catID = $('.block-category-dropdown').attr('data-selected-cats').split(',');
    $('.ui.category-dropdown').dropdown('set selected',catID);
  </script>

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

<script type="text/javascript">
  $('.btn-product-image').click(function(event) {
  $(".product-image-modal").modal('show');
});
$(document).on('click', '.remove-product-image', function(event) {
  var numberImage = parseInt($(this).attr('data-count-image'));
  $('#product-image-'+numberImage).remove();
  $('#img-product-image-'+numberImage).remove();
  $(this).remove();
});
</script>
@endsection