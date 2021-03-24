//$(document).ready(function() {
	$('#data-table').DataTable( {
	  "scrollY":        $(window).height() - 170,
	  "order": [],
	  "fixedColumns": true,
	  "AutoWidth": true,
	  "scrollCollapse": true,
	  "paging":         false,
	  "language": datatable_language,
	});

	$('.btn-delete').click(function(event) {
		$(".del-modal").modal('show');
		var header = '<p>Có phải bạn có muốn xóa liên hệ: ' + $(this).attr('data-tag-name') + '?</p>';
		$(".del-modal .content").html(header);
		$(".del-modal .positive").attr('data-tag-id', $(this).attr('data-tag-id'));
	});
	$('.positive').click(function(event) {
		window.location.href= 'contacts/' + $(this).attr('data-tag-id') + '/delete';
	});
//});