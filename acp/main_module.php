<?php
/**
 *
 * Linked Accounts extension for phpBB 3.2
 *
 * @copyright (c) 2018 Flerex
 * @license       GNU General Public License, version 2 (GPL-2.0)
 *
 */

namespace flerex\linkedaccounts\acp;

class main_module
{

	const ACCOUNTS_PER_PAGE = 10;
	const FORM_KEY = 'flerex_linkedaccounts_ucp_management';

	public $u_action;
	public $tpl_name;
	public $page_title;


	/** @var \phpbb\config\config $config */
	protected $config;

	/** @var \phpbb\request\request $request */
	protected $request;

	/** @var \phpbb\template\template $template */
	protected $template;

	/** @var \phpbb\user $user */
	protected $user;

	/** @var \phpbb\language\language $language */
	protected $language;

	/** @var \phpbb\db\driver\factory $db  */
	protected $db;

	/** @var \flerex\linkedaccounts\service\utils $utils */
	protected $utils;

	/** @var string $phpbb_root_path */
	protected $phpbb_root_path;

	/** @var string $phpbb_container */
	protected $phpbb_container;

	/** @var string $phpEx */
	protected $phpEx;

	/** @var string $phpbb_admin_path */
	protected $phpbb_admin_path;

	public function main($id, $mode)
	{
		global $config, $request, $template, $user, $db, $phpbb_container;
		global $phpbb_root_path, $phpEx, $phpbb_admin_path;

		$this->config = $config;
		$this->request = $request;
		$this->template = $template;
		$this->user = $user;
		$this->db = $db;
		$this->phpEx = $phpEx;
		$this->phpbb_container = $phpbb_container;
		$this->phpbb_root_path = $phpbb_root_path;
		$this->phpbb_admin_path = $phpbb_admin_path;

		$this->utils = $this->phpbb_container->get('flerex.linkedaccounts.utils');
		$this->language = $this->phpbb_container->get('language');

		switch ($mode)
		{
			case 'overview':
			default:
				$this->tpl_name = 'acp_overview';
				$this->page_title = $this->language->lang('ADM_LINKED_ACCOUNTS_OVERVIEW');
				$this->mode_overview();
			break;

			case 'settings':
				$this->tpl_name = 'acp_settings';
				$this->page_title = $this->language->lang('ADM_LINKED_ACCOUNTS_SETTINGS');
				$this->mode_settings();
			break;

			case 'management':
				$this->tpl_name = 'acp_management';
				$this->page_title = $this->language->lang('ADM_LINKED_ACCOUNTS_MANAGEMENT');
				$this->mode_management();
			break;
		}
	}


	/**
	 * Controller for the overview mode
	 */
	private function mode_overview()
	{
		add_form_key(self::FORM_KEY);

		$start = $this->request->variable('start', 0);
		$limit = $this->request->variable('limit', main_module::ACCOUNTS_PER_PAGE);

		$accounts = $this->utils->get_accounts($start, $limit);
		foreach ($accounts as $account)
		{
			$this->template->assign_block_vars('accounts', array(
				'ID'         => $account['user_id'],
				'URL_EDIT'   => append_sid($this->phpbb_admin_path . 'index.' . $this->phpEx, 'i=users&amp;action=edit&amp;u=' . $account['user_id']),
				'USERNAME'   => get_username_string('no_profile', $account['user_id'], $account['username'], $account['user_colour']),
				'LINK_COUNT' => $account['link_count'],
			));
		}

		$pagination = $this->phpbb_container->get('pagination');
		$account_count = $this->utils->get_account_count();
		$pagination->generate_template_pagination($this->u_action, 'pagination', 'start', $account_count, $limit, $start);

		$this->template->assign_vars(array(
			'U_ACTION'              => str_replace('mode=overview', 'mode=management', $this->u_action),
			'LINKED_ACCOUNTS_COUNT' => $account_count,
			'LINK_COUNT'            => $this->utils->get_link_count(),
			'PAGE_NUMBER'           => $pagination->on_page($account_count, $limit, $start),
		));
	}

