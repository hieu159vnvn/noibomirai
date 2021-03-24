$('#data-table').DataTable({
	"language": datatable_language
});
$('#data-table1').DataTable({
	"language": datatable_language
});
$('.btn-delete').click(function (event) {
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
	window.location.href = 'daotao/' + $(this).attr('data-id') + '/delete';
});

