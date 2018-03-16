<?php
/**
*
* Linked Accounts extension for phpBB 3.2
*
* @copyright (c) 2018 Flerex
* @license GNU General Public License, version 2 (GPL-2.0)
*
*/

namespace flerex\linkedaccounts\acp;

class main_info
{
	public function module()
	{
		return array(
			'filename'	=> '\flerex\linkedaccounts\acp\main_module',
			'title'		=> 'LINKED_ACCOUNTS',
			'modes'		=> array(
				'overview' => array(
					'title'	=> 'ADM_LINKED_ACCOUNTS_OVERVIEW',
					'auth'	=> 'ext_flerex/linkedaccounts && acl_a_link_accounts',
					'cat'	=> array('ADM_LINKED_ACCOUNTS'),
				),
				'management' => array(
					'title'	=> 'ADM_LINKED_ACCOUNTS_MANAGEMENT',
					'auth'	=> 'ext_flerex/linkedaccounts && acl_a_link_accounts',
					'cat'	=> array('ADM_LINKED_ACCOUNTS'),
				),
			),
		);
	}
}
