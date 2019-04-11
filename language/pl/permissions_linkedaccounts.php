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

	'ACL_U_SWITCH_ACCOUNTS' => 'Może przełączać się między profilami',
	'ACL_U_LINK_ACCOUNTS' => 'Może łączyć profile',
	'ACL_A_LINK_ACCOUNTS' => 'Może zarządzać połączeniami między profilami',
));
