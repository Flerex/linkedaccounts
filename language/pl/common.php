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

	// General translations
	'LINKED_ACCOUNTS'                       => 'Połączone profile',
	'ADM_LINKED_ACCOUNTS'                   => 'Połączone profile',

	// UCP Management Module
	'LINKED_ACCOUNTS_MANAGEMENT'            => 'Zarządzanie profilem',
	'LINKED_ACCOUNTS_DESCRIPTION'           => 'Tutaj możesz połączyć inne profile z tym, na którym jesteś obecnie zalogowany. Łączenie pozwala łatwo przełączać się pomiędzy różnymi profilami bez konieczności podawania za każdym razem hasła.',
	'LINK_ACCOUNT'                          => 'Połącz profil',
	'ACCOUNT'                               => 'Profil',
	'LINKED_ON'                             => 'Połączony z',
	'NO_LINKED_ACCOUNTS'                    => 'Brak połączonych profili.',
	'UNLINK_ACCOUNT'                        => 'Odłącz profil',
	'SUCCESSFUL_UNLINKING'                  => 'Pomyślnie odłączono profile.',

	// UCP Linking Module
	'LINKING_ACCOUNT'                       => 'Łączenie profili',
	'ACCOUNT_LINKING_EXPLAIN'               => 'Tutaj musisz podać dane logowania profilu, który chcesz połączyć.',
	'FIND_ACCOUNT'                          => 'Znajdź profil',
	'CURRENT_PASSWORD_EXPLAIN_LINKACCOUNTS' => 'Jeśli chcesz utworzyć połączenie z poprzednim kontem, musisz podać swoje obecne hasło.',
	'EMPTY_FIELDS'                          => 'Nazwa użytkownika oraz hasło nie mogą być puste.',
	'INCORRECT_LINKED_ACCOUNT_CREDENTIALS'  => 'Wprowadzone dane nie pasują do żadnego profilu.',
	'SAME_ACCOUNT'                          => 'Nie możesz połączyć tego samego profilu samego ze sobą!',
	'INACTIVE_ACCOUNT'                      => 'Wygląda na to, że profil, z którym chcesz połączyć swoje konto, jest nieaktywny.',
	'BANNED_ACCOUNT'                        => 'Wygląda na to, że profil, z którym chcesz połączyć swoje konto, jest zbanowany.',
	'ALREADY_LINKED'                        => 'Jesteś już połączony z tym profilem.',

	// Switching process
	'ACCOUNTS_SWITCHED'                     => 'Pomyślnie połączono profile.',
	'INVALID_LINKED_ACCOUNT'                => 'Nie możesz przełączyć się na ten profil.',

	// ACP Overview Module
	'ADM_LINKED_ACCOUNTS_OVERVIEW'          => 'Przegląd',
	'ADM_LINKED_ACCOUNTS_OVERVIEW_EXPLAIN'  => 'W tej sekcji znajdziesz pewne statystyki użycia, razem z listą użytkowników połączonych z innymi profilami.',
	'LINKED_ACCOUNTS_COUNT'                 => 'Użytkownicy z połączeniami',
	'LINKED_ACCOUNTS_COUNT_EXPLAIN'         => 'Liczba profili z co najmniej jednym połączeniem.',
	'LINK_COUNT'                            => 'Połączenia',
	'LINK_COUNT_EXPLAIN'                    => 'Całkowita ilość utworzonych połączeń.',
	'NO_ACCOUNTS_LINKED'                    => 'Brak profili posiadających połączenia.',

	// ACP Management Module
	'ADM_LINKED_ACCOUNTS_MANAGEMENT'        => 'Zarządzaj użytkownikami',
	'SELECT_USER'                           => 'Wybierz użytkownika',
	'MANAGING_USER'                         => 'Zarządzanie użytkownikiem :: %s',
	'ACCOUNT_LINKS'                         => 'Połączone profile',
	'LINK_ACCOUNTS'                         => 'Połącz profile',
	'LINK_ACCOUNTS_EXPLAIN'                 => 'Tutaj możesz utworzyć połączenia dla tego użytkownika.',
	'SUCCESSFUL_MULTI_LINK_CREATION'        => 'Pomyślnie utworzono połączenia.',

	// ACP Settings Module
	'ADM_LINKED_ACCOUNTS_SETTINGS'          => 'Ustawienia',
	'ADM_LINKED_ACCOUNTS_SETTINGS_EXPLAIN'  => 'Tutaj możesz dostosować niektóre ustawienia tego rozszerzenia.',
	'CONF_AJAX'                             => 'Użyj AJAX podzas łączenia profili',
	'CONF_AJAX_EXPLAIN'                     => 'Włączenie tej opcji spowoduje, że będziesz przekierowywany automatycznie, bez przechodzenia przez stronę "Informacja". Wyłączenie AJAX spowoduje konieczność przejścia przez ową stronę.',
	'CONF_RETURN_TO_INDEX'                  => 'Wróć na stronę główną po przełączeniu profili',
	'CONF_RETURN_TO_INDEX_EXPLAIN'          => 'Jeśli wyłączone, przełączenie profili spowoduje powrót do wcześniej odwiedzonej strony.',
	'CONF_PRIVATE_LINKS'                    => 'Prywatne połączenia',
	'CONF_PRIVATE_LINKS_EXPLAIN'            => 'Ustawienie TAK spowoduje, że menu przełączania zostanie ukryte w sytuacji, gdy użytkownik nie będzie posiadał niezbędnych uprawnień, nawet gdy jego konto posiada połączenia. Może to spowodować zmniejszenie bezpieczeństwa i dlatego zaleca się, aby pozostawić tę opcję wyłączoną.',
));
