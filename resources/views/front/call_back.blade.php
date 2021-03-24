<?php 
require_once ($app['path.base']. '/vendor/autoload.php');
$zalo = new Zalo\Zalo([
            'app_id' => '3284770593814930448',
            'app_secret' => 'myhFY02XwnLjITx4F7rs',
            'oa_id' => '3923700149134539878',
            'oa_secret' => 'Se0mOWF4d0vD3s8OR8o5'
        ]);
    $helper = $zalo->getRedirectLoginHelper();
    $callBackUrl = "http://qcthong.vnwis/zlapp/call_back";
    $accessToken = $helper->getAccessToken($callBackUrl); // get access token
    $params = ['message' => 'Test API','link'=>"http://epoxykimlong.com"];
    $response = $zalo->post('/me/feed', $params, $accessToken);
    $result = $response->getDecodedBody(); // result thong tin ca nhan
    echo Auth::id();
    var_dump($result);
?>
