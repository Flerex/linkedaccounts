<?php
/**
*
* Linked Accounts extension for phpBB 3.2
*
* @copyright (c) 2018 Flerex
* @author Flerex <flerex@icloud.com>
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
	'LINKED_ACCOUNTS'						=> 'Vínculo de Contas',
	'ADM_LINKED_ACCOUNTS'					=> 'Vínculo de Contas',
	
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

	// ACP Overview Module
	'ADM_LINKED_ACCOUNTS_OVERVIEW'			=> 'Vista xeral',
	'ADM_LINKED_ACCOUNTS_OVERVIEW_EXPLAIN'	=> 'Nesta sección podes atopar estadísticas de uso xunto con unha lista de usuarios con vínculos a outras contas.',
	'LINKED_ACCOUNTS_COUNT'					=> 'Usuarios con vínculos',
	'LINKED_ACCOUNTS_COUNT_EXPLAIN'			=> 'Número de usuarios que teñen alomenos un vínculo.',
	'LINK_COUNT'							=> 'Vínculos',
	'LINK_COUNT_EXPLAIN'					=> 'Número de vínculos creados en total.',
	'NO_ACCOUNTS_LINKED'					=> 'Non hai usuarios que teñan vínculos.',
	
	// ACP Management Module
	'ADM_LINKED_ACCOUNTS_MANAGEMENT'		=> 'Xestionar usuarios',
	'SELECT_USER'							=> 'Seleccionar usuario',
	'MANAGING_USER'							=> 'Xestión de usuario :: %s',
	'LINK_ACCOUNTS'							=> 'Vincular contas',
	'LINK_ACCOUNTS_EXPLAIN'					=> 'Dende aquí poderás crear vínculos para este usuario.',
	'SUCCESSFUL_MULTI_LINK_CREATION'		=> 'Vínculos creados satisfatoriamente.',

	// ACP Settings Module
	'ADM_LINKED_ACCOUNTS_SETTINGS'			=> 'Configuración',
	'ADM_LINKED_ACCOUNTS_SETTINGS_EXPLAIN'	=> 'Aquí podes personalizar algunhas das características da extensión.',
	'CONF_AJAX'								=> 'Empregar AJAX ao cambiar de conta',
	'CONF_AJAX_EXPLAIN'						=> 'Activar esta opción redirixirate automáticamente sen ter que pasar pola páxina intermediaria “Información”. Os usuarios sen soporte a AJAX pasarán por dita páxina de todas maneiras.',
	'CONF_RETURN_TO_INDEX'					=> 'Voltar ó indice ó cambiar de conta',
	'CONF_RETURN_TO_INDEX_EXPLAIN'			=> 'Se esta opción non está activa redirixirase á mesma páxina por defecto.',
	'CONF_PRIVATE_LINKS'					=> 'Vínculos privados',
	'CONF_PRIVATE_LINKS_EXPLAIN'			=> 'Marcar esta opción como “si” ocultará o menú de cambio de conta cando un usuario non teña permisos para cambiar de conta, incluso se a conta ten actualmente enlaces. Esto pode supoñer unha ameaza de seguridade e se recomenda mantela desactivada.',
));
