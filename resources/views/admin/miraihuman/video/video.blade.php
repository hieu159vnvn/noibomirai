@extends('admin.master')
@section('title', 'Danh sách Nhân viên')
@section('PageContent')
  <h2 class="ui header center aligned">
  DANH SÁCH TIN TỨC
  <div class="sub header">
  </div>
  </h2>
	<div class="ui secondary menu">
      {{-- @permission('logo-create') --}}
      <div class="right menu">
        <div class="item">
          <a href="{{url('video/add')}}" class="ui labeled icon green button"><i class="plus circle icon"></i>Thêm</a>
        </div>
      </div>
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
              <th>TIÊU ĐỀ</th>
              {{-- <th>TIÊU ĐỀ JP</th> --}}
              <th>VIDEO</th>
              <th>LOẠI / LINK</th>
              <th>TRẠNG THÁI</th>
              <th>THAO TÁC</th>
            </tr>
          </thead>
          <tbody>

            @foreach($video as $key => $v)
              <tr>
                <td>{{$key+1}}</td>
                <td>{{$v->ten}}</td>
                {{-- <td>{{$v->tenjp}}</td> --}}
                <td>
                  <video width="160" height="120" controls>
                    <source src="{{$v->video}}" type="video/mp4">
                  </video>
                </td>
                <td>{{$v->loai}}: {{$v->link}}</td>
                <td><div class="ui form wrapstatus"  >
                    <div class="inline field status" >
                      <div class="ui toggle checkbox cont{{$v->id}}" >
                        <input name="stt" type="checkbox" class="cont" idstatus="{{$v->id}}" rootstatus="{{$v->stt}}" @if ($v->stt == 1) checked="" @endif>
                        <label>Đã phát hành</label>
                      </div>
                    </div>
                  </div>
                </td>
                <td>
                {{-- @permission('logo-edit')--}}
                  <a href="{{url('video/' . $v->id . '/edit')}}" class="mini ui icon blue button" title="Sửa"><i class="edit icon"></i></a>
                {{-- @endpermission
                @permission('logo-delete') --}}
                  <button type="button" class="mini ui icon red button btn-delete" data-id="{{$v->id}}" data-name="{{$v->id}}" title="Xóa"><i class="window close icon"></i></button>
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
<script>
    $('#data-table').DataTable({
      "columnDefs": [
        { "width": "5%", "targets": 0 },
        { "width": "15%", "targets": 4 },
        { "width": "15%", "targets": 5 }
      ]
    });
    </script>
  <script src="{{url('js/miraihuman/index.js')}}"></script>
  <script> status_delete('video'); </script>
  
@endsection