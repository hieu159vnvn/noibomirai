//$(document).ready(function() {
	$('#data-table').DataTable( {
	  "scrollY":        $(window).height() - 170,
	  "order": [],
	  "fixedColumns": true,	  
	  "paging": false,
	  "language": datatable_language,
	});
	
	var html = '<a href="/admin-dashboard/products/add"><button id="addtag" style="margin: -8px 0 0 20px" class="ui labeled icon button green"><i class="plus circle icon"></i>Thêm Sản Phẩm</button></a>'
	$('#data-table_filter').after(html);

	$('.btn-delete').click(function(event) {
		$(".del-modal").modal('show');
		var header = '<p>Có phải bạn có muốn xóa sản phẩm: ' + $(this).attr('data-post-title') + '?</p>';
		$(".del-modal .content").html(header);
		$(".del-modal .positive").attr('data-post-id', $(this).attr('data-post-id'));
	});
	$('.positive').click(function(event) {
		window.location.href= 'products/' + $(this).attr('data-post-id') + '/delete';
	});

	$('.product-status').click(function(event) {
		var _token = $('meta[name="csrf-token"]').attr('content');
		$.ajax({
			url: '/admin-dashboard/products/changestatus',
			type: 'POST',
			data: {_token: _token,id: $(this).attr('data-id'), status: $(this).prop('checked')},
			success: function(data){
				if(data == 'OK'){
					$('.ajax-messenger').html('Cập nhật hiển thị thành công!');
					$('.ajax-messenger').addClass('alert-success').css('display','block').delay(3000).slideUp();
				}
			}
		});
	});

	$('.product-noibat').click(function(event) {
		var _token = $('meta[name="csrf-token"]').attr('content');
		$.ajax({
			url: '/admin-dashboard/products/changenoibat',
			type: 'POST',
			data: {_token: _token,id: $(this).attr('data-id'), noibat: $(this).prop('checked')},
			success: function(data){
				if(data == 'OK'){
					$('.ajax-messenger').html('Cập nhật thành công!');
					$('.ajax-messenger').addClass('alert-success').css('display','block').delay(3000).slideUp();
				}
			}
		});
	});

	$('.product-banchay').click(function(event) {
		var _token = $('meta[name="csrf-token"]').attr('content');
		$.ajax({
			url: '/admin-dashboard/products/changebanchay',
			type: 'POST',
			data: {_token: _token,id: $(this).attr('data-id'), banchay: $(this).prop('checked')},
			success: function(data){
				if(data == 'OK'){
					$('.ajax-messenger').html('Cập nhật thành công!');
					$('.ajax-messenger').addClass('alert-success').css('display','block').delay(3000).slideUp();
				}
			}
		});
	});

	$('.product-stt').change(function(event) {
		var _token = $('meta[name="csrf-token"]').attr('content');
		$.ajax({
			url: '/admin-dashboard/products/changestt',
			type: 'POST',
			data: {_token: _token,id: $(this).attr('data-id'), stt: $(this).val()},
			success: function(data){
				if(data == 'OK'){
					$('.ajax-messenger').html('Cập nhật số thứ tự thành công!');
					$('.ajax-messenger').addClass('alert-success').css('display','block').delay(3000).slideUp();
				}
			}
		});
	});
//});