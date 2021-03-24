@extends('admin.master')
@section('title', 'Thêm Tài Khoản Mới')
@section('PageContent')
  <h1 class="ui header centered page-title">Thêm Tài Khoản Mới</h1>
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
          <input type="text" id="username" name="username" placeholder="Username" value="{{ old('username') }}" required>
          <p id="error-username" class="error-messenger">Username đã tồn tại</p>
        </div>
        <div class="field">
          <label>Password (*)</label>
          <input type="password" id="password" name="password" placeholder="Password" required>
        </div>
        <p id="error-password" class="error-messenger">Password không trùng nhau</p>
        <div class="field">
          <label>Nhập Lại Password (*)</label>
          <input type="password" id="repassword" placeholder="Nhập lại Password" required>
        </div>
        <div class="field">
          <label>Level (*)</label>
          <select name="level">
            <option value="2">Giáo Viên</option>
            <option value="1">Trưởng Phòng</option>
          </select>
        </div>
        <div class="field">
          <label>Nhân viên (*)</label>
          <select name="get-value" class="selectnv">
            <option value="" >Chọn Nhân Viên</option>
            @foreach($nhanvien as $nv)
              <option value="{{$nv->id}} - {{$nv->email}} - {{$nv->hoten}}">{{$nv->hoten}}</option>
            @endforeach
          </select>
          <input type="hidden" id="id-nhan-vien" name="id_nhan_vien" value="">
        </div>
        <div class="field">
          <label>Email (*)</label>
          <input type="email" id="email" name="email" placeholder="Email" value="{{ old('email') }}" required>
          <p id="error-email" class="error-messenger">Email đã tồn tại</p>
        </div>
        <div class="field">
          <label>Tên</label>
          <input type="text" id="name" name="name" placeholder="Tên" value="{{ old('name') }}">
        </div>
        <a href="{{url('admin-dashboard/users')}}" class="ui labeled icon button btn-align-left"><i class="arrow left icon"></i>Danh Sách Tài Khoản</a>
        <button type="submit" id="btn-submit" class="ui labeled icon button blue btn-align-right"><i class="plus circle icon"></i>Tạo Tài Khoản</button>
      </form>
    </div>
  </div>
  <script>
$(document).ready(function(){
  $('.selectnv').on('change', function() {
    var selected = this.value ;
    if (selected != null) {
      var array = selected.split(' - '); // split string on comma space
      $("#id-nhan-vien").val(array[0]);
      $("#email").val(array[1]);
      $("#name").val(array[2]);
    }else{
      $("#email").val();
      $("#name").val();
    }
  });
});
</script>
@endsection
@section('JsLibraries')
  <script src="{{url('js/admin/user/add_user.js')}}"></script>
@endsection