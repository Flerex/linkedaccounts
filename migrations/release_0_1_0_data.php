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

class release_0_1_0_data extends \phpbb\db\migration\migration
{

	static public function depends_on()
	{
		return array('\flerex\linkedaccounts\migrations\release_0_1_0_schemas');
	}

	/**
	 * Populate phpBB's tables with some needed
	 * data for Linked Accounts to work
	 */
	public function update_data()
	{
		return array(

			array('module.add', array('ucp', 0, 'LINKED_ACCOUNTS')),

			// Add main_module to the parent module (UCP_PROFILE)
			array('module.add', array(
				'ucp',
				'LINKED_ACCOUNTS',
				array(
					'module_basename' => '\flerex\linkedaccounts\ucp\main_module',
					'modes'           => array('management', 'link'),
				),
			)),

			// Create a new “can link accounts” permission
			array('permission.add', array('u_link_accounts')),
			// set it to yes in the Stantard User role and Registered user group
			array('permission.permission_set', array('REGISTERED', 'u_link_accounts', 'group')),
			array('permission.permission_set', array('ROLE_USER_STANDARD', 'u_link_accounts')),
		);
	}
}
