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
	'LINKED_ACCOUNTS'                       => 'Cuentas enlazadas',
	'ADM_LINKED_ACCOUNTS'                   => 'Cuentas enlazadas',

	// UCP Management Module
	'LINKED_ACCOUNTS_MANAGEMENT'            => 'Gestión de cuentas',
	'LINKED_ACCOUNTS_DESCRIPTION'           => 'Desde aquí podrá enlazar otras cuentas a esta. El enlace permitirá cambiar entre distintas cuentas sin tener que escribir la contraseña.',
	'LINK_ACCOUNT'                          => 'Enlazar cuenta',
	'ACCOUNT'                               => 'Cuenta',
	'LINKED_ON'                             => 'Enlazada el',
	'NO_LINKED_ACCOUNTS'                    => 'No hay cuentas enlazadas actualmente.',
	'UNLINK_ACCOUNT'                        => 'Desenlazar cuenta',
	'SUCCESSFUL_UNLINKING'                  => 'Cuentas desenlazadas satisfactoriamente.',

	// UCP Linking Module
	'LINKING_ACCOUNT'                       => 'Crear enlace',
	'ACCOUNT_LINKING_EXPLAIN'               => 'Aquí deberá introducir las credenciales de la cuenta a la  que intentas enlazarte.',
	'FIND_ACCOUNT'                          => 'Buscar cuentas',
	'CURRENT_PASSWORD_EXPLAIN_LINKACCOUNTS' => 'Debe introducir la contraseña de su cuenta actual si desea crear un enlace a la misma.',
	'EMPTY_FIELDS'                          => 'El nombre de usuario y la contraseña no pueden estar vacíos.',
	'INCORRECT_LINKED_ACCOUNT_CREDENTIALS'  => 'Los credenciales introducidos no se corresponden a los de ninguna cuenta.',
	'SAME_ACCOUNT'                          => '¡No puedes crear un enlace a ti mismo!',
	'INACTIVE_ACCOUNT'                      => 'La cuenta a la que se intenta vincular parece estar inactiva.',
	'BANNED_ACCOUNT'                        => 'La cuenta a la que se intenta vincular parece estar sancionada.',
	'ALREADY_LINKED'                        => 'Ya estaba enlazado a esa cuenta.',

	// Switching process
	'ACCOUNTS_SWITCHED'                     => 'Se ha cambiado de cuenta satisfactoriamente.',
	'INVALID_LINKED_ACCOUNT'                => 'No se ha podido realizar el cambio a esa cuenta.',

	// ACP Overview Module
	'ADM_LINKED_ACCOUNTS_OVERVIEW'          => 'Vista general',
	'ADM_LINKED_ACCOUNTS_OVERVIEW_EXPLAIN'  => 'En esta sección podrá encontrar estadísticas de uso junto con una lista de usuarios con enlaces a otras cuentas.',
	'LINKED_ACCOUNTS_COUNT'                 => 'Usuarios con enlaces',
	'LINKED_ACCOUNTS_COUNT_EXPLAIN'         => 'Número de usuarios que tienen por lo menos un enlace.',
	'LINK_COUNT'                            => 'Enlaces',
	'LINK_COUNT_EXPLAIN'                    => 'Número de enlaces creados en total.',
	'NO_ACCOUNTS_LINKED'                    => 'No hay usuarios que tengan enlaces.',

	// ACP Management Module
	'ADM_LINKED_ACCOUNTS_MANAGEMENT'        => 'Gestionar usuarios',
	'SELECT_USER'                           => 'Seleccionar usuario',
	'MANAGING_USER'                         => 'Gestión de usuario :: %s',
	'ACCOUNT_LINKS'                         => 'Enlaces de la cuenta',
	'LINK_ACCOUNTS'                         => 'Enlazar cuentas',
	'LINK_ACCOUNTS_EXPLAIN'                 => 'Desde aquí puedes crear enlaces para este usuario.',
	'SUCCESSFUL_MULTI_LINK_CREATION'        => 'Enlaces creados satisfactoriamente.',

	// ACP Settings Module
	'ADM_LINKED_ACCOUNTS_SETTINGS'          => 'Configuración',
	'ADM_LINKED_ACCOUNTS_SETTINGS_EXPLAIN'  => 'Aquí puedes personalizar algunas de las características de la extensión.',
	'CONF_AJAX'                             => 'Utilizar AJAX al cambiar de cuenta',
	'CONF_AJAX_EXPLAIN'                     => 'Activar esta opción te redirigirá automáticamente sin tener que pasar por la página intermediaria “Información”. Los usuarios sin soporte a AJAX pasarán por dicha página de todas formas.',
	'CONF_RETURN_TO_INDEX'                  => 'Volver al índice al cambiar de cuenta',
	'CONF_RETURN_TO_INDEX_EXPLAIN'          => 'Si esta opción no está activada se redirigirá a la misma página por defecto.',
	'CONF_PRIVATE_LINKS'                    => 'Enlaces privados',
	'CONF_PRIVATE_LINKS_EXPLAIN'            => 'Marcar esta opción como “sí” ocultará el menú de cambio de cuenta cuando un usuario no tiene permisos para cambiar de cuenta, incluso si la cuenta tiene actualmente enlaces. Esto puede llegar a ser un problema de seguridad y se recomienda dejarlo desactivado.',
));
