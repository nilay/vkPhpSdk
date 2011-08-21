<?php
require_once dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'VkPhpSdk.php';
require_once dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'Oauth2Proxy.php';

?><a href="http://api.vkontakte.ru/oauth/authorize?client_id=2446676&scope=offline,notify,friends,photos,audio,video&redirect_uri=http://localhost/vkPhpSdk/example&response_type=code&display=page">Login</a><br /><br /><?php

if(isset($_GET['code']))
{
	// Initialization
	$oauth2Proxy = new Oauth2Proxy('2446676', 'oawLNhZCTYRjEJ72ZdET', $_GET['code'], 'https://api.vkontakte.ru/oauth/access_token');
	$vkPhpSdk = new VkPhpSdk();
	$vkPhpSdk->setAccessToken($oauth2Proxy->getAccessToken());
	$vkPhpSdk->setUserId($oauth2Proxy->getUserId());
	
	// API call
	$result = $vkPhpSdk->api('photos.getAlbums', array('uid' => $vkPhpSdk->getUserId()));
	echo '<pre />';
	print_r($result);
}