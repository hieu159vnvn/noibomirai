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
	
	var html = '<a href="/admin-dashboard/users/add"><button id="addtag" style="margin: -5px 0 0 20px" class="ui labeled icon button green"><i class="plus circle icon"></i>Thêm Tài Khoản</button></a>'
	$('#data-table_filter').after(html);

	$('.btn-delete').click(function(event) {
		$(".del-modal").modal('show');
		var header = '<p>Có phải bạn có muốn xóa tài khoản: ' + $(this).attr('data-user-name') + '?</p>';
		$(".del-modal .content").html(header);
		$(".del-modal .positive").attr('data-user-id', $(this).attr('data-user-id'));
	});
	$('.positive').click(function(event) {
		window.location.href= 'users/' + $(this).attr('data-user-id') + '/delete';
	});
//});