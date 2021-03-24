@extends('admin.master')
@section('title', 'Danh sách Nhân viên')
@section('PageContent')
  <h2 class="ui header center aligned">
  DANH SÁCH LOGO
  <div class="sub header">
    Chỉ hiển thị 1
  </div>
  </h2>
	<div class="ui secondary menu">
      {{-- @permission('logo-create') --}}
      {{-- <div class="right menu">
        <div class="item">
          <a href="{{url('logo/add')}}" class="ui labeled icon green button"><i class="plus circle icon"></i>Thêm</a>
        </div>
      </div> --}}
      {{-- @endpermission --}}
  </div> 
@if (session('status'))
  <div class="ui positive message">
  <i class="close icon"></i>
  <div class="header">
    Thông Báo !
  </div>
  <p>{{ session('status') }}</p>
</div>
@endif
  <div class="ui segments">
      <div class="ui segment">
      <table id="data-table" class="ui selectable celled striped table">
          <thead class="full-width">
            <tr>
              <th>STT</th>
              <th>LOGO</th>
              <th>TRẠNG THÁI</th>
              <th>THAO TÁC</th>
            </tr>
          </thead>
          <tbody>

            @foreach($logo as $key => $lg)
              <tr>
                <td>{{$key+1}}</td>
                <td >
                @if ($lg->image == '0' || $lg->image == null)
                  <img src="uploads/no-image.jpg" alt="logo" style="max-height: 50px;">
                @else
                  <img src="{{$lg->image}}" alt="logo" style="max-height: 50px;">
                @endif 
                </td>
                <td><div class="ui form wrapstatus"  >
                    <div class="inline field status" >
                      <div class="ui toggle checkbox cont{{$lg->id}}" >
                        <input name="stt" type="checkbox" class="cont" idstatus="{{$lg->id}}" rootstatus="{{$lg->stt}}" @if ($lg->stt == 1) checked="" @endif>
                        <label>Đã phát hành</label>
                      </div>
                    </div>
                  </div>
                </td>
                <td>
                {{-- @permission('logo-edit')--}}
                  <a href="{{url('logo/' . $lg->id . '/edit')}}" class="mini ui icon blue button" title="Sửa"><i class="edit icon"></i></a>
                {{-- @endpermission
                @permission('logo-delete') --}}
                  {{-- <button type="button" class="mini ui icon red button btn-delete" data-id="{{$lg->id}}" data-name="{{$lg->id}}" title="Xóa"><i class="window close icon"></i></button> --}}
                {{-- @endpermission --}}
                </td>
              </tr>
            @endforeach
          </tbody>
          <tfoot class="full-width"></tfoot>
      </table>
  </div>
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
  <script src="{{url('js/miraihuman/index.js')}}"></script>
  <script> status_delete('logo'); </script>
  <script>
    $('#data-table').DataTable({
    });
  </script>
@endsection