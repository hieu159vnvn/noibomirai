@extends('admin.master')
@section('title', 'Cấu Hình Chân Trang')
@section('PageContent')
  <div class="ui two column centered grid wrap-content-header">
    <div id="content-header" class="twelve wide column">
      <h1 class="ui header centered page-title">Cấu Hình Chân Trang</h1>
    </div>
  </div>
  <div class="ui two column centered grid"> 
    <div class="twelve wide column">
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
          <label>Thông tin công ty cột bên trái chân trang</label>
          <textarea id="post-content" rows="50" class="post-content" name="content" placeholder="Thông tin công ty cột bên trái">{{$footer->content}}</textarea>
        </div>
        <div class="field">
          <label>Link Fanpage Facebook ở cột bên phải chân trang:</label>
          <input type="text" name="facebook" value="{{$footer->content3}}" placeholder="Link Fanpage Facebook">
        </div>
        <div class="field">
          <label>Thông tin Google map:</label>
          <div>Vào trang <a href="https://www.latlong.net/">https://www.latlong.net/</a>. Nhập địa chỉ vào ô "Place Name", click "Find" để lấy "Latitude" và "Longitude".</div>
          <div>Sau đó dán vào ô bên dưới theo cấu trúc: Tên công ty;địa chỉ;hotline;email;Latitude;Longitude</div>
          <input type="text" class="h1-tag" name="googleMap" value="{{ $footer->content1}}" placeholder="Ví dụ: công ty ABC;1 Nguyễn Huệ, Q.1, TpHCM;0909 999 999;mail@gmail.com;10.773045;106.704040">
        </div>  
        <div class="field">
          <label>Link video 1</label>
          <input type="text" class="post-content" name="video1" value="{{$video->video1}}">
        </div>
        <div class="field">
          <label>Link video 2</label>
          <input type="text" class="post-content" name="video2" value="{{$video->video2}}">
        </div>
        <div class="field">
          <label>Link video 3</label>
          <input type="text" class="post-content" name="video3" value="{{$video->video3}}">
        </div>
        <div class="field">
          <label>Link video 4</label>
          <input type="text" class="post-content" name="video4" value="{{$video->video4}}">
        </div>
        <div class="field">
          <label>Link video 5</label>
          <input type="text" class="post-content" name="video5" value="{{$video->video5}}">
        </div>
        <button type="submit" class="ui labeled icon button blue btn-align-right"><i class="download icon"></i>Lưu</button>
      </form>
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
  </script>
@endsection
