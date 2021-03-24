@extends('admin.master')
@section('title', 'Quản lý Tài Khoản')
@section('PageContent')
	<h1 class="ui header centered page-title">Quản Lý Tài Khoản</h1>
  @if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
  @endif
  <table id="data-table" class="cell-border hover order-column" style="width:100%">
      <thead>
        <tr>
          <th>Username</th>
          <th>Tên</th>
          <th>Email</th>
          <th>Hành Động</th>
        </tr>
      </thead>
      <tbody>
        @foreach($users as $user)
        <tr>
          <td>{{$user->username}}</td>
          <td>{{$user->name}}</td>
          <td>{{$user->email}}</td>
          <td>
            <a href="{{url('admin-dashboard/users/' . $user->id . '/edit')}}" class="mini ui icon blue button"><i class="edit icon"></i></a>
            @if($user->id > 1)
            <button type="button" class="mini ui icon red button btn-delete" data-user-id="{{$user->id}}" data-user-name="{{$user->username}}"><i class="window close icon"></i></button>
            @endif
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
  <script src="{{url('js/admin/user/user.js')}}"></script>
@endsection