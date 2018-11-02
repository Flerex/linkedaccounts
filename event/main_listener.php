<?php
/**
*
* Linked Accounts extension for phpBB 3.2
*
* @copyright (c) 2018 Flerex
* @license GNU General Public License, version 2 (GPL-2.0)
*
*/

namespace flerex\linkedaccounts\event;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class main_listener implements EventSubscriberInterface
{

	/** @var \phpbb\auth\auth */
	protected $auth;

	/** @var \phpbb\config\config */
	protected $config;

	/** @var \phpbb\template\template */
	protected $template;

	/** @var \phpbb\controller\helper */
	protected $helper;

	/** @var \flerex\linkedaccounts\service\utils */
	protected $utils;

	/**
	 * Assign functions defined in this class to event listeners in the core
	 *
	 * @return array
	 */
	static public function getSubscribedEvents()
	{
		return array(
			'core.user_setup'			=> 'load_language_on_setup',
			'core.permissions'			=> 'add_permissions',
			'core.page_header'			=> 'add_switchable_accounts',
			'core.delete_user_after'	=> 'cleanup_table',
		);
	}

	/**
	 * Constructor
	 *
	 * @param \phpbb\auth\auth						$auth
	 * @param \phpbb\config\config					$config
	 * @param \phpbb\template\template				$template
	 * @param \phpbb\controller\helper				$helper
	 * @param \flerex\linkedaccounts\service\utils	$utils
	 */
	public function __construct(\phpbb\auth\auth $auth, \phpbb\config\config $config, \phpbb\template\template $template, \phpbb\controller\helper $helper, \flerex\linkedaccounts\service\utils $utils)
	{
		$this->auth		= $auth;
		$this->config	= $config;
		$this->template	= $template;
		$this->helper	= $helper;
		$this->utils	= $utils;
	}

	/**
	 * Load the Linked Accounts language file
	 *	 flerex/linkedaccounts/language/en/common.php
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

		foreach($linked_accounts as $linked_account)
		{
			$this->template->assign_block_vars('switchable_account', array(
				'SWITCH_LINK'	=> $this->helper->route('flerex_linkedaccounts_switch', array('account_id' => $linked_account['user_id'])),
				'AVATAR'		=> phpbb_get_user_avatar($linked_account),
				'NAME'			=> get_username_string('no_profile', $linked_account['user_id'], $linked_account['username'], $linked_account['user_colour']),
				'S_AJAX'		=> $this->config['flerex_linkedaccounts_ajax'],
			));
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
}