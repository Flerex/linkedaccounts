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

class switcher
{
	/** @var \phpbb\user */
	protected $user;

	/** @var \phpbb\auth\auth $auth */
	protected $auth;

	/** @var \phpbb\config\config $config */
	protected $config;

	/** @var \phpbb\request\request $request */
	protected $request;

	/** @var \phpbb\controller\helper $helper */
	protected $helper;

	/** @var \flerex\linkedaccounts\service\utils $utils */
	protected $utils;

	/** @var string $phpbb_root_path */
	protected $phpbb_root_path;

	/** @var string $phpEx */
	protected $phpEx;

	/**
	 * Constructor
	 *
	 * @param \phpbb\user                          $user
	 * @param \phpbb\auth\auth                     $auth
	 * @param \phpbb\config\config                 $config
	 * @param \phpbb\request\request               $request
	 * @param \phpbb\controller\helper             $helper
	 * @param \flerex\linkedaccounts\service\utils $utils
	 * @param string                               $phpbb_root_path
	 * @param string                               $phpEx
	 */
	public function __construct(\phpbb\user $user, \phpbb\auth\auth $auth, \phpbb\config\config $config, \phpbb\request\request $request, \phpbb\controller\helper $helper, \flerex\linkedaccounts\service\utils $utils, string $phpbb_root_path, string $phpEx)
	{
		$this->user = $user;
		$this->auth = $auth;
		$this->config = $config;
		$this->request = $request;
		$this->helper = $helper;
		$this->utils = $utils;
		$this->phpbb_root_path = $phpbb_root_path;
		$this->phpEx = $phpEx;
	}

	/**
	 * Demo controller for route /switchaccount/{name}
	 *
	 * @param int $account_id
	 * @return \Symfony\Component\HttpFoundation\Response
	 * @throws \phpbb\exception\http_exception
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
			else if (!$this->utils->can_switch_to($account_id))
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

				$this->utils->switch_to_linked_account($account_id);
			}

			$json_response = new \phpbb\json_response();
			$json_response->send($data);
		}

		if (!$this->auth->acl_get('u_switch_accounts'))
		{
			throw new \phpbb\exception\http_exception(403, 'NO_AUTH_OPERATION');
		}

		if (!$this->utils->can_switch_to($account_id))
		{
			throw new \phpbb\exception\http_exception(403, 'INVALID_LINKED_ACCOUNT', array($account_id));
		}

		$this->utils->switch_to_linked_account($account_id);

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
	private function get_session_page() : string
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
	private function get_redirect_path() : string
	{
		$script_path = $this->config['script_path'];

		// If the script path is not the root folder, we need to add a forward slash to build well-formed paths.
		if ($script_path !== '/')
		{
			$script_path .= '/';
		}

		$redirect = $this->config['flerex_linkedaccounts_return_to_index']
			? append_sid($script_path . 'index.' . $this->phpEx)
			: append_sid($script_path . $this->get_session_page());

		return $redirect;
	}

}