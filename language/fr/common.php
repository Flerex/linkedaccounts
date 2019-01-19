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
	'LINKED_ACCOUNTS'                       => 'Comptes Liés',
	'ADM_LINKED_ACCOUNTS'                   => 'Comptes Liés',

	// UCP Management Module
	'LINKED_ACCOUNTS_MANAGEMENT'            => 'Gestion du compte',
	'LINKED_ACCOUNTS_DESCRIPTION'           => 'Ici vous pourrez associer d’autres comptes à celui auquel vous êtes actuellement connecté. La liaison vous permet de basculer facilement entre différents comptes sans avoir à saisir votre mot de passe à chaque fois.',
	'LINK_ACCOUNT'                          => 'Lier les comptes',
	'ACCOUNT'                               => 'Compte',
	'LINKED_ON'                             => 'Liaison',
	'NO_LINKED_ACCOUNTS'                    => 'Il n’y a pas de comptes liés.',
	'UNLINK_ACCOUNT'                        => 'Dissocier le compte',
	'SUCCESSFUL_UNLINKING'                  => 'Comptes dissociés avec succès.',

	// UCP Linking Module
	'LINKING_ACCOUNT'                       => 'Lien de compte',
	'ACCOUNT_LINKING_EXPLAIN'               => 'Ici vous devez fournir les informations d’identification du compte auquel vous souhaitez vous connecter.',
	'FIND_ACCOUNT'                          => 'Trouver un compte',
	'CURRENT_PASSWORD_EXPLAIN_LINKACCOUNTS' => 'Vous devez entrer votre mot de passe actuel si vous souhaitez créer un lien vers le compte précédent.',
	'EMPTY_FIELDS'                          => 'Le nom d’utilisateur et le mot de passe ne peuvent pas être vides.',
	'INCORRECT_LINKED_ACCOUNT_CREDENTIALS'  => 'Les informations d’identification fournies ne correspondent à aucun compte.',
	'SAME_ACCOUNT'                          => 'Vous ne pouvez pas lier ce compte à lui-même !',
	'INACTIVE_ACCOUNT'                      => 'Le compte auquel vous essayez de vous connecter semble être inactif.',
	'BANNED_ACCOUNT'                        => 'Le compte auquel vous essayez de vous connecter semble être banni.',
	'ALREADY_LINKED'                        => 'Vous êtes déja lié à ce compte.',

	// Switching process
	'ACCOUNTS_SWITCHED'                     => 'Comptes échangés avec succès.',
	'INVALID_LINKED_ACCOUNT'                => 'Vous ne pouvez pas basculer sur ce compte.',

	// ACP Overview Module
	'ADM_LINKED_ACCOUNTS_OVERVIEW'          => 'Vue d’ensemble',
	'ADM_LINKED_ACCOUNTS_OVERVIEW_EXPLAIN'  => 'Dans cette section, vous trouverez des statistiques d’utilisation ainsi qu’une liste des utilisateurs ayant des liens vers d’autres comptes.',
	'LINKED_ACCOUNTS_COUNT'                 => 'Utilisateurs avec des liens',
	'LINKED_ACCOUNTS_COUNT_EXPLAIN'         => 'Nombre de comptes ayant au moins un lien.',
	'LINK_COUNT'                            => 'Liens',
	'LINK_COUNT_EXPLAIN'                    => 'Quantité totale de liens créés.',
	'NO_ACCOUNTS_LINKED'                    => 'Il n’y a pas de compte avec des liens.',

	// ACP Management Module
	'ADM_LINKED_ACCOUNTS_MANAGEMENT'        => 'Gérer les utilisateurs',
	'SELECT_USER'                           => 'Sélectionner un utilisateur',
	'MANAGING_USER'                         => 'Gestion de l’utilisateur :: %s',
	'ACCOUNT_LINKS'                         => 'Comptes liés',
	'LINK_ACCOUNTS'                         => 'Lier les comptes',
	'LINK_ACCOUNTS_EXPLAIN'                 => 'Ici, vous pouvez créer des liens pour cet utilisateur.',
	'SUCCESSFUL_MULTI_LINK_CREATION'        => 'Liens créés avec succès.',

	// ACP Settings Module
	'ADM_LINKED_ACCOUNTS_SETTINGS'          => 'Réglages',
	'ADM_LINKED_ACCOUNTS_SETTINGS_EXPLAIN'  => 'Ici, vous pouvez personnaliser certaines fonctionnalités de l’extension.',
	'CONF_AJAX'                             => 'Utilisez AJAX pour changer de compte',
	'CONF_AJAX_EXPLAIN'                     => 'Activer cette option vous redirigera automatiquement, sans avoir à passer par la page «Information». Les utilisateurs sans support AJAX vont quand même parcourir cette page.',
	'CONF_RETURN_TO_INDEX'                  => 'Retour à l’index lors du changement de compte',
	'CONF_RETURN_TO_INDEX_EXPLAIN'          => 'Si non activé, le changement de compte retournera à la même page par défaut.',
	'CONF_PRIVATE_LINKS'                    => 'Liens privés',
	'CONF_PRIVATE_LINKS_EXPLAIN'            => 'Si vous définissez cette option sur «oui», le menu de basculement sera masqué lorsqu’un utilisateur ne dispose pas d’autorisations de basculement, même lorsque le compte dispose de liens. Cela pourrait constituer un risque pour la sécurité et il est recommandé de le laisser désactivé.',

	// Posting as
	'POSTING_AS'                            => 'Posting as',

));
