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
	
	var html = '<a href="/admin-dashboard/productcategories/add"><button id="addtag" style="margin: -5px 0 0 20px" class="ui labeled icon button green"><i class="plus circle icon"></i>Thêm Danh Mục</button></a>'
	$('#data-table_filter').after(html);

	$('.btn-delete').click(function(event) {
		$(".del-modal").modal('show');
		var header = '<p>Có phải bạn có muốn xóa danh mục: ' + $(this).attr('data-category-name') + '?</p><p>(Chú ý: các danh mục con và sản phẩm thuộc các danh mục này cũng sẽ bị xóa theo.)</p>';
		$(".del-modal .content").html(header);
		$(".del-modal .positive").attr('data-category-id', $(this).attr('data-category-id'));
	});
	$('.positive').click(function(event) {
		window.location.href= 'productcategories/' + $(this).attr('data-category-id') + '/delete';
	});
//});