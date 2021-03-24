@extends('admin.master')
@section('title', 'Danh sách Lich Công Tác')
@section('PageContent')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.css"/>

  <h2 class="ui header center aligned">
  DANH SÁCH LỊCH CÔNG TÁC
  <div class="sub header">
  </div>
  </h2>
	<div class="ui secondary menu">
      {{-- @permission('logo-create') --}}
      <div class="right menu">
        <div class="item">
          <a href="{{url('addlichcongtac')}}" class="ui labeled icon green button"><i class="plus circle icon"></i> Thêm</a>
        </div>
      </div>
      {{-- @endpermission --}}
  </div> 
@if (session('status'))
  <div class="ui positive message">
  <i class="close icon"></i>
  <div class="header">
    Thông Báo !
  </div>
  <p>{{ session('status') }}</p>
</div>
@endif
  <div >
    {!! $calendar_details->calendar() !!}
    {!! $calendar_details->script() !!}
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
  <script> status_delete('banner'); </script>
  <script>
    $('#data-table').DataTable({
    });
  </script>
  <!-- Scripts -->
<script src="http://code.jquery.com/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.js"></script>
@endsection