@extends('admin.master')
@section('title', 'QUẢN LÝ KÝ TÚC XÁ')
@section('PageContent')
  <h2 class="ui header center aligned">
  QUẢN LÝ KÝ TÚC XÁ
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
@if (session('error'))
				<div class="ui negative message">
				<i class="close icon"></i>
				<div class="header">
					Thông Báo !
				</div>
				<p>{{ session('error') }}</p>
				</div>
			@endif
 <div class="ui secondary menu">
    <div class="right menu">
      <div class="item">
        <a href="{{url('kitucxa/add')}}" class="ui labeled icon green button"><i class="plus circle icon"></i>Thêm</a>
      </div>
    </div>
  </div> 
  <div class="ui segments">
      <div class="ui segment">
        <table id="data-table" class="ui selectable celled striped table">
            <thead class="full-width">
              <tr>
                <th>STT</th>
                <th>TÊN PHÒNG</th>
                <th>SỐ HỌC VIÊN HIỆN TẠI</th>
                <th>SỐ HỌC VIÊN TỐI ĐA</th>
                <th>THAO TÁC</th>
              </tr>
            </thead>
            <tbody>
              @foreach($danhsach as $key => $item)
                <tr>
                  <td>{{$key+1}}</td>
                  <td>{{$item->tenphong}}</td>
                  @php
                      $demhocvien=DB::table('kitucxa_hocvien')->where('id_kitucxa',$item->id)->count();
                  @endphp
                  @if ($demhocvien > $item->sohocvien)
                    <td style="background-color: #f38383">{{$demhocvien}}</td>
                  @else
                    <td>{{$demhocvien}}</td>
                  @endif
                  <td>{{$item->sohocvien}}</td>
                  <td> 
                    <a href="{{url('kitucxa/view/'.$item->id.'')}}" class="mini ui icon green button" title="Xem phòng"><i class="eye icon"></i></a>
                    <a href="{{url('kitucxa/' . $item->id . '/edit')}}" class="mini ui icon blue button" title="Sửa"><i class="edit icon"></i></a>
                    <button type="button" class="mini ui icon red button btn-delete" data-id="{{$item->id}}" data-name="{{$item->id}}" title="Xóa"><i class="window close icon"></i></button>
                  </td>
                </tr>
              @endforeach
            </tbody>
            <tfoot class="full-width"></tfoot>
        </table>
    </div>
  </div>
  <h2 class="ui header center aligned">PHÒNG ĐẶC BIỆT</h2>
  <div class="ui secondary menu">
    <div class="right menu">
      <div class="item">
        <a href="{{url('kitucxa/adddacbiet')}}" class="ui labeled icon green button"><i class="plus circle icon"></i>Thêm</a>
      </div>
    </div>
  </div> 
  <div class="ui segments">
      <div class="ui segment">
        <table id="data-table1" class="ui selectable celled striped table " style="text-align: center">
            <thead class="full-width">
              <tr>
                <th>STT</th>
                <th>TÊN PHÒNG</th>
                <th>SỐ HỌC VIÊN HIỆN TẠI</th>
                <th>SỐ HỌC VIÊN TỐI ĐA</th>
                <th>THAO TÁC</th>
              </tr>
            </thead>
            <tbody>
              @foreach($danhsachdacbiet as $key => $item)
                <tr>
                  <td>{{$key+1}}</td>
                  <td>{{$item->tenphong}}</td>
                  @php
                      $demhocvien=DB::table('kitucxa_hocvien')->where('id_kitucxa',$item->id)->count();
                  @endphp
                  @if ($demhocvien > $item->sohocvien)
                    <td style="background-color: #f38383">{{$demhocvien}}</td>
                  @else
                    <td>{{$demhocvien}}</td>
                  @endif
                  <td>{{$item->sohocvien}}</td>
                  <td> 
                    <a href="{{url('kitucxa/view/'.$item->id.'')}}" class="mini ui icon green button" title="Xem phòng"><i class="eye icon"></i></a>
                    <a href="{{url('kitucxa/' . $item->id . '/editdacbiet')}}" class="mini ui icon blue button" title="Sửa"><i class="edit icon"></i></a>
                    <button type="button" class="mini ui icon red button btn-delete" data-id="{{$item->id}}" data-name="{{$item->id}}" title="Xóa"><i class="window close icon"></i></button>
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
<script src="{{url('js/miraihuman/index.js')}}"></script>
<script> status_delete('danhsach'); </script>
@endsection