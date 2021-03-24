<!DOCTYPE html>
<html>
<head>
	<title>Tạo Mới Mật Khẩu</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<!------ Include the above in your HEAD tag ---------->
	<style type="text/css">
		#wrap-login-box{
			-webkit-box-shadow: 0px 0px 15px 1px rgba(0,0,0,0.75);
		    -moz-box-shadow: 0px 0px 15px 1px rgba(0,0,0,0.75);
		    box-shadow: 0px 0px 5px 2px rgba(175, 175, 175, 0.75);
		}
		.panel-heading {
		    padding: 12px;
		    font-size: 18px;
		}

		.panel-footer {
			padding: 12px;
			color: #A0A0A0;
		}

		.profile-img {
			width: 96px;
			height: 96px;
			margin: 0 auto 10px;
			display: block;
			-moz-border-radius: 50%;
			-webkit-border-radius: 50%;
			border-radius: 50%;
		}
	</style>
</head>
<body>
    <div class="container" style="margin-top:40px">
		<div class="row">
			<div class="col-sm-6 col-md-6 col-md-offset-3">
				<div id="wrap-login-box" class="panel panel-default">
					<div class="panel-heading text-center">
						<strong>Trang tạo mới mật khẩu</strong>
					</div>
					<div class="panel-body">
						<form role="form" action="" method="POST">
							{{ csrf_field() }}
							<fieldset>
								<div class="row">
									@if ($errors->any())
									    <div class="alert alert-danger text-center">
									        <ul>
									            @foreach ($errors->all() as $error)
									                <li>{{ $error }}</li>
									            @endforeach
									        </ul>
									    </div>
									@endif
									<div class="col-sm-12 col-md-10  col-md-offset-1 ">
										<input type="hidden" name="email" value="{{$passReset->email}}">
										<div class="form-group">
											<div style="margin-bottom: 10px" class="input-group">
												<span class="input-group-addon">
													<i class="glyphicon glyphicon-lock"></i>
												</span> 
												<input id="password" class="form-control" placeholder="Mật khẩu mới" name="password" type="password" value="{{ old('email') }}" autofocus required>
											</div>

                            				<p class="alert-error-messager" style="display:none;color:red;text-align: center">Mật khẩu không trùng nhau!</p>

											<div class="input-group">
												<span class="input-group-addon">
													<i class="glyphicon glyphicon-lock"></i>
												</span> 
												<input id="repassword" class="form-control" placeholder="Nhập lại mật khẩu mới" name="repassword" type="password" value="{{ old('email') }}" autofocus required>
											</div>
										</div>
										<div class="form-group">
											<input type="submit" class="btn btn-lg btn-primary btn-block" value="Tạo mật khẩu" disabled>
										</div>
									</div>
								</div>
							</fieldset>
						</form>
					</div>
                </div>
			</div>
		</div>
	</div>
	<script type="text/javascript">
		$(document).ready(function() {
			$('.alert').delay(6000).slideUp(400);

			$('#wrap-login-box').on('keyup', ['#password','#repassword'], function(event) {
                event.preventDefault();
                if($('#password').val() !== $('#repassword').val()){
                    $('.alert-error-messager').css('display', 'block');
                    $('.btn-block').attr('disabled', true);
                }else{
                    $('.alert-error-messager').css('display', 'none');
                    $('.btn-block').attr('disabled', false);
                }
            });
		});
	</script>
</body>
</html>