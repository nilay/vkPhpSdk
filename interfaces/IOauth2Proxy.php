<?php
/**
 * IOauth2Proxy interface file.
 *
 * @author Andrey Geonya <manufacturer.software@gmail.com>
 * @link http://crazycode.net/
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
	public function __construct($clientId, $clientSecret, $code, $accessTokenUrl);
	
	public function getAccessToken();
}