@extends('admin.master')
@section('title', 'Cấu Hình Đầu Trang')
@section('PageContent')
  <div class="ui two column centered grid wrap-content-header">
    <div id="content-header" class="ten wide column">
      <h1 class="ui header centered page-title">Cấu Hình Đầu Trang</h1>
    </div>
  </div>
  <div class="ui two column centered grid"> 
    <div class="ten wide column">
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
          <label>Favicon (30x30px)</label>
          <div class="ui action input ten column">
            <input type="text" id="favicon-image" name="favicon" placeholder="Chọn hình cho favicon...." readonly value="{{$header->favicon}}">
            <button type="button" class="ui button btn-favicon-image">Chọn hình</button>
          </div>
          <img id="show-favicon-image" src="{{$header->favicon}}"><i class="window close icon red remove-favicon-image" @if($header->favicon) style="display: inline" @endif></i>
        </div>
        <div class="field">
          <label>Logo (400x119px)</label>
          <div class="ui action input ten column">
            <input type="text" id="feature-image" name="logo" placeholder="Chọn hình đại diện...." readonly value="{{$header->logo}}">
            <button type="button" class="ui button btn-feature-image">Chọn hình</button>
          </div>
          <img id="show-feature-image" src="{{$header->logo}}"><i class="window close icon red remove-feature-image" @if($header->logo) style="display: inline" @endif></i>
        </div>

        <div class="field">
          <label>Quảng cáo (1349x400px)</label>
          <div class="ui action input ten column">
            <input type="text" id="quangcao-image" name="quangcao" placeholder="Chọn hình đại diện...." readonly value="{{$header->quangcao}}">
            <button type="button" class="ui button btn-quangcao-image">Chọn hình</button>
          </div>
          <img id="show-quangcao-image" src="{{$header->quangcao}}"><i class="window close icon red remove-quangcao-image" @if($header->quangcao) style="display: inline" @endif></i>
        </div>
        <div class="field">
          <label>Hotline:</label>
          <input type="text" name="hotline1" value="{{$header->hotline1}}" placeholder="Hotline 1">
        </div>
        <div class="field">
          <label>Hotline 2:</label>
          <input type="text" name="hotline2" value="{{$header->hotline2}}" placeholder="Hotline 2">
        </div>
        <div class="field">
          <label>Link Facebook:</label>
          <input type="text" name="facebook" value="{{$header->facebook}}" placeholder="Link Facebook">
        </div>
        <div class="field">
          <label>Link Skype:</label>
          <input type="text" name="skype" value="{{$header->skype}}" placeholder="Link Skype">
        </div>
        <div class="field">
          <label>Link Youtube:</label>
          <input type="text" name="youtube" value="{{$header->youtube}}" placeholder="Link Youtube">
        </div>
        <div class="field">
          <label>Link Linkedin:</label>
          <input type="text" name="linkedin" value="{{$header->linkedin}}" placeholder="Linkedin">
        </div>
{{-- DOITAC --}}
    <h3>ĐỐI TÁC (200x150px)</h3>
        <div class="field">
          <label>Pic 1</label>
          <div class="ui action input ten column">
            <input type="text" id="pic1-image" name="pic1" placeholder="Chọn hình đại diện...." readonly value="{{$doitac->pic1}}">
            <button type="button" class="ui button btn-pic1-image">Chọn hình</button>
          </div>
          <img id="show-pic1-image" src="{{$doitac->pic1}}"><i class="window close icon red remove-pic1-image" @if($doitac->pic1) style="display: inline" @endif></i>
        </div>
        <div class="field">
          <label>Pic 2</label>
          <div class="ui action input ten column">
            <input type="text" id="pic2-image" name="pic2" placeholder="Chọn hình đại diện...." readonly value="{{$doitac->pic2}}">
            <button type="button" class="ui button btn-pic2-image">Chọn hình</button>
          </div>
          <img id="show-pic2-image" src="{{$doitac->pic2}}"><i class="window close icon red remove-pic2-image" @if($doitac->pic2) style="display: inline" @endif></i>
        </div>
        <div class="field">
          <label>Pic 3</label>
          <div class="ui action input ten column">
            <input type="text" id="pic3-image" name="pic3" placeholder="Chọn hình đại diện...." readonly value="{{$doitac->pic3}}">
            <button type="button" class="ui button btn-pic3-image">Chọn hình</button>
          </div>
          <img id="show-pic3-image" src="{{$doitac->pic3}}"><i class="window close icon red remove-pic3-image" @if($doitac->pic3) style="display: inline" @endif></i>
        </div>
        <div class="field">
          <label>Pic 4</label>
          <div class="ui action input ten column">
            <input type="text" id="pic4-image" name="pic4" placeholder="Chọn hình đại diện...." readonly value="{{$doitac->pic4}}">
            <button type="button" class="ui button btn-pic4-image">Chọn hình</button>
          </div>
          <img id="show-pic4-image" src="{{$doitac->pic4}}"><i class="window close icon red remove-pic4-image" @if($doitac->pic4) style="display: inline" @endif></i>
        </div>
        <div class="field">
          <label>Pic 5</label>
          <div class="ui action input ten column">
            <input type="text" id="pic5-image" name="pic5" placeholder="Chọn hình đại diện...." readonly value="{{$doitac->pic5}}">
            <button type="button" class="ui button btn-pic5-image">Chọn hình</button>
          </div>
          <img id="show-pic5-image" src="{{$doitac->pic5}}"><i class="window close icon red remove-pic5-image" @if($doitac->pic5) style="display: inline" @endif></i>
        </div>
        <div class="field">
          <label>Pic 6</label>
          <div class="ui action input ten column">
            <input type="text" id="pic6-image" name="pic6" placeholder="Chọn hình đại diện...." readonly value="{{$doitac->pic6}}">
            <button type="button" class="ui button btn-pic6-image">Chọn hình</button>
          </div>
          <img id="show-pic6-image" src="{{$doitac->pic6}}"><i class="window close icon red remove-pic6-image" @if($doitac->pic6) style="display: inline" @endif></i>
        </div>
        <div class="field">
          <label>Pic 7</label>
          <div class="ui action input ten column">
            <input type="text" id="pic7-image" name="pic7" placeholder="Chọn hình đại diện...." readonly value="{{$doitac->pic7}}">
            <button type="button" class="ui button btn-pic7-image">Chọn hình</button>
          </div>
          <img id="show-pic7-image" src="{{$doitac->pic7}}"><i class="window close icon red remove-pic7-image" @if($doitac->pic7) style="display: inline" @endif></i>
        </div>
        <div class="field">
          <label>Pic 8</label>
          <div class="ui action input ten column">
            <input type="text" id="pic8-image" name="pic8" placeholder="Chọn hình đại diện...." readonly value="{{$doitac->pic8}}">
            <button type="button" class="ui button btn-pic8-image">Chọn hình</button>
          </div>
          <img id="show-pic8-image" src="{{$doitac->pic8}}"><i class="window close icon red remove-pic8-image" @if($doitac->pic8) style="display: inline" @endif></i>
        </div>
        <button type="submit" class="ui labeled icon button blue btn-align-right"><i class="download icon"></i>Lưu</button>
      </form>
    </div>
  </div>
  <div class="ui large image-modal modal">
    <div class="header">
      Chọn hình đại diện cho bài viết
    </div>
    <div class="content">
      <iframe width="100%" height="500" src="/filemanager/dialog.php?type=1&field_id=feature-image&fldr=" frameborder="0" ></iframe>
    </div>  
  </div>
  <div class="ui large quangcao-modal modal">
    <div class="header">
      Chọn hình đại diện cho bài viết
    </div>
    <div class="content">
      <iframe width="100%" height="500" src="/filemanager/dialog.php?type=1&field_id=quangcao-image&fldr=" frameborder="0" ></iframe>
    </div>  
  </div>
  <div class="ui large favicon-modal modal">
    <div class="header">
      Chọn hình đại diện cho bài viết
    </div>
    <div class="content">
      <iframe width="100%" height="500" src="/filemanager/dialog.php?type=1&field_id=favicon-image&fldr=" frameborder="0" ></iframe>
    </div>  
  </div>

  <div class="ui large pic1-modal modal">
    <div class="header">
      Chọn hình đại diện cho bài viết
    </div>
    <div class="content">
      <iframe width="100%" height="500" src="/filemanager/dialog.php?type=1&field_id=pic1-image&fldr=" frameborder="0" ></iframe>
    </div>  
  </div>
  <div class="ui large pic2-modal modal">
    <div class="header">
      Chọn hình đại diện cho bài viết
    </div>
    <div class="content">
      <iframe width="100%" height="500" src="/filemanager/dialog.php?type=1&field_id=pic2-image&fldr=" frameborder="0" ></iframe>
    </div>  
  </div>

  <div class="ui large pic3-modal modal">
    <div class="header">
      Chọn hình đại diện cho bài viết
    </div>
    <div class="content">
      <iframe width="100%" height="500" src="/filemanager/dialog.php?type=1&field_id=pic3-image&fldr=" frameborder="0" ></iframe>
    </div>  
  </div>

  <div class="ui large pic4-modal modal">
    <div class="header">
      Chọn hình đại diện cho bài viết
    </div>
    <div class="content">
      <iframe width="100%" height="500" src="/filemanager/dialog.php?type=1&field_id=pic4-image&fldr=" frameborder="0" ></iframe>
    </div>  
  </div>

  <div class="ui large pic5-modal modal">
    <div class="header">
      Chọn hình đại diện cho bài viết
    </div>
    <div class="content">
      <iframe width="100%" height="500" src="/filemanager/dialog.php?type=1&field_id=pic5-image&fldr=" frameborder="0" ></iframe>
    </div>  
  </div>

  <div class="ui large pic6-modal modal">
    <div class="header">
      Chọn hình đại diện cho bài viết
    </div>
    <div class="content">
      <iframe width="100%" height="500" src="/filemanager/dialog.php?type=1&field_id=pic6-image&fldr=" frameborder="0" ></iframe>
    </div>  
  </div>


  <div class="ui large pic7-modal modal">
    <div class="header">
      Chọn hình đại diện cho bài viết
    </div>
    <div class="content">
      <iframe width="100%" height="500" src="/filemanager/dialog.php?type=1&field_id=pic7-image&fldr=" frameborder="0" ></iframe>
    </div>  
  </div>


  <div class="ui large pic8-modal modal">
    <div class="header">
      Chọn hình đại diện cho bài viết
    </div>
    <div class="content">
      <iframe width="100%" height="500" src="/filemanager/dialog.php?type=1&field_id=pic8-image&fldr=" frameborder="0" ></iframe>
    </div>  
  </div>
  <script type="text/javascript">
    //trigger for: if click add image button then add select() for image input
    function responsive_filemanager_callback(field_id){
      var url=jQuery('#'+field_id).val();
      if(field_id == "feature-image"){
        $('#show-feature-image').attr('src', url);
        $('.remove-feature-image').css('display', 'inline-block');
      } 
      if(field_id == "favicon-image"){
        $('#show-favicon-image').attr('src', url);
        $('.remove-favicon-image').css('display', 'inline-block');
      }
      if(field_id == "quangcao-image"){
        $('#show-quangcao-image').attr('src', url);
        $('.remove-quangcao-image').css('display', 'inline-block');
      }
      //doitac
      if(field_id == "pic1-image"){
        $('#show-pic1-image').attr('src', url);
        $('.remove-pic1-image').css('display', 'inline-block');
      }
      if(field_id == "pic2-image"){
        $('#show-pic2-image').attr('src', url);
        $('.remove-pic2-image').css('display', 'inline-block');
      }
      if(field_id == "pic3-image"){
        $('#show-pic3-image').attr('src', url);
        $('.remove-pic3-image').css('display', 'inline-block');
      }
      if(field_id == "pic4-image"){
        $('#show-pic4-image').attr('src', url);
        $('.remove-pic4-image').css('display', 'inline-block');
      }
      if(field_id == "pic5-image"){
        $('#show-pic5-image').attr('src', url);
        $('.remove-pic5-image').css('display', 'inline-block');
      }
      if(field_id == "pic6-image"){
        $('#show-pic6-image').attr('src', url);
        $('.remove-pic6-image').css('display', 'inline-block');
      }
      if(field_id == "pic7-image"){
        $('#show-pic7-image').attr('src', url);
        $('.remove-pic7-image').css('display', 'inline-block');
      }
      if(field_id == "pic8-image"){
        $('#show-pic8-image').attr('src', url);
        $('.remove-pic8-image').css('display', 'inline-block');
      }
     
    }
  </script>
@endsection
@section('JsLibraries')
  <script src="{{url('js/admin/config/header.js')}}"></script>
@endsection