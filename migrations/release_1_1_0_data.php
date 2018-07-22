<?php
/**
*
* Linked Accounts extension for phpBB 3.2
*
* @copyright (c) 2018 Flerex
* @license GNU General Public License, version 2 (GPL-2.0)
*
*/

namespace flerex\linkedaccounts\migrations;

class release_1_1_0_data extends \phpbb\db\migration\migration
{

	static public function depends_on()
	{
		return array('\flerex\linkedaccounts\migrations\release_0_2_0_data');
	}

	/**
	 * Populate phpBB's tables with some needed
	 * data for Linked Accounts to work with
	 * features added on version 0.2.0
	 */
	public function update_data()
	{
		return array(

			// Remove the management module
			array('module.remove', array(
				'acp',
				'ADM_LINKED_ACCOUNTS',
				array(
					'module_basename' => '\flerex\linkedaccounts\acp\main_module',
					'modes' => array('management'),
				),
			)),

			// Add the settings and management module
			array('module.add', array(
				'acp',
				'ADM_LINKED_ACCOUNTS',
				array(
					'module_basename' => '\flerex\linkedaccounts\acp\main_module',
					'modes' => array('settings', 'management'), // We add again the management module so it is after settings
				),
			)),

			array('config.add', array('flerex_linkedaccounts_ajax', 1)),
			array('config.add', array('flerex_linkedaccounts_private_links', 0)),
			array('config.add', array('flerex_linkedaccounts_return_to_index', 0)),
		);
	}
}
