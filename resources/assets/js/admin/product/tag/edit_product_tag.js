//$(document).ready(function() {
$('#generate-slug').click(function(event){
	$.change_alias($('#tag-name').val(),$('#tag-slug'));
});
//});