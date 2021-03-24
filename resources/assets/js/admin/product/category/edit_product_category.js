$('#generate-slug').click(function(event){
	$.change_alias($('#category-name').val(),$('#category-slug'));
});

$('#category-price').val($.format_number($('#category-price').val()));
$('#category-price').keyup(function(){
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