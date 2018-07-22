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

	// General translations
	'LINKED_ACCOUNTS'						=> 'Verbundene Accounts',
	'ADM_LINKED_ACCOUNTS'					=> 'Verbundene Accounts',

	// UCP Management Module
	'LINKED_ACCOUNTS_MANAGEMENT'			=> 'Accountverwaltung',
	'LINKED_ACCOUNTS_DESCRIPTION'			=> 'Hier kannst du den Account, auf dem du gerade eingeloggt bist, mit anderen verbinden. Accounts zu verbinden erlaubt es dir, zwischen Accounts zu wechseln, ohne jedes Mal das Passwort neu einzugeben.',
	'LINK_ACCOUNT'							=> 'Account verbinden',
	'ACCOUNT'								=> 'Account',
	'LINKED_ON'								=> 'Verbunden am',
	'NO_LINKED_ACCOUNTS'					=> 'Es sind noch keine Accounts verbunden worden.',
	'UNLINK_ACCOUNT'						=> 'Verbindung auflösen',
	'SUCCESSFUL_UNLINKING' 					=> 'Verbindung erfolgreich aufgelöst.',

	// UCP Linking Module
	'LINKING_ACCOUNT'						=> 'Account verbinden',
	'ACCOUNT_LINKING_EXPLAIN'				=> 'Hier musst du die Zugangsdaten des Accounts, den du verbinden möchtest, eingeben.',
	'FIND_ACCOUNT'							=> 'Account finden',
	'CURRENT_PASSWORD_EXPLAIN_LINKACCOUNTS' => 'Du musst dein derzeitiges Passwort eingeben, um einen Account zu verbinden.',
	'EMPTY_FIELDS'							=> 'Benutername und Passwort können nicht leer sein.',
	'INCORRECT_LINKED_ACCOUNT_CREDENTIALS'	=> 'Die eingegebenen Zugangsdaten stimmen mit keinem vorhandenen Account überein.',
	'SAME_ACCOUNT'							=> 'Du kannst diesen Account nicht mit ihm selbst verbinden!',
	'INACTIVE_ACCOUNT'						=> 'Der Account, den du verbinden möchtest, scheint inaktiv zu sein.',
	'BANNED_ACCOUNT'						=> 'Der Account, den du verbinden möchtest, scheint gebannt zu sein.',
	'ALREADY_LINKED'						=> 'Du bist schon mit diesem Account verbunden.',

	// Switching process
	'ACCOUNTS_SWITCHED'						=> 'Accounts erfolgreich gewechselt.',
	'INVALID_LINKED_ACCOUNT'				=> 'Du kannst nicht zu diesem Account wechseln.',

	// ACP Overview Module
	'ADM_LINKED_ACCOUNTS_OVERVIEW'			=> 'Übersicht',
	'ADM_LINKED_ACCOUNTS_OVERVIEW_EXPLAIN'	=> 'In diesem Bereich findest du Nutzungsstatistiken mit einer Liste der Benutzer, die Verbindungen zu anderen Accounts haben.',
	'LINKED_ACCOUNTS_COUNT'					=> 'Benutzer mit Verbindungen',
	'LINKED_ACCOUNTS_COUNT_EXPLAIN'			=> 'Accounts, die mindestens eine Verbindung haben.',
	'LINK_COUNT'							=> 'Verbindungen',
	'LINK_COUNT_EXPLAIN'					=> 'Gesamte Anzahl an Verbindungen.',
	'NO_ACCOUNTS_LINKED'					=> 'Es gibt keine Accounts mit Verbindungen.',

	// ACP Management Module
	'ADM_LINKED_ACCOUNTS_MANAGEMENT'		=> 'Benutzer verwalten',
	'SELECT_USER'							=> 'Benutzer auswählen',
	'MANAGING_USER'							=> 'Benutzerverwaltung :: %s',

	// ACP Settings Module
	'LINKED_ACCOUNTS_SETTINGS'				=> 'Settings',
	'ADM_LINKED_ACCOUNTS_SETTINGS_EXPLAIN'	=> 'Here you can customize some of the extension’s features.',
	'CONF_AJAX'								=> 'Use AJAX when switching accounts',
	'CONF_AJAX_EXPLAIN'						=> 'Enabling this option will redirect you automatically, without having to go through the “Information” page. Users with no AJAX support will go throught that page anyways.',
	'CONF_RETURN_TO_INDEX'					=> 'Return to index when switching accounts',
	'CONF_RETURN_TO_INDEX_EXPLAIN'			=> 'If not enabled switching accounts will return to the same page by default.',
	'CONF_PRIVATE_LINKS'					=> 'Private links',
	'CONF_PRIVATE_LINKS_EXPLAIN'			=> 'Setting this option to “yes” will hide the switching menu when a user doesn’t have switching permissions, even when the account has links. This could be a security hazard and it is recommended to be left disabled.',
));
