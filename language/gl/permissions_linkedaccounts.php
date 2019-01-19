<?php
/**
 *
 * Linked Accounts extension for phpBB 3.2
 *
 * @copyright (c) 2018 Flerex
 * @author        Flerex <flerex@icloud.com>
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

	'ACL_U_SWITCH_ACCOUNTS' => 'Pode cambiar de conta',
	'ACL_U_LINK_ACCOUNTS'   => 'Pode vincular contas',
	'ACL_A_LINK_ACCOUNTS'   => 'Pode xestionar os enlaces entre contas',
	'ACL_U_POST_AS_ACCOUNT' => 'Pode publicar coma unha das súas contas vinculadas',
));
