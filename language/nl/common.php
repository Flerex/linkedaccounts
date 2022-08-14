<?php
/**
 *
 * Linked Accounts extension for phpBB 3.2
 *
 * @copyright (c) 2018 Flerex
 * @author        Nederlandse vertaling @ Solidjeuh <https://www.muziekpromo.net>
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

	// General translations
	'LINKED_ACCOUNTS'                           => 'Gekoppelde accounts',
	'ADM_LINKED_ACCOUNTS'                       => 'Gekoppelde accounts',

	// UCP Management Module
	'LINKED_ACCOUNTS_MANAGEMENT'                => 'Account beheer',
	'LINKED_ACCOUNTS_DESCRIPTION'               => 'Hier kunt u andere accounts koppelen aan diegene waar u momenteel bent aangemeld. Met koppelen kunt u eenvoudig schakelen tussen verschillende accounts zonder telkens uw wachtwoord te moeten invoeren.',
	'LINK_ACCOUNT'                              => 'Koppel account',
	'ACCOUNT'                                   => 'Account',
	'LINKED_ON'                                 => 'Gekoppeld op',
	'NO_LINKED_ACCOUNTS'                        => 'Er zijn geen gekoppelde accounts.',
	'UNLINK_ACCOUNT'                            => 'Ontkoppel accounts',
	'SUCCESSFUL_UNLINKING'                      => 'Accounts succesvol ontkoppelt.',

	// UCP Linking Module
	'LINKING_ACCOUNT'                           => 'Account koppelen',
	'ACCOUNT_LINKING_EXPLAIN'                   => 'Hier moet u de referenties opgeven van het account waarnaar u een koppeling wilt maken.',
	'FIND_ACCOUNT'                              => 'Zoek account',
	'CURRENT_PASSWORD_EXPLAIN_LINKACCOUNTS'     => 'U moet uw huidige wachtwoord invoeren als u een koppeling naar het vorige account wilt maken.',
	'EMPTY_FIELDS'                              => 'Gebruikersnaam en wachtwoord mogen niet leeg zijn.',
	'INCORRECT_LINKED_ACCOUNT_CREDENTIALS'      => 'De opgegeven inloggegevens komen niet overeen met een account.',
	'SAME_ACCOUNT'                              => 'U kunt dit account niet aan zichzelf koppelen!',
	'INACTIVE_ACCOUNT'                          => 'Het account dat u probeert te koppelen lijkt inactief te zijn.',
	'BANNED_ACCOUNT'                            => 'Het account dat u probeert te koppelen lijkt verbannen te zijn.',
	'ALREADY_LINKED'                            => 'U bent al gekoppeld aan dit account.',
	'MAX_LINKS_EXCEEDED'                        => 'You have exceeded the maximum number of links allowed.',

	// Switching process
	'ACCOUNTS_SWITCHED'                         => 'Accounts werden succesvol overgeschakeld.',
	'INVALID_LINKED_ACCOUNT'                    => 'U kunt niet overschakelen naar dit account.',

	// ACP Overview Module
	'ADM_LINKED_ACCOUNTS_OVERVIEW'              => 'Overzicht',
	'ADM_LINKED_ACCOUNTS_OVERVIEW_EXPLAIN'      => 'In deze sectie vindt u enkele gebruiker statistieken samen met een lijst met de gebruikers die koppelingen naar andere accounts hebben.',
	'LINKED_ACCOUNTS_COUNT'                     => 'Gebruikers met koppelingen',
	'LINKED_ACCOUNTS_COUNT_EXPLAIN'             => 'Aantal accounts met ten minste één koppeling.',
	'LINK_COUNT'                                => 'Koppelingen',
	'LINK_COUNT_EXPLAIN'                        => 'Totaal aantal gemaakte koppelingen.',
	'NO_ACCOUNTS_LINKED'                        => 'Er zijn geen accounts met koppelingen.',

	// ACP Management Module
	'ADM_LINKED_ACCOUNTS_MANAGEMENT'            => 'Beheer gebruikers',
	'SELECT_USER'                               => 'Selecteer gebruiker',
	'MANAGING_USER'                             => 'Gebruikers beheer :: %s',
	'ACCOUNT_LINKS'                             => 'Gekoppelde accounts',
	'LINK_ACCOUNTS'                             => 'Gekoppelde accounts',
	'LINK_ACCOUNTS_EXPLAIN'                     => 'Hier kunt u koppelingen voor deze gebruiker aanmaken.',
	'SUCCESSFUL_MULTI_LINK_CREATION'            => 'Links met succes aangemaakt.',

	// ACP Settings Module
	'ADM_LINKED_ACCOUNTS_SETTINGS'              => 'Instellingen',
	'ADM_LINKED_ACCOUNTS_SETTINGS_EXPLAIN'      => 'Hier kunt u enkele functies van de extensie aanpassen.',
	'CONF_AJAX'                                 => 'Gebruik AJAX bij het wisselen tussen accounts',
	'CONF_AJAX_EXPLAIN'                         => 'Als u deze optie inschakelt, wordt u automatisch omgeleid, zonder dat u de pagina “Informatie” hoeft te doorlopen. Gebruikers zonder AJAX ondersteuning zullen sowieso door die pagina gaan.',
	'CONF_RETURN_TO_INDEX'                      => 'Keer terug naar index bij het wisselen tussen accounts',
	'CONF_RETURN_TO_INDEX_EXPLAIN'              => 'Als dit niet is ingeschakeld, keren accounts standaard naar dezelfde pagina terug.',
	'CONF_PRIVATE_LINKS'                        => 'Private links',
	'CONF_PRIVATE_LINKS_EXPLAIN'                => 'Als u deze optie instelt op “Ja”, wordt het account koppel menu verborgen als een gebruiker geen account koppel permissies heeft, ook niet als het account koppelingen bevat. Dit kan een veiligheidsrisico vormen en het wordt aanbevolen om uitgeschakeld te blijven.',
	'CONF_PRESERVE_ADMIN_SESSION'               => 'Preserve administration session',
	'CONF_PRESERVE_ADMIN_SESSION_EXPLAIN'       => 'When this option is enabled, if an administrator has already re-typed his password, they will not be asked for a password again when switching accounts. It is recommended to leave this setting disabled.',
	'CONF_PRESERVE_VIEW_ONLINE_SESSION'         => 'Preserve online status visibility',
	'CONF_PRESERVE_VIEW_ONLINE_SESSION_EXPLAIN' => 'When this option is enabled, if an account that is hidden switches to a linked account, the linked account will continue being hidden, regardless of its preference.',
	'CONF_MAX_LINKS'                            => 'Maximum links',
	'CONF_MAX_LINKS_EXPLAIN'                    => 'The maximum allowed links per account. Reducing this number will not remove already created links. Use 0 to allow infinite links (default).',

	// Posting as
	'POSTING_AS'                                => 'Posten als',

));
