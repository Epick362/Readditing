<?php
/**
 * Reddit OAuth2 Provider
 *
 * @package    CodeIgniter/OAuth2
 * @category   Provider
 * @author     Phil Sturgeon
 * @copyright  (c) 2012 HappyNinjas Ltd
 * @license    http://philsturgeon.co.uk/code/dbad-license
 */

class OAuth2_Provider_Reddit extends OAuth2_Provider
{
	protected $scope = array('identity');

	public function url_authorize()
	{
		return 'https://ssl.reddit.com/api/v1/authorize';
	}

	public function url_access_token()
	{
		return 'https://ssl.reddit.com/api/v1/access_token';
	}

	public function get_user_info(OAuth2_Token_Access $token)
	{
		$url = 'https://oauth.reddit.com/api/v1/me.json';
	    $ch = curl_init();
	    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
	    curl_setopt($ch, CURLOPT_HEADER, array('Authorization: bearer '.$token->access_token));
	    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
	    curl_setopt($ch, CURLOPT_URL, $url);
	    curl_setopt($ch, CURLOPT_REFERER, $url);
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
	    $result = curl_exec($ch);
	    curl_close($ch);
	    return $result;
	}
}
