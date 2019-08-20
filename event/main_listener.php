<?php
/**
 *
 * Linked Accounts extension for phpBB 3.2
 *
 * @copyright (c) 2018 Flerex
 * @license       GNU General Public License, version 2 (GPL-2.0)
 *
 */

namespace flerex\linkedaccounts\event;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class main_listener implements EventSubscriberInterface
{

	/** @var \phpbb\auth\auth */
	protected $auth;

	/** @var \phpbb\user */
	protected $user;

	/** @var \phpbb\request\request */
	protected $request;

	/** @var \phpbb\config\config */
	protected $config;

	/** @var \phpbb\template\template */
	protected $template;

	/** @var \phpbb\controller\helper */
	protected $helper;

	/** @var \flerex\linkedaccounts\service\utils */
	protected $utils;

	/** @var string */
	protected $root_path;

	/** @var string */
	protected $php_ext;


	/**
	 * Used for the posting_as feature to hold the value of the old $user global variable when overriding it
	 * to trick phpBB it's posting as another user.
	 *
	 * @var array
	 */
	protected $user_backup;

	/**
	 * Constructor
	 *
	 * @param \phpbb\auth\auth                     $auth
	 * @param \phpbb\user                          $user
	 * @param \phpbb\request\request               $request
	 * @param \phpbb\config\config                 $config
	 * @param \phpbb\template\template             $template
	 * @param \phpbb\controller\helper             $helper
	 * @param \flerex\linkedaccounts\service\utils $utils
	 * @param string                               $root_path
	 * @param string                               $php_ext
	 */
	public function __construct(\phpbb\auth\auth $auth, \phpbb\user $user, \phpbb\request\request $request, \phpbb\config\config $config, \phpbb\template\template $template, \phpbb\controller\helper $helper, \flerex\linkedaccounts\service\utils $utils, $root_path, $php_ext)
	{
		$this->auth = $auth;
		$this->user = $user;
		$this->request = $request;
		$this->config = $config;
		$this->template = $template;
		$this->helper = $helper;
		$this->utils = $utils;
		$this->root_path = $root_path;
		$this->php_ext = $php_ext;
	}

	/**
	 * Assign functions defined in this class to event listeners in the core
	 *
	 * @return array
	 */
	static public function getSubscribedEvents()
	{
		return array(
			'core.user_setup'                   => 'load_language_on_setup',
			'core.permissions'                  => 'add_permissions',
			'core.page_header'                  => 'add_switchable_accounts',
			'core.delete_user_after'            => 'cleanup_table',
			'core.posting_modify_template_vars' => 'posting_as_template',
			'core.modify_posting_parameters'    => array('posting_as_logic', PHP_INT_MAX),
			'core.modify_posting_auth'          => 'posting_as_error_override',
			'core.memberlist_view_profile'      => 'profile_linked_accounts_list',
		);
	}

	/**
	 * Load the Linked Accounts language file
	 *     flerex/linkedaccounts/language/en/common.php
	 *
	 * @param \phpbb\event\data $event The event object
	 */
	public function load_language_on_setup($event)
	{

		$lang_set_ext = $event['lang_set_ext'];
		$lang_set_ext[] = array(
			'ext_name' => 'flerex/linkedaccounts',
			'lang_set' => 'common',
		);
		$event['lang_set_ext'] = $lang_set_ext;

	}

	/**
	 * Make phpBB aware of Linked Accounts' permissions
	 *
	 * @param \phpbb\event\data $event The event object
	 */
	public function add_permissions($event)
	{
		$permissions = $event['permissions'];
		$permissions['u_switch_accounts'] = array('lang' => 'ACL_U_SWITCH_ACCOUNTS', 'cat' => 'profile');
		$permissions['u_link_accounts'] = array('lang' => 'ACL_U_LINK_ACCOUNTS', 'cat' => 'profile');
		$permissions['a_link_accounts'] = array('lang' => 'ACL_A_LINK_ACCOUNTS', 'cat' => 'user_group');
		$permissions['u_post_as_account'] = array('lang' => 'ACL_U_POST_AS_ACCOUNT', 'cat' => 'post');
		$permissions['u_view_other_users_linked_accounts'] = array('lang' => 'ACL_U_VIEW_OTHER_USERS_LINKED_ACCOUNTS', 'cat' => 'profile');
		$event['permissions'] = $permissions;
	}

	/**
	 * Create global variables with the switched accounts
	 * to be used on the template event
	 *
	 * @param \phpbb\event\data $event The event object
	 */
	public function add_switchable_accounts($event)
	{

		$can_switch = $this->auth->acl_get('u_switch_accounts');

		$linked_accounts = $this->utils->get_linked_accounts();

		if (!$can_switch && $this->config['flerex_linkedaccounts_private_links'])
		{
			$linked_accounts = array();
		}

		$this->template->assign_var('U_CAN_SWITCH_ACCOUNT', $can_switch);

		foreach ($linked_accounts as $linked_account)
		{
			$this->template->assign_block_vars('switchable_account', array(
				'SWITCH_LINK' => $this->helper->route('flerex_linkedaccounts_switch', array('account_id' => $linked_account['user_id'])),
				'AVATAR'      => phpbb_get_user_avatar($linked_account),
				'NAME'        => get_username_string('no_profile', $linked_account['user_id'], $linked_account['username'], $linked_account['user_colour']),
			));

			$this->template->assign_var('S_LINKEDACCOUNTS_AJAX', $this->config['flerex_linkedaccounts_ajax']);
		}

	}

