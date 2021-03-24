@extends('admin.master')
@section('title', 'Quản lý Top Menu')
@section('CssLibraries')
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">
  <link href="{{url('libraries/nestable-master/style.css')}}" rel="stylesheet">
@endsection
@section('PageContent')
	<h1 class="ui header centered page-title">Quản Lý Top Menu</h1>
  @if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
  @endif
  <div class="ui grid">
    <div class="sixteen wide column">
      <form class="ui form" action="" method="post">
        {{ csrf_field() }}
        <textarea style="display: none" name="menuContent" class="form-control" id="json-output" rows="5">{{$menu}}</textarea>
        <button type="submit" class="ui labeled icon button blue"><i class="edit icon"></i>Lưu thay đổi</button>
      </form>
    </div>
    <div class="ten wide column">
      <h3>Menu</h3>
      <div class="dd nestable" id="nestable">
        <ol class="dd-list">
          {!!$menu!!}
        </ol>
      </div>
    </div>
    <div class="six wide column">
      <form class="form-inline ui form" id="menu-add">
        <h3>Thêm dữ liệu cho Menu</h3>
        <div class="form-group">
          <label for="addInputName">Tên</label>
          <input type="text" class="form-control" id="addInputName" placeholder="Item name" required>
        </div>
        <div class="form-group">
          <label for="addInputSlug">Slug</label>
          <input type="text" class="form-control" id="addInputSlug" placeholder="item-slug" required>
        </div>
        <button id="addButton" class="ui labeled icon button"><i class="plus circle icon"></i>Thêm</button>
      </form>

      <form class="ui form" id="menu-editor" style="display: none;">
        <h3>Sửa đổi: <span id="currentEditName"></span></h3>
        <div class="form-group">
          <label for="addInputName">Tên</label>
          <input type="text" class="form-control" id="editInputName" placeholder="Item name" required>
        </div>
        <div class="form-group">
          <label for="addInputSlug">Slug</label>
          <input type="text" class="form-control" id="editInputSlug" placeholder="item-slug">
        </div>
        <button id="editButton" class="ui labeled icon button"><i class="edit icon"></i>Thay đổi</button>
      </form>
    
    </div>
  </div>

@endsection
@section('JsLibraries')
  <script src="{{url('libraries/nestable-master/jquery.nestable.js')}}"></script>
  <script src="{{url('libraries/nestable-master/jquery.nestable++.js')}}"></script>
  <script src="{{url('js/admin/menu/menu.js')}}"></script>
@endsection