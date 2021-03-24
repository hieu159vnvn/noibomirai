@extends('admin.master')
@section('title', 'Điểm danh')
@section('PageContent')

  <h2 class="ui header center aligned">
    QUẢN LÝ ĐIỂM DANH   
    <div class="sub header">
      Tổng cộng {{count($daotao)}} lớp học.
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

		<form class="ui form" action="" method="post" name="form_1" autocomplete="off">
			{{ csrf_field() }}	
			<div class="ui secondary menu">
	        	<div class="right menu">
					<button type="submit" class="ui labeled icon button green nutluu"><i class="save icon"></i> Kiểm tra</button>
				</div>
			</div>
			
			<div class="ui segments">
				<div class="ui segment">
					<div class="ui calendar" id="date-only">
						<label>CHỌN NGÀY:</label>
						<div class="ui input left icon">
							<i class="calendar icon"></i>
							<input type="text" name="mdate" value="{{date("Y-m-d")}}">
						</div>
					</div>
				</div>
				<div class="ui segment">
					<h2 class="ui header centered ">Danh sách Lớp Học Hôm nay </h2>
					<p class="ui header centered">{{date("d-m-Y")}}</p>
					<table id="data-table" class="ui celled striped table left">	
						<thead class="full-width">
						<tr style="text-align: left;">
							<th style="text-align: left;">
								<div class="ui toggle red checkbox">
								<input type="checkbox"  class="checkedall" name="mcheckall" >
								<label>CHECK ALL</label>
								</div>
							</th>
							<th>GIÁO VIÊN</th>
							<th>LỚP HỌC</th>
							<th>ĐIỂM DANH</th>			          
						</tr>
						</thead>
						<tbody>		
							<tr>
								<td colspan="4" style="text-align: left;"><h3 class="ui left">Phòng đào tạo</h3></td>
							</tr>
							@foreach($daotao as $key => $dt)
							@if($dt->coso == 3)
								<tr style="text-align: left;">
									<td>
										<div class="ui toggle checkbox">
											@if(in_array($dt->id,$diemdanh))
												@if (in_array($dt->id,$khoaduyet))
													<input type="checkbox" class="checked" name="mcheck[]" value="{{$dt->id}}"> <label style="color: red">Đã duyệt</label>
												@else 
													<input type="checkbox" class="checked" name="mcheck[]" checked  value="{{$dt->id}}"> <label></label>
												@endif
											@else
												<input type="checkbox" class="checked" name="mcheck[]" value="{{$dt->id}}" disabled> <label></label>
											@endif
										</div>
									</td>
									<td>
										@foreach($giaovien as $gv)
											@if($gv->id == $dt->gvcn)
												<strong>{{$gv->hoten}}</strong>
											@endif
										@endforeach
									</td>									
									<td> Lớp {{$dt->ten_lop_hoc}} </td>
									<td>
										<div class="item">
											@if (in_array($dt->id,$diemdanh) )
												@if (Auth::user()->hasRole('Đào Tạo'))
													@if (in_array($dt->id,$khoaduyet))
														<a href="{{url('diemdanh/' . $dt->id . '/add')}}" class="mini ui icon orange button"><i class="check icon"></i> Đã Duyệt</a>														
													@else
														<a href="{{url('diemdanh/' . $dt->id . '/add')}}" class="mini ui icon blue button"><i class="check icon"></i> Đã Điểm danh</a>
													@endif
												@else
													<div class="mini ui icon blue button"><i class="check icon"></i> Đã điểm danh</div>
												@endif
											@else 
												@if (Auth::user()->hasRole('Đào Tạo'))
													<a href="{{url('diemdanh/' . $dt->id . '/add')}}" class="mini ui icon red button"><i class="circle icon"></i> Chưa điểm danh</a>
												@else
													<div class="mini ui icon red button"><i class="circle icon"></i> Chưa điểm danh</div>
												@endif
											@endif
											@if($dt->email == Auth::user()->email)
												<a href="{{url('diemdanh/' . $dt->id . '/add')}}" class="mini ui icon green button"><i class="check icon"></i> Điểm danh của bạn</a>
											@endif

											{{-- @if (in_array($dt->id,$khoaduyet))
												<div class="mini ui icon orange button"><i class="check icon"></i> Đã duyệt</div>
											@endif --}}

										</div>	
										
									</td>
								</tr>
							@endif
							@endforeach
						</tbody>
					</table>
					<div class="column">
					
					<br/>
					<hr/>
					<div class="ui column">
						<div class="ui selection dropdown">
							Điểm Danh Thay "Phòng đào tạo"
							<i class="dropdown icon"></i>
							<div class="menu">
								@foreach($daotao as $dt)
									@if($dt->coso == 3)
									<a class="item" href="{{url('diemdanh/' . $dt->id . '/add')}}">Lớp {{$dt->ten_lop_hoc}} -  Phòng đào tạo</a>
									@endif 
								@endforeach
							</div>
						</div>
					</div>	
				</div>
				</div>
			</div>
			<div class="ui secondary menu">
	        	<div class="right menu">
					<button type="submit" class="ui labeled icon button green nutluu"><i class="save icon"></i> Kiểm tra</button>
				</div>
			</div>
		</form>
			
	<script type="text/javascript">
		$('.ui.dropdown').dropdown('hide');
		$(document).ready(function(){
			$(".checkedall").click(function(){
				var checked = $(".checkedall").is(":checked");
				if (checked == true) {
					$('.checked').prop( "checked", true );
				}
				if (checked == false) {
					$('.checked').prop( "checked", false );
				}
			});
			var calendarOpts = {
				type: 'date',
				formatter: {
					date: function (date, settings) {
						if (!date) return '';
						var day = date.getDate() + '';
						if (day.length < 2) {
							day = '0' + day;
						}
						var month = (date.getMonth() + 1) + '';
						if (month.length < 2) {
							month = '0' + month;
						}
						var year = date.getFullYear();
						// return year + '-' + month + '-' + day;
						return day + '-' + month + '-' + year;
		        }
		    }
		};
		$('#date-only').calendar(calendarOpts);
	});
</script>
@endsection
@section('JsLibraries')
@endsection