<?php
/**
*
* Linked Accounts extension for phpBB 3.2
*
* @copyright (c) 2018 Flerex
* @license GNU General Public License, version 2 (GPL-2.0)
*
*/

namespace flerex\linkedaccounts\acp;

class main_module
{

	const ACCOUNTS_PER_PAGE = 10;

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
		global $table_prefix, $phpbb_root_path, $phpEx, $phpbb_admin_path;
		
		$this->config 				= $config;
		$this->request 				= $request;
		$this->template 			= $template;
		$this->user 				= $user;
		$this->db 					= $db;
		$this->phpEx 				= $phpEx;
		$this->table_prefix 		= $table_prefix;
		$this->phpbb_container 		= $phpbb_container;
		$this->phpbb_root_path 		= $phpbb_root_path;
		$this->phpbb_admin_path 	= $phpbb_admin_path;
		$this->linkedacconts_table 	= $this->table_prefix . 'flerex_linkedaccounts';

		$this->utils				= $this->phpbb_container->get('flerex.linkedaccounts.utils');

		switch($mode)
		{
			case 'overview':
			default:
				$this->tpl_name = 'acp_overview';
				$this->page_title = $this->user->lang('ADM_LINKED_ACCOUNTS_OVERVIEW');
				$this->mode_overview();
				break;

			case 'management':
				$this->tpl_name = 'acp_management';
				$this->page_title = $this->user->lang('ADM_LINKED_ACCOUNTS_MANAGEMENT');
				$this->mode_management();
				break;
		}		
	}


	/**
	 * Controller for the overview mode
	 */
	private function mode_overview()
	{
		add_form_key('flerex_linkedaccounts_ucp_management');

		$start = $this->request->variable('start', 0);
		$limit = $this->request->variable('limit', main_module::ACCOUNTS_PER_PAGE);

		$accounts = $this->utils->get_accounts($start, $limit);
		foreach($accounts as $account)
		{
			$this->template->assign_block_vars('accounts', array(
				'ID' 			=> $account['user_id'],
				'URL_EDIT'		=> append_sid($this->phpbb_admin_path . 'index.' . $this->phpEx, 'i=users&amp;action=edit&amp;u=' . $account['user_id']),
				'USERNAME'		=> get_username_string('no_profile', $account['user_id'], $account['username'], $account['user_colour']),
				'LINK_COUNT' 	=> $account['link_count'],
			));
		}

		$pagination = $this->phpbb_container->get('pagination');		
		$account_count = $this->utils->get_account_count();
		$pagination -> generate_template_pagination($this->u_action, 'pagination', 'start', $account_count, $limit, $start);
		
		$this->template->assign_vars(array(
			'U_ACTION'				=> str_replace('mode=overview', 'mode=management', $this->u_action),
			'LINKED_ACCOUNTS_COUNT'	=> $account_count,
			'LINK_COUNT'			=> $this->utils->get_link_count(),
			'PAGE_NUMBER'			=> $pagination->on_page($account_count, $limit, $start),
		));
	}
	/**
	 * Controller for the management mode
	 */
	private function mode_management()
	{
		add_form_key('flerex_linkedaccounts_ucp_management');

		if ($this->request->is_set_post('submituser'))
		{
			if (!check_form_key('flerex_linkedaccounts_ucp_management'))
			{
				trigger_error('FORM_INVALID', E_USER_WARNING);
			}

			$username = utf8_clean_string($this->request->variable('account', '', true));
			$user_id = $this->request->variable('accountID', 0);

			if($user_id || $username)
			{

				$user = $this->utils->get_user($user_id ?: $username);

				if(empty($user))
				{
					trigger_error($this->user->lang['NO_USER'] . adm_back_link($this->u_action), E_USER_WARNING);
				}
				
				$this->tpl_name = 'acp_management_edit';

				$title = sprintf($this->user->lang('MANAGING_USER'),
					get_username_string('no_profile', $user['user_id'], $user['username'], $user['user_colour']));
				
				$this->page_title = $title;

				foreach($this->utils->get_linked_accounts($user['user_id']) as $account)
				{
					$this->template->assign_block_vars('accounts', array(
						'ID' 		=> $account['user_id'],
						'USERNAME'	=> get_username_string('no_profile', $account['user_id'], $account['username'], $account['user_colour']),
						'URL_EDIT'	=> append_sid($this->phpbb_admin_path . 'index.' . $this->phpEx, 'i=users&amp;action=edit&amp;u=' . $account['user_id']),
						'DATE' 		=> $this->user->format_date($account['created_at']),
					));
				}

				$this->template->assign_vars(array(
					'PAGE_TITLE'		=> $title,
					'CURRENT_ACCOUNT'	=> $user['user_id'],
				));

				return;
			}

		}
		else if($this->request->is_set_post('unlink'))
		{
			if (!check_form_key('flerex_linkedaccounts_ucp_management'))
			{
				trigger_error('FORM_INVALID', E_USER_WARNING);
			}

			$keys = $this->request->variable('keys', array(''));
			$current_account = $this->request->variable('currentaccount', 0);

			if(!empty($keys))
			{
				$this->utils->remove_links($keys, $current_account);
			}
			trigger_error($this->user->lang('SUCCESSFUL_UNLINKING') . adm_back_link($this->u_action));


		}

		$this->template->assign_vars(array(
			'U_ACTION'			=> $this->u_action,
			'U_FIND_USERNAME'	=> append_sid($this->phpbb_root_path . 'memberlist.' . $this->phpEx, 'mode=searchuser&amp;form=select_user&amp;field=account&amp;select_single=true'),
		));
	}


}
