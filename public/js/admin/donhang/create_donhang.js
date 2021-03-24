$('#data-table').DataTable({
			"language": datatable_language,
			processing: true
});
$('.ghepdonhang').change(function (event) {
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
