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
		$opts = array(
			'http' => array(
				'method' => 'GET',
				'header' => 'Authorization: Bearer '.$token->access_token
			)
		);
		$_default_opts = stream_context_get_params(stream_context_get_default());
		
		$opts = array_merge_recursive($_default_opts['options'], $opts);
		$context = stream_context_create($opts);
		$url = 'https://oauth.reddit.com/api/v1/me.json';

		$user = json_decode(file_get_contents($url,false,$context));

		// Create a response from the request
		return $user;
	}
}
