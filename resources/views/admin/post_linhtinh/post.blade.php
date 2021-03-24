@extends('admin.master')
@section('title', 'Quản lý bài viết')
@section('PageContent')
	<h1 class="ui header centered page-title">Quản Lý Bài Viết</h1>
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
          <th class="title-column-table">Tiêu Đề Bài Viết</th>
          {{-- <th>Slug</th> --}}
          <th class="cat-column-table">Chuyên Mục</th>
          <th style="display: none" class="tag-column-table">Thẻ</th>
          <th class="status-column-table">Hiển Thị</th>
          <th class="image-column-table">Hình đại diện</th>
          {{-- <th>SEO Title</th> --}}
          {{-- <th>SEO Description</th> --}}
          <th class="action-column-table">Hành Động</th>
        </tr>
      </thead>
      <tbody>
        @foreach($posts as $post)
        <tr>
          <td>{{$post->id}}</td>
          <td class="title-column"><a href="{{url('admin-dashboard/posts/'.$post->id.'/edit')}}" title="sửa {{$post->post_title}}">{{$post->post_title}}</a></td>
          {{-- <td>{{$post->post_slug}}</td> --}}
          <td><a href="{{url('admin-dashboard/postcategories/'.$post->category->id.'/edit')}}" title="sửa {{$post->category->category_name}}">{{$post->category->category_name}}</a></td>
          <td style="display: none" class="tag-space">
            @foreach($post->tags as $tag)
              <a href="{{url('admin-dashboard/posttags/'.$tag->id.'/edit')}}" title="sửa {{$tag->tag_name}}">- {{$tag->tag_name}}</a>
            @endforeach
          </td>
          <td>
            <div style="margin-left: 15px;" class="ui toggle checkbox">
              <input type="checkbox" class="post-status" name="status" data-id="{{$post->id}}" @if($post->post_status == 1) checked @endif>
              <label></label>
            </div>
          </td>
          <td><img class="post-image-feature" src="{{$post->post_image}}" alt=""></td>
          {{-- <td>{{$post->post_seo_title}}</td> --}}
          {{-- <td>{{$post->post_seo_description}}</td> --}}
          <td>
            <a href="{{url($post->post_slug . '-bv.html')}}" class="mini ui icon green button" title="Xem" target="_blank"><i class="eye icon"></i></a>
            <a href="{{url('admin-dashboard/posts/' . $post->id . '/edit')}}" class="mini ui icon blue button" title="Chỉnh sửa"><i class="edit icon"></i></a>
            <button type="button" class="mini ui icon red button btn-delete" data-post-id="{{$post->id}}" data-post-title="{{$post->post_title}}" title="Xóa"><i class="window close icon" ></i></button>
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
  <script src="{{url('js/admin/post/post.js')}}"></script>
@endsection