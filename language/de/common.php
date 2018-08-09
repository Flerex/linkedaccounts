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
	'ACCOUNT_LINKS'							=> 'Verbundene Accounts',
	'LINK_ACCOUNTS'							=> 'Accounts verbinden',
	'LINK_ACCOUNTS_EXPLAIN'					=> 'Hier kannst du Verbindungen für diesen Benutzer anlegen.',
	'SUCCESSFUL_MULTI_LINK_CREATION'		=> 'Verbindung erfolgreich angelegt.',

	// ACP Settings Module
	'ADM_LINKED_ACCOUNTS_SETTINGS'			=> 'Einstellungen',
	'ADM_LINKED_ACCOUNTS_SETTINGS_EXPLAIN'	=> 'Hier kannst du einige der Funktionen dieser Erweiterung anpassen.',
	'CONF_AJAX'								=> 'AJAX beim Wechseln benutzen',
	'CONF_AJAX_EXPLAIN'						=> 'Das aktivieren dieser Option wird dich automatisch weiterleiten, ohne zuerst die "Informationsseite" sehen zu müssen. Benutzer ohne AJAX-Unterstützung werden diese Seite trotzdem sehen.',
	'CONF_RETURN_TO_INDEX'					=> 'Zum Index zurückkehren, wenn Accounts gewechselt wurden',
	'CONF_RETURN_TO_INDEX_EXPLAIN'			=> 'Wenn nicht aktiviert, werden wechselnde Accounts standardmäßig zur selben Seite zurückkehren.',
	'CONF_PRIVATE_LINKS'					=> 'Private Verbindungen',
	'CONF_PRIVATE_LINKS_EXPLAIN'			=> 'Diese Option auf "Ja" zu setzen wird das Wechselmenü verstecken, wenn der Benutzer keine Berechtigungen für das Wechseln hat, auch wenn der Account bereits Verbindungen besitzt. Dies kann ein Sicherheitsrisiko darstellen und es wird empfohlen, diese Option deaktiviert zu lassen.',
));
