<?php
require_once dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'VkPhpSdk.php';
require_once dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'Oauth2Proxy.php';

?><a href="http://api.vkontakte.ru/oauth/authorize?client_id=2446676&scope=friends,video,offline&redirect_uri=http://localhost/vkPhpSdk/example&response_type=code">Login</a><br /><br /><?php

if(isset($_GET['code']))
{
	// Initialization
	$oauth2Proxy = new Oauth2Proxy('2446676', 'oawLNhZCTYRjEJ72ZdET', $_GET['code'], 'https://api.vkontakte.ru/oauth/access_token');
	$vkPhpSdk = new VkPhpSdk($oauth2Proxy);
	
	// API call
	$profiles = $vkPhpSdk->api('getProfiles ', array('uids' => '7132311,shvedaleksey'));
	var_dump($profiles);
}