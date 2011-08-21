<?php
require_once dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR . 'interfaces' . DIRECTORY_SEPARATOR . 'IOauth2Proxy.php';

/**
 * Oauth2Proxy class file.
 *
 * @author Andrey Geonya <manufacturer.software@gmail.com>
 * @link http://novy.tv/
 * @copyright Copyright &copy; 2011-2012 MMVI Novyj kanal
 */

/**
 * Oauth2Proxy is the proxy class.
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

	public function __construct($clientId, $clientSecret, $code, $accessTokenUrl)
	{
		$this->_clientId = $clientId;
		$this->_clientSecret = $clientSecret;
		$this->_code = $code;
		$this->_accessTokenUrl = $accessTokenUrl;
	}

	public function getAccessToken()
	{
		if ($this->_accessParams === null)
			$this->_accessParams = json_decode($this->getAccessJsonParams(), true);
		return $this->_accessParams['access_token'];
	}

	protected function getAccessJsonParams()
	{
		return file_get_contents("$this->_accessTokenUrl?client_id=$this->_clientId&client_secret=$this->_clientSecret&code=$this->_code");
	}
}