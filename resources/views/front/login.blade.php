<?php
	require_once ($app['path.base']. '/vendor/autoload.php');
$zalo = new Zalo\Zalo([
            'app_id' => '3284770593814930448',
            'app_secret' => 'myhFY02XwnLjITx4F7rs',
            'oa_id' => '3923700149134539878',
            'oa_secret' => 'Se0mOWF4d0vD3s8OR8o5'
        ]);

	if (isset($_COOKIE['app_id'])) {
		header('Location: index.php');
		exit();
	}
	$helper = $zalo->getRedirectLoginHelper();
	$callBackUrl = "http://qcthong.vnwis/zlapp/call_back";
	$loginUrl = $helper->getLoginUrl($callBackUrl); // This is login url

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ZALO API</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
</head>
<body>
	<div class="container">
			<a href="<?php echo $loginUrl ?>"> <h2> Login with Zalo </h2> </a><br>				
	</div>
</body>
</html>