<?php

namespace flerex\linkedaccounts\ucp;

class main_module
{

	protected const MODULE_BASENAME = '-flerex-linkedaccounts-ucp-main_module';

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

		if ($this->request->is_set_post('link'))
		{
			if (!check_form_key('flerex_linkedaccounts_ucp_link'))
			{
				trigger_error('FORM_INVALID');
			}
			
			$username = $this->request->variable('username', '', true);
			$password = $this->request->variable('password', '', true);
			$cur_password = $this->request->variable('cur_password', '', true);

			$passwords_manager = $this->phpbb_container->get('passwords.manager');

			if(!(empty($password) && empty($cur_password) && empty($username)))
			{
				if(empty($cur_password))
				{
					trigger_error('CUR_PASSWORD_EMPTY');
				}

				if (!$passwords_manager->check($cur_password, $this->user->data['user_password'])) {
					trigger_error('CUR_PASSWORD_ERROR');
				}

				if (empty($username) || empty($password))
				{
					trigger_error('EMPTY_FIELDS');
				}

				if (utf8_clean_string($username) == $this->user->data['username_clean'])
				{
					trigger_error('SAME_ACCOUNT');
				}

				$sql = 'SELECT user_id, user_password, user_email, user_type
					FROM ' . USERS_TABLE . '
					WHERE username_clean = \'' . $this->db->sql_escape(utf8_clean_string($username)) . '\'';

				$result = $this->db->sql_query($sql);
				$row = $this->db->sql_fetchrow($result);

				if (!$row || !$passwords_manager->check($password, $row['user_password'])) {
					trigger_error('INCORRECT_LINKED_ACCOUNT_CREDENTIALS');
				}
				else if($row['user_type'] == 1)
				{
					trigger_error('INACTIVE_ACCOUNT');
				}
				else if($this->user->check_ban($row['user_id'], false, $row['user_email'], true) !== false) // we set $return to true because otherwise if the account to link was banned we would be kicked out of the current account
				{
					trigger_error('BANNED_ACCOUNT');
				}
				else if($this->already_linked($row['user_id']))
				{
					trigger_error('ALREADY_LINKED' . adm_back_link($this->u_action), E_USER_ERROR);
				}
				else
				{
					var_dump($row);
					$sql = 'INSERT INTO ' . $this->linkedacconts_table . '
					VALUES (' . $this->user->data['user_id'] . ', ' . $row['user_id'] . ', ' . (int) time() . ')';
					$this->db->sql_query($sql);
					redirect(append_sid($this->phpbb_root_path . 'ucp.' . $this->phpEx, 'i=' . main_module::MODULE_BASENAME . '&amp;mode=management'));
				}
				$this->db->sql_freeresult($result);
			}

		}


		$this->template->assign_vars(array(
			'U_ACTION' => $this->u_action,
			'U_FIND_USERNAME'	=> append_sid("{$this->phpbb_root_path}memberlist.$this->phpEx", "mode=searchuser&amp;form=ucp&amp;field=username&amp;select_single=1"),
		));

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
				trigger_error('FORM_INVALID');
			}

			$keys = $this->request->variable('keys', array(''));

			if(!empty($keys))
			{
				$this->remove_links($keys);
			}

		}

		foreach($this->get_linked_accounts() as $linked_account)
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

	/**
	 * Obtain a list of the accounts linked
	 * to the current user.
	 *
	 * @return array An array of (int) IDs
	 */
	private function get_linked_accounts()
	{

		$sql = 'SELECT u.user_id, u.user_colour, u.username, u.user_avatar, u.user_avatar_type, u.user_avatar_height, u.user_avatar_width, l.created_at
			FROM ' . USERS_TABLE . ' u
			LEFT JOIN ' . $this->linkedacconts_table . ' l
			ON u.user_id = l.linked_user_id
			WHERE l.user_id = ' . (int) $this->user->data['user_id'] . '
			UNION
			SELECT u.user_id, u.user_colour, u.username, u.user_avatar, u.user_avatar_type, u.user_avatar_height, u.user_avatar_width, l.created_at
			FROM ' . USERS_TABLE . ' u
			LEFT JOIN ' . $this->linkedacconts_table . ' l
			ON u.user_id = l.user_id
			WHERE l.linked_user_id = ' . (int) $this->user->data['user_id'];
		
		$result = $this->db->sql_query($sql);

		$output = array();
		while ($row = $this->db->sql_fetchrow($result))
		{
			$output[] = $row;
		}

		$this->db->sql_freeresult($result);

		return $output;
	}

	/**
	 * Unlinks the given accounts from the current user
	 *
	 * @param array $links An array with the accounts IDs
	 * @return array An array of (int) IDs
	 *
	 */
	private function remove_links($links)
	{

		$sql_where = '';
		$len = count($links);
		foreach($links as $key => $account)
		{
			$sql_where .= '(user_id = ' . (int) $this->db->sql_escape($account) . ' OR linked_user_id = ' . (int) $this->db->sql_escape($account) . ')';

			if($key != $len - 1)
			{
				$sql_where .= ' OR ';
			}
		}

		$sql = 'DELETE FROM ' . $this->linkedacconts_table . '
			WHERE (user_id = ' . (int) $this->user->data['user_id'] . ' OR linked_user_id = ' . (int) $this->user->data['user_id'] . ')
			AND (' . $sql_where . ')';

		$this->db->sql_query($sql);

	}
/**
	 * Checks whether the account is already linked to the account
	 * trying to be linking to
	 *
	 * @param int $linked_id The id of the account to be linked
	 * @return bool
	 *
	 */
	private function already_linked($linked_id)
	{

		$sql = 'SELECT COUNT(user_id) AS already_linked FROM ' . $this->linkedacconts_table . '
			WHERE (user_id = ' . (int) $this->user->data['user_id'] . ' AND linked_user_id = ' . (int) $this->db->sql_escape($linked_id) . ')
			OR (user_id = ' . (int) $this->db->sql_escape($linked_id) . ' AND linked_user_id = ' . (int) $this->user->data['user_id'] . ')';

		$result = $this->db->sql_query($sql);
		$found_something = $this->db->sql_fetchfield('already_linked') != 0;

		$this->db->sql_freeresult($result);
		return $found_something;

	}

}
