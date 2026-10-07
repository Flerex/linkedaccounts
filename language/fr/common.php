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
	$lang = [];
}

//
// Some characters you may want to copy&paste:
// ’ « » “ ” …
//

$lang = array_merge($lang, [

	// General translations
	'LINKED_ACCOUNTS'                           => 'Comptes utilisateur liés',
	'ADM_LINKED_ACCOUNTS'                       => 'Comptes utilisateur liés',

	// UCP Management Module
	'LINKED_ACCOUNTS_MANAGEMENT'                => 'Gestion des comptes utilisateurs',
	'LINKED_ACCOUNTS_DESCRIPTION'               => 'Permet d’associer d’autres comptes utilisateur à celui actuellement utilisé. En associant des comptes utilisateur il devient alors possible de permuter facilement entre eux sans avoir besoin de fournir ses identifiants de connexion.',
	'LINK_ACCOUNT'                              => 'Associer un compte utilisateur',
	'ACCOUNT'                                   => 'Noms d’utilisateur des comptes associés',
	'LINKED_ON'                                 => 'Associé le',
	'NO_LINKED_ACCOUNTS'                        => 'Il n’y a pas de comptes associés.',
	'UNLINK_ACCOUNT'                            => 'Dissocier des comptes utilisateur',
	'SUCCESSFUL_UNLINKING'                      => 'Comptes utilisateurs dissociés avec succès.',

	// UCP Linking Module
	'LINKING_ACCOUNT'                           => 'Association de comptes utilisateurs',
	'ACCOUNT_LINKING_EXPLAIN'                   => 'Permet de saisir les informations d’identification du compte utilisateur à associer.',
	'FIND_ACCOUNT'                              => 'Rechercher un membre',
	'CURRENT_PASSWORD_EXPLAIN_LINKACCOUNTS'     => 'Il est nécessaire de saisir le mot de passe du compte utilisateur actuellement utilisé pour générer une association avec le compte renseigné ci-dessus.',
	'EMPTY_FIELDS'                              => 'Un nom d’utilisateur et son mot de passe correspondant doivent être renseigné.',
	'INCORRECT_LINKED_ACCOUNT_CREDENTIALS'      => 'Les informations d’identification fournies ne correspondent à aucun compte.',
	'SAME_ACCOUNT'                              => 'Il n’est pas possible d’associer ce compte à lui-même !',
	'INACTIVE_ACCOUNT'                          => 'Le compte auquel vous essayez de vous connecter semble être inactif.',
	'BANNED_ACCOUNT'                            => 'Le compte auquel vous essayez de vous connecter semble être banni.',
	'ALREADY_LINKED'                            => 'Vous êtes déjà lié à ce compte.',
	'MAX_LINKS_EXCEEDED'                        => 'Vous avez dépassé le nombre maximum de liens autorisés.',

	// Switching process
	'ACCOUNTS_SWITCHED'                         => 'Comptes permutés avec succès !',
	'INVALID_LINKED_ACCOUNT'                    => 'Il n’est pas possible de permuter vers ce compte.',

	// ACP Overview Module
	'ADM_LINKED_ACCOUNTS_OVERVIEW'              => 'Vue d’ensemble',
	'ADM_LINKED_ACCOUNTS_OVERVIEW_EXPLAIN'      => 'Permet de consulter les statistiques d’utilisation ainsi que la liste des membres ayant des associations de comptes utilisateur.',
	'LINKED_ACCOUNTS_COUNT'                     => 'Membres ayant des associations',
	'LINKED_ACCOUNTS_COUNT_EXPLAIN'             => 'Nombre de comptes ayant au moins une association.',
	'LINK_COUNT'                                => 'Associations',
	'LINK_COUNT_EXPLAIN'                        => 'Total des associations effectuées.',
	'NO_ACCOUNTS_LINKED'                        => 'Il n’y a aucun compte associé.',

	// ACP Management Module
	'ADM_LINKED_ACCOUNTS_MANAGEMENT'            => 'Gérer les membres',
	'SELECT_USER'                               => 'Sélectionner un membre',
	'MANAGING_USER'                             => 'Gestion du membre :: %s',
	'ACCOUNT_LINKS'                             => 'Comptes associés',
	'LINK_ACCOUNTS'                             => 'Associer des comptes',
	'LINK_ACCOUNTS_EXPLAIN'                     => 'Permet de créer des associations pour ce membre.',
	'SUCCESSFUL_MULTI_LINK_CREATION'            => 'Associations effectuées avec succès !',

	// ACP Settings Module
	'ADM_LINKED_ACCOUNTS_SETTINGS'              => 'Paramètres',
	'ADM_LINKED_ACCOUNTS_SETTINGS_EXPLAIN'      => 'Permet de personnaliser certaines fonctionnalités de l’extension.',
	'CONF_AJAX'                                 => 'Utiliser la méthode AJAX pour permuter entre les comptes utilisateur',
	'CONF_AJAX_EXPLAIN'                         => 'En activant cette option, vous serez redirigé automatiquement, sans avoir à passer par la page « Informations ». Les utilisateurs qui ne disposent pas de la compatibilité AJAX seront redirigés vers cette page.',
	'CONF_RETURN_TO_INDEX'                      => 'Retourner vers la page de l’index du forum lors de la permutation entre comptes utilisateurs',
	'CONF_RETURN_TO_INDEX_EXPLAIN'              => 'Permet d’activer la redirection vers la page de l’index du forum après avoir permuté de compte utilisateur. Dans le cas contraire, si cette option est désactivée la redirection s’effectuera vers la même page qu’avant la permutation.',
	'CONF_PRIVATE_LINKS'                        => 'Associations privés',
	'CONF_PRIVATE_LINKS_EXPLAIN'                => 'Si cette option est définie sur « oui », le menu de permutation sera masqué lorsqu’un utilisateur n’a pas les permissions de commuter, même si le compte possède des liens. Cela peut constituer un risque pour la sécurité et il est recommandé de laisser cette option désactivée.',
	'CONF_PRESERVE_ADMIN_SESSION'               => 'Préserver la session d’administration',
	'CONF_PRESERVE_ADMIN_SESSION_EXPLAIN'       => 'Lorsque cette option est activée, si un administrateur a déjà retapé son mot de passe, il ne lui sera pas redemandé de mot de passe lors d’une permutation de compte. Il est recommandé de laisser ce paramètre désactivé.',
	'CONF_PRESERVE_VIEW_ONLINE_SESSION'         => 'Préserver la visibilité du statut en ligne',
	'CONF_PRESERVE_VIEW_ONLINE_SESSION_EXPLAIN' => 'Lorsque cette option est activée, si un compte masqué commute vers un compte lié, le compte lié continuera d’être masqué, quelle que soit sa préférence.',
	'CONF_MAX_LINKS'                            => 'Nombre maximum de liens',
	'CONF_MAX_LINKS_EXPLAIN'                    => 'Le nombre maximum de liens autorisés par compte. La réduction de ce nombre ne supprimera pas les liens déjà créés. Utilisez 0 pour autoriser un nombre infini de liens (valeur par défaut).',

	// Posting as
	'POSTING_AS'                                => 'Publié en tant que',

]);
