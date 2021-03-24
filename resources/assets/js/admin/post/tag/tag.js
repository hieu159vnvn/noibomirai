//$(document).ready(function() {
	$('#data-table').DataTable( {
	  "scrollY":        $(window).height() - 170,
	  "order": [ 0, "desc" ],
	  "fixedColumns": true,
	  "AutoWidth": true,
	  "scrollCollapse": true,
	  "paging":         false,
	  "language": datatable_language,
	});
	
	var html = '<a href="/admin-dashboard/posttags/add"><button id="addtag" style="margin: -5px 0 0 20px" class="ui labeled icon button green"><i class="plus circle icon"></i>Thêm Thẻ</button></a>'
	$('#data-table_filter').after(html);

	$('.btn-delete').click(function(event) {
		$(".del-modal").modal('show');
		var header = '<p>Có phải bạn có muốn xóa thẻ: ' + $(this).attr('data-tag-name') + '?</p>';
		$(".del-modal .content").html(header);
		$(".del-modal .positive").attr('data-tag-id', $(this).attr('data-tag-id'));
	});
	$('.positive').click(function(event) {
		window.location.href= 'posttags/' + $(this).attr('data-tag-id') + '/delete';
	});
//});