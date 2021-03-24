@extends('admin.master')
@section('title', 'LỊCH SỬ CÁC THAO TÁC')
@section('PageContent')
  <h2 class="ui header center aligned">
  LỊCH SỬ CÁC THAO TÁC
  <div class="sub header">
  </div>
  </h2>
  <div class="ui segments">
      <div class="ui segment">
        <table id="data-table" class="ui selectable celled striped table">
            <thead class="full-width">
              <tr>
                <th>STT</th>
                <th>THAO TÁC</th>
                <th>TÊN PHÒNG</th>
                <th>TÊN HỌC VIÊN</th>
                <th>NGÀY SINH</th>
                <th>LÍ DO</th>
                <th>NGƯỜI THAO TÁC</th>
                <th>NGÀY THAO TÁC</th>
              </tr>
            </thead>
            <tbody>
              @foreach($lichsu as $key => $item)
                <tr>
                  <td>{{$key+1}}</td>
                  <td>{{$item->thaotac}}</td>
                  <td>
                    @foreach ($kitucxa as $ktx)
                        @if ($ktx->id == $item->id_kitucxa)
                            {{$ktx->tenphong}}
                        @endif
                    @endforeach
                  </td>
                  <td>
                    @foreach ($hocvien as $hv)
                        @if ($hv->id == $item->id_hocvien)
                            {{$hv->hoten}}
                        @endif
                    @endforeach
                  </td>
                  <td>
                    @foreach ($hocvien as $hv)
                        @if ($hv->id == $item->id_hocvien)
                            {{date('d-m-Y', strtotime($hv->ngaysinh))}}
                        @endif
                    @endforeach
                  </td>
                  <td>{{$item->lido}}</td>
                  <td>{{$item->creator}}</td>
                  <td>{{date('H:i:s d-m-Y', strtotime($item->created_at))}}</td>
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
<script src="{{url('js/miraihuman/index.js')}}"></script>
<script> status_delete('danhsach'); </script>
@endsection