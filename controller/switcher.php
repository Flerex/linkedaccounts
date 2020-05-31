<?php
/**
 *
 * Linked Accounts extension for phpBB 3.2
 *
 * @copyright (c) 2018 Flerex
 * @license       GNU General Public License, version 2 (GPL-2.0)
 *
 */

namespace flerex\linkedaccounts\controller;

use flerex\linkedaccounts\service\linking_service;
use phpbb\auth\auth;
use phpbb\config\config;
use phpbb\controller\helper;
use phpbb\exception\http_exception;
use phpbb\json_response;
use phpbb\request\request;
use phpbb\symfony_request;
use phpbb\user;
use \Symfony\Component\HttpFoundation\Response;

class switcher
{
	/** @var user */
	protected $user;

	/** @var auth $auth */
	protected $auth;

	/** @var config $config */
	protected $config;

	/** @var request $request */
	protected $request;

	/* @var symfony_request $symfony_request */
	protected $symfony_request;

	/** @var helper $helper */
	protected $helper;

	/** @var linking_service $linking_service */
	protected $linking_service;

	/** @var string $phpbb_root_path */
	protected $phpbb_root_path;

	/** @var string $phpEx */
	protected $phpEx;

	/**
	 * Constructor
	 *
	 * @param user            $user
	 * @param auth            $auth
	 * @param config          $config
	 * @param request         $request
	 * @param symfony_request $symfony_request
	 * @param helper          $helper
	 * @param linking_service $linking_service
	 * @param string          $phpbb_root_path
	 * @param string          $phpEx
	 */
	public function __construct(user $user, auth $auth, config $config, request $request, symfony_request $symfony_request,
		helper $helper, linking_service $linking_service, string $phpbb_root_path, string $phpEx)
	{
		$this->user = $user;
		$this->auth = $auth;
		$this->config = $config;
		$this->request = $request;
		$this->symfony_request = $symfony_request;
		$this->helper = $helper;
		$this->linking_service = $linking_service;
		$this->phpbb_root_path = $phpbb_root_path;
		$this->phpEx = $phpEx;
	}

	/**
	 * Demo controller for route /switchaccount/{name}
	 *
	 * @param int $account_id
	 * @return Response
	 * @throws http_exception
	 */
	public function handle(int $account_id)
	{
		if ($this->request->is_ajax())
		{

			if (!$this->auth->acl_get('u_switch_accounts'))
			{
				$data = array(
					'MESSAGE_TITLE' => $this->user->lang('ERROR'),
					'MESSAGE_TEXT'  => $this->user->lang('NO_AUTH_OPERATION'),
				);
			}
			else if (!$this->linking_service->can_switch_to($account_id))
			{
				$data = array(
					'MESSAGE_TITLE' => $this->user->lang('ERROR'),
					'MESSAGE_TEXT'  => $this->user->lang('INVALID_LINKED_ACCOUNT'),
				);
			}
			else
			{
				$data = array(
					'SUCCESS' => true,
				);

				$data['REFRESH_DATA'] = [
					'url'  => $this->get_redirect_path(),
					'time' => 0,
				];

				$this->linking_service->switch_to_linked_account($account_id);
			}

			$json_response = new json_response();
			$json_response->send($data);
		}

		if (!$this->auth->acl_get('u_switch_accounts'))
		{
			throw new http_exception(403, 'NO_AUTH_OPERATION');
		}

		if (!$this->linking_service->can_switch_to($account_id))
		{
			throw new http_exception(403, 'INVALID_LINKED_ACCOUNT', array($account_id));
		}

		$this->linking_service->switch_to_linked_account($account_id);

		meta_refresh(3, $this->get_redirect_path());

		return $this->helper->message('ACCOUNTS_SWITCHED');
	}

	/**
	 * Returns the path of the page that the current user's session
	 * is at.
	 *
	 * If mod_rewrite is enabled, a well-formed URL taking the rewrite
	 * into account is returned instead.
	 *
	 * @return string
	 */
	private function get_session_page(): string
	{
		$session_page = $this->user->data['session_page'];
		$rewrite_helper = 'app.php/';
		$len = strlen($rewrite_helper);

		// If mod_rewrite is enabled and the session page is rewritable (/app.php/whatever) then we correct it.
		if ($this->config['enable_mod_rewrite'] && substr($session_page, 0, $len) === $rewrite_helper)
		{
			return substr($session_page, $len);
		}

		return $session_page;
	}

	/**
	 * Generates the URL that the user will be redirected to
	 * once the account switching is finished.
	 *
	 * @return string
	 */
	private function get_redirect_path(): string
	{
		$script_path = rtrim($this->config['script_path'], '/')  . '/';
		$script_name = $this->symfony_request->getScriptName();
		$page_name = substr($script_name, -1, 1) == '/' ? '' : utf8_basename($script_name);

		if ($page_name !== 'app.php')
		{
			$script_path .= '/';
		}

		$redirect = $this->config['flerex_linkedaccounts_return_to_index']
			? append_sid($script_path . 'index.' . $this->phpEx)
			: append_sid($script_path . $this->get_session_page());

		return $redirect;
	}

}