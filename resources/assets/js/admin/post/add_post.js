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

$('.btn-feature-image').click(function(event) {
	$(".image-modal").modal('show');
});

$('.remove-feature-image').click(function(event) {
	$('#feature-image').val('');
	$('#show-feature-image').attr('src', '');
	$('.remove-feature-image').css('display', 'none');
});

//});