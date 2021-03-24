@extends('admin.master')
@section('title', 'Danh sách dịch vụ')
@section('PageContent')
  <h2 class="ui header center aligned">
  DANH SÁCH DỊCH VỤ
  <div class="sub header">
  </div>
  </h2>
	<div class="ui secondary menu">
      {{-- @permission('logo-create') --}}
      <div class="right menu">
        <div class="item">
          <a href="{{url('dichvu/add')}}" class="ui labeled icon green button"><i class="plus circle icon"></i>Thêm</a>
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
              <th>DANH MỤC</th>
              <th>TIÊU ĐỀ</th>
              <th>TIÊU ĐỀ JP</th>
              <th>THỨ TỰ</th>
              <th>TRẠNG THÁI</th>
              <th>THAO TÁC</th>
            </tr>
          </thead>
          <tbody>

            @foreach($dichvu as $key => $dvc)
              <tr>
                <td>{{$dvc->tendvcat}}</td>
                <td>{{$dvc->ten}}</td>
                <td>{{$dvc->tenjp}}</td>
                <td>{{$dvc->sapxep}}</td>
                <td><div class="ui form wrapstatus"  >
                    <div class="inline field status" >
                      <div class="ui toggle checkbox cont{{$dvc->id}}" >
                        <input name="stt" type="checkbox" class="cont" idstatus="{{$dvc->id}}" rootstatus="{{$dvc->stt}}" @if ($dvc->stt == 1) checked="" @endif>
                        <label>Đã phát hành</label>
                      </div>
                    </div>
                  </div>
                </td>
                <td>
                {{-- @permission('logo-edit')--}}
                  <a href="{{url('dichvu/' . $dvc->id . '/edit')}}" class="mini ui icon blue button" title="Sửa"><i class="edit icon"></i></a>
                {{-- @endpermission
                @permission('logo-delete') --}}
                  <button type="button" class="mini ui icon red button btn-delete" data-id="{{$dvc->id}}" data-name="{{$dvc->id}}" title="Xóa"><i class="window close icon"></i></button>
                {{-- @endpermission --}}
                </td>
              </tr>
            @endforeach
          </tbody>
          <tfoot class="full-width">
          </tfoot>
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

        { "width": "15%", "targets": 3 },
        { "width": "15%", "targets": 4 }
      ],
      initComplete: function () {
          this.api().columns([0]).every( function () {
              var column = this;
              var select = $('<select><option value="">Danh sách dịch vụ</option></select>')
                .appendTo( $(column.header()).empty() )
                .on( 'change', function () {
                    var val = $.fn.dataTable.util.escapeRegex(
                        $(this).val()
                    );
                    column.search( val ? '^'+val+'$' : '', true, false ).draw();
                } );
              column.data().unique().sort().each( function ( d, j ) {
                  select.append( '<option value="'+d+'">'+d+'</option>' )
              } );
          } );
      }
    });
    </script>
  <script src="{{url('js/miraihuman/index.js')}}"></script>
  <script> status_delete('dichvu'); </script>
  <style>
      .ui.table thead th{
        padding: 5px !important;
      }
      thead {
          display: table-header-group;
      }
      thead tr {
        height: 10px !important;
      }
      thead th{
        text-align: center !important;
        background: #F9FAFB !important;
      }
      thead th select {
        padding: 5px;
      }
    </style>
@endsection