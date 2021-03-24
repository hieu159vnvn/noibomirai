$('.change-stt').change(function (event) {
var _token = $('meta[name="csrf-token"]').attr('content');
$.ajax({
	url: '/donhang/changestt',
	type: 'POST',
	data: { _token: _token, id: $(this).attr('data-id'), stt: $(this).val() },
	success: function success(data) {
		location.reload();
	}
});
});

$('.pvdau').click(function(event){
	$(this).addClass('green');
	$(this).parent().find($('div.pvrot')).removeClass('red');
	var _token = $('meta[name="csrf-token"]').attr('content');
	$.ajax({
		url: '/donhang/phongvandau',
		type: 'POST',
		data: { _token: _token, id: $(this).attr('data-id') },
		success: function success(data) {
		}
	});
});
$('.pvrot').click(function(event){
	$(this).addClass('red');
	$(this).parent().find($('div.pvdau')).removeClass('green');
	var _token = $('meta[name="csrf-token"]').attr('content');
	$.ajax({
		url: '/donhang/phongvanrot',
		type: 'POST',
		data: { _token: _token, id: $(this).attr('data-id') },
		success: function success(data) {
		}
	});
});

