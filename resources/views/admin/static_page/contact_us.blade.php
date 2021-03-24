@extends('admin.master')
@section('title', 'Trang Liên Hệ')
@section('PageContent')
  <div class="ui two column centered grid wrap-content-header">
    <div id="content-header" class="thirteen wide column">
      <h1 class="ui header centered page-title">Cấu Hình Trang Liên Hệ</h1>
      <div class="link-page">
        Đường link: <a href="{{url('lien-he')}}" target="_blank">{{url('lien-he')}}</a>
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
        <div class="field">
          <div class="field">
          <label>Tiêu Đề Trang</label>
          <input type="text" class="h1-tag" name="title" value="{{ $contact_us->title }}" placeholder="Tiêu đề trang...">
        </div>
        <div class="field">
          <label>Nội Dung</label>
          <textarea rows="4" id="page-content" name="pageContent" placeholder="Nội dung...">{{ $contact_us->content }}</textarea>
        </div>
        <div style="margin-top: 40px" class="field">
          <label>Thông tin Google map:</label>
          <div>Vào trang <a href="https://www.latlong.net/">https://www.latlong.net/</a>. Nhập địa chỉ vào ô "Place Name", click "Find" để lấy "Latitude" và "Longitude". Sau đó dán vào ô bên dưới theo cấu trúc: Tên công ty;địa chỉ;hotline;email;Latitude;Longitude</div>
          <input type="text" class="h1-tag" name="googleMap" value="{{ $contact_us->content_1 }}" placeholder="Ví dụ: công ty ABC;1 Nguyễn Huệ, Q.1, TpHCM;0909 999 999;mail@gmail.com;10.773045;106.704040">
        </div>
        <div class="field">
          <label>Thẻ H1</label>
          <input type="text" class="h1-tag" name="h1Tag" value="{{ $contact_us->h1_tag }}" placeholder="Thẻ H1">
        </div>
        <div class="field">
          <label>Thẻ H2 (mỗi H2 cách nhau bằng dấu ',')</label>
          <textarea rows="2" class="h2-tag" name="h2Tag" placeholder="Các thẻ H2 cách nhau bằng dấu ,">{{ $contact_us->h2_tag }}</textarea>
        </div>
        <div class="field">
          <label>Thẻ H3 (mỗi H3 cách nhau bằng dấu ',')</label>
          <textarea rows="2" class="h3-tag" name="h3Tag" placeholder="Các thẻ H3 cách nhau bằng dấu ,">{{ $contact_us->h3_tag }}</textarea>
        </div>
        <div class="field">
          <label>SEO Title (Tối đa nên ít hơn 80 ký tự)</label>
          <p class="seo-title-messager"></p>
          <input type="text" class="seo-title" name="seoTitle" value="{{ $contact_us->seo_title }}" placeholder="SEO title">
        </div>
        <div class="field">
          <label>SEO Description  (Tối đa nên ít hơn 210 ký tự)</label>
          <p class="seo-description-messager"></p>
          <textarea rows="4" class="seo-description" name="seoDescription" placeholder="SEO description">{{ $contact_us->seo_description }}</textarea>
        </div>
        <button type="submit" class="ui labeled icon button blue btn-align-right"><i class="download icon"></i>Lưu</button>
      </form>
    </div>
  </div>
  
  <script type="text/javascript">
    // Replace the <textarea id="editor1"> with a CKEditor
    // instance, using default configuration.
    CKEDITOR.replace( 'page-content', {
      filebrowserBrowseUrl : '{!!url("filemanager/dialog.php?type=2&editor=ckeditor&fldr=")!!}',
      filebrowserUploadUrl : '{!!url("filemanager/dialog.php?type=2&editor=ckeditor&fldr=")!!}',
      filebrowserImageBrowseUrl : '{!!url("filemanager/dialog.php?type=1&editor=ckeditor&fldr=")!!}'
    });
  </script>
@endsection