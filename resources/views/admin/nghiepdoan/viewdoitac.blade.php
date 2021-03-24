@extends('admin.master')
@section('title', 'Danh sách công ty của nghiệp đoàn ')
@section('PageContent')
  <h2 class="ui header center aligned">
    Danh sách công ty của nghiệp đoàn {{$nghiepdoan->tennghiepdoan}}  
    <div class="sub header">
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
            <table id="myTable" class="ui selectable celled striped table">
              <thead>
                  <tr>
                      <th>STT</th>
                      <th>TÊN CÔNG TY</th>  
                      <th>ĐỊA CHỈ</th>
                      <th>NGƯỜI ĐẠI DIỆN</th>
                      <th>EMAIL</th>
                  </tr>
              </thead>
              <tbody>
                @foreach ($doitac as $key => $item)
                  <tr>
                    <td>{{$key+1}}</td>
                    <td>{{$item->tencongty}}</td>
                    <td>{{$item->diachi}}</td>
                    <td>{{$item->nguoidaidien}}</td>
                    <td>{{$item->email}}</td>
                  </tr>
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
  <script type="text/javascript">
    $( document ).ready(function() {
      
       var table = $('#myTable').DataTable( {
  
        });
    });

  </script>
@endsection
@section('JsLibraries')
  <script src="{{url('js/admin/nghiepdoan/nghiepdoan.js')}}"></script>
@endsection