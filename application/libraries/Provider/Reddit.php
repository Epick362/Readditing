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
		return 'https://ssl.reddit.com/';
	}

	public function url_access_token()
	{
		return 'https://oauth.reddit.com/';
	}

	public function get_user_info(OAuth2_Token_Access $token)
	{
		// Create a response from the request
		return array(
			'uid' => $token->access_token,
		);
	}
}
