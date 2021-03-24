@extends('admin.master')
@section('title', 'Danh sách Nhân viên')
@section('PageContent')
  <h2 class="ui header center aligned">
    DANH SÁCH NHÂN VIÊN 
    <div class="sub header">
      Tổng cộng {{count($nhanvien)}} nhân viên. ({{$nam}} Nam - {{$nu}} Nữ)
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
              <div class="ui secondary menu">
                  @permission('nhanvien-create')
                  <div class="right menu">
                    <a class="item">
                      <a href="{{url('nhanvien/add')}}" class="ui labeled icon green button"><i class="plus icon"></i>Thêm</a>
                    </a>
                  </div>
                  @endpermission
                </div>
          </div>          
          <div class="ui segment">
          <table id="data-table" class="ui selectable celled striped table">
              <thead class="full-width">
                <tr>
                  <th>STT</th>
               {{--    <th>MÃ NV</th> --}}
                  <th>HÌNH ẢNH</th>
                  <th>HỌ TÊN</th>          
                  <th>CHỨC VỤ</th>
                  <th>ĐIỆN THOẠI</th>                  
                  <th>EMAIL</th>
                  <th>NGÀY VÀO LÀM</th>
                  <th>GHI CHÚ</th>
                  <th>TỈNH/TP</th>
                  <th>THAO TÁC</th>
                </tr>
              </thead>
              <tbody>

                @foreach($nhanvien as $key => $nv)
                
                  <tr @if ($nv->ngaynghiviec) class="active" @endif>
                    <td>{{$key+1}}</td>
               {{--      <td>NV-0{{$nv->id}}</td> --}}
                    <td><img class="ui avatar image" data-name="{{$nv->hoten}}" @if($nv->hinhanh) src="{{$nv->hinhanh}}" @else src="/images/admin/avatar.png"  @endif></td>
                    <td>{{$nv->hoten}}</td>

                    <td>
                      @foreach($chucvu as $cv)
                        @if($nv->chucvu == $cv->id)
                           {{$cv->chucvu_vn}}
                        @endif
                      @endforeach
                    </td>
                    <td>{{$nv->sodienthoai}}</td>                    
                    <td>{{$nv->email}}</td>
                    <td>{{$nv->ngayvaolam}}</td>
                    <td>{{$nv->ghichu}}</td>
                    <td>
                      @foreach($tinhthanh as $tinh)
                        @if($nv->tinhthanh == $tinh->id)
                           {{$tinh->ten}}
                        @endif
                      @endforeach
                    </td>
                    <td>                        
                     {{--  <button type="button" class="mini ui icon green button btn-view" data-id="{{$nv->id}}" title="Xem"><i class="eye icon"></i></button> --}}
                    @permission('nhanvien-edit')
                      <a href="{{url('nhanvien/' . $nv->id . '/edit')}}" class="mini ui icon blue button" title="Sửa"><i class="edit icon"></i></a>
                    @endpermission 
                    @permission('nhanvien-delete')
                      <button type="button" class="mini ui icon red button btn-delete" data-id="{{$nv->id}}" data-name="{{$nv->hoten}}" title="Xóa"><i class="window close icon"></i></button>
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

  <script type="text/javascript">    
        $('.btn-delete').click(function (event) {
          $(".del-modal").modal('show');
          var header = '<p>Có phải bạn có muốn xóa ' + $(this).attr('data-name') + '?</p><i>Lưu ý: Cần cân nhắc trước khi xóa. Sẽ không phục hồi lại được!</i>';
          $(".del-modal .content").html(header);
          $(".del-modal .positive").attr('data-id', $(this).attr('data-id'));
        });

        $('.btn-view').click(function(event){
          $('.view-modal').modal('show');
          $(".view-modal .positive").attr('data-id', $(this).attr('data-id'));
        });

        $('.positive').click(function (event) {
          window.location.href = 'nhanvien/' + $(this).attr('data-id') + '/delete';
        });
  </script>
@endsection
@section('JsLibraries')
  <script src="{{url('js/admin/nhanvien/nhanvien.js')}}"></script>
@endsection