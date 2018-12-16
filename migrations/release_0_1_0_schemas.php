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

class release_0_1_0_schemas extends \phpbb\db\migration\migration
{

	/**
	 * This migration depends on phpBB's v320 migration
	 * already being installed.
	 */
	static public function depends_on()
	{
		return array('\phpbb\db\migration\data\v320\v320');
	}

	/**
	 * Linked Lists table initialization
	 */
	public function update_schema()
	{
		return array(
			'add_tables' => array(
				$this->table_prefix . 'flerex_linkedaccounts' => array(
					'COLUMNS'     => array(
						'user_id'        => array('UINT', 0),
						'linked_user_id' => array('UINT', 0),
						'created_at'     => array('TIMESTAMP', 0),
					),
					'PRIMARY_KEY' => array('user_id', 'linked_user_id'),
				),
			),
		);
	}

	public function revert_schema()
	{
		return array(
			'drop_tables' => array(
				$this->table_prefix . 'flerex_linkedaccounts',
			),
		);
	}
}
