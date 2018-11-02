<?php
/**
*
* Linked Accounts extension for phpBB 3.2
*
* @copyright (c) 2018 Flerex
* @author Shenzy <nekonia-chan@hotmail.de>
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

	'ACL_U_SWITCH_ACCOUNTS' => 'Kann Account wechseln',
	'ACL_U_LINK_ACCOUNTS' => 'Kann Accounts verbinden',
	'ACL_A_LINK_ACCOUNTS' => 'Kann Account-Verbindungen verwalten',
));
