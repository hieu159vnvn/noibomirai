@extends('admin.master')
@section('title', 'Quản lý Sản Phẩm')
@section('PageContent')
	<h1 class="ui header centered page-title">Danh sách quản lý</h1>
  @if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
  @endif
  <div class="ajax-messenger"></div>
  <table id="data-table" class="cell-border hover order-column">
      <thead>
        <tr>
          <th class="id-column-table">ID</th>
          <th class="id-column-table">STT</th>
          <th class="title-column-table">Tên tiêu đề</th>
          <th class="cat-column-table">Danh Mục</th>
          <th style="display: none" class="tag-column-table">Thẻ</th>
          <th class="status-column-table">Hiển Thị</th>
          <th class="status-column-table">Nổi bật</th>
          <th class="status-column-table">Tiêu biểu</th>
          <th class="image-column-table">Hình đại diện</th>
          <th class="action-column-table">Hành Động</th>
        </tr>
      </thead>
      <tbody>
        @foreach($products as $product)
        <tr>
          <td>{{$product->id}}</td>
          <td><input style="width: 45px; text-align: center" type="number" class="product-stt" name="stt" value="{{$product->stt}}" data-id="{{$product->id}}"></td>
          <td class="title-column"><a href="{{url('admin-dashboard/products/'.$product->id.'/edit')}}" title="sửa {{$product->product_title}}">{{$product->product_title}}</a></td>
          {{-- <td>{{$post->post_slug}}</td> --}}
          <td><a href="{{url('admin-dashboard/productcategories/'.$product->category->id.'/edit')}}" title="sửa {{$product->category->product_category_name}}">{{$product->category->product_category_name}}</a>
          </td>
          <td style="display: none" class="tag-space">
            @foreach($product->tags as $tag)
              <a href="{{url('admin-dashboard/producttags/'.$tag->id.'/edit')}}" title="sửa {{$tag->tag_name}}">- {{$tag->tag_name}}</a>
            @endforeach
          </td>
          <td>
            <div style="margin-left: 15px;" class="ui toggle checkbox">
              <input type="checkbox" class="product-status" name="status" data-id="{{$product->id}}" @if($product->product_status == 1) checked @endif>
              <label></label>
            </div>
          </td>
           <td>
            <div style="margin-left: 15px;" class="ui toggle checkbox">
              <input type="checkbox" class="product-noibat" name="noibat" data-id="{{$product->id}}" @if($product->product_noibat == 1) checked @endif>
              <label></label>
            </div>
          </td>
          <td>
            <div style="margin-left: 15px;" class="ui toggle checkbox">
              <input type="checkbox" class="product-banchay" name="banchay" data-id="{{$product->id}}" @if($product->product_banchay == 1) checked @endif>
              <label></label>
            </div>
          </td>
          <td><img class="post-image-feature" src="{{$product->product_feature_image}}" alt=""></td>
          <td>
            <a href="{{url('admin-dashboard/products/' . $product->id . '/edit')}}" class="mini ui icon blue button" title="Sửa"><i class="edit icon"></i></a>
            <button type="button" class="mini ui icon red button btn-delete" data-post-id="{{$product->id}}" data-post-title="{{$product->product_title}}" title="Xóa"><i class="window close icon"></i></button>
          </td>
        </tr>
        @endforeach
      </tbody>
  </table>
  <div class="ui tiny del-modal modal">
    <div class="content"></div>
    <div class="actions">
      <div class="ui negative button">
        No
      </div>
      <div class="ui positive right labeled icon button">
        Yes
        <i class="checkmark icon"></i>
      </div>
    </div>
  </div>

@endsection
@section('JsLibraries')
  <script src="{{url('js/admin/product/product.js')}}"></script>
@endsection