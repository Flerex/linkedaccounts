<?php
/**
 *
 * Linked Accounts extension for phpBB 3.2
 *
 * @copyright (c) 2018 Flerex
 * @author        Awide
 * @license       GNU General Public License, version 2 (GPL-2.0)
 *
 */

if (!defined('IN_PHPBB'))
{
	exit;
}

if (empty($lang) || !is_array($lang))
{
	$lang = array();
}

$lang = array_merge($lang, array(

	'ACL_U_SWITCH_ACCOUNTS'                  => 'Megválthat fiókokat',
	'ACL_U_LINK_ACCOUNTS'                    => 'Párosíthat fiókokat',
	'ACL_A_LINK_ACCOUNTS'                    => 'Kezelhet fiók párosításokat',
	'ACL_U_POST_AS_ACCOUNT'                  => 'Hozzászólhat, mint az egyik párosított fiókja',
	'ACL_U_VIEW_OTHER_USERS_LINKED_ACCOUNTS' => 'Megtekintheti más felhasználók párosított fiókjait',

));
