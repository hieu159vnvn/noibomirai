@extends('admin.master')
@section('title', 'Danh sách Đối tác')
@section('PageContent')
  <h2 class="ui header center aligned">
        QUẢN LÝ CÔNG TY   
        <div class="sub header">
          Danh sách Công ty tại Nhật
        </div>
  </h2>

  @if (session('status'))
    <div class="ui message">
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
      <div class="ui secondary menu">
        <div class="left menu">
          <div class="item">
            <p>Có {{count($doitac)}} công ty</p>
          </div>
        </div>
        @permission('doitac-create')
        <div class="right menu">
          <div class="item">
            <a href="{{url('doitac/add')}}" class="ui labeled icon green button"><i class="plus circle icon"></i>Thêm</a>
          </div>
        </div>
        @endpermission
      </div>
    </div>
    <div class="ui segment">
      <table id="myTable" class="ui selectable celled striped table">
        <thead>
            <tr>
                <th>STT</th>
                <th>TÊN NGHIỆP ĐOÀN</th>
                <th>TÊN CÔNG TY</th>  
                <th>ĐỊA CHỈ</th>
                <th>NGƯỜI ĐẠI DIỆN</th>
                {{-- <th>NGÀNH NGHỀ</th> --}}
                <th>EMAIL</th>
                <th>ACTION</th>
            </tr>
        </thead>
       
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

  <script type="text/javascript">
    $( document ).ready(function() {
      
       var table = $('#myTable').DataTable( {
            stateSave: true,
            processing: true,
            serverSide: true,
            ajax: '/dhdatatables/doitac',
            columns: [
            {data: 'id'},
            {data: 'tennghiepdoan'},
            {data: 'tencongty'},
            {data: 'diachi'},
            {data: 'nguoidaidien'},
            // {data: 'dienthoai'},
            {data: 'email'},
            {data: 'action'}
            ],
            
            "columnDefs": [
              { "width": "10%", "targets": 4 }, 
              { "width": "10%", "targets": 3 }, 
              { "width": "40%", "targets": 2 }, 
              {
            "searchable": true,
            "orderable": true,
            // "targets": [1,4,5,6]
          } ],
          ordering: false,
          order: [0, "desc"],
          language: datatable_language,
          "fnRowCallback": function(nRow, aData, iDisplayIndex, iDisplayIndexFull) {
              var index = iDisplayIndexFull + 1;
              $('td:eq(0)',nRow).html(index);
              return nRow;
          },

  
        });
    });

  </script> 
@endsection
@section('JsLibraries')
  <script src="{{url('js/admin/doitac/doitac.js')}}"></script>
@endsection