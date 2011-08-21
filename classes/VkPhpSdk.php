<?php
/**
 * VkPhpSdk class file.
 *
 * @author Andrey Geonya <manufacturer.software@gmail.com>
 * @link https://github.com/AndreyGeonya/vkPhpSdk
 * @copyright Copyright &copy; 2011-2012 Andrey Geonya
 */

if (!function_exists('curl_init'))
	throw new Exception('VkPhpSdk needs the CURL PHP extension.');
if (!function_exists('json_decode'))
	throw new Exception('VkPhpSdk needs the JSON PHP extension.');

require_once 'VkApiException.php';

/**
 * VkPhpSdk class.
 * Provides access to the Vkontakte Platform.
 *
 * @see http://vkontakte.ru/developers.php
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
	public static $curlOptions = array(
		CURLOPT_CONNECTTIMEOUT => 10,
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_TIMEOUT => 60,
		CURLOPT_USERAGENT => 'vkontakte-php-1.0',
	);

	/**
	 * Maps aliases to Vkontakte domains.
	 */
	public static $domainMap = array(
		'api' => 'https://api.vkontakte.ru/method/',
		'www' => 'http://www.vkontakte.ru/',
	);
	
	private $_oauth2Proxy;

	private $_curlConnection;
	
	/**
	 * Constructor.
	 * 
	 * @param IOauth2Proxy $oauth2Proxy OAuth 2.0 proxy object 
	 */
	public function __construct(IOauth2Proxy $oauth2Proxy)
	{
		$this->_oauth2Proxy = $oauth2Proxy;
	}

	/**
	 * Get user id.
	 * 
	 * @return string
	 */
	public function getUserId()
	{
		return $this->_oauth2Proxy->getUserId();
	}

	/**
	 * Makes a call to VK API.
	 *
	 * @param string $method The API method name
	 * @param array $params The API call parameters
	 * 
	 * @return array decoded response
	 * 
	 * @throws VkApiException
	 */
	public function api($method, array $params = null)
	{
		$result = json_decode($this->makeCurlRequest($method, $params), true);
		
		$this->validateApiResult($result);
		
		return $result;
	}
		
	/**
	 * Make request to service provider (by cURL) and return response.
	 * 
	 * @param string $method The API method name
	 * @param array $params The API call parameters
	 * 
	 * @return string
	 * 
	 * @throws VkApiException
	 */
	protected function makeCurlRequest($method, array $params = null)
	{
		if($this->_curlConnection === null)
			$this->_curlConnection = curl_init();
		
		if(is_array($params))
			self::$curlOptions[CURLOPT_POSTFIELDS] = http_build_query($params, null, '&');
		self::$curlOptions[CURLOPT_URL] = self::$domainMap['api'] . $method;		
		
		curl_setopt_array($this->_curlConnection, self::$curlOptions);
			
		$result = curl_exec($this->_curlConnection);

		if ($result === false)
		{
			$exception = new VkApiException(array(
						'error_code' => curl_errno($this->_curlConnection),
						'error_msg' => curl_error($this->_curlConnection),
						'error_type' => 'CurlException'
					));
			curl_close($this->_curlConnection);
			throw $exception;
		}
		
		curl_close($this->_curlConnection);
		
		return $result;		
	}
	
    /**
	 * Validate the API result array.
	 *
	 * @return true
	 * 
	 * @throws VkApiException
	 */
	protected function validateApiResult(array $result)
	{
		if (is_array($result) && isset($result['error']))
			throw new VkApiException($result['error']);
		
		return true;
	}
}