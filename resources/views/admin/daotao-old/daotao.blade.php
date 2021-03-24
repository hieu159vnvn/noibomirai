@extends('admin.master')
@section('title', 'Danh sách Lớp Học')
@section('PageContent')
  <h2 class="ui header center aligned">
  DANH SÁCH LỚP HỌC
  <div class="sub header">
  </div>
  </h2>
@if (session('status'))
  <div class="ui positive message">
  <i class="close icon"></i>
  <div class="header">
    Thông Báo !
  </div>
  <p>{{ session('status') }}</p>
</div>
@endif
 <div class="ui secondary menu">
    @permission('daotao-create')
    <div class="right menu">
      <div class="item">
        <a href="{{url('daotao/add')}}" class="ui labeled icon green button"><i class="plus circle icon"></i>Thêm</a>
      </div>
    </div>
    @endpermission
  </div> 
  <div class="ui segments">
      <div class="ui segment">
        <table id="data-table" class="ui selectable celled striped table">
            <thead class="full-width">
              <tr>
                <th>STT</th>
                <th>TÊN LỚP HỌC</th>
                <th>CƠ SỞ</th>
                <th>GIÁO VIÊN</th>
                <th>NGÀY KHAI GIẢNG</th>
                <th>THAO TÁC</th>
              </tr>
            </thead>
            <tbody>

              @foreach($daotao as $key => $dt)
                <tr>
                  <td>{{$key+1}}</td>
                  <td>{{$dt->ten_lop_hoc}}</td>
                  <td>
                    @if($dt->coso == 3)
                      Phòng đào tạo
                    @else
                      chưa cập nhật
                    @endif
                  </td>  
                  <td>
                    @foreach($giaovien as $gv)
                      @if($gv->id == $dt->gvcn)
                         {{$gv->hoten}}
                      @endif
                    @endforeach
                  </td>
                  
                  <td>{{date('d-m-Y', strtotime($dt->ngay_khai_giang))}}</td>
                  <td> 
                  @permission('daotao-show')                       
                    <a href="{{url('daotao/' . $dt->id . '/view')}}" class="mini ui icon green button" title="xem"><i class="eye icon"></i></a>
                  @endpermission
                  @permission('daotao-edit')
                    <a href="{{url('daotao/' . $dt->id . '/edit')}}" class="mini ui icon blue button" title="Sửa"><i class="edit icon"></i></a>
                  @endpermission
                  @permission('daotao-delete')
                    <button type="button" class="mini ui icon red button btn-delete" data-id="{{$dt->id}}" data-name="{{$dt->id}}" title="Xóa"><i class="window close icon"></i></button>
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
  <script src="{{url('js/admin/daotao/daotao.js')}}"></script>
@endsection