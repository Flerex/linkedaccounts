<?php
/**
*
* Linked Accounts extension for phpBB 3.2
*
* @copyright (c) 2018 Flerex
* @author Nederlandse vertaling @ Solidjeuh <https://www.muziekpromo.net>
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
	'ADM_LINKED_ACCOUNTS_OVERVIEW'			=> 'Overzicht',
	'ADM_LINKED_ACCOUNTS_OVERVIEW_EXPLAIN'	=> 'In deze sectie vindt u enkele gebruiker statistieken samen met een lijst met de gebruikers die koppelingen naar andere accounts hebben.',
	'LINKED_ACCOUNTS_COUNT'					=> 'gebruikers met koppelingen',
	'LINKED_ACCOUNTS_COUNT_EXPLAIN'			=> 'Aantal accounts met ten minste één koppeling.',
	'LINK_COUNT'							=> 'Koppelingen',
	'LINK_COUNT_EXPLAIN'					=> 'Totaal aantal gemaakte koppelingen.',
	'NO_ACCOUNTS_LINKED'					=> 'Er zijn geen accounts met koppelingen.',
	
	// ACP Management Module
	'ADM_LINKED_ACCOUNTS_MANAGEMENT'		=> 'Beheer gebruikers',
	'SELECT_USER'							=> 'Selecteer gebruiker',
	'MANAGING_USER'							=> 'Gebruikers beheer :: %s',
));
