@extends('admin.master')
@section('title', 'Điểm danh')
@section('PageContent')
<h2 class="ui header center aligned">
ĐIỂM DANH  
<div class="sub header">
	<h3>Lớp Học : {{$daotao->ten_lop_hoc}}</h3>
</div>
</h2>
  
<h4>GIÁO VIÊN: {{$giaovien->hoten}}</h4>
@if (session('status'))
<div class="ui message">
<i class="close icon"></i>
<div class="header">
  Thông Báo !
</div>
<p>{{ session('status') }}</p>
</div>
@endif	
	
<form class="ui form" action="" method="post" name="form_1">
	{{ csrf_field() }}	
	<div class="field">
		@php
			if ($dd) {
				$aa = json_decode($dd, true);
			}else{
				$aa = json_decode("{}", true);
			}
			$i = 0;
			foreach ($aa as $key => $hv) {
				if ($key == $id) {
					$i = 1;
				}
			}
			function duyet($duyet) {
			    if ($duyet == "ok") {
			    	return "disabled";
			    }else{
			    	return "";
			    }
			}
		@endphp			
	@if($i == 0)
	{{-- add --}}
			<table id="data-table" class="ui selectable celled striped table">
			<thead class="full-width" style="text-align: left;">
		        <tr>
		          <th class="td">TÊN HỌC VIÊN</th>
		          
		          <th>HIỆN DIỆN</th>
		          <th>NGHỈ PHÉP</th>
		          <th>LÝ DO</th>
		        </tr>
		      </thead>
		      <tbody style="text-align: left;">
					@foreach($hocvien as $hv)
						@php 
							$dshv = json_decode($daotao->dshv);
						@endphp
						@if($dshv)
							@foreach($dshv as $key => $lhv)
								@if($lhv == $hv->id)
								<tr class="diemdanh">
									<td><h4>{{$hv->hoten}}</h4></td>
									
									<td class="vangmat">
										<div class="ui toggle checkbox">
										  <input type="checkbox"  class="checked" name="vang" value="{{$hv->id}}">
										  <label>vắng mặt</label>
										</div>
									</td>
									<input type="hidden" class="duyet" name="duyet" value="">
									<td class="phep">
										<span class="container">
											<div class="ui toggle checkbox">
											  <input type="checkbox"  class="checked" name="phep" value="{{$hv->id}}">
											  <label>Có phép</label>
											</div> &nbsp;
											<div class="ui toggle checkbox">
											  <input type="checkbox"  class="checkedtre" name="tre" value="{{$hv->id}}">
											  <label>Đi Trễ</label>
											</div>
										</span>
									</td>
									<td class="lydo">
										<div class="ui input">
										<input type="text" class="container" name="lydo" value="" placeholder="Lý do">
											<select name="tre" class="containertre">
												@for( $i = 1; $i < 8; $i++ )
													<option value="{{$i}}">Tiết {{$i}}</option>
					
												@endfor
											</select>
										</div>
									</td>
								</tr>
								@endif
							@endforeach
						@endif
					@endforeach       
				</tbody>
			</table>					
			<p class="p"></p>
			<div class="ui two column grid">
				<div class="eight wide column">
					<button class="ui labeled icon button blue  checkk"><i class="save icon"></i>Đồng ý</button>
				</div>
			</div>
	@else
	{{-- edit --}}
		<table id="data-table" class="ui selectable celled striped table">
			<thead class="full-width" style="text-align: left;">
				<tr >
					<th>TÊN HỌC VIÊN</th>
					<th>HIỆN DIỆN</th>
					<th>NGHỈ PHÉP</th>
					<th>LÝ DO</th>					          
				</tr>
			</thead>
			<tbody style="text-align: left;">
				@foreach ($aa as $key => $hv) 
				@if($id == $key) 
				@foreach ($hv as $ten)
				{{-- @if($ten['duyet']== "ok") disabled @endif --}}
				
				<tr class="diemdanh">
					<td>
						@foreach ($hocvien as $key => $value)
						@if ($ten['id'] == $value->id)
						<h4>{{$value->hoten}}</h4>
						@endif
						@endforeach
					</td>
					
					<td class="vangmat">
						<div class="ui toggle checkbox">
						  <input type="checkbox" {{duyet($ten['duyet'])}} class="checked" <?php if($ten['checked'] != "comat") {echo "checked";} ?> name="vang" value="{{$ten['id']}}">
						  <label>Vắng mặt</label>
						</div>
						<input type="hidden" class="duyet" name="duyet" value="{{$ten['duyet']}}">
					</td>
					<td class="phep">
						<div class="container">
							<div class="ui toggle checkbox">
							  <input type="checkbox" {{duyet($ten['duyet'])}}  class="checked" <?php if($ten['checked'] == "cophep") {echo "checked";} ?> name="phep" value="{{$ten['id']}}">
							  <label>Có phép</label>
							</div>&nbsp;
							<div class="ui toggle checkbox">
							  <input type="checkbox" {{duyet($ten['duyet'])}} <?php if(isset($ten['tre'])) {echo "checked";} ?>  class="checkedtre" name="tre" value="">
							  <label>Đi Trễ</label>
							</div>
							
						</div>
					</td>
					<td class="lydo">
						<div class="ui input">
						@if($ten['ly-do'])
							<input type="text" {{duyet($ten['duyet'])}} class="container" name="lydo" value="{{$ten['ly-do']}}" placeholder="Lý do">
						@else
							<input type="text" {{duyet($ten['duyet'])}} class="container" name="lydo" value="" placeholder="Lý do">
						@endif
						<select name="tre" {{duyet($ten['duyet'])}} class="containertre">
							@for( $i = 1; $i < 8; $i++ )
							@if(isset($ten['tre']) && $ten['tre'] == $i)
								<option selected value="{{$i}}">Tiết {{$i}}</option>
							@else
								<option value="{{$i}}">Tiết {{$i}}</option>
							@endif
							@endfor
						</select>
					</div>

					</td>
				</tr>
				@endforeach
				@endif
				@endforeach
			</tbody>
		</table>
		<p class="p"></p>
		<div class="ui two column  grid">
			<div class="eight wide column">
				<button class="ui labeled icon button blue  checkk"><i class="save icon"></i>Đồng ý</button>
			</div>
		</div>
	@endif
	<br>
	{{-- result --}}
		<h3 class="ui red label">Kết quả điểm danh ngày {{date("d-m-Y")}}</h3>
		<table id="data-table" class="ui selectable celled striped table">
			<thead class="full-width" style="text-align: left;">
				<tr>
					<th>TÊN HỌC VIÊN</th>
					<th>ĐIỂM DANH</th>
					<th>LÝ DO</th>
					<th>DUYỆT</th>					          
				</tr>
			</thead>
			<tbody style="text-align: left;">
				@foreach ($aa as $key => $hv) 
				@if($id == $key) 
				@foreach ($hv as $ten)
				<tr>
					<td>
						@foreach ($hocvien as $key => $value)
						@if ($ten['id'] == $value->id)
						<h4>{{$value->hoten}}</h4>
						@endif
						@endforeach
					</td>
					<td>
						
						@if ($ten['checked'] == "comat")
							<span class="ui blue basic label"><i class="small checkmark icon blue"></i> CÓ MẶT </span>
						@elseif($ten['checked'] == "cophep")
							<span class="ui orange basic label"><i class="large icon close red"></i> CÓ PHÉP </span>
						@elseif ($ten['checked'] == "khongphep")
							<span class="ui red basic label"><i class="large icon close red"></i> KHÔNG PHÉP </span>
						@elseif ($ten['checked'] == "tre")
							<span class="ui yellow basic label">
								<i class="large close icon red"></i> TRỄ </label>
							</span>
							<div class="ui left pointing black label"> Tiết {{$ten['tre']}}</div>
						@endif
					</td>
					<td>
						@if($ten['ly-do'])
							<label>Lý do: {{$ten['ly-do']}}</label>
						@endif
					</td>
					<td>
						@if ($ten['duyet'] == 'ok') 
							<span class="ui blue label">đã xác nhận</span>
						@elseif($ten['duyet'] == '' && $ten['checked'] == "cophep" || $ten['checked'] == "tre")
							<span class="ui red label">chưa xác nhận</span>
						@endif
					</td>
				</tr>
				@endforeach
				@endif
				@endforeach
			</tbody>
		</table>
	</div>
