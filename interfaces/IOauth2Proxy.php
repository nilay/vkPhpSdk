<?php
/**
 * IOauth2Proxy interface file.
 *
 * This source file is subject to the New BSD License
 * that is bundled with this package in the file license.txt.
 * 
 * @author Andrey Geonya <manufacturer.software@gmail.com>
 * @link https://github.com/AndreyGeonya/vkPhpSdk
 * @copyright Copyright &copy; 2011-2012 Andrey Geonya
 */

/**
 * Oauth2Proxy is the OAuth 2.0 proxy interface.
 * Redirects requests to the external web resource by OAuth 2.0 protocol.
 *
 * @see http://oauth.net/2/
 * @author Andrey Geonya
 */
interface IOauth2Proxy
{
	/**
	 * Constructor.
	 * 
	 * @param string $clientId Id of the client application
	 * @param string $clientSecret id of the application secret key
	 * @param string $code code that must be returned from service provider
	 * @param string $accessTokenUrl access token url
	 */
	public function __construct($clientId, $clientSecret, $code, $accessTokenUrl);
	
	/**
	 * Get access token.
	 * 
	 * @return string
	 */
	public function getAccessToken();
	
	/**
	 * Get expires time.
	 * 
	 * @return string
	 */
	public function getExpiresIn();
	
	/**
	 * Get user id.
	 * 
	 * @return string
	 */
	public function getUserId();
}