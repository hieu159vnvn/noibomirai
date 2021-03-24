$("#menu li > a").each(function () {
	if ($(this).attr("href") == $(location).attr('href')) {
		$(this).addClass("active");
		$("li").has(this).css('background','#444141');
	}
});
window.datatable_language = {
	"sProcessing": "Đang xử lý...",
	"sLengthMenu": "Hiện _MENU_ dòng",
	"sZeroRecords": "Không tìm thấy dòng nào phù hợp",
	"sInfo": "Đang xem _START_ đến _END_ trong tổng số _TOTAL_ dòng",
	"sInfoEmpty": "Đang xem 0 đến 0 trong tổng số 0 dòng",
	"sInfoFiltered": "(được lọc từ _MAX_ mục)",
	"sInfoPostFix": "",
	"sSearch": "Tìm kiếm",
	"sUrl": "",
	"oPaginate": {
		"sFirst": "Đầu",
		"sPrevious": "Trước",
		"sNext": "Tiếp",
		"sLast": "Cuối"
	}
};

$.format_number = function (number, prefix, thousand_separator, decimal_separator) {
	var thousand_separator = thousand_separator || ',',
	    decimal_separator = decimal_separator || '.',
	    regex = new RegExp('[^' + decimal_separator + '\\d]', 'g'),
	    number_string = number.replace(regex, '').toString(),
	    split = number_string.split(decimal_separator),
	    rest = split[0].length % 3,
	    result = split[0].substr(0, rest),
	    thousands = split[0].substr(rest).match(/\d{3}/g);

	if (thousands) {
		separator = rest ? thousand_separator : '';
		result += separator + thousands.join(thousand_separator);
	}
	result = split[1] != undefined ? result + decimal_separator + split[1] : result;
	return prefix == undefined ? result : result ? prefix + result : '';
};

$('.message .close')
.on('click', function() {
  $(this).closest('.message').transition('fade');
});