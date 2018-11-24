<?php
/**
*
* Linked Accounts extension for phpBB 3.2
*
* @copyright (c) 2018 Flerex
* @author Flerex <flerex@icloud.com>
* @license GNU General Public License, version 2 (GPL-2.0)
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

	'ACL_U_SWITCH_ACCOUNTS' => 'Can switch accounts',
	'ACL_U_LINK_ACCOUNTS' => 'Can link accounts',
	'ACL_A_LINK_ACCOUNTS' => 'Can manage account links',
));
