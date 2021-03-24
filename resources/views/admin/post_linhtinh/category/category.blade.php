@extends('admin.master')
@section('title', 'Quản lý chuyên mục của bài viết')
@section('PageContent')
	<h1 class="ui header centered page-title">Quản Lý Chuyên Mục Của Bài Viết</h1>
  @if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
  @endif
  <table id="data-table" class="cell-border hover order-column" style="width:100%">
      <thead>
        <tr>
          <th class="id-column-table">ID</th>
          <th class="title-column-table">Tên Chuyên Mục</th>
          <th class="title-column-table">Slug</th>
          <th class="seo-title-column-table">SEO Title</th>
          <th class="seo-des-column-table">SEO Description</th>
          <th class="action-column-table">Hành Động</th>
        </tr>
      </thead>
      <tbody>
        @foreach($categories as $category)
        <tr>
          <td>{{$category->id}}</td>
          <td class="title-column"><a href="{{url('admin-dashboard/postcategories/' . $category->id . '/edit')}}" title="sửa {{$category->category_name}}">{{$category->prefixString . $category->category_name}}</a></td>
          <td>{{$category->category_slug}}</td>
          <td>{{$category->category_seo_title}}</td>
          <td>{{$category->category_seo_description}}</td>
          <td>
            <a href="{{url($category->category_slug . '.html')}}" class="mini ui icon green button" title="Xem" target="_blank"><i class="eye icon"></i></a>
            <a href="{{url('admin-dashboard/postcategories/' . $category->id . '/edit')}}" class="mini ui icon blue button" title="Sửa"><i class="edit icon"></i></a>
            <button type="button" class="mini ui icon red button btn-delete" data-category-id="{{$category->id}}" data-category-name="{{$category->category_name}}" title="Xóa"><i class="window close icon"></i></button>
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
  <script src="{{url('js/admin/post/category/category.js')}}"></script>
@endsection