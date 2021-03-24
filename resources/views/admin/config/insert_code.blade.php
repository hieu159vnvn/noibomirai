@extends('admin.master')
@section('title', 'Chèn code')
@section('PageContent')
  <div class="ui two column centered grid wrap-content-header">
    <div id="content-header" class="twelve wide column">
      <h1 class="ui header centered page-title">Chèn Code</h1>
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
          <label>Chèn code vào đầu trang</label>
          <textarea rows="15" class="post-description" name="headerCode" placeholder="Chèn code tại đây...">{{ $code->content }}</textarea>
        </div>
        <div style="margin-top: 40px" class="field">
          <label>Chèn code vào chân trang</label>
          <textarea rows="15" class="post-description" name="footerCode" placeholder="Chèn code tại đây...">{{ $code->content1 }}</textarea>
        </div>
        <button type="submit" class="ui labeled icon button blue btn-align-right"><i class="download icon"></i>Lưu</button>
      </form>
    </div>
  </div>

@endsection
@section('JsLibraries')
@endsection