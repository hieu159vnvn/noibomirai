@extends('admin.master')
@section('title', 'Quản lý danh mục của sản phẩm')
@section('PageContent')
	<h1 class="ui header centered page-title">Quản Lý Danh Mục</h1>
  @if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
  @endif
  <table id="data-table" class="cell-border hover order-column" style="width:100%">
      <thead>
        <tr>
          <th class="id-column-table">ID</th>
          <th class="title-column-table">Tên Danh Mục</th>
          <th class="title-column-table">Slug</th>
          <th class="image-column-table">Hình đại diện</th>
          <th class="action-column-table">Hành Động</th>
        </tr>
      </thead>
      <tbody>
        @foreach($categories as $category)
        <tr>
          <td>{{$category->id}}</td>
          <td class="title-column"><a href="{{url('admin-dashboard/productcategories/' . $category->id . '/edit')}}" title="sửa {{$category->product_category_name}}">{{$category->prefixString . $category->product_category_name}}</a></td>
          <td>{{$category->product_category_slug}}</td>
          <td><img class="post-image-feature" src="{{$category->product_category_image}}" alt=""></td>
          <td>
            <a href="{{url($category->product_category_slug)}}" class="mini ui icon green button" title="Xem" target="_blank"><i class="eye icon"></i></a>
            <a href="{{url('admin-dashboard/productcategories/' . $category->id . '/edit')}}" class="mini ui icon blue button" title="Sửa"><i class="edit icon"></i></a>
            <button type="button" class="mini ui icon red button btn-delete" data-category-id="{{$category->id}}" data-category-name="{{$category->product_category_name}}" title="Xóa"><i class="window close icon"></i></button>
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
  <script src="{{url('js/admin/product/category/product_category.js')}}"></script>
@endsection