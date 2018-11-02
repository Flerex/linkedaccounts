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

	/** @var \phpbb\config\config $config */
	protected $config;

	/** @var \phpbb\request\request $request */
	protected $request;

	/** @var \flerex\linkedaccounts\service\utils $utils */
	protected $utils;

	/** @var string $phpbb_root_path */
	protected $phpbb_root_path;

	/** @var string $phpEx */
	protected $phpEx;

	/**
	 * Constructor
	 *
	 * @param \phpbb\user							$user
	 * @param \phpbb\auth\auth						$auth
	 * @param \phpbb\config\config					$config
	 * @param \phpbb\request\request				$request
	 * @param \flerex\linkedaccounts\service\utils	$utils
	 * @param string								$phpbb_root_path
	 * @param string								$phpEx
	 */
	public function __construct(\phpbb\user $user, \phpbb\auth\auth $auth, \phpbb\config\config $config, \phpbb\request\request $request, \flerex\linkedaccounts\service\utils $utils, $phpbb_root_path, $phpEx)
	{
		$this->user				= $user;
		$this->auth				= $auth;
		$this->config			= $config;
		$this->request			= $request;
		$this->utils			= $utils;
		$this->phpbb_root_path	= $phpbb_root_path;
		$this->phpEx			= $phpEx;
	}

	/**
	 * Demo controller for route /switchaccount/{name}
	 *
	 * @param int $account_id
	 * @throws \phpbb\exception\http_exception
	 */
	public function handle($account_id)
	{

		$redirect = $this->config['flerex_linkedaccounts_return_to_index']
			? append_sid($this->phpbb_root_path . 'index.' . $this->phpEx)
			: append_sid($this->user->data['session_page']);

		if ($this->request->is_ajax())
		{

			if (!$this->auth->acl_get('u_switch_accounts'))
			{
				$data = array(
					'MESSAGE_TITLE'	=> $this->user->lang('ERROR'),
					'MESSAGE_TEXT'	=> $this->user->lang('NO_AUTH_OPERATION'),
				);
			}
			else if (!$this->utils->can_switch_to($account_id))
			{
				$data = array(
					'MESSAGE_TITLE'	=> $this->user->lang('ERROR'),
					'MESSAGE_TEXT'	=> $this->user->lang('INVALID_LINKED_ACCOUNT'),
				);
			}
            else
            {
                $data = array(
                    'SUCCESS'	=> true,
                );

                if ($this->config['flerex_linkedaccounts_return_to_index'])
                {
                    $data['REDIRECT'] = $redirect;
                }

                $this->utils->switch_to_linked_account($account_id);
            }

			$json_response = new \phpbb\json_response();
			$json_response->send($data);
		}
        else
        {
            if (!$this->auth->acl_get('u_switch_accounts'))
            {
                throw new \phpbb\exception\http_exception(403, 'NO_AUTH_OPERATION');
            }

            if (!$this->utils->can_switch_to($account_id))
            {
                throw new \phpbb\exception\http_exception(403, 'INVALID_LINKED_ACCOUNT', array($account_id));
            }

            $this->utils->switch_to_linked_account($account_id);
		
            meta_refresh(3, $redirect);
            throw new \phpbb\exception\http_exception(200, 'ACCOUNTS_SWITCHED');
        }
	}

}