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

	// General translations
	'LINKED_ACCOUNTS'						=> 'Gekoppelde accounts',
	'ADM_LINKED_ACCOUNTS'					=> 'Gekoppelde accounts',
	
	// UCP Management Module
	'LINKED_ACCOUNTS_MANAGEMENT'			=> 'Account beheer',
	'LINKED_ACCOUNTS_DESCRIPTION'			=> 'Hier kunt u andere accounts koppelen aan diegene waar u momenteel bent aangemeld. Met koppelen kunt u eenvoudig schakelen tussen verschillende accounts zonder telkens uw wachtwoord te moeten invoeren.',
	'LINK_ACCOUNT'							=> 'Koppel account',
	'ACCOUNT'								=> 'Account',
	'LINKED_ON'								=> 'Gekoppeld op',
	'NO_LINKED_ACCOUNTS'					=> 'Er zijn geen gekoppelde accounts.',
	'UNLINK_ACCOUNT'						=> 'Ontkoppel accounts',
	'SUCCESSFUL_UNLINKING' 					=> 'Accounts succesvol ontkoppelt.',

	// UCP Linking Module
	'LINKING_ACCOUNT'						=> 'Account koppelen',
	'ACCOUNT_LINKING_EXPLAIN'				=> 'Hier moet u de referenties opgeven van het account waarnaar u een koppeling wilt maken.',
	'FIND_ACCOUNT'							=> 'Zoek account',
	'CURRENT_PASSWORD_EXPLAIN_LINKACCOUNTS' => 'U moet uw huidige wachtwoord invoeren als u een koppeling naar het vorige account wilt maken.',
	'EMPTY_FIELDS'							=> 'Gebruikersnaam en wachtwoord mogen niet leeg zijn.',
	'INCORRECT_LINKED_ACCOUNT_CREDENTIALS'	=> 'De opgegeven inloggegevens komen niet overeen met een account.',
	'SAME_ACCOUNT'							=> 'U kunt dit account niet aan zichzelf koppelen!',
	'INACTIVE_ACCOUNT'						=> 'Het account dat u probeert te koppelen lijkt inactief te zijn.',
	'BANNED_ACCOUNT'						=> 'Het account dat u probeert te koppelen lijkt verbannen te zijn.',
	'ALREADY_LINKED'						=> 'U bent al gekoppeld aan dit account.',

	// Switching process
	'ACCOUNTS_SWITCHED'						=> 'Accounts werden succesvol gewisseld.',
	'INVALID_LINKED_ACCOUNT'				=> 'U kunt niet overschakelen naar dit account.',

	// ACP Overview Module
	'ADM_LINKED_ACCOUNTS_OVERVIEW'			=> 'Overview',
	'ADM_LINKED_ACCOUNTS_OVERVIEW_EXPLAIN'	=> 'In this section you\'ll find some usage statistics along with a list with the users that have links to other accounts.',
	'LINKED_ACCOUNTS_COUNT'					=> 'Users with links',
	'LINKED_ACCOUNTS_COUNT_EXPLAIN'			=> 'Amount of accounts that have at least one link.',
	'LINK_COUNT'							=> 'Links',
	'LINK_COUNT_EXPLAIN'					=> 'Total amount of links created.',
	'NO_ACCOUNTS_LINKED'					=> 'There are no accounts with links.',
	
	// ACP Management Module
	'ADM_LINKED_ACCOUNTS_MANAGEMENT'		=> 'Manage users',
	'SELECT_USER'							=> 'Select user',
	'MANAGING_USER'							=> 'User management :: %s',
));
