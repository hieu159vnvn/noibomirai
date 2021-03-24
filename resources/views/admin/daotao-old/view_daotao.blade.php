@extends('admin.master')
@section('title', 'Danh sách Lớp Học')
@section('PageContent')
  <div class="ui two column centered grid wrap-content-header">
    <h1 class="ui header centered page-title">DANH SÁCH HỌC VIÊN</h1>
  </div> 
  <h2 class="ui header centered ">Lớp Học : {{$dt->ten_lop_hoc}} </h2>
  <h2 class="ui header centered ">Giáo Viên : {{$giaovien->hoten}} </h2>
  @php
    function ym($time) {
      $timestamp = strtotime($time);
      $year = date("Y", $timestamp);
      $month = date("m", $timestamp);
      return $year.'/'.$month;
    }
  @endphp
  @if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
  @endif
  <div class="ajax-messenger"></div>
  <table id="data-table" class="ui selectable celled striped table">
      <thead class="full-width">
        <tr>
          <th>STT</th>
          <th>TÊN HỌC VIÊN</th>
          <th>ẢNH</th>
        </tr>
      </thead>
      <tbody>
        @foreach($hocvien as $hv)
            @if($dshv)
              @foreach($dshv as $key => $lhv)
                @if($lhv == $hv->id)
                  <tr>
                    <td>{{$key+1}}</td>
                    <td><a href="{{url('hoso/'.$hv->id.'/show')}}">{{$hv->hoten}}</a></td>
                    <td> @if($hv->hinhanh)
                        <img src="{{url('')}}/hocviens/{{ym($hv->created_at)}}/{{$hv->hinhanh}}" width="50px">
                        @else 
                          <img src="{{asset('images/admin/avatar.png')}}" width="50px"> 
                        @endif 
                      </td>                    
                  </tr>
                @endif
              @endforeach
            @endif
        @endforeach        
      </tbody>
      <tfoot class="full-width"></tfoot>
  </table>
  <div class="ui two column grid">
          <div class="eight wide column">
          @permission('daotao-list')
            <a href="{{url('daotao')}}" class="ui labeled icon button btn-align-left"><i class="arrow left icon"></i>Danh Sách</a>
          @endpermission
          @permission('daotao-edit')
              <a href="{{url('daotao/' . $dt->id . '/edit')}}" class="ui labeled icon blue button btn-align-left" title="Sửa"><i class="edit icon"></i> Chỉnh sửa lớp</a>
          @endpermission

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