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
	
	var html = '<a href="/admin-dashboard/postcategories/add"><button id="addtag" style="margin: -5px 0 0 20px" class="ui labeled icon button green"><i class="plus circle icon"></i>Thêm Chuyên Mục</button></a>'
	$('#data-table_filter').after(html);

	$('.btn-delete').click(function(event) {
		$(".del-modal").modal('show');
		var header = '<p>Có phải bạn có muốn xóa chuyên mục: ' + $(this).attr('data-category-name') + '?</p><p>(Chú ý: các chuyên mục con và bài viết thuộc các chuyên mục này cũng sẽ bị xóa theo.)</p>';
		$(".del-modal .content").html(header);
		$(".del-modal .positive").attr('data-category-id', $(this).attr('data-category-id'));
	});
	$('.positive').click(function(event) {
		window.location.href= 'postcategories/' + $(this).attr('data-category-id') + '/delete';
	});
//});