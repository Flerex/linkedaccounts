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

	'ACL_U_SWITCH_ACCOUNTS'                  => 'สามารถสลับบัญชีได้',
	'ACL_U_LINK_ACCOUNTS'                    => 'สามารถลิงก์บัญชีได้',
	'ACL_A_LINK_ACCOUNTS'                    => 'สามารถจัดการลิงก์บัญชีได้',
	'ACL_U_POST_AS_ACCOUNT'                  => 'สามารถโพสต์เป็นหนึ่งในบัญชีที่ลิงก์ของพวกเขาได้',
	'ACL_U_VIEW_OTHER_USERS_LINKED_ACCOUNTS' => 'ดูบัญชีที่ลิงก์ของผู้ใช้อื่น',

));
