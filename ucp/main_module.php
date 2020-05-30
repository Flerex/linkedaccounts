<?php
/**
 *
 * Linked Accounts extension for phpBB 3.2
 *
 * @copyright (c) 2018 Flerex
 * @license       GNU General Public License, version 2 (GPL-2.0)
 *
 */

namespace flerex\linkedaccounts\ucp;

// Required by EPV
if (!defined('IN_PHPBB'))
{
	exit;
}

class main_module
{
	public $u_action;
	public $tpl_name;
	public $page_title;


	protected $config;
	protected $request;
	protected $template;
	protected $user;
	protected $db;
	protected $captcha;

	protected $phpbb_root_path;
	protected $phpbb_container;
	protected $phpEx;

	protected $linking_service;
	protected $auth_service;

	protected $module_basename;
	protected $passwords_manager;

	/**
	 * @param $id
	 * @param $mode
	 */
	public function main($id, $mode): void
	{
		global $config, $request, $template, $user, $db, $phpbb_container;
		global $phpbb_root_path, $phpEx;

		$this->config = $config;
		$this->request = $request;
		$this->template = $template;
		$this->user = $user;
		$this->db = $db;
		$this->phpEx = $phpEx;
		$this->phpbb_container = $phpbb_container;
		$this->phpbb_root_path = $phpbb_root_path;

		$this->linking_service = $this->phpbb_container->get('flerex.linkedaccounts.linking_service');
		$this->auth_service = $this->phpbb_container->get('flerex.linkedaccounts.auth_service');
		$this->captcha = $this->phpbb_container->get('captcha.factory');
		$this->module_basename = str_replace('\\', '-', $id);
		$this->passwords_manager = $this->phpbb_container->get('passwords.manager');

		switch ($mode)
		{
			case 'management':
			default:
				$this->tpl_name = 'ucp_management';
				$this->page_title = $this->user->lang('LINKED_ACCOUNTS_MANAGEMENT');
				$this->mode_management();
			break;

			case 'link':
				$this->tpl_name = 'ucp_link';
				$this->page_title = $this->user->lang('LINKING_ACCOUNT');
				$this->mode_link();
			break;
		}

	}

	/**
	 * Controller for the management mode
	 *
	 * @return void
	 */
	private function mode_management(): void
	{
		add_form_key('flerex_linkedaccounts_ucp_management');

		if ($this->request->is_set_post('unlink'))
		{
			if (!check_form_key('flerex_linkedaccounts_ucp_management'))
			{
				trigger_error('FORM_INVALID', E_USER_WARNING);
			}

			$keys = $this->request->variable('keys', array(''));

			if (!empty($keys))
			{
				$this->linking_service->remove_links($keys);
			}

		}

		foreach ($this->linking_service->get_linked_accounts() as $linked_account)
		{
			$this->template->assign_block_vars('linkedaccounts', array(
				'ID'   => $linked_account['user_id'],
				'NAME' => get_username_string('full', $linked_account['user_id'], $linked_account['username'],
					$linked_account['user_colour']),
				'DATE' => $this->user->format_date($linked_account['created_at']),
			));
		}

		$this->template->assign_vars(array(
			'U_ACTION'       => $this->u_action,
			'U_LINK_ACCOUNT' => $this->u_action . '&amp;mode=link',
		));
	}

	/**
	 * Controller for the linking mode
	 *
	 * @return void
	 */
	private function mode_link(): void
	{
		add_form_key('flerex_linkedaccounts_ucp_link');

		$this->template->assign_vars([
			'U_ACTION'        => $this->u_action,
			'U_FIND_USERNAME' => append_sid("{$this->phpbb_root_path}memberlist.$this->phpEx",
				"mode=searchuser&amp;form=ucp&amp;field=username&amp;select_single=1"),
		]);

		// Handle the POST request
		if ($this->request->is_set_post('link'))
		{
			if (!check_form_key('flerex_linkedaccounts_ucp_link'))
			{
				trigger_error('FORM_INVALID', E_USER_WARNING);
			}

			$this->linking_request();
		}
	}

	/**
	 * Takes care of the POST request for the linking functionality.
	 */
	private function linking_request()
	{
		$username = $this->request->variable('username', '', true);

		// We find whether there are errors on the fields themselves or regarding the current user.
		$errors = $this->get_form_errors();
		if (count($errors))
		{
			$this->template->assign_vars($errors);
			return;
		}

		// Now that we know the user we are tying to link is real, we retrieve its data.
		$user = $this->auth_service->get_user_auth_info($username);


		// Once the form is well formed (no pun intended), if the login attempts are exceeded, we show and check the CAPTCHA.
		$wrong_captcha = $this->with_captcha($user);
		if ($wrong_captcha)
		{
			return;
		}

		// We ensure that we can login into that account. The password might not match, the account might be banned…
		$errors = $this->get_auth_errors($user);
		if (count($errors))
		{
			$this->add_login_attempts($username, $user['user_id']);
			$this->assign_errors($errors);
			return;
		}

		// Remove previous attempts, create link and redirect.
		$this->remove_login_attempts($username, $user);
		$this->linking_service->create_link($this->user->data['user_id'], $user['user_id']);
		redirect($this->u_action . '&amp;mode=management');

	}

