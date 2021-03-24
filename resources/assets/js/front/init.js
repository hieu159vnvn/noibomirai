function setSameHeight(elements){
	var maxheight = 0;
	elements.each(function(index, el) {
		if($(this).height() > maxheight)
			maxheight = $(this).height();
	});
	elements.height(maxheight);
}

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

$(document).ready(function($) {
	setSameHeight($('.ih-item .img'));
	setSameHeight($('.wrap-product-title'));
	setSameHeight($('.wrap-product-block'));

	$('.submenu-sidebar').each(function(index, el) {
		if($(this).has('li').length == 0)
			$(this).remove();
	});
});