<!DOCTYPE html>
<html>
<head>
	<title>IMPORT</title>
</head>
<body>
<form action="" method="POST" enctype="">
	<input type="hidden" name="_token" value="{!!csrf_token()!!}">
	<label>IMPORT</label>
	<input type="file" name="file">
	<button type="submit">IMPORT</button>
	
</form>
</body>
</html>