<?php
/**
 *
 * Linked Accounts extension for phpBB 3.2
 *
 * @copyright (c) 2018 Flerex
 * @license       GNU General Public License, version 2 (GPL-2.0)
 *
 */

namespace flerex\linkedaccounts\migrations;

class release_0_2_0_data extends \phpbb\db\migration\migration
{

	static public function depends_on()
	{
		return array('\flerex\linkedaccounts\migrations\release_0_1_0_schemas');
	}

	/**
	 * Populate phpBB's tables with some needed
	 * data for Linked Accounts to work with
	 * features added on version 0.2.0
	 */
	public function update_data()
	{
		return array(

			array('module.add', array('acp', 'ACP_CAT_DOT_MODS', 'ADM_LINKED_ACCOUNTS')),

			// Add main_module to the parent module (ACP_CAT_DOT_MODS)
			array('module.add', array(
				'acp',
				'ADM_LINKED_ACCOUNTS',
				array(
					'module_basename' => '\flerex\linkedaccounts\acp\main_module',
					'modes'           => array('overview', 'management'),
				),
			)),

			// Create a new “can manage user's linked accounts” permission
			array('permission.add', array('a_link_accounts')),
			// set it to yes in the Stantard Admin role and Administrators groups
			array('permission.permission_set', array('ADMINISTRATORS', 'a_link_accounts', 'group')),
			array('permission.permission_set', array('ROLE_ADMIN_STANDARD', 'a_link_accounts')),
			array('permission.permission_set', array('ROLE_ADMIN_FULL', 'a_link_accounts')),
			array('permission.permission_set', array('ROLE_ADMIN_USERGROUP', 'a_link_accounts')),
		);
	}
}
