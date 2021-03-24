$(document).on('keyup', '#password, #repassword', function(event) {
	event.preventDefault();

	if($('#password').val() !== $('#repassword').val()){
		$('#error-password').css('display', 'block');
	}
	else{
		$('#error-password').css('display', 'none');
	}
});

$('#username').blur(function(event) {
	var _token = $('meta[name="csrf-token"]').attr('content');
	$.ajax({
		url: '/admin-dashboard/users/checkuniqueusername',
		type: 'POST',
		data: {_token: _token,username: $('#username').val(), action: 'add', oldValue:""},
		success: function(data){
			if(data == true)
				$('#error-username').css('display', 'block');
			else
				$('#error-username').css('display', 'none');
		}
	});
});

$('#email').blur(function(event) {
	var _token = $('meta[name="csrf-token"]').attr('content');
	$.ajax({
		url: '/admin-dashboard/users/checkuniqueemail',
		type: 'POST',
		data: {_token: _token,email: $('#email').val(), action: 'add',oldValue:""},
		success: function(data){
			if(data == true)
				$('#error-email').css('display', 'block');
			else
				$('#error-email').css('display', 'none');
		}
	});
});