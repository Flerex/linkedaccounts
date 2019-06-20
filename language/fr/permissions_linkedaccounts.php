<?php
/**
 *
 * Linked Accounts extension for phpBB 3.2
 *
 * @copyright (c) 2018 Flerex
 * @author        Flerex <flerex@icloud.com> | French translation by Galixte (http://www.galixte.com)
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

	'ACL_U_SWITCH_ACCOUNTS'                  => 'Peut permuter de compte utilisateur.',
	'ACL_U_LINK_ACCOUNTS'                    => 'Peut associer des comptes utilisateur.',
	'ACL_A_LINK_ACCOUNTS'                    => 'Peut gérer les comptes utilisateur associés.',
	'ACL_U_POST_AS_ACCOUNT'                  => 'Peut publier des messages avec un de ses comptes utilisateur associés.',
	'ACL_U_VIEW_OTHER_USERS_LINKED_ACCOUNTS' => 'Peut voir les comptes utilisateur associés des autres membres.',

));
