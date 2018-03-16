<?php
/**
*
* Linked Accounts extension for phpBB 3.2
*
* @copyright (c) 2018 Flerex
* @license GNU General Public License, version 2 (GPL-2.0)
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

	const MODULE_BASENAME = '-flerex-linkedaccounts-ucp-main_module';

	public $u_action;
	public $tpl_name;
	public $page_title;


	protected $config;
	protected $request;
	protected $template;
	protected $user;
	protected $db;

	protected $table_prefix;
	protected $phpbb_root_path;
	protected $phpbb_container;
	protected $phpExt;

	protected $linkedacconts_table;

	protected $utils;

	public function main($id, $mode)
	{
		global $config, $request, $template, $user, $db, $phpbb_container;
		global $table_prefix, $phpbb_root_path, $phpEx;
		
		$this->config 				= $config;
		$this->request 				= $request;
		$this->template 			= $template;
		$this->user 				= $user;
		$this->db 					= $db;
		$this->phpEx 				= $phpEx;
		$this->table_prefix 		= $table_prefix;
		$this->phpbb_container 		= $phpbb_container;
		$this->phpbb_root_path 		= $phpbb_root_path;
		$this->linkedacconts_table 	= $this->table_prefix . 'flerex_linkedaccounts';

		$this->utils				= $this->phpbb_container->get('flerex.linkedaccounts.utils');

		switch($mode)
		{
			case 'management':
				$this->tpl_name = 'ucp_management';
				$this->page_title = $this->user->lang('LINKED_ACCOUNTS_MANAGEMENT');
				break;

			case 'link':
				$this->tpl_name = 'ucp_link';
				$this->page_title = $this->user->lang('LINKING_ACCOUNT');
				break;

		}
		
		$this->{'mode_' . $mode}();
	
	}

	

	/**
	 * Controller for the linking mode
	 */
	private function mode_link()
	{
		add_form_key('flerex_linkedaccounts_ucp_link');

		$template_vars = array(
			'U_ACTION'			=> $this->u_action,
			'U_FIND_USERNAME'	=> append_sid("{$this->phpbb_root_path}memberlist.$this->phpEx", "mode=searchuser&amp;form=ucp&amp;field=username&amp;select_single=1"),
		);

		if ($this->request->is_set_post('link'))
		{
			$errors = array();

			if (!check_form_key('flerex_linkedaccounts_ucp_link'))
			{
				trigger_error('FORM_INVALID', E_USER_WARNING);
			}
			
			$username = $this->request->variable('username', '', true);
			$password = $this->request->variable('password', '', true);
			$cur_password = $this->request->variable('cur_password', '', true);

			$passwords_manager = $this->phpbb_container->get('passwords.manager');

			if(!(empty($password) && empty($cur_password) && empty($username)))
			{
				if(empty($cur_password))
				{
					$errors[] = $this->user->lang('CUR_PASSWORD_EMPTY');
				}
				else if (!$passwords_manager->check($cur_password, $this->user->data['user_password']))
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
				else
				{
					$user = $this->utils->get_user_auth_info($username);

					if (!$user || !$passwords_manager->check($password, $user['user_password'])) {
						$errors[] = $this->user->lang('INCORRECT_LINKED_ACCOUNT_CREDENTIALS');
					}
					else if($user['user_type'] == 1)
					{
						$errors[] = $this->user->lang('INACTIVE_ACCOUNT');
					}
					else if($this->user->check_ban($user['user_id'], false, $user['user_email'], true) !== false) // we set $return to true because otherwise if the account to link was banned we would be kicked out of the current account
					{
						$errors[] = $this->user->lang('BANNED_ACCOUNT');
					}
					else if($this->utils->already_linked($user['user_id']))
					{
						$errors[] = $this->user->lang('ALREADY_LINKED');
					}
				}

				if(count($errors))
				{
					$template_vars['ERROR'] = implode('<br />', $errors);
				}
				else
				{
					$this->utils->create_link($this->user->data['user_id'], $user['user_id']);
					redirect(append_sid($this->phpbb_root_path . 'ucp.' . $this->phpEx, 'i=' . main_module::MODULE_BASENAME . '&amp;mode=management'));					
				}

			}

		}


		$this->template->assign_vars($template_vars);

	}


	/**
	 * Controller for the management mode
	 */
	private function mode_management()
	{
		add_form_key('flerex_linkedaccounts_ucp_management');

		if ($this->request->is_set_post('unlink'))
		{
			if (!check_form_key('flerex_linkedaccounts_ucp_management'))
			{
				trigger_error('FORM_INVALID', E_USER_WARNING);
			}

			$keys = $this->request->variable('keys', array(''));

			if(!empty($keys))
			{
				$this->utils->remove_links($keys);
			}

		}

		foreach($this->utils->get_linked_accounts() as $linked_account)
		{
			$this->template->assign_block_vars('linkedaccounts', array(
				'ID' 					=> $linked_account['user_id'],
				'NAME'					=> get_username_string('full', $linked_account['user_id'], $linked_account['username'], $linked_account['user_colour']),
				'DATE' 					=> $this->user->format_date($linked_account['created_at']),
			));
		}

		$this->template->assign_vars(array(
			'U_ACTION'			=> $this->u_action,
			'U_LINK_ACCOUNT'	=> append_sid($this->phpbb_root_path . 'ucp.' . $this->phpEx, 'i=' . main_module::MODULE_BASENAME . '&amp;mode=link'),
		));
	}

}
