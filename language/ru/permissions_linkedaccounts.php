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

	'ACL_U_SWITCH_ACCOUNTS'                  => 'Может переключать аккаунты',
	'ACL_U_LINK_ACCOUNTS'                    => 'Может привязывать аккаунты',
	'ACL_A_LINK_ACCOUNTS'                    => 'Может настраивать привязки к аккаунту',
	'ACL_U_POST_AS_ACCOUNT'                  => 'Может отвечать как один из привязанных аккаунтов',
	'ACL_U_VIEW_OTHER_USERS_LINKED_ACCOUNTS' => 'Может просматривать привязки другого аккаунта',

));