	/**
	 * Returns a list of errors related to the current user and the form itself.
	 *
	 * @return array
	 */
	private function get_form_errors(): array
	{

		$errors = array();

		$username = $this->request->variable('username', '', true);
		$password = $this->request->variable('password', '', true);
		$cur_password = $this->request->variable('cur_password', '', true);

		if (empty($cur_password))
		{
			$errors[] = $this->user->lang('CUR_PASSWORD_EMPTY');
		}
		else if (!$this->passwords_manager->check($cur_password, $this->user->data['user_password']))
		{
			$errors[] = $this->user->lang('CUR_PASSWORD_ERROR');
		}

		if (empty($username) || empty($password))
		{
			$errors[] = $this->user->lang('EMPTY_FIELDS');
		}
		else if (utf8_clean_string($username) == $this->user->data['username_clean'])
		{
			$errors[] = $this->user->lang('SAME_ACCOUNT');
		}

		return $errors;
	}

	/**
	 * Returns a list of errors related to the ability to log in to the account to be linked.
	 *
	 * @param array $user The user data of the account to be linked
	 * @return array
	 */
	private function get_auth_errors(array $user): array
	{
		$password = $this->request->variable('password', '', true);

		$errors = [];

		if (!$user)
		{
			$errors[] = $this->user->lang('INCORRECT_LINKED_ACCOUNT_CREDENTIALS');
		}
		else if (!$this->passwords_manager->check($password, $user['user_password']))
		{
			$errors[] = $this->user->lang('INCORRECT_LINKED_ACCOUNT_CREDENTIALS');
		}
		else if ($user['user_type'] == 1)
		{
			$errors[] = $this->user->lang('INACTIVE_ACCOUNT');
		}
		/*
		 * we set $return to true because otherwise if the account to link was banned
		 * we would be kicked out of the current account
		 */
		else if ($this->user->check_ban($user['user_id'], false, $user['user_email'], true) !== false)
		{
			$errors[] = $this->user->lang('BANNED_ACCOUNT');
		}
		else if ($this->linking_service->already_linked($user['user_id']))
		{
			$errors[] = $this->user->lang('ALREADY_LINKED');
		}

		return $errors;
	}


	/**
	 * Assigns an array with errors to the template.
	 *
	 * @param array $errors
	 */
	private function assign_errors(array $errors): void
	{
		$this->template->assign_vars([
			'ERROR' => implode('<br />', $errors),
		]);
	}


	/**
	 * Returns whether the form should show a CAPTCHA.
	 *
	 * @param array $user
	 */
	private function form_needs_captcha(array $user): bool
	{

		$attempts = $this->auth_service->get_ip_login_attempts();

		return $this->config['ip_login_limit_max'] && $attempts >= $this->config['ip_login_limit_max']
			|| $this->config['max_login_attempts'] && $user['user_login_attempts'] >= $this->config['max_login_attempts'];
	}


	/**
	 * Creates a captcha and sets the CAPTCHA mode, sending the necessary data to the template.
	 */
	private function create_captcha()
	{
		// We also create a new captcha to be filled by the user
		$captcha = $this->captcha->get_instance($this->config['captcha_plugin']);
		$captcha->init(CONFIRM_LOGIN);

		$this->template->assign_vars([
			'CAPTCHA_TEMPLATE' => $captcha->get_template(),
			'ERROR'            => $this->user->lang('LOGIN_ERROR_ATTEMPTS'),
		]);

		return $captcha;
	}


	/**
	 * Manages all the captcha process for the current session by login attemtps to the given user.
	 *
	 * Returns true if the captcha was needed and was not introduced correctly.
	 *
	 * @param $user
	 * @return bool
	 */
	private function with_captcha($user): bool
	{
		if ($this->form_needs_captcha($user))
		{
			$captcha = $this->create_captcha();

			if ($captcha->validate())
			{
				return true; // Captcha is wrong!
			}

			// We reset the CAPTCHA so that future sending of the form has to complete a new one.
			$captcha->reset();

		}
		return false;
	}

	/**
	 * Adds a new login attempt for the given user.
	 *
	 * @param string $username
	 * @param int    $user_id
	 */
	private function add_login_attempts(string $username, int $user_id)
	{
		$this->auth_service->add_ip_login_attempt($username, $user_id);
		$this->auth_service->add_login_attempt_for_user($user_id);
	}

	/**
	 * Adds a new login attempt for the given user.
	 *
	 * @param string $username
	 * @param array  $user
	 */
	private function remove_login_attempts(string $username, array $user)
	{
		$this->auth_service->remove_ip_login_attempt_for_user($user['user_id']);
		if ($user['user_login_attempts'] != 0)
		{
			$this->auth_service->restore_login_attempt_for_user($user['user_id']);
		}
	}
}
