@extends('admin.master')
@section('title', 'Danh sách Cảm nhận')
@section('PageContent')
  <h2 class="ui header center aligned">
  DANH SÁCH CẢM NHẬN
  <div class="sub header">
  </div>
  </h2>
	<div class="ui secondary menu">
      {{-- @permission('logo-create') --}}
      <div class="right menu">
        <div class="item">
          <a href="{{url('camnhan/add')}}" class="ui labeled icon green button"><i class="plus circle icon"></i>Thêm</a>
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
              <th>Tên học viên</th>
              <th>Ngành nghề</th>
              <th>Ngành nghề JP</th>
              <th>Nội dung</th>
              <th>Nội dung JP</th>
              <th>Hình ảnh</th>
              <th>THAO TÁC</th>
            </tr>
          </thead>
          <tbody>

            @foreach($camnhan as $key => $tt)
              <tr>
                <td>{{$key+1}}</td>
                <td>{{$tt->tenhocvien}}</td>
                <td>{{$tt->nganhnghe}}</td>
                <td>{{$tt->nganhnghejp}}</td>
                <td>{{str_limit($tt->noidung,30)}}</td>
                <td>{{str_limit($tt->noidungjp,30)}}</td>
                <td>
                  @if ($tt->image == '0' || $tt->image == null)
                    <img src="uploads/no-image.jpg" alt="logo" style="max-height: 50px;">
                  @else
                    <img src="{{$tt->image}}" alt="logo" style="max-height: 50px;">
                  @endif 
                </td>
                <td>
                {{-- @permission('logo-edit')--}}
                  <a href="{{url('camnhan/' . $tt->id . '/edit')}}" class="mini ui icon blue button" title="Sửa"><i class="edit icon"></i></a>
                {{-- @endpermission
                @permission('logo-delete') --}}
                  <button type="button" class="mini ui icon red button btn-delete" data-id="{{$tt->id}}" data-name="{{$tt->id}}" title="Xóa"><i class="window close icon"></i></button>
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
        { "width": "15%", "targets": 3 },
        { "width": "15%", "targets": 4 }
      ]
    });
    </script>
  <script src="{{url('js/miraihuman/index.js')}}"></script>
  <script> status_delete('camnhan'); </script>
  
@endsection