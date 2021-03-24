@extends('admin.master')
@section('title', 'Cấu Hình Trang Sản Phẩm')
@section('PageContent')
  <div class="ui two column centered grid wrap-content-header">
    <div id="content-header" class="thirteen wide column">
      <h1 class="ui header centered page-title">Cấu Hình Trang Sản Phẩm</h1>
      <div class="link-page">
        Đường link: <a href="{{url('san-pham')}}" target="_blank">{{url('san-pham')}}</a>
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
          <input type="text" class="h1-tag" name="title" value="{{ $san_pham->title }}" placeholder="Tiêu đề trang...">
        </div>
        <div class="field">
          <label>Thẻ H1</label>
          <input type="text" class="h1-tag" name="h1Tag" value="{{ $san_pham->h1_tag }}" placeholder="Thẻ H1">
        </div>
        <div class="field">
          <label>Thẻ H2 (mỗi H2 cách nhau bằng dấu ',')</label>
          <textarea rows="2" class="h2-tag" name="h2Tag" placeholder="Các thẻ H2 cách nhau bằng dấu ,">{{ $san_pham->h2_tag }}</textarea>
        </div>
        <div class="field">
          <label>Thẻ H3 (mỗi H3 cách nhau bằng dấu ',')</label>
          <textarea rows="2" class="h3-tag" name="h3Tag" placeholder="Các thẻ H3 cách nhau bằng dấu ,">{{ $san_pham->h3_tag }}</textarea>
        </div>
        <div class="field">
          <label>SEO Title (Tối đa nên ít hơn 80 ký tự)</label>
          <p class="seo-title-messager"></p>
          <input type="text" class="seo-title" name="seoTitle" value="{{ $san_pham->seo_title }}" placeholder="SEO title">
        </div>
        <div class="field">
          <label>SEO Description  (Tối đa nên ít hơn 210 ký tự)</label>
          <p class="seo-description-messager"></p>
          <textarea rows="4" class="seo-description" name="seoDescription" placeholder="SEO description">{{ $san_pham->seo_description }}</textarea>
        </div>
        <button type="submit" class="ui labeled icon button blue btn-align-right"><i class="download icon"></i>Lưu</button>
      </form>
    </div>
  </div>
@endsection