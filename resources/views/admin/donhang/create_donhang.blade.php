@extends('admin.master')
@section('title', 'Ghép Đơn Hàng')
@section('PageContent')
	<h2 class="ui header center aligned">
        GHÉP ĐƠN HÀNG   
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
	
		<div class="thongtin">
			<div class="ui segments">
				<div class="ui segment">
		            <div class="ui secondary menu">
	                    <div class="right menu">
				        	<a href="{{url('donhang')}}" class="ui labeled icon button btn-align-left"><i class="arrow left icon"></i>Danh Sách</a>
	                    </div>
		            </div>
		        </div>		            
				<div class="ui segment">
					<table id="myTable" class="ui selectable celled striped table">
					  <thead class="full-width">
						  <tr>
							<th>STT</th>
							<th>ẢNH</th>           
							<th>HỌ & TÊN</th>
							<th>GIỚI TÍNH</th>
							<th>NGÀY SINH</th>
							<th>ĐIỆN THOẠI</th>
							<th>CHỌN</th>
						  </tr>
					  </thead>
					  <tfoot>
						<tr>
							<th></th>
							<th></th>
							<th></th>            
							<th></th>
							<th></th>
							<th></th>
							<th></th>                
						</tr>
					  </tfoot>
					</table>
				</div>
			</div>
			
		</div>	
	</form>
	<style>
	.ui.table td.positive, .ui.table tr.positive {
      background: #e5ecd3 !important;   
    }
	</style>
	<script type="text/javascript">
	  $( document ).ready(function() {
		 var table = $('#myTable').DataTable( {
			stateSave: true,
			processing: true,
			serverSide: true,
			ajax: '/datatables/donhang/{{$iddh}}',
			columns: [
				{ data: 'id'},
				{ data: 'hinhanh'},         
				{ data: 'hoten'},
				{ data: 'gioitinh'},
				{ data: 'ngaysinh'},
				{ data: 'dienthoai'},
				{ data: 'chon'}],
				ordering: true,
          order: [0, "desc"],
		  language: datatable_language,
		  "fnRowCallback": function(nRow, aData, iDisplayIndex, iDisplayIndexFull) {
              var index = iDisplayIndexFull + 1;
              $('td:eq(0)',nRow).html(index);
              return nRow;
          },
		  });
	  });
	
	
	</script>
	<script>
		$("div").on('click','.ghepdonhang',function(e){
		// $('.ghepdonhang').change(function (event) {
		var idhv = $(this).attr('data-id');
		var iddh = $(this).attr('data-dh');
		var _token = $('meta[name="csrf-token"]').attr('content');
		$.ajax({
			url: '/donhang/changetinhtrang',
			type: 'POST',
			data: { _token: _token, id: idhv, dh: iddh ,status: $(this).prop('checked') },
			success: function success(data) {
				if (data == 'OK') {
					swal("Thông Báo !", "Đã cập nhật đơn hàng thành công!", "success");
					location.reload();
				}
			}
			});
		});
		</script>
@endsection
@section('JsLibraries')

  {{-- <script src="{{url('js/admin/donhang/create_donhang.js')}}"></script> --}}
@endsection


		