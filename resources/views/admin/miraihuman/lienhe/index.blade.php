@extends('admin.master')
@section('title', 'Danh sách liên hệ')
@section('PageContent')
  <h2 class="ui header center aligned">
  DANH SÁCH LIÊN HỆ
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
  <div class="ui segments">
      <div class="ui segment">
      <table id="data-table" class="ui selectable celled striped table">
          <thead class="full-width">
            <tr>
              <th>STT</th>
              <th>Họ và tên</th>
              <th>Email</th>
              <th>Số điện thoại</th>
              <th>Tiêu đề</th>
              <th>Nội dung</th>
              <th>Ngày nhận</th>
              <th>Trạng thái<br>(check:đã liên hệ,chưa check:chưa liên hệ)</th>
            </tr>
          </thead>
          <tbody>

            @foreach($lienhe as $key => $item)
              <tr>
                <td>{{$key+1}}</td>
                <td>{{$item->hovaten}}</td>
                <td>{{$item->email}}</td>
                <td>{{$item->sodienthoai}}</td>
                <td>{{$item->tieude}}</td>
                <td>{{$item->noidung}}</td>
                <td>{{$item->created_at}}</td>
                <td><div class="ui toggle checkbox">
                  <input type="checkbox" data-lienhe="{{$item->id}}"@if($item->tinhtrang == 1) checked @endif>
                  <label></label>
                </div></td>
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
    $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });
    $('#data-table').on('change','input:checkbox',function (event) {
    var id = $(this).attr('data-lienhe');
    $.post("/lienhe/"+id,
      {
        id: id
      });
    });
    </script>
  <script src="{{url('js/miraihuman/index.js')}}"></script>
  {{-- <script> status_delete('loaihoidap'); </script> --}}
  
@endsection