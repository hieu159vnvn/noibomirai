@extends('admin.master')
@section('title', 'Danh sách Đơn hàng')
@section('PageContent')
  <h2 class="ui header center aligned">
  DANH SÁCH Đơn hàng
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
              <th>TÊN ĐƠN HÀNG</th>
              <th>NGÀNH NGHỀ</th>
              <th>NGÀY CẬP NHẬT</th>
              <th>TRẠNG THÁI</th>
            </tr>
          </thead>
          <tbody>

            @foreach($donhangstt as $key => $dh)
              <tr>
                <td>{{$key+1}}</td>
                <td>{{$dh->tendonhang}}</td>
                <td>{{$dh->nganhnghe_vn}}</td>
                <td>{{date_format(date_create($dh->created_at),"d/m/Y")}}</td>
                <td><div class="ui form wrapstatus"  >
                    <div class="inline field status" >
                      <div class="ui toggle checkbox cont{{$dh->id}}" >
                        <input name="stt" type="checkbox" class="cont" idstatus="{{$dh->id}}" rootstatus="{{$dh->stt}}" @if ($dh->stt == 1) checked="" @endif>
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
  <script src="{{url('js/miraihuman/index.js')}}"></script>
  <script> status_delete('donhangstt'); </script>
  <script>
    $('#data-table').DataTable({
    });
  </script>
@endsection