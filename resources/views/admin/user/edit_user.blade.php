@extends('admin.master')
@section('title', 'Thay Đổi Thông Tin Tài Khoản')
@section('PageContent')
  <h1 class="ui header centered page-title">Thay Đổi Tài Khoản: {{$user->username}}</h1>
  @if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
  @endif
  <div class="ui two column centered grid"> 
    <div class="column">
      @if ($errors->any())
          <div class="alert alert-danger">
              <ul>
                  @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                  @endforeach
              </ul>
          </div>
      @endif
      <form class="ui form" action="" method="post">
        {{ csrf_field() }}
        <div class="field">
          <label>Username (*)</label>
          <input type="text" id="username" name="username" data-old-value="{{ $user->username }}" placeholder="Username" value="{{ $user->username }}" required>
          <p id="error-username" class="error-messenger">Username đã tồn tại</p>
        </div>
        <div class="field">
          <label>Password (*)</label>
          <input type="password" id="password" name="password" placeholder="Password">
        </div>
        <p id="error-password" class="error-messenger">Password không trùng nhau</p>
        <div class="field">
          <label>Nhập Lại Password (*)</label>
          <input type="password" id="repassword" placeholder="Nhập lại Password">
        </div>
        <div class="field">
          <label>Email (*)</label>
          <input type="email" id="email" name="email" data-old-value="{{ $user->email }}" placeholder="Email" value="{{ $user->email }}" required>
          <p id="error-email" class="error-messenger">Email đã tồn tại</p>
        </div>
        <div class="field">
          <label>Tên</label>
          <input type="text" id="name" name="name" placeholder="Tên" value="{{ $user->name }}">
        </div>
        <a href="{{url('admin-dashboard/users')}}" class="ui labeled icon button btn-align-left"><i class="arrow left icon"></i>Danh Sách Tài Khoản</a>
        <button type="submit" id="btn-submit" class="ui labeled icon button blue btn-align-right"><i class="plus circle icon"></i>Lưu thay đổi</button>
      </form>
    </div>
  </div>
  
@endsection
@section('JsLibraries')
  <script src="{{url('js/admin/user/edit_user.js')}}"></script>
@endsection