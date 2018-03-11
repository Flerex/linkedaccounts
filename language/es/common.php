<?php
/**
*
* @package phpBB Extension - Linked Accounts
* @copyright (c) 2018 Flerex
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
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

	'LINKED_ACCOUNTS'						=> 'Cuentas enlazadas',
	
	// UCP Management Module
	'LINKED_ACCOUNTS_MANAGEMENT'			=> 'Gestión de cuentas',
	'LINKED_ACCOUNTS_DESCRIPTION'			=> 'Desde aquí podrá enlazar otras cuentas a esta. El enlace permitirá cambiar entre distintas cuentas sin tener que escribir la contraseña.',
	'LINK_ACCOUNT'							=> 'Enlazar cuenta',
	'ACCOUNT'								=> 'Cuenta',
	'LINKED_ON'								=> 'Enlazada el',
	'NO_LINKED_ACCOUNTS'					=> 'No hay cuentas enlazadas actualmente.',
	'UNLINK_ACCOUNT'						=> 'Desenlazar cuenta',
	'SUCCESSFUL_UNLINKING' 					=> 'Cuentas desenlazadas satisfactoriamente.',

	// UCP Linking Module
	'LINKING_ACCOUNT'						=> 'Crear enlace',
	'ACCOUNT_LINKING_EXPLAIN'				=> 'Aquí deberá introducir las credenciales de la cuenta a la  que intentas enlazarte.',
	'FIND_ACCOUNT'							=> 'Buscar cuentas',
	'CURRENT_PASSWORD_EXPLAIN_LINKACCOUNTS' => 'Debe introducir la contraseña de su cuenta actual si desea crear un enlace a la misma.',
	'EMPTY_FIELDS'							=> 'El nombre de usuario y la contraseña no pueden estar vacíos.',
	'INCORRECT_LINKED_ACCOUNT_CREDENTIALS'	=> 'Los credenciales introducidos no se corresponden a los de ninguna cuenta.',
	'SAME_ACCOUNT'							=> '¡No puedes crear un enlace a ti mismo!',
	'INACTIVE_ACCOUNT'						=> 'La cuenta a la que se intenta vincular parece estar inactiva.',
	'BANNED_ACCOUNT'						=> 'La cuenta a la que se intenta vincular parece estar sancionada.',
	'ALREADY_LINKED'						=> 'Ya estaba enlazado a esa cuenta.',

	// Switching process
	'ACCOUNTS_SWITCHED'						=> 'Se ha cambiado de cuenta satisfactoriamente.',
	'INVALID_LINKED_ACCOUNT'				=> 'No se ha podido realizar el cambio a esa cuenta.',
));
