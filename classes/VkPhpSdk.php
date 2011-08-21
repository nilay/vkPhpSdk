<?php
if (!function_exists('curl_init'))
	throw new Exception('VkPhpSdk needs the CURL PHP extension.');
if (!function_exists('json_decode'))
	throw new Exception('VkPhpSdk needs the JSON PHP extension.');

/**
 * VkPhpSdk class
 *
 * @author Andrey Geonya <manufacturer.software@gmail.com>
 */
class VkPhpSdk
{
	/**
	 * Version.
	 */
	const VERSION = '1.0.0';
	
	/**
	 * Default options for curl.
	 */
	public static $CURL_OPTIONS = array(
		CURL_CONNECTTIMEOUT => 10,
		CURL_RETURNTRANSFER => true,
		CURL_TIMEOUT => 60,
		CURL_USERAGENT => 'vkontakte-php-1.0',
	);
	
	/**
	 * Maps aliases to Vkontakte domains.
	 */
	public static $DOMAIN_MAP = array(
		'api' => 'https://api.vkontakte.ru/method/',
		'www' => 'https://www.vkontakte.ru/',
	);	
}