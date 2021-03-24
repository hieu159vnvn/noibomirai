@extends('admin.master')
@section('title', 'Danh sách Nhân viên')
@section('PageContent')
  <h2 class="ui header center aligned">
  DANH SÁCH NGÀNH NGHỀ
  <div class="sub header">
  </div>
  </h2>
  <div class="ui secondary menu">
      @permission('nganhnghe-create')
      <div class="right menu">
        <div class="item">
          <a href="{{url('nganhnghe/add')}}" class="ui labeled icon green button"><i class="plus circle icon"></i>Thêm</a>
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
@if (session('error'))
<div class="ui message red">
<i class="close icon"></i>
<div class="header">
  Thông Báo !
</div>
<p>{{ session('error') }}</p>
</div>
@endif
    <div class="ui segments">
      <div class="ui segment">
        <table id="data-table" class="ui selectable celled striped table">
            <thead class="full-width">
              <tr>
                <th>STT</th>
                <th>TÊN NGÀNH NGHỀ VN</th>
                <th>TÊN NGÀNH NGHỀ JP</th>
                <th>GHI CHÚ</th>
                <th>THAO TÁC</th>
              </tr>
            </thead>
            <tbody>

              @foreach($nganhnghe as $key => $nn)
                <tr>
                  <td>{{$key+1}}</td>
                  <td>{{$nn->nganhnghe_vn}}</td>
                  <td>{{$nn->nganhnghe_jp}}</td>
                  <td>{{$nn->ghichu}}</td>
                  <td>                        
                  @permission('nganhnghe-edit')
                    <a href="{{url('nganhnghe/' . $nn->id . '/edit')}}" class="mini ui icon blue button" title="Sửa"><i class="edit icon"></i></a>
                    @endpermission
                  @permission('nganhnghe-delete')
                    <button type="button" class="mini ui icon red button btn-delete" data-id="{{$nn->id}}" data-name="{{$nn->nganhnghe_vn}}" title="Xóa"><i class="window close icon"></i></button>
                  @endpermission
                  </td>
                </tr>
              @endforeach
            </tbody>
            <tfoot class="full-width"></tfoot>
        </table>
      </div>
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
  <script src="{{url('js/admin/nganhnghe/nganhnghe.js')}}"></script>
@endsection