@extends('admin.master')
@section('title', 'Quản lý Thẻ Của Sản Phẩm')
@section('PageContent')
	<h1 class="ui header centered page-title">Quản Lý Thẻ Của Sản Phẩm</h1>
  @if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
  @endif
  <table id="data-table" class="cell-border hover order-column" style="width:100%">
      <thead>
        <tr>
          <th class="id-column-table">ID</th>
          <th class="title-column-table">Tên Thẻ</th>
          <th class="title-column-table">Slug</th>
          <th class="seo-title-column-table">SEO Title</th>
          <th class="seo-des-column-table">SEO Description</th>
          <th class="action-column-table">Hành Động</th>
        </tr>
      </thead>
      <tbody>
        @foreach($tags as $tag)
        <tr>
          <td>{{$tag->id}}</td>
          <td class="title-column"><a href="{{url('admin-dashboard/producttags/' . $tag->id . '/edit')}}" title="sửa {{$tag->tag_name}}">{{$tag->tag_name}}</a></td>
          <td>{{$tag->tag_slug}}</td>
          <td>{{$tag->tag_seo_title}}</td>
          <td>{{$tag->tag_seo_description}}</td>
          <td>
            <a href="{{url('admin-dashboard/producttags/' . $tag->id . '/edit')}}" class="mini ui icon blue button" title="Sửa"><i class="edit icon"></i></a>
            <button type="button" class="mini ui icon red button btn-delete" data-tag-id="{{$tag->id}}" data-tag-name="{{$tag->tag_name}}"><i class="window close icon" title="Xóa"></i></button>
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
  <script src="{{url('js/admin/product/tag/product_tag.js')}}"></script>
@endsection