@extends('admin.master')
@section('title', 'Danh sách Đơn hàng')
@section('PageContent')
  <h2 class="ui header center aligned">
    QUẢN LÝ ĐƠN HÀNG    
    <div class="sub header">
      Tổng cộng {{count($hoso)}} học viên đủ điều kiện.
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
      <div class="ui secondary menu">
        <div class="right menu">
          @permission('donhang-create')
             <a href="{{url('donhang/add')}}" class="ui labeled icon blue button"><i class="plus circle icon"></i>Thêm</a>
          @endpermission
        </div>
      </div>
            <div class="ui segments">
              <div class="ui segment">
                  <h3>ĐƠN HÀNG MỚI</h3>
              </div>
              <div class="ui segment">
                <table id="data-table" class="ui selectable celled striped table">
                    <thead class="full-width">
                      <tr>
                        <th>STT</th>
                        <th>ĐƠN HÀNG</th>
                        <th>TÊN CÔNG TY</th>
                        <th>NGÀNH NGHỀ</th>
                        <th>NGÀY PHỎNG VẤN</th>
                        <th>SỐ LƯỢNG TUYỂN</th> 
                        @permission('donhang-show')
                        <th>DUYỆT ĐH</th>
                        @endpermission
                        <th>THAO TÁC</th>
                        
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($donhang as $key => $dh)
                        <tr>
                          <td>{{$key+1}}</td>
                          <td>{{$dh->tendonhang}}</td>
                          <td>
                              @foreach($doitac as $dt)
                                @if($dt->id == $dh->doitac_id)
                                    {{$dt->tencongty}}
                                @endif
                              @endforeach
                          </td>
                          <td>
                              @foreach($nganhnghe as $nn)
                                @if($nn->id == $dh->nganhnghe_id)
                                    {{$nn->nganhnghe_vn}}
                                @endif
                              @endforeach                                
                          </td>
                          <td>
                              @php
                                $LogintDate = strtotime($dh->ngaypv);
                                $ngaypv = date('d-m-Y', $LogintDate);
                              @endphp
                            {{$ngaypv}}</td>
                          <td>{{$dh->soluongtuyen}}</td>
                          @permission('donhang-show')
                          <td>
                            <div class="ui toggle checkbox">
                              <input type="checkbox" class="duyetdonhang" data-dh="{{$dh->id}}" @if($dh->tinhtrang == 1) checked @endif>
                              <label></label>
                            </div>
                          </td>
                          @endpermission
                          <td>
                            @permission('donhang-list')
                            <a href="{{url('donhang/' . $dh->id . '/print')}}" class="mini ui icon green button" title="In đơn hàng"><i class="print icon"></i></a>  
                            @endpermission  
                            @permission('donhang-edit')                    
                            <a href="{{url('donhang/' . $dh->id . '/edit')}}" class="mini ui icon blue button" title="Sửa"><i class="edit icon"></i></a>
                            @endpermission
                            @permission('donhang-delete')             
                            <button type="button" class="mini ui icon red button btn-delete" data-id="{{$dh->id}}" data-name="DH-0{{$dh->id}}" title="Xóa"><i class="window close icon"></i></button>
                            @endpermission
                          </td>
                        </tr>
                      @endforeach
                    </tbody>
                    <tfoot class="full-width"></tfoot>
                </table>
              </div>
            </div>
            <div class="ui segments">
              <div class="ui segment">
                  <h3>ĐƠN HÀNG ĐÃ DUYỆT</h3>
              </div>
              <div class="ui segment">
                <table id="data-table-1" class="ui selectable celled striped table">
                    <thead class="full-width">
                      <tr>
                        <th>STT</th>
                        <th>ĐƠN HÀNG</th>
                        <th>TÊN CÔNG TY</th>
                        <th>NGÀNH NGHỀ</th>
                        <th>NGÀY PHỎNG VẤN</th>
                        <th>SỐ LƯỢNG TUYỂN</th> 
                        @permission('donhang-show')         
                        <th>GHÉP ĐƠN HÀNG</th>
                        @endpermission
                        <th>THAO TÁC</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($donhang as $key => $dh)
                        @if($dh->tinhtrang == 1)
                        <tr>
                          <td>{{$key+1}}</td>
                          <td>{{$dh->tendonhang}}</td>
                          <td>
                              @foreach($doitac as $dt)
                                @if($dt->id == $dh->doitac_id)
                                    {{$dt->tencongty}}
                                @endif
                              @endforeach
                          </td>
                          <td>
                              @foreach($nganhnghe as $nn)
                                @if($nn->id == $dh->nganhnghe_id)
                                    {{$nn->nganhnghe_vn}}
                                @endif
                              @endforeach                                
                          </td>
                          <td>
                            @php
                              $LogintDate = strtotime($dh->ngaypv);
                              $ngaypv = date('d-m-Y', $LogintDate);
                            @endphp
                          {{$ngaypv}}</td>
                          <td>{{$dh->soluongtuyen}}</td>
                          
                            @permission('donhang-show')
                            <td><a href="{{url('donhang/' . $dh->id . '/create')}}" class="mini ui icon green button" title="Ghép đơn hàng"><i class="plus icon"></i></a></td>
                            @endpermission
                          
                          <td>
                            @permission('donhang-check')
                              <a href="{{url('donhang/' . $dh->id . '/show')}}" class="mini ui icon blue button" title="Xem danh sách"><i class="eye icon"></i></a> 
                            @endpermission
                            @permission('donhang-delete')             
                            <button type="button" class="mini ui icon red button btn-delete" data-id="{{$dh->id}}" data-name="DH-0{{$dh->id}}" title="Xóa"><i class="window close icon"></i></button>
                            @endpermission
                            <button class="mini ui icon green button prints" data-id="{{$dh->id}}" title="In Đơn Hàng"><i class="print icon"></i></button>
                            
                          </td>
                        </tr>
                        @endif
                      @endforeach
                    </tbody>
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

{{-- ///khung ajax --}}
  <div class="ui large longer modal">
    <div class="header">PRINT FULL</div>
    <div class="scrolling content">
      <div id="printfull"></div>
    </div>
    <div class="actions">
      <a class="ui labeled icon red button" href="javascript:void(0)" onclick="In_Content('listorder')"><i class="save icon"></i>IN DS</a>
        <a class="ui labeled icon red button" href="javascript:void(0)" onclick="In_Content('resultorder')"><i class="save icon"></i>IN KQ PHỎNG VẤN</a>
        <a class="ui labeled icon red button" href="javascript:void(0)" onclick="In_Content('coverorder')"><i class="save icon"></i>IN BÌA</a>  
        <a class="ui labeled icon green button" href="javascript:void(0)" onclick="In_Content('intiengnhat')"> <i class="print icon"></i>IN HỌC VIÊN</a>
        <a class="ui labeled icon blue button" href="javascript:void(0)" onclick="In_Content('printdoc')"> <i class="print icon"></i>IN DỌC</a>
        <a class="ui labeled icon blue button" href="javascript:void(0)" onclick="In_Content('printngang')"> <i class="print icon"></i>IN NGANG</a>
    </div>
  </div>  
{{-- ///ket thuc khung ajax --}}
@endsection
@section('JsLibraries')
<script>
  $(document).ready(function () {
    $( "#data-table-1" ).on( "click", ".prints",function (event) {
      var id = $(this).attr('data-id');
      $("#printfull").load("donhang/"+id+"/printAjax");
      $('.ui.longer.modal').modal('show');
    });
  });
</script>
  <script src="{{url('js/admin/donhang/donhang.js')}}"></script>
@endsection