	/**
	 * Controller for the settings mode
	 */
	private function mode_settings()
	{

		$submit = $this->request->is_set_post('submit');

		$display_vars = array(

			'flerex_linkedaccounts_ajax' => array(
				'lang'     => 'CONF_AJAX',
				'validate' => 'bool',
				'type'     => 'radio:yes_no',
				'explain'  => true,
			),

			'flerex_linkedaccounts_return_to_index' => array(
				'lang'     => 'CONF_RETURN_TO_INDEX',
				'validate' => 'bool',
				'type'     => 'radio:yes_no',
				'explain'  => true,
			),

			'flerex_linkedaccounts_private_links' => array(
				'lang'     => 'CONF_PRIVATE_LINKS',
				'validate' => 'bool',
				'type'     => 'radio:yes_no',
				'explain'  => true,
			),

		);

		$new_config = clone $this->config;
		$cfg_array = $this->request->is_set('config') ? $this->request->variable('config', array('' => ''), true) : $new_config;
		$error = array();
		validate_config_vars($display_vars, $cfg_array, $error);

		add_form_key(self::FORM_KEY);

		if ($submit && !check_form_key(self::FORM_KEY))
		{
			$error[] = $this->language->lang('FORM_INVALID');
		}

		if (count($error))
		{
			$submit = false;
		}

		if ($submit)
		{
			foreach ($display_vars as $config_name => $data)
			{
				if (!isset($display_vars[$config_name]))
				{
					continue;
				}

				$new_config[$config_name] = $config_value = $cfg_array[$config_name];
				$this->config->set($config_name, $config_value);
			}
			trigger_error($this->language->lang('CONFIG_UPDATED') . adm_back_link($this->u_action), E_USER_NOTICE);
		}

		$this->template->assign_vars(array(
			'U_ACTION' => $this->u_action,
		));

		foreach ($display_vars as $config_key => $vars)
		{

			$type = explode(':', $vars['type']);

			$l_explain = '';
			if ($vars['explain'] && isset($vars['lang_explain']))
			{
				$l_explain = ($this->language->is_set([$vars['lang_explain']])) ? $this->language->lang($vars['lang_explain']) : $vars['lang_explain'];
			}
			else if ($vars['explain'])
			{
				$l_explain = ($this->language->is_set($vars['lang'] . '_EXPLAIN')) ? $this->language->lang($vars['lang'] . '_EXPLAIN') : '';
			}

			$content = build_cfg_template($type, $config_key, $new_config, $config_key, $vars);

			if (empty($content))
			{
				continue;
			}

			$this->template->assign_block_vars('options', array(
					'KEY'           => $config_key,
					'TITLE'         => $this->language->is_set([$vars['lang']])
						? $this->language->lang($vars['lang'])
						: $vars['lang'],
					'S_EXPLAIN'     => $vars['explain'],
					'TITLE_EXPLAIN' => $l_explain,
					'CONTENT'       => $content,
				)
			);

			unset($display_vars['vars'][$config_key]);

		}
	}

	/**
	 * Controller for the management mode
	 */
	private function mode_management()
	{

		add_form_key(self::FORM_KEY);

		if ($this->request->is_set_post('submituser'))
		{
			if (!check_form_key(self::FORM_KEY))
			{
				trigger_error('FORM_INVALID', E_USER_WARNING);
			}

			$username = utf8_clean_string($this->request->variable('account', '', true));
			$user_id = $this->request->variable('accountID', 0);

			if ($user_id || $username)
			{

				$user = $this->utils->get_user($user_id ?: $username);

				if (empty($user))
				{
					trigger_error($this->language->lang('NO_USER') . adm_back_link($this->u_action), E_USER_WARNING);
				}

				$this->tpl_name = 'acp_management_edit';

				$this->page_title = $this->language->lang('MANAGING_USER', get_username_string('username', $user['user_id'], $user['username'], $user['user_colour']));

				foreach ($this->utils->get_linked_accounts($user['user_id']) as $account)
				{
					$this->template->assign_block_vars('accounts', array(
						'ID'       => $account['user_id'],
						'USERNAME' => get_username_string('no_profile', $account['user_id'], $account['username'], $account['user_colour']),
						'URL_EDIT' => append_sid($this->phpbb_admin_path . 'index.' . $this->phpEx, 'i=users&amp;action=edit&amp;u=' . $account['user_id']),
						'DATE'     => $this->user->format_date($account['created_at']),
					));
				}

				$this->template->assign_vars(array(
					'EDITED_PAGE_TITLE' => $this->language->lang('MANAGING_USER', get_username_string('no_profile', $user['user_id'], $user['username'], $user['user_colour'])),
					'CURRENT_ACCOUNT'   => $user['user_id'],
					'U_FIND_USERNAME'   => append_sid($this->phpbb_root_path . 'memberlist.' . $this->phpEx, 'mode=searchuser&amp;form=usermanagement&amp;field=usernames'),
				));

				return;
			}

		}
		else if ($this->request->is_set_post('unlink'))
		{
			// the user we are currently managing
			$current_account = $this->request->variable('currentaccount', 0);

			if (!check_form_key(self::FORM_KEY) || $current_account == 0)
			{
				trigger_error('FORM_INVALID', E_USER_WARNING);
			}

			$keys = $this->request->variable('keys', array(''));


			if (!empty($keys))
			{
				$this->utils->remove_links($keys, $current_account);
			}
			trigger_error($this->language->lang('SUCCESSFUL_UNLINKING') . adm_back_link($this->u_action));


		}
		else if ($this->request->is_set_post('createlinks'))
		{
			// the user we are currently managing
			$current_account = $this->request->variable('currentaccount', 0);

			if (!check_form_key(self::FORM_KEY) || $current_account == 0)
			{
				trigger_error('FORM_INVALID', E_USER_WARNING);
			}

			$name_ary = $this->request->variable('usernames', '', true);

			if (!$name_ary)
			{
				trigger_error($this->language->lang('NO_USERS') . adm_back_link($this->u_action), E_USER_WARNING);
			}

			$name_ary = array_unique(explode("\n", $name_ary));

			include($this->phpbb_root_path . 'includes/functions_user.' . $this->phpEx);
			user_get_id_name($id_ary, $name_ary);

			$id_ary = array_diff($id_ary, $this->utils->get_linked_accounts_of_array($current_account, $id_ary));

			$this->utils->create_links($current_account, $id_ary);

			trigger_error($this->language->lang('SUCCESSFUL_MULTI_LINK_CREATION') . adm_back_link($this->u_action));

		}

		$this->template->assign_vars(array(
			'U_ACTION'        => $this->u_action,
			'U_FIND_USERNAME' => append_sid($this->phpbb_root_path . 'memberlist.' . $this->phpEx, 'mode=searchuser&amp;form=select_user&amp;field=account&amp;select_single=true'),
		));
	}


}
