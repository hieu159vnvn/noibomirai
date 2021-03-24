@extends('admin.master')
@section('title', 'Cấu Hình Chân Trang')
@section('PageContent')
  <div class="ui two column centered grid wrap-content-header">
    <div id="content-header" class="twelve wide column">
      <h1 class="ui header centered page-title">Hỗ trợ oline</h1>
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
        <h2>Hotline 1</h2>
        <div class="field">          
          <label>Tên</label>
          <input type="text" name="name1" value="{{$hotro->content}}" placeholder="">
        </div>
        <div class="field"> 
        <label>SDT</label>
          <input type="text" name="sdt1" value="{{$hotro->content1}}" placeholder="">
        </div> 
        <div class="field">  
        <label>Email</label>
          <input type="text" name="email1" value="{{$hotro->content2}}" placeholder="">
        </div>
         <h2>Hotline 2</h2>
        <div class="field">          
          <label>Tên</label>
          <input type="text" name="name2" value="{{$hotro->content3}}" placeholder="">
        </div>
        <div class="field"> 
        <label>SDT</label>
          <input type="text" name="sdt2" value="{{$hotro->content4}}" placeholder="">
        </div> 
        <div class="field">  
        <label>Email</label>
          <input type="text" name="email2" value="{{$hotro->content5}}" placeholder="">
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
