@extends('admin.master')
@section('title', 'Hồ Sơ Học Viên')
@section('PageContent')
  <div class="ui two column centered grid wrap-content-header">
    <h1 class="ui header centered page-title">DANH SÁCH HỌC VIÊN</h1>
  </div>
  <div class="ui menu menu-top">
    <div class="ui container">
      <a class="item"><i class="align right icon"></i> Tổng cộng có {{count($hoso)}} học viên</a>
      <a class="item"><i class="mars icon"></i> {{$nam}} Nam</a>
      <a class="item"><i class="venus icon"></i> {{$nu}} Nữ</a>
      <div class="right menu">
        <div class="item">
          <a href="{{url('/admin-dashboard/hosohocviens/add')}}" class="ui labeled icon green button"><i class="plus circle icon"></i>Add</a>
        </div>
        <div class="item">
          <a href="{{url('admin-dashboard/hosohocviens/import')}}" class="ui labeled icon red button"><i class="download icon"></i>Import</a>
        </div>
        <div class="item">
          <a href="{{url('/admin-dashboard/hosohocviens/export')}}" class="ui labeled icon blue button"><i class="file excel icon"></i>Export</a>
        </div>
      </div>
    </div>
  </div>
  @if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
  @endif
  <div class="ajax-messenger"></div>
  <form class="ui form" action="" method="post" name="form_1">
    {{ csrf_field() }}
  <table id="data-table" class="ui selectable celled striped table">
      <thead class="full-width">
        <tr>
          <th>STT</th>
          <th>HÌNH ẢNH</th>
          <th>HỌ TÊN</th>
          <th>NGÀY SINH</th>
          <th>GIỚI TÍNH</th>
          <th>ĐIỆN THOẠI</th>
          <th>TÌNH TRẠNG</th>
          <th>TỈNH/TP</th>
          <th>THAO TÁC</th>
        </tr>
      </thead>
      <tbody>
        @foreach($hoso as $key => $hs)
          <tr>
{{--             <td><input class="ui checkbox" type="checkbox" name=""></td> --}}
            <td>{{$key+1}}</td>
            <td><img src="{{$hs->hinhanh}}" width="60px" height="80px"></td>
            <td>{{$hs->hoten}}</td>
            <td>{{$hs->ngaysinh}}</td>
            <td>@if($hs->gioitinh==1) Nam @else Nữ @endif</td>
            <td>{{$hs->dienthoai}}</td>
            <td>
              @switch($hs->tinhtrang)
                  @case(1)
                      Chưa phỏng vấn
                      @break
                  @case(2)
                      Đậu phỏng vấn
                      @break
                  @case(3)
                      Dự bị
                      @break
                  @case(4)
                      Rớt phỏng vấn
                      @break
                  @case(5)
                      Đã xuất cảnh
                      @break            
                  @default
                      Đã hũy
              @endswitch             
            </td>
            <td>
              @foreach($tinhthanh as $tinh)
                @if($hs->mien == $tinh->id)
                   {{$tinh->ten}}
                @endif
              @endforeach

            </td>
            <td>                        
                <div class="ui toggle checkbox">
                  <input type="checkbox"  class="checked" name="mcheck[]" value="{{$hs->id}}">
                  <label> Check </label>
                </div>
            </td>
          </tr>
        @endforeach
      </tbody>
      <tfoot class="full-width"></tfoot>
  </table>
  <button type="submit" class="ui labeled icon button green nutluu"><i class="save icon"></i> Print </button>
</form>
@endsection
<script type="text/javascript">
function In_Content(strid){   
    var prtContent = document.getElementById(strid);
    var WinPrint = window.open('','','letf=0,top=0,width=800,height=800');
    WinPrint.document.write(prtContent.innerHTML);
    WinPrint.document.close();
    WinPrint.focus();
    WinPrint.print();
}
</script>
@section('JsLibraries')
  <script src="{{url('js/admin/hoso/hoso.js')}}"></script>
@endsection