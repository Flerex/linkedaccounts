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
	$lang = array();
}

$lang = array_merge($lang, array(

	// General translations
	'LINKED_ACCOUNTS'                       => 'Comptes utilisateur liés',
	'ADM_LINKED_ACCOUNTS'                   => 'Comptes utilisateur liés',

	// UCP Management Module
	'LINKED_ACCOUNTS_MANAGEMENT'            => 'Gestion des comptes utilisateurs',
	'LINKED_ACCOUNTS_DESCRIPTION'           => 'Permet d’associer d’autres comptes utilisateur à celui actuellement utilisé. En associant des comptes utilisateur il devient alors possible de permuter facilement entre eux sans avoir besoin de fournir ses identifiants de connexion.',
	'LINK_ACCOUNT'                          => 'Associer un compte utilisateur',
	'ACCOUNT'                               => 'Noms d’utilisateur des comptes associés',
	'LINKED_ON'                             => 'Associé le',
	'NO_LINKED_ACCOUNTS'                    => 'Il n’y a pas de comptes associés.',
	'UNLINK_ACCOUNT'                        => 'Dissocier des comptes utilisateur',
	'SUCCESSFUL_UNLINKING'                  => 'Comptes utilisateurs dissociés avec succès.',

	// UCP Linking Module
	'LINKING_ACCOUNT'                       => 'Association de comptes utilisateurs',
	'ACCOUNT_LINKING_EXPLAIN'               => 'Permet de saisir les informations d’identification du compte utilisateur à associer.',
	'FIND_ACCOUNT'                          => 'Rechercher un membre',
	'CURRENT_PASSWORD_EXPLAIN_LINKACCOUNTS' => 'Il est nécessaire de saisir le mot de passe du compte utilisateur actuellement utilisé pour générer une association avec le compte renseigné ci-dessus.',
	'EMPTY_FIELDS'                          => 'Un nom d’utilisateur et son mot de passe correspondant doivent être renseigné.',
	'INCORRECT_LINKED_ACCOUNT_CREDENTIALS'  => 'Les informations d’identification fournies ne correspondent à aucun compte.',
	'SAME_ACCOUNT'                          => 'Il n’est pas possible d’associer ce compte à lui-même !',
	'INACTIVE_ACCOUNT'                      => 'Le compte auquel vous essayez de vous connecter semble être inactif.',
	'BANNED_ACCOUNT'                        => 'Le compte auquel vous essayez de vous connecter semble être banni.',
	'ALREADY_LINKED'                        => 'Vous êtes déjà lié à ce compte.',

	// Switching process
	'ACCOUNTS_SWITCHED'                     => 'Comptes permutés avec succès !',
	'INVALID_LINKED_ACCOUNT'                => 'Il n’est pas possible de permuter vers ce compte.',

	// ACP Overview Module
	'ADM_LINKED_ACCOUNTS_OVERVIEW'          => 'Vue d’ensemble',
	'ADM_LINKED_ACCOUNTS_OVERVIEW_EXPLAIN'  => 'Permet de consulter les statistiques d’utilisation ainsi que la liste des membres ayant des associations de comptes utilisateur.',
	'LINKED_ACCOUNTS_COUNT'                 => 'Membres ayant des associations',
	'LINKED_ACCOUNTS_COUNT_EXPLAIN'         => 'Nombre de comptes ayant au moins une association.',
	'LINK_COUNT'                            => 'Associations',
	'LINK_COUNT_EXPLAIN'                    => 'Total des associations effectuées.',
	'NO_ACCOUNTS_LINKED'                    => 'Il n’y a aucun compte associé.',

	// ACP Management Module
	'ADM_LINKED_ACCOUNTS_MANAGEMENT'        => 'Gérer les membres',
	'SELECT_USER'                           => 'Sélectionner un membre',
	'MANAGING_USER'                         => 'Gestion du membre :: %s',
	'ACCOUNT_LINKS'                         => 'Comptes associés',
	'LINK_ACCOUNTS'                         => 'Associer des comptes',
	'LINK_ACCOUNTS_EXPLAIN'                 => 'Permet de créer des associations pour ce membre.',
	'SUCCESSFUL_MULTI_LINK_CREATION'        => 'Associations effectuées avec succès !',

	// ACP Settings Module
	'ADM_LINKED_ACCOUNTS_SETTINGS'          => 'Paramètres',
	'ADM_LINKED_ACCOUNTS_SETTINGS_EXPLAIN'  => 'Permet de personnaliser certaines fonctionnalités de l’extension.',
	'CONF_AJAX'                             => 'Utiliser le langage AJAX pour permuter entre les comptes utilisateur',
	'CONF_AJAX_EXPLAIN'                     => 'Permet d’activer cette option qui permettera automatiquement le membre vers un autre compte utilisateur sans avoir à s’identifier. Les utilisateurs n’ayant pas activé le support du langage AJAX seront eux aussi redirigés vers cette page.',
	'CONF_RETURN_TO_INDEX'                  => 'Retourner vers la page de l’index du forum lors de la permutation entre comptes utilisateurs',
	'CONF_RETURN_TO_INDEX_EXPLAIN'          => 'Permet d’activer la redirection vers la page de l’index du forum après avoir permuté de compte utilisateur. Dans le cas contraire, si cette option est désactivée la redirection s’effectuera vers la même page qu’avant la permutation.',
	'CONF_PRIVATE_LINKS'                    => 'Associations privés',
	'CONF_PRIVATE_LINKS_EXPLAIN'            => 'Permet de masquer l’option de permutation de comptes utilisateur pour les membres n’ayant pas l’autorisation de permuter et alors même que le membre aurait une association établie entre deux compte utilisateur. Il se peut que cela occasionne un risque pour la sécurité aussi il est recommandé de laisser cette option désactivée.',

	// Posting as
	'POSTING_AS'                            => 'Publié en tant que',

));
