VKontakte PHP SDK
=================

The VK Platform http://vk.com/developers.php is a set of APIs that make your
application more social.

Usage
-----

To create a new instance of VkPhpSdk:

<?php
require_once dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'VkPhpSdk.php';
require_once dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'Oauth2Proxy.php';

?><a href="http://api.vkontakte.ru/oauth/authorize?client_id=2446676&scope=offline,notify,friends,photos,audio,video&redirect_uri=http://localhost/vkPhpSdk/example&response_type=code&display=page">Login</a><br /><br /><?php

if(isset($_GET['code']))
{
	// Initialization
	$oauth2Proxy = new Oauth2Proxy('2446676', 'oawLNhZCTYRjEJ72ZdET', $_GET['code'], 'https://api.vkontakte.ru/oauth/access_token');
	$vkPhpSdk = new VkPhpSdk($oauth2Proxy);
	
	// API call
	$profiles = $vkPhpSdk->api('photos.getAlbums', array('uid' => '7132311'));
	var_dump($profiles);
}

Feedback
--------

Use GitHub issues tracker to report bugs and issues
https://github.com/mordehaigerman/VKontakte-PHP-SDK/issues.

License
-------

The VKontakte PHP SDK is released under the New BSD License.