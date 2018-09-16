<?php
/**
*
* Linked Accounts extension for phpBB 3.2
*
* @copyright (c) 2018 Flerex
* @author Awide
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
	'LINKED_ACCOUNTS'						=> 'Párosított Fiókok',
	'ADM_LINKED_ACCOUNTS'					=> 'Párosított Fiókok',
	
	// UCP Management Module
	'LINKED_ACCOUNTS_MANAGEMENT'			=> 'Fiókok kezelése',
	'LINKED_ACCOUNTS_DESCRIPTION'			=> 'Itt párosíthatsz meglévő fiókokat a jelenleg bejelentkezett fiókodhoz. Párosítás után könnyen válthatsz fiókjaid között a jelszavak újbóli beírása nélkül.',
	'LINK_ACCOUNT'							=> 'Fiókok párosítása',
	'ACCOUNT'								=> 'Fiók',
	'LINKED_ON'								=> 'Párosított',
	'NO_LINKED_ACCOUNTS'					=> 'Nincsenek párosított fiókok.',
	'UNLINK_ACCOUNT'						=> 'Párosítás megszüntetése',
	'SUCCESSFUL_UNLINKING' 					=> 'Fiók párosítás sikeresen megszüntetve.',

	// UCP Linking Module
	'LINKING_ACCOUNT'						=> 'Fiókok párosítása',
	'ACCOUNT_LINKING_EXPLAIN'				=> 'Itt meg kell adni a fiók adatait ami párosításra fog kerülni.',
	'FIND_ACCOUNT'							=> 'Fiók keresése',
	'CURRENT_PASSWORD_EXPLAIN_LINKACCOUNTS' => 'Meg kell adni az aktív fiók jelszavát egy párosítás létrehozásához.',
	'EMPTY_FIELDS'							=> 'A felhasználónév és jelszó mezők nem lehetnek üresek.',
	'INCORRECT_LINKED_ACCOUNT_CREDENTIALS'	=> 'A megadott adatok nem egyeznek egyik fiók adataival sem.',
	'SAME_ACCOUNT'							=> 'Nem párosíthatók a fiókok önmagukhoz!',
	'INACTIVE_ACCOUNT'						=> 'A kiválasztott fiók inaktívnak tűnik.',
	'BANNED_ACCOUNT'						=> 'A kiválasztott fiók kitiltottnak tűnik.',
	'ALREADY_LINKED'						=> 'A kiválasztott fiók már párosított.',

	// Switching process
	'ACCOUNTS_SWITCHED'						=> 'Sikeres fiókváltás.',
	'INVALID_LINKED_ACCOUNT'				=> 'Nem lehet a kiválsztott fiókra váltani.',

	// ACP Overview Module
	'ADM_LINKED_ACCOUNTS_OVERVIEW'			=> 'Áttekintés',
	'ADM_LINKED_ACCOUNTS_OVERVIEW_EXPLAIN'	=> 'Ebben a részlegben használati statisztikák és listák találhatóak párosított fiókkal.',
	'LINKED_ACCOUNTS_COUNT'					=> 'Fiókok párosításokkal',
	'LINKED_ACCOUNTS_COUNT_EXPLAIN'			=> 'Fiókok száma legalább egy párosítással.',
	'LINK_COUNT'							=> 'Párosítások',
	'LINK_COUNT_EXPLAIN'					=> 'Összes létező párosítás.',
	'NO_ACCOUNTS_LINKED'					=> 'Nincsenek párosított fiókok.',

	// ACP Management Module
	'ADM_LINKED_ACCOUNTS_MANAGEMENT'		=> 'Felhasználók kezelése',
	'SELECT_USER'							=> 'Felhasználó kiválasztása',
	'MANAGING_USER'							=> 'Felhasználó kezelése :: %s',
	'ACCOUNT_LINKS'							=> 'Párosított fiókok',
	'LINK_ACCOUNTS'							=> 'Fiók Párosítása',
	'LINK_ACCOUNTS_EXPLAIN'					=> 'Itt létrehozhatóak párosítások a kiválasztott felhasználónak.',
	'SUCCESSFUL_MULTI_LINK_CREATION'		=> 'Párosítás sikeresen létrehozva.',

	// ACP Settings Module
	'ADM_LINKED_ACCOUNTS_SETTINGS'			=> 'Beállítások',
	'ADM_LINKED_ACCOUNTS_SETTINGS_EXPLAIN'	=> 'Ezen az oldalon a párosításokkal kapcsolatos beállításokat adhatod meg.',
	'CONF_AJAX'								=> 'AJAX használata fiókváltáskor',
	'CONF_AJAX_EXPLAIN'						=> 'Ez a beállítás automatikusan átirányítja a felhasználókat anélkül, hogy át kellene menniük az “Információ” oldalon. AJAX támogatás nélkül mindenképpen át kell menniük azon az oldalon.',	
	'CONF_RETURN_TO_INDEX'					=> 'Visszatérés a kezdőoldalra fiókváltás után.',
	'CONF_RETURN_TO_INDEX_EXPLAIN'			=> 'Ha nincs bekapcsolva fiókváltáskor ugyanarra az oldalra kerülnek alapból.',
	'CONF_PRIVATE_LINKS'					=> 'Rejtett párosítások',
	'CONF_PRIVATE_LINKS_EXPLAIN'			=> 'Ez a beállítás “igen” állapotban elrejti a fiókváltás menüt amikor egy felhasználónak nincsen fiókváltási joga, akkor is ha van párosított fiókja. Ez egy biztonsági rés lehet és javasolt kikapcsoltan hagyni.',
));
