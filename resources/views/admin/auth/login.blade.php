<!DOCTYPE html>
<html>
<head>
	<title>Login Page</title>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">	
	<link rel="stylesheet" type="text/css" href="{{url('libraries/semanticui/semantic.min.css')}}">
	<script src="{{url('libraries/jquery-3.3.1.min.js')}}"></script>
	<script src="{{url('libraries/semanticui/semantic.min.js')}}"></script>
</head>
<style type="text/css">
	body {
      background-color: #DADADA;
    }
    body > .grid {
      height: 100%;
    }
    .image {
      margin-top: -100px;
    }
    .column {
      max-width: 450px;
    }
  </style>
</style>
<body>

	<div class="ui middle aligned center aligned grid">
	  <div class="column">
	    <h2 class="ui teal image header">
	      <img src="{{$configHeader->logo}}" class="image">
	      <div class="content">
	           Log-in Mirai Human
	      </div>
	    </h2>
	    <form class="ui large form"role="form" action="" method="POST">
	    	{{ csrf_field() }}
	      <div class="ui stacked segment">
	        <div class="field">
	          <div class="ui left icon input">
	            <i class="user icon"></i>
	            <input type="text" name="username" placeholder="username" autofocus>
	          </div>
	        </div>
	        <div class="field">
	          <div class="ui left icon input">
	            <i class="lock icon"></i>
	            <input type="password" name="password" placeholder="Password" >
	          </div>
	        </div>
	        <input class="ui fluid large teal button" type="submit" value="ĐĂNG NHẬP">
	      </div>
	    </form>
        @if ($errors->any())
        <div class="ui error message">
		    @foreach ($errors->all() as $error)
		         <li>{{ $error }}</li>
		    @endforeach
		</div>    
		@endif
		@if (session('status'))
			<div class="ui error message">
                {{ session('status') }}
            </div>    
        @endif
	    <div class="ui message">
	      Bạn chưa có tài khoản ? <a href="mailto:thiengoan@gmail.com">Liên hệ</a>
	    </div>
	  </div>
	</div>
	<script type="text/javascript">
		$(document).ready(function() {
			$('.error').delay(5000).slideUp(400);
		});
	</script>
</body>
</html>