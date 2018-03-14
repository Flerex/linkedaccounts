<?php
/**
*
* @package phpBB Extension - Linked Accounts
* @copyright (c) 2018 Flerex
* @author Flerex <flerex@icloud.com>
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
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

	'ACL_U_LINK_ACCOUNTS' => 'Can link accounts',
	'ACL_A_LINK_ACCOUNTS' => 'Can manage users\' account links',
));
