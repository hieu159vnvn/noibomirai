@extends('admin.master')
@section('title', 'Danh sách Nhân viên')
@section('PageContent')
  <h2 class="ui header center aligned">
  DANH SÁCH CHỨC VỤ
  <div class="sub header">
  </div>
  </h2>
	<div class="ui secondary menu">
      @permission('chucvu-create')
      <div class="right menu">
        <div class="item">
          <a href="{{url('chucvu/add')}}" class="ui labeled icon green button"><i class="plus circle icon"></i>Thêm</a>
        </div>
      </div>
      @endpermission
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
              <th>TÊN CHỨC VỤ VN</th>
              <th>TÊN CHỨC VỤ JP</th>
              <th>GHI CHÚ</th>
              <th>THAO TÁC</th>
            </tr>
          </thead>
          <tbody>

            @foreach($chucvu as $key => $cv)
              <tr>
                <td>{{$key+1}}</td>
                <td>{{$cv->chucvu_vn}}</td>
                <td>{{$cv->chucvu_jp}}</td>
                <td>{{$cv->ghichu}}</td>
                <td>
                @permission('chucvu-edit')                        
                  <a href="{{url('chucvu/' . $cv->id . '/edit')}}" class="mini ui icon blue button" title="Sửa"><i class="edit icon"></i></a>
                @endpermission
                @permission('chucvu-delete')
                  <button type="button" class="mini ui icon red button btn-delete" data-id="{{$cv->id}}" data-name="{{$cv->chucvu_vn}}" title="Xóa"><i class="window close icon"></i></button>
                @endpermission
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
  <script src="{{url('js/admin/chucvu/chucvu.js')}}"></script>
@endsection