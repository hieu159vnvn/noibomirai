//$(document).ready(function() {
$('#generate-slug').click(function(event){
	$.change_alias($('#category-name').val(),$('#category-slug'));
});

$('.ui.tag-dropdown')
  	.dropdown()
;

$('.ui.category-dropdown')
  	.dropdown()
;

$('#category-old-price').val($.format_number($('#category-old-price').val()));
$('#category-old-price').keyup(function(){
  	$(this).val($.format_number($(this).val()));
});

$('#category-new-price').val($.format_number($('#category-new-price').val()));
$('#category-new-price').keyup(function(){
  	$(this).val($.format_number($(this).val()));
});

$('.btn-feature-image').click(function(event) {
	$(".image-modal").modal('show');
});
$('.remove-feature-image').click(function(event) {
	$('#feature-image').val('');
	$('#show-feature-image').attr('src', '');
	$('.remove-feature-image').css('display', 'none');
});

$('.btn-product-image').click(function(event) {
	$(".product-image-modal").modal('show');
});
$(document).on('click', '.remove-product-image', function(event) {
	var numberImage = parseInt($(this).attr('data-count-image'));
	$('#product-image-'+numberImage).remove();
	$('#img-product-image-'+numberImage).remove();
	$(this).remove();
});

var tagID = $('.block-tag-dropdown').attr('data-selected-tags').split(",");
$('.tag-dropdown').dropdown('set selected',tagID);
//});