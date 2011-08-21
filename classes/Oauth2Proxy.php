<?php
/**
 * IOauth2Proxy class file.
 *
 * This source file is subject to the New BSD License
 * that is bundled with this package in the file license.txt.
 * 
 * @author Andrey Geonya <manufacturer.software@gmail.com>
 * @link https://github.com/AndreyGeonya/vkPhpSdk
 * @copyright Copyright &copy; 2011-2012 Andrey Geonya
 * @license http://www.opensource.org/licenses/bsd-license.php
 */

require_once dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR . 'interfaces' . DIRECTORY_SEPARATOR . 'IOauth2Proxy.php';

/**
 * Oauth2Proxy is the OAuth 2.0 proxy class.
 * Redirects requests to the external web resource by OAuth 2.0 protocol.
 *
 * @see http://oauth.net/2/
 * @author Andrey Geonya
 */
class Oauth2Proxy implements IOauth2Proxy
{
	private $_clientId;
	private $_clientSecret;
	private $_code;
	private $_accessTokenUrl;
	private $_accessParams;

	/**
	 * Constructor.
	 * 
	 * @param string $clientId Id of the client application
	 * @param string $clientSecret id of the application secret key
	 * @param string $code code that must be returned from service provider
	 * @param string $accessTokenUrl access token url
	 */	
	public function __construct($clientId, $clientSecret, $code, $accessTokenUrl)
	{
		$this->_clientId = $clientId;
		$this->_clientSecret = $clientSecret;
		$this->_code = $code;
		$this->_accessTokenUrl = $accessTokenUrl;
	}

	/**
	 * Get access token.
	 * 
	 * @return string
	 */
	public function getAccessToken()
	{
		if ($this->_accessParams === null)
			$this->_accessParams = json_decode($this->getAccessJsonParams(), true);
		return $this->_accessParams['access_token'];
	}

	/**
	 * Get expires time.
	 * 
	 * @return string
	 */
	public function getExpiresIn()
	{
		if ($this->_accessParams === null)
			$this->_accessParams = json_decode($this->getAccessJsonParams(), true);
		return $this->_accessParams['expires_in'];
	}
	
	/**
	 * Get user id.
	 * 
	 * @return string
	 */
	public function getUserId()
	{
		if ($this->_accessParams === null)
			$this->_accessParams = json_decode($this->getAccessJsonParams(), true);
		return $this->_accessParams['user_id'];		
	}

	/**
	 * Get access params from service provider.
	 * 
	 * @return string params in JSON format
	 */
	protected function getAccessJsonParams()
	{
		return file_get_contents("$this->_accessTokenUrl?client_id=$this->_clientId&client_secret=$this->_clientSecret&code=$this->_code");
	}
}