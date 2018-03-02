<?php
/**
*
* @package phpBB Extension - Linked Accounts
* @copyright (c) 2018 Flerex
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace flerex\linkedaccounts\migrations;

class release_0_1_0_schemas extends \phpbb\db\migration\migration
{

	static public function depends_on()
	{
		return array('\phpbb\db\migration\data\v320\v320');
	}

	public function update_schema()
	{
		return array(
			'add_tables' => array(
				$this->table_prefix . 'flerex_linkedaccounts' => array(
					'COLUMNS' => array(
						'user_id' => array('UINT', null, 'auto_increment'),
						'linked_user_id' => array('VCHAR:255', ''),
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
