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

class release_1_3_0_data extends \phpbb\db\migration\migration
{

	static public function depends_on()
	{
		return array('\flerex\linkedaccounts\migrations\release_1_2_0_data');
	}

	/**
	 * Populate phpBB's tables with some needed
	 * data for Linked Accounts to work with
	 * features added on version 1.3.0
	 */
	public function update_data()
	{
		return array(
			array('config.add', array('flerex_linkedaccounts_preserve_admin_session', 0)),
		);
	}
}
