<?php
require_once dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'VkPhpSdk.php';
require_once dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'Oauth2Proxy.php';

// Init OAuth 2.0 proxy
$oauth2Proxy = new Oauth2Proxy(
	'2446676',
	'oawLNhZCTYRjEJ72ZdET',
	'http://api.vkontakte.ru/oauth/authorize?client_id=2446676&scope=offline,notify,friends,photos,audio,video&redirect_uri=http://localhost/vkPhpSdk/example&response_type=code&display=page',
	'https://api.vkontakte.ru/oauth/access_token'
);

// Try to authorize client
if($oauth2Proxy->authorize() === true)
{
	// Init vk.com SDK
	$vkPhpSdk = new VkPhpSdk();
	$vkPhpSdk->setAccessToken($oauth2Proxy->getAccessToken());
	$vkPhpSdk->setUserId($oauth2Proxy->getUserId());

	// API call
	$result = $vkPhpSdk->api('getProfiles', array('uids' => $vkPhpSdk->getUserId()));
	echo '<pre />';
	print_r($result);		
}