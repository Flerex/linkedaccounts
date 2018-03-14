<?php
/**
*
* @package phpBB Extension - Linked Accounts
* @copyright (c) 2018 Flerex
* @author Nederlandse vertaling
* Nederlandse vertaling @ Solidjeuh <https://www.muziekpromo.net>
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

	'ACL_U_LINK_ACCOUNTS' => 'Kan accounts koppelen',
	'ACL_A_LINK_ACCOUNTS' => 'HOLAAAACan manage users\' account links',
));
