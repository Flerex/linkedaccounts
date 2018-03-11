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

	'LINKED_ACCOUNTS'						=> 'Vínculo de Contas',
	
	// UCP Management Module
	'LINKED_ACCOUNTS_MANAGEMENT'			=> 'Xestión das contas',
	'LINKED_ACCOUNTS_DESCRIPTION'			=> 'Dende aquí poderás vincular outras contas a esta. O vínculo permitirá cambiar entre distintas contas sen ter que escribir o contrasinal.',
	'LINK_ACCOUNT'							=> 'Vincular conta',
	'ACCOUNT'								=> 'Conta',
	'LINKED_ON'								=> 'Vinculada o',
	'NO_LINKED_ACCOUNTS'					=> 'Non hai contas vinculadas actualmente.',
	'UNLINK_ACCOUNT'						=> 'Desvincular conta',
	'SUCCESSFUL_UNLINKING' 					=> 'Contas desvinculadas satisfactoriamente.',

	// UCP Linking Module
	'LINKING_ACCOUNT'						=> 'Crear vínculo',
	'ACCOUNT_LINKING_EXPLAIN'				=> 'Aquí deberás introducir as credenciais da conta á que intentas vincularte.',
	'FIND_ACCOUNT'							=> 'Procurar contas',
	'CURRENT_PASSWORD_EXPLAIN_LINKACCOUNTS' => 'Debes introducir o teu contrasinal actual se desexas crear un vínculo á devandita.',
	'EMPTY_FIELDS'							=> 'O nome de usuario e contrasinal non deben estar vacíos.',
	'INCORRECT_LINKED_ACCOUNT_CREDENTIALS'	=> 'Os credenciais introducidos non se corresponden a ningunha conta.',
	'SAME_ACCOUNT'							=> 'Non podes vincularte a ti mesmo!',
	'INACTIVE_ACCOUNT'						=> 'A conta á que tratas de vincularte parece estar inactiva.',
	'BANNED_ACCOUNT'						=> 'A conta á que tratas de vincularte parece estar prohibida.',
	'ALREADY_LINKED'						=> 'Xa estabas vinculado a esta conta.',

	// Switching process
	'ACCOUNTS_SWITCHED'						=> 'Cambiouse de conta satisfactoriamente.',
	'INVALID_LINKED_ACCOUNT'				=> 'Non se puido cambiar a esta conta.',
));
