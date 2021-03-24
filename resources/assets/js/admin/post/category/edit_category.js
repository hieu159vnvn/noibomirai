//$(document).ready(function() {
$('#generate-slug').click(function(event){
	$.change_alias($('#category-name').val(),$('#category-slug'));
});
//});