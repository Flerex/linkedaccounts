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

	// General translations
	'LINKED_ACCOUNTS'						=> 'Linked Accounts',
	'ADM_LINKED_ACCOUNTS'					=> 'Linked Accounts',
	
	// UCP Management Module
	'LINKED_ACCOUNTS_MANAGEMENT'			=> 'Account management',
	'LINKED_ACCOUNTS_DESCRIPTION'			=> 'Here you will be able to link other accounts to the one you are currently logged into. Linking allows you to easily switch between different accounts without having to type your password every time.',
	'LINK_ACCOUNT'							=> 'Link account',
	'ACCOUNT'								=> 'Account',
	'LINKED_ON'								=> 'Linked on',
	'NO_LINKED_ACCOUNTS'					=> 'There are no linked accounts.',
	'UNLINK_ACCOUNT'						=> 'Unlink account',
	'SUCCESSFUL_UNLINKING' 					=> 'Accounts successfully unlinked.',

	// UCP Linking Module
	'LINKING_ACCOUNT'						=> 'Account linking',
	'ACCOUNT_LINKING_EXPLAIN'				=> 'Here you must provide the credentials of the account you want to link to.',
	'FIND_ACCOUNT'							=> 'Find account',
	'CURRENT_PASSWORD_EXPLAIN_LINKACCOUNTS' => 'You must enter your current password if you wish to create a link to the previous account.',
	'EMPTY_FIELDS'							=> 'Username and password cannot be empty.',
	'INCORRECT_LINKED_ACCOUNT_CREDENTIALS'	=> 'The provided credentials don’t match any account.',
	'SAME_ACCOUNT'							=> 'You cannot link this account to itself!',
	'INACTIVE_ACCOUNT'						=> 'The account you are trying to link to appears to be inactive.',
	'BANNED_ACCOUNT'						=> 'The account you are trying to link to appears to be banned.',
	'ALREADY_LINKED'						=> 'You are already linked to this account.',

	// Switching process
	'ACCOUNTS_SWITCHED'						=> 'Accounts switched successfully.',
	'INVALID_LINKED_ACCOUNT'				=> 'You cannot switch to this account.',

	// ACP Overview Module
	'ADM_LINKED_ACCOUNTS_OVERVIEW'			=> 'Overview',
	'ADM_LINKED_ACCOUNTS_OVERVIEW_EXPLAIN'	=> 'In this section you’ll find some usage statistics along with a list with the users that have links to other accounts.',
	'LINKED_ACCOUNTS_COUNT'					=> 'Users with links',
	'LINKED_ACCOUNTS_COUNT_EXPLAIN'			=> 'Amount of accounts that have at least one link.',
	'LINK_COUNT'							=> 'Links',
	'LINK_COUNT_EXPLAIN'					=> 'Total amount of links created.',
	'NO_ACCOUNTS_LINKED'					=> 'There are no accounts with links.',

	// ACP Management Module
	'ADM_LINKED_ACCOUNTS_MANAGEMENT'		=> 'Manage users',
	'SELECT_USER'							=> 'Select user',
	'MANAGING_USER'							=> 'User management :: %s',
	'ACCOUNT_LINKS'							=> 'Linked accounts',
	'LINK_ACCOUNTS'							=> 'Link Accounts',
	'LINK_ACCOUNTS_EXPLAIN'					=> 'Here you can create links for this user.',
	'SUCCESSFUL_MULTI_LINK_CREATION'		=> 'Links created successfully.',

	// ACP Settings Module
	'ADM_LINKED_ACCOUNTS_SETTINGS'			=> 'Settings',
	'ADM_LINKED_ACCOUNTS_SETTINGS_EXPLAIN'	=> 'Here you can customize some of the extension’s features.',
	'CONF_AJAX'								=> 'Use AJAX when switching accounts',
	'CONF_AJAX_EXPLAIN'						=> 'Enabling this option will redirect you automatically, without having to go through the “Information” page. Users with no AJAX support will go through that page anyway.',
	'CONF_RETURN_TO_INDEX'					=> 'Return to index when switching accounts',
	'CONF_RETURN_TO_INDEX_EXPLAIN'			=> 'If not enabled switching accounts will return to the same page by default.',
	'CONF_PRIVATE_LINKS'					=> 'Private links',
	'CONF_PRIVATE_LINKS_EXPLAIN'			=> 'Setting this option to “yes” will hide the switching menu when a user doesn’t have switching permissions, even when the account has links. This could be a security hazard and it is recommended to be left disabled.',
));
