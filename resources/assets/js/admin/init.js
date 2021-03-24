window.datatable_language = {
    "sProcessing":   "Đang xử lý...",
    "sLengthMenu":   "Xem _MENU_ mục",
    "sZeroRecords":  "Không tìm thấy dòng nào phù hợp",
    "sInfo":         "Đang xem _START_ đến _END_ trong tổng số _TOTAL_ mục",
    "sInfoEmpty":    "Đang xem 0 đến 0 trong tổng số 0 mục",
    "sInfoFiltered": "(được lọc từ _MAX_ mục)",
    "sInfoPostFix":  "",
    "sSearch":       "Tìm kiếm:",
    "sUrl":          "",
    "oPaginate": {
        "sFirst":    "Đầu",
        "sPrevious": "Trước",
        "sNext":     "Tiếp",
        "sLast":     "Cuối"
    }
};

// Create our number formatter.
$.format_number = function(number, prefix, thousand_separator, decimal_separator)
{
	var thousand_separator = thousand_separator || ',',
		decimal_separator = decimal_separator || '.',
		regex		= new RegExp('[^' + decimal_separator + '\\d]', 'g'),
		number_string = number.replace(regex, '').toString(),
		split	  = number_string.split(decimal_separator),
		rest 	  = split[0].length % 3,
		result 	  = split[0].substr(0, rest),
		thousands = split[0].substr(rest).match(/\d{3}/g);
	
	if (thousands) {
		separator = rest ? thousand_separator : '';
		result += separator + thousands.join(thousand_separator);
	}
	result = split[1] != undefined ? result + decimal_separator + split[1] : result;
	return prefix == undefined ? result : (result ? prefix + result : '');
};

//$(document).ready(function(){
/************** Menu Sidebar********************************/
	$(".has-child span.glyphicon-menu-down").click(function(){
		var className = $(this).attr('class');
		
		if( className.search("glyphicon-active") == -1) {
			$(".has-child span.glyphicon-active").siblings('.ul-sidebar-lv2').slideUp(200);
			$(".has-child .glyphicon-active").removeClass("glyphicon-active");
		    $(this).addClass("glyphicon-active");
		    $(this).siblings('.ul-sidebar-lv2').slideDown(300);
		}
		else{
			$(this).siblings('.ul-sidebar-lv2').slideUp(200);
		    $(this).removeClass("glyphicon-active");
		}
	});
	$(".has-child > a").click(function(event){
		var elem = $(this).siblings('span');
		var className = elem.attr('class');
		if( className.search("glyphicon-active") == -1) {
			$(".has-child span.glyphicon-active").siblings('.ul-sidebar-lv2').slideUp(200);
			$(".has-child .glyphicon-active").removeClass("glyphicon-active");
		    elem.addClass("glyphicon-active");
		    elem.siblings('.ul-sidebar-lv2').slideDown(300);
		}
		else{
			elem.siblings('.ul-sidebar-lv2').slideUp(200);
		    elem.removeClass("glyphicon-active");
		}
	});

	//$('.menu-sidebar a').click(function() {
	//	location.reload();
	//});
	$(".menu-sidebar li > a").each(function(){
        if($(this).attr("href") == $(location).attr('href') ){
			$("li").has(this).addClass("li-active");
			$(".li-active .glyphicon-menu-down").addClass("glyphicon-active");

        }
    });
/************** End of Menu Sidebar********************************/
	
	$(".flasMessage,.error_msg, .alert-success, .alert-danger, .ajax-messenger").delay(3000).slideUp();

	$('.seo-title').keyup(function(event) {
		/* Act on the event */
		var html = "Số ký tự hiện tại: " + $(this).val().length;
		$('.seo-title-messager').css('display', 'block');
		$('.seo-title-messager').html(html);
	});
	$('.seo-description').keyup(function(event) {
		/* Act on the event */
		var html = "Số ký tự hiện tại: " + $(this).val().length;
		$('.seo-description-messager').css('display', 'block');
		$('.seo-description-messager').html(html);
	});

//});

$.change_alias = function(alias, element) {
    var str = alias;
    str = str.toLowerCase();
    str = str.replace(/à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ/g,"a"); 
    str = str.replace(/è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ/g,"e"); 
    str = str.replace(/ì|í|ị|ỉ|ĩ/g,"i"); 
    str = str.replace(/ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ/g,"o"); 
    str = str.replace(/ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ/g,"u"); 
    str = str.replace(/ỳ|ý|ỵ|ỷ|ỹ/g,"y"); 
    str = str.replace(/đ/g,"d");
    str = str.replace(/!|@|%|\^|\*|\(|\)|\+|\=|\<|\>|\?|\/|,|\.|\:|\;|\'|\"|\&|\#|\[|\]|~|\$|_|`| |{|}|\||\\/g,"-");
    str = str.replace(/ + /g,"-");
    str = str.trim(); 
    
    element.val(str);
}