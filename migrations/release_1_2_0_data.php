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

class release_1_2_0_data extends \phpbb\db\migration\migration
{

	static public function depends_on()
	{
		return array('\flerex\linkedaccounts\migrations\release_1_1_0_data');
	}

	/**
	 * Populate phpBB's tables with some needed
	 * data for Linked Accounts to work with
	 * features added on version 1.1.4
	 */
	public function update_data()
	{
		return array(

			// Create a new “can post as another account” permission
			array('permission.add', array('u_post_as_account')),

			// set it to yes in the Standard User role and Registered user group
			array('permission.permission_set', array('REGISTERED', 'u_post_as_account', 'group')),
			array('permission.permission_set', array('ROLE_USER_STANDARD', 'u_post_as_account')),

			// Create a new “can view another user’s linked accounts” permission
			array('permission.add', array('u_view_other_users_linked_accounts')),

			// set it to yes for Full admin, Standard admin, User-Group admin, Full moderator and Standard moderator roles and Administrators and Moderator suser groups
			array('permission.permission_set', array('ADMINISTRATORS', 'u_view_other_users_linked_accounts', 'group')),
			array('permission.permission_set', array('GLOBAL_MODERATORS', 'u_view_other_users_linked_accounts', 'group')),
			array('permission.permission_set', array('ROLE_ADMIN_USERGROUP', 'u_view_other_users_linked_accounts')),
			array('permission.permission_set', array('ROLE_ADMIN_STANDARD', 'u_view_other_users_linked_accounts')),
			array('permission.permission_set', array('ROLE_ADMIN_FULL', 'u_view_other_users_linked_accounts')),
			array('permission.permission_set', array('ROLE_MOD_FULL', 'u_view_other_users_linked_accounts')),
			array('permission.permission_set', array('ROLE_MOD_STANDARD', 'u_view_other_users_linked_accounts')),

			/*
			 * Full admin and User-Group admin roles can manage user’s linked accounts by default.
			 *
			 * See release_0_2_0_data.php where the standard role is already set the permission.
			 */
			array('permission.permission_set', array('ROLE_ADMIN_FULL', 'a_link_accounts')),
			array('permission.permission_set', array('ROLE_ADMIN_USERGROUP', 'a_link_accounts')),
		);
	}
}
