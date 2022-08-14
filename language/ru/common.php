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
	'LINKED_ACCOUNTS'                           => 'Связанные аккаунты',
	'ADM_LINKED_ACCOUNTS'                       => 'Связанные аккаунты',

	// UCP Management Module
	'LINKED_ACCOUNTS_MANAGEMENT'                => 'Настройка аккаунтов',
	'LINKED_ACCOUNTS_DESCRIPTION'               => 'Здесь вы можете привязать другие аккаунты к тому, с которого вы сейчас авторизированны на сайте. Привязка позволит Вам переключаться между аккаунтами без необходимости ввода пароля.',
	'LINK_ACCOUNT'                              => 'Привязать аккаунт',
	'ACCOUNT'                                   => 'Аккаунт',
	'LINKED_ON'                                 => 'Привязан',
	'NO_LINKED_ACCOUNTS'                        => 'Нет привязанных аккаунтов.',
	'UNLINK_ACCOUNT'                            => 'Отвязать аккаунт',
	'SUCCESSFUL_UNLINKING'                      => 'Аккаунт успешно отвязан.',

	// UCP Linking Module
	'LINKING_ACCOUNT'                           => 'Привязка аккаунта',
	'ACCOUNT_LINKING_EXPLAIN'                   => 'Здесь вы должны предоставить данные аккаунта, который Вы хотите привязать.',
	'FIND_ACCOUNT'                              => 'Найти аккаунт',
	'CURRENT_PASSWORD_EXPLAIN_LINKACCOUNTS'     => 'Для привязки введите свой текущий пароль.',
	'EMPTY_FIELDS'                              => 'Логин и пароль не могут быть пустыми',
	'INCORRECT_LINKED_ACCOUNT_CREDENTIALS'      => 'Предоставленные данные не соответствуют ни одному из аккаунтов.',
	'SAME_ACCOUNT'                              => 'Нельзя привязать аккаунт к самому себе!',
	'INACTIVE_ACCOUNT'                          => 'Аккаунт, который вы пытаетесь привязать, неактивен.',
	'BANNED_ACCOUNT'                            => 'Аккаунт, который вы пытаетесь привязать, заблокирован.',
	'ALREADY_LINKED'                            => 'Вы уже привязаны к этому аккаунту.',
	'MAX_LINKS_EXCEEDED'                        => 'You have exceeded the maximum number of links allowed.',

	// Switching process
	'ACCOUNTS_SWITCHED'                         => 'Аккаунт успешно переключен.',
	'INVALID_LINKED_ACCOUNT'                    => 'Вы не можете переключиться на этот аккаунт.',

	// ACP Overview Module
	'ADM_LINKED_ACCOUNTS_OVERVIEW'              => 'Обзор',
	'ADM_LINKED_ACCOUNTS_OVERVIEW_EXPLAIN'      => 'В этом разделе вы найдёте статистику по привязкам, а также список пользователей у которых есть привязки к другим аккаунтам.',
	'LINKED_ACCOUNTS_COUNT'                     => 'Пользователей с привязками',
	'LINKED_ACCOUNTS_COUNT_EXPLAIN'             => 'Количество аккаунтов, у которых есть хотя бы одна привязка.',
	'LINK_COUNT'                                => 'Привязки',
	'LINK_COUNT_EXPLAIN'                        => 'Общее количество привязок.',
	'NO_ACCOUNTS_LINKED'                        => 'Нет аккаунтов с привязками.',

	// ACP Management Module
	'ADM_LINKED_ACCOUNTS_MANAGEMENT'            => 'Управление пользователями',
	'SELECT_USER'                               => 'Выбрать пользователя',
	'MANAGING_USER'                             => 'Управление пользователем :: %s',
	'ACCOUNT_LINKS'                             => 'Привязанные аккаунты',
	'LINK_ACCOUNTS'                             => 'Привязать аккаунт',
	'LINK_ACCOUNTS_EXPLAIN'                     => 'Здесь вы можете привязать аккаунт к пользователю.',
	'SUCCESSFUL_MULTI_LINK_CREATION'            => 'Привязка успешно создана.',

	// ACP Settings Module
	'ADM_LINKED_ACCOUNTS_SETTINGS'              => 'Настройки',
	'ADM_LINKED_ACCOUNTS_SETTINGS_EXPLAIN'      => 'Здесь Вы можете настроить некоторые функции расширения.',
	'CONF_AJAX'                                 => 'Использовать AJAX для переключения аккаунтов',
	'CONF_AJAX_EXPLAIN'                         => 'Включение этого пункта приведет к тому, что пользователи при переключении аккаунта не будут перенаправлены на информационную страницу. Пользователи, у которых нет поддержки AJAX, будут перенаправлены на страницу информации.',
	'CONF_RETURN_TO_INDEX'                      => 'Возвращаться на главную страницу при переключении аккаунтов.',
	'CONF_RETURN_TO_INDEX_EXPLAIN'              => 'Если настройка выключена, то пользователь будет перенаправлен на страницу, на которой он произвёл переключение.',
	'CONF_PRIVATE_LINKS'                        => 'Частные ссылки',
	'CONF_PRIVATE_LINKS_EXPLAIN'                => 'Изменение этой настройки на “да” скроет настройку переключения аккаунтов, даже если у него есть привязки. Это может привести к проблемам безопасности, желательно использовать значение “нет”',
	'CONF_PRESERVE_ADMIN_SESSION'               => 'Высший приоритет сессии администратора',
	'CONF_PRESERVE_ADMIN_SESSION_EXPLAIN'       => 'Если эта опция включена, и администратор уже ввёл свой пароль, он не будет заново запрошен при переключении аккаунта. Рекомендовано оставить эту настройку отключенной.',
	'CONF_PRESERVE_VIEW_ONLINE_SESSION'         => 'Preserve online status visibility',
	'CONF_PRESERVE_VIEW_ONLINE_SESSION_EXPLAIN' => 'When this option is enabled, if an account that is hidden switches to a linked account, the linked account will continue being hidden, regardless of its preference.',
	'CONF_MAX_LINKS'                            => 'Maximum links',
	'CONF_MAX_LINKS_EXPLAIN'                    => 'The maximum allowed links per account. Reducing this number will not remove already created links. Use 0 to allow infinite links (default).',

	// Posting as
	'POSTING_AS'                                => 'Ответить как',

));
