$('#data-table').DataTable({
	"language": datatable_language,
	stateSave: true
});
$('#data-table-1').DataTable({
	"language": datatable_language,
	stateSave: true
});
$( "#data-table" ).on( "click", ".btn-delete",function (event) {
// $('.btn-delete').click(function (event) {
	$(".del-modal").modal('show');
	var header = '<p>Có phải bạn có muốn xóa ' + $(this).attr('data-name') + '?</p><i>Lưu ý: Cần cân nhắc trước khi xóa. Sẽ không phục hồi lại được!</i>';
	$(".del-modal .content").html(header);
	$(".del-modal .positive").attr('data-id', $(this).attr('data-id'));
});
$( "#data-table-1" ).on( "click", ".btn-delete",function (event) {
	// $('.btn-delete').click(function (event) {
		$(".del-modal").modal('show');
		var header = '<p>Có phải bạn có muốn xóa ' + $(this).attr('data-name') + '?</p><i>Lưu ý: Cần cân nhắc trước khi xóa. Sẽ không phục hồi lại được!</i>';
		$(".del-modal .content").html(header);
		$(".del-modal .positive").attr('data-id', $(this).attr('data-id'));
	});

$('.btn-view').click(function(event){
	$('.view-modal').modal('show');
	$(".view-modal .positive").attr('data-id', $(this).attr('data-id'));
});

$('.positive').click(function (event) {
	window.location.href = 'donhang/' + $(this).attr('data-id') + '/delete';
});

$( "#data-table" ).on( "change", ".duyetdonhang",function (event) {
// $('.duyetdonhang').change(function (event) {
var id = $(this).attr('data-dh');
var _token = $('meta[name="csrf-token"]').attr('content');
$.ajax({
	url: '/donhang/duyetdonhang/'+id,
	type: 'GET',
	data: { dh: id ,status: $(this).prop('checked') },
	success: function success(data) {
		if (data == 'OK') {
			location.reload();
		}
	}
	});
});
