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

	/** @var \phpbb\template\template */
	protected $template;

	/** @var \phpbb\user */
	protected $user;

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
	 * @param \phpbb\user							$user
	 * @param \phpbb\template\template				$template
	 * @param \phpbb\controller\helper				$helper
	 * @param \flerex\linkedaccounts\service\utils	$utils
	 */
	public function __construct(\phpbb\user $user, \phpbb\template\template $template, \phpbb\controller\helper $helper, \flerex\linkedaccounts\service\utils $utils)
	{
		$this->template	= $template;
		$this->user		= $user;
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
		foreach($this->utils->get_linked_accounts() as $linked_account)
		{
			$this->template->assign_block_vars('switchable_account', array(
				'SWITCH_LINK'	=> $this->helper->route('flerex_linkedaccounts_switch', array('account_id' => $linked_account['user_id'])),
				'AVATAR'		=> phpbb_get_user_avatar($linked_account),
				'NAME'			=> get_username_string('no_profile', $linked_account['user_id'], $linked_account['username'], $linked_account['user_colour']),
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