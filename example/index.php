<?php
require_once dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'VkPhpSdk.php';
require_once dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'Oauth2Proxy.php';

// Init OAuth 2.0 proxy
$oauth2Proxy = new Oauth2Proxy(
	'2446676',											// client id
	'oawLNhZCTYRjEJ72ZdET',								// client secret
	'https://api.vkontakte.ru/oauth/access_token',		// access token url
	'http://api.vkontakte.ru/oauth/authorize',			// dialog url
	'code',												// response type
	'http://localhost/vkPhpSdk/example',				// redirect url
	'offline,notify,friends,photos,audio,video'			// scope
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