	/**
	 * Remove all links of a user when it is being deleted
	 *
	 * @param \phpbb\event\data $event The event object
	 */
	public function cleanup_table($event)
	{
		$this->utils->remove_links($event['user_ids']);
	}

	/**
	 * Add the template variables necessary for
	 *  the posting as menu.
	 *
	 * @param \phpbb\event\data $event The event object
	 */
	public function posting_as_template($event)
	{

		// The “posting as” feature is only available when creating posting, replying or quoting
		if ($event['mode'] != 'post' && $event['mode'] != 'reply' && $event['mode'] != 'quote')
		{
			return;
		}

		// The user must have permission
		$post_as_permission = $this->auth->acl_get('u_post_as_account');
		$this->template->assign_var('U_CAN_POST_AS_ACCOUNT', $post_as_permission);

		if (!$post_as_permission)
		{
			return;
		}


		$default_value = $this->user->data['user_id'];

		// If the user previews the post, we keep the selected value set in the dropdown
		$poster_id = $this->request->variable('posting_as', $default_value);

		$this->template->assign_block_vars('available_accounts', array(
			'ID'   => $this->user->data['user_id'],
			'NAME' => get_username_string('username', $this->user->data['user_id'], $this->user->data['username'], $this->user->data['user_colour']),
			'ATTR' => $poster_id == $default_value ? ' selected' : '',
		));

		/*
		 * Get from the linked accounts of the user, those accounts that:
		 *     - Can create a topic in this forum (if we are creating a topic)
		 *     - Can reply to a post in this forum (if we are replying to a topic)
		 *     - Are accessible (are not banned or inactive)
		*/
		$available_accounts = array_filter($this->utils->get_linked_accounts(), function ($user) use ($event) {
			return $this->utils->can_switch_to($user['user_id'])
				&& $this->utils->user_can_post_on_forum(
					$user['user_id'],
					$event['post_data']['forum_id'],
					$event['mode'],
					$event['mode'] == 'post'
				);
		});

		// Don't show the “posting as” menu if you don't have any account link
		$this->template->assign_var('U_CAN_POST_AS_ACCOUNT', count($available_accounts) > 0);

		foreach ($available_accounts as $account)
		{
			$this->template->assign_block_vars('available_accounts', array(
				'ID'   => $account['user_id'],
				'NAME' => get_username_string('username', $account['user_id'], $account['username'], $account['user_colour']),
				'ATTR' => $poster_id == $account['user_id'] ? ' selected' : '',
			));
		}
	}

	/**
	 * Implement the logic behind the “posting
	 * as” menu.
	 *
	 * @param \phpbb\event\data $event The event object
	 */
	public function posting_as_logic($event)
	{
		$default_value = $this->user->data['user_id'];

		// Retrieve the account selected from the dropdown menu
		$poster_id = $this->request->variable('posting_as', $default_value);

		if (!$this->auth->acl_get('u_post_as_account') // user must have permissions
			|| $poster_id == $default_value // “poster as” should be changed
			|| !$this->utils->can_switch_to($poster_id) // the new account should be linked && login-able (not banned, inactive, etc.)
		)
		{
			return;
		}

		/*
		 * We don't reassign the previous values because we want posting.php think that it's the other user. This
		 * means that if there's another extension modifying some posting functionality in any of the events, it will
		 * correctly trigger the events thinking is that other user.
		 *
		 * Moreover, once posting.php is finished, loading phpBB again from another file will again recompute the data
		 * for the correct user stored in the cookie, so changes will be overridden anyway.
		 *
		 * The only exception where we will reassign $user and $auth is when there was an error in posting.php, so the
		 * error is shown as the current user (e.g. if we didn't do this and there was a error when posting without permissions
		 * the navbar would show the wrong user's username).
		 *
		 */

		$this->user_backup = $this->user->data;


		$userdata = $this->utils->get_user($poster_id);

		$this->user->data = array_merge($this->user->data, $userdata);
		$this->auth->acl($userdata);
	}

	/**
	 * Override errors in posting.php that might return a page that looks like it's authed with another user
	 * because of posting_as_logic's $auth and $user overrides.
	 *
	 * @param \phpbb\event\data $event The event object
	 */
	public function posting_as_error_override($event)
	{
		if (!$event['is_authed'])
		{
			// We are back to the actual user doing the action
			$this->user->data = $this->user_backup;
			$this->auth->acl($this->user->data);
		}
	}

	/**
	 * Show list of linked accounts in every user profile.
	 *
	 * @param \phpbb\event\data $event The event object
	 */
	public function profile_linked_accounts_list($event)
	{
		// The user must have permission
		$this->template->assign_var('U_CAN_VIEW_LINKED_ACCOUNTS', $this->auth->acl_get('u_view_other_users_linked_accounts'));

		foreach ($this->utils->get_linked_accounts($event['member']['user_id']) as $account)
		{
			$user_rank_data = phpbb_get_user_rank($account, (($account['user_id'] == ANONYMOUS) ? false : $account['user_posts']));
			$this->template->assign_block_vars('linked_accounts', array(
				'ID'           => $account['user_id'],
				'USERNAME'     => get_username_string('full', $account['user_id'], $account['username'], $account['user_colour']),
				'AVATAR'       => phpbb_get_user_avatar($account),
				'RANK_TITLE'   => $user_rank_data['title'],
				'RANK_IMG'     => $user_rank_data['img'],
				'RANK_IMG_SRC' => $user_rank_data['img_src'],
			));
		}

	}
}