</form>
	{{-- test --}}
<script type="text/javascript">
	$(document).ready(function(){
		$('.nutluu').hide();
		var length = $( '.diemdanh').length;
		var i;
		$(".checkk").click(function(){
			$('.nutluu').show();
			var arr = new Array();
			for (i = 0; i < length; i++) {
				var vang = $('.vangmat .checked:eq('+ i +')').is(":checked");
				var phep = $('.phep .checked:eq('+ i +')').is(":checked");
				var tre = $('.phep .checkedtre:eq('+ i +')').is(":checked");
				if (vang == false) {
					arr.push('{"id":'+'"'+$(".vangmat .checked:eq("+i+")").val()+'","checked":"comat","ly-do":"","duyet":""}');
				}else{
					if (phep == true) {
						arr.push('{"id":'+'"'+$(".phep .checked:eq("+i+")").val()+'","checked":"cophep","ly-do":"'+$('.lydo .container:eq('+ i +')').val()+'","duyet":"'+$('.duyet:eq('+ i +')').val()+'"}');
					} else if(tre == true){
						arr.push('{"id":'+'"'+$(".phep .checked:eq("+i+")").val()+'","checked":"tre","ly-do":"'+$('.lydo .container:eq('+ i +')').val()+'","duyet":"'+$('.duyet:eq('+ i +')').val()+'","tre":"'+$('.lydo .containertre:eq('+ i +')').val()+'"}');
					}
					else {
						
						arr.push('{"id":'+ '"'+$(".phep .checked:eq("+i+")").val()+'","checked":"khongphep","ly-do":"","duyet":""}');
					}
				}
			}
			var u = arr.toString();
			$(".p").append(" <input type='hidden' name='diemdanhsave' value='"+u+"'>");
		});
		
		$('.phep .container').hide();
		$('.lydo .container').hide();
		$('.lydo .containertre').hide();
		for (i = 0; i < length; i++) {
			checked(i);
		}
		function checked(i){
			if ($('.vangmat .checked:eq('+ i +')').is(":checked") == true) {
				$('.phep .container:eq('+ i +')  ').show();
				$('.lydo .container:eq('+ i +')  ').hide();
			}else {
				$('.phep .container:eq('+ i +')  ').hide();
				$('.lydo .container:eq('+ i +')  ').hide();
				$('.lydo .containertre:eq('+ i +')  ').hide();
			}
			if ($('.phep .checked:eq('+ i +')').is(":checked") == true) {
				$('.lydo .container:eq('+ i +')  ').show();
			}
			if ($('.phep .checkedtre:eq('+ i +')').is(":checked") == true) {
				$('.lydo .containertre:eq('+ i +')  ').show();
				$('.lydo .container:eq('+ i +')  ').show();
			}
			$('.vangmat .checked:eq('+ i +')').click(function(){
				$('.phep .checked:eq('+ i +')').prop( "checked", false);
				$('.phep .checkedtre:eq('+ i +')').prop( "checked", false);
				var checked = $('.vangmat .checked:eq('+ i +')').is(":checked");
				if (checked == true) {
					$('.phep .container:eq('+ i +')  ').show();
					$('.lydo .container:eq('+ i +')  ').hide();
					$('.lydo .containertre:eq('+ i +')  ').hide();
				}else {
					$('.phep .container:eq('+ i +')  ').hide();
					$('.lydo .container:eq('+ i +')  ').hide();
					$('.lydo .containertre:eq('+ i +')  ').hide();
				}
			});
			$('.phep .checked:eq('+ i +')').click(function(){
				$('.vangmat .checked:eq('+ i +')').prop( "checked", true );
				// $('.phep .checked:eq('+ i +')').prop( "checked", true);
				$('.phep .checkedtre:eq('+ i +')').prop( "checked", false);
				var checked = $('.phep .checked:eq('+ i +')').is(":checked");
				if (checked = true) {
					$('.lydo .container:eq('+ i +')  ').show();
					$('.lydo .containertre:eq('+ i +')  ').hide();
				}else {
					$('.lydo .container:eq('+ i +')  ').hide();
				}
			});
			$('.phep .checkedtre:eq('+ i +')').click(function(){
				$('.vangmat .checked:eq('+ i +')').prop( "checked", true );
				$('.phep .checked:eq('+ i +')').prop( "checked", false);
				$('.phep .checkedtre:eq('+ i +')').prop( "checked", true);
				var checked = $('.phep .checkedtre:eq('+ i +')').is(":checked");
				if (checked = true) {
					$('.lydo .containertre:eq('+ i +')  ').show();
					$('.lydo .container:eq('+ i +')  ').show();

				}else {
					$('.lydo .containertre:eq('+ i +')  ').hide();
				}
			});
		}
	});
</script>
	{{-- /test --}}
@endsection
@section('JsLibraries')
  <script src="{{url('js/admin/diemdanh/add-diemdanh.js')}}"></script>
@endsection