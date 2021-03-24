@extends('admin.master')
@section('title', 'Danh sách')
@section('PageContent')
  <h2 class="ui header center aligned">
  DANH SÁCH
  <div class="sub header">
  </div>
  </h2>
	<div class="ui secondary daotaohome">
      {{-- @permission('logo-create') --}}
      {{-- <div class="right daotaohome">
        <div class="item">
          <a href="{{url('daotaohome/add')}}" class="ui labeled icon green button"><i class="plus circle icon"></i>Thêm</a>
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
              <th>Nội dung</th>
              <th>Nội dung jp</th>
              <th>TRẠNG THÁI</th>
              <th>THAO TÁC</th>
            </tr>
          </thead>
          <tbody>
            @php
                $key=0;
            @endphp
            @foreach($daotaohome as $key => $th)
              <tr>
                <td>{{str_limit($th->noidung,30)}}</td>
                <td>{{str_limit($th->noidungjp,30)}}</td>
                <td>
                {{-- @permission('logo-edit')--}}
                  <a href="{{url('daotaohome/' . $th->id . '/edit')}}" class="mini ui icon blue button" title="Sửa"><i class="edit icon"></i></a>
                {{-- @endpermission
                @permission('logo-delete') --}}
                  {{-- <button type="button" class="mini ui icon red button btn-delete" data-id="{{$th->id}}" data-name="{{$th->id}}" title="Xóa"><i class="window close icon"></i></button> --}}
                {{-- @endpermission --}}
                </td>
                <td><div class="ui form wrapstatus"  >
                  <div class="inline field status" >
                    <div class="ui toggle checkbox cont{{$th->id}}" >
                      <input name="stt" type="checkbox" class="cont" idstatus="{{$th->id}}" rootstatus="{{$th->stt}}" @if ($th->stt == 1) checked="" @endif>
                      <label>Đã phát hành</label>
                    </div>
                  </div>
                </div>
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
        { "width": "15%", "targets": 3 },
        { "width": "15%", "targets": 4 }
      ]
    });
    </script>
  <script src="{{url('js/miraihuman/index.js')}}"></script>
  <script> status_delete('daotaohome'); </script>
  
@endsection