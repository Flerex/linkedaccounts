<?php
/**
*
* Linked Accounts extension for phpBB 3.2
*
* @copyright (c) 2018 Flerex
* @license GNU General Public License, version 2 (GPL-2.0)
*
*/

namespace flerex\linkedaccounts\controller;

use \Symfony\Component\HttpFoundation\Response;

class switcher
{
	/** @var \phpbb\user */
	protected $user;

	/** @var \phpbb\auth\auth $auth */
	protected $auth;

	/** @var \phpbb\request\request $request */
	protected $request;

	/** @var \flerex\linkedaccounts\service\utils $utils */
	protected $utils;

	/**
	 * Constructor
	 *
	 * @param \flerex\linkedaccounts\service\utils $utils
	 */
	public function __construct(\phpbb\user $user, \phpbb\auth\auth $auth, \phpbb\request\request $request, \flerex\linkedaccounts\service\utils $utils)
	{
		$this->user			= $user;
		$this->auth			= $auth;
		$this->request		= $request;
		$this->utils		= $utils;
	}

	/**
	 * Demo controller for route /demo/{name}
	 *
	 * @param int $account_id
	 * @throws \phpbb\exception\http_exception
	 */
	public function handle($account_id)
	{

		if ($this->request->is_ajax())
		{

			$data = array(
				'SUCCESS' => true,
			);

			if(!$this->auth->acl_get('u_link_accounts'))
			{
				$data = array(
					'MESSAGE_TITLE'	=> $this->user->lang('ERROR'),
					'MESSAGE_TEXT'	=> $this->user->lang('NO_AUTH_OPERATION'),
				);
			}

			if (!$this->utils->can_switch_to($account_id))
			{
				$data = array(
					'MESSAGE_TITLE'	=> $this->user->lang('ERROR'),
					'MESSAGE_TEXT'	=> $this->user->lang('INVALID_LINKED_ACCOUNT'),
				);
			}
			
			$this->utils->switch_to_linked_account($account_id);

			$json_response = new \phpbb\json_response();
			$json_response->send($data);
		}

		if (!$this->auth->acl_get('u_link_accounts'))
		{
			throw new \phpbb\exception\http_exception(403, 'NO_AUTH_OPERATION');
		}

		if (!$this->utils->can_switch_to($account_id))
		{
			throw new \phpbb\exception\http_exception(403, 'INVALID_LINKED_ACCOUNT', array($account_id));
		}

		// Obtain the session's page before switching accounts (otherwise it would be overriten)
		$session_page = $this->user->data['session_page'];

		$this->utils->switch_to_linked_account($account_id);
		
		meta_refresh(3, $session_page);
		throw new \phpbb\exception\http_exception(200, 'ACCOUNTS_SWITCHED');

	}

}