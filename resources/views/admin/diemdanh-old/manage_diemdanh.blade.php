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
					<h2 class="ui header centered ">Danh sách Lớp Học </h2>
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
							{{-- <tr>
							    <td colspan="4" style="text-align: left;"><h3> CƠ SỞ 1 </h3></td>
							</tr>
							@foreach($daotao as $key => $dt)
							@if($dt->coso == 1)
								<tr style="text-align: left;">
									<td>
										<div class="ui toggle checkbox">
											<input type="checkbox"  class="checked" name="mcheck[]" value="{{$dt->id}}">
											<label></label>
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
										<div class="item"><a href="{{url('diemdanh/' . $dt->id . '/add')}}" class="mini ui icon blue button"><i class="check icon"></i></a> 
										</div>	
									</td>
								</tr>
							@endif
							@endforeach --}}

							{{-- <tr>
							    <td colspan="4" style="text-align: left;"><h3 class="ui left">CƠ SỞ 2</h3></td>
							</tr>
							@foreach($daotao as $key => $dt)
							@if($dt->coso == 2)
								<tr style="text-align: left;">
									<td>
										<div class="ui toggle checkbox">
											<input type="checkbox"  class="checked" name="mcheck[]" value="{{$dt->id}}">
											<label></label>
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
											<a href="{{url('diemdanh/' . $dt->id . '/add')}}" class="mini ui icon blue button"><i class="check icon"></i></a> 
										</div>	
									</td>
								</tr>
							@endif
							@endforeach --}}

							<tr>
								<td colspan="4" style="text-align: left;"><h3 class="ui left">Phòng đào tạo</h3></td>
							</tr>
							@foreach($daotao as $key => $dt)
							@if($dt->coso == 3)
								<tr style="text-align: left;">
									<td>
										<div class="ui toggle checkbox">
											<input type="checkbox"  class="checked" name="mcheck[]" value="{{$dt->id}}">
											<label></label>
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
											<a href="{{url('diemdanh/' . $dt->id . '/add')}}" class="mini ui icon blue button"><i class="check icon"></i></a> 
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
						{{-- <div class="ui selection dropdown">
						  	Điểm Danh Thay Cơ Sở 1 
						  	<i class="dropdown icon"></i>
						  	<div class="menu">
						    	@foreach($daotao as $dt)
						    		@if($dt->coso == 1)
									<a class="item" href="{{url('diemdanh/' . $dt->id . '/add')}}">Lớp {{$dt->ten_lop_hoc}} - cơ sở {{$dt->coso}}</a>
									@endif 
								@endforeach
						  	</div>
						</div>

						<div class="ui selection dropdown">
						  	Điểm Danh Thay Cơ Sở 2 
						  	<i class="dropdown icon"></i>
						  	<div class="menu">
						    	@foreach($daotao as $dt)
						    		@if($dt->coso == 2)
									<a class="item" href="{{url('diemdanh/' . $dt->id . '/add')}}">Lớp {{$dt->ten_lop_hoc}} - cơ sở {{$dt->coso}}</a>
									@endif 
								@endforeach
						  	</div>
						</div> --}}

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