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
	'LINKED_ACCOUNTS'                           => 'บัญชีที่เชื่อมโยง',
	'ADM_LINKED_ACCOUNTS'                       => 'บัญชีที่เชื่อมโยง',

	// UCP Management Module
	'LINKED_ACCOUNTS_MANAGEMENT'                => 'การจัดการบัญชี',
	'LINKED_ACCOUNTS_DESCRIPTION'               => 'ที่นี่คุณจะสามารถเชื่อมโยงบัญชีอื่นกับบัญชีที่คุณเข้าสู่ระบบอยู่ในปัจจุบัน การเชื่อมโยงช่วยให้คุณสามารถสลับระหว่างบัญชีต่างๆ ได้อย่างง่ายดายโดยไม่ต้องพิมพ์รหัสผ่านของคุณทุกครั้ง',
	'LINK_ACCOUNT'                              => 'เชื่อมโยงบัญชี',
	'ACCOUNT'                                   => 'บัญชี',
	'LINKED_ON'                                 => 'เชื่อมโยงบน',
	'NO_LINKED_ACCOUNTS'                        => 'ไม่มีบัญชีที่เชื่อมโยง',
	'UNLINK_ACCOUNT'                            => 'ยกเลิกการเชื่อมโยงบัญชี',
	'SUCCESSFUL_UNLINKING'                      => 'ยกเลิกการเชื่อมโยงบัญชีผู้ใช้เสร็จเรียบร้อยแล้ว',

	// UCP Linking Module
	'LINKING_ACCOUNT'                           => 'การเชื่อมโยงบัญชี',
	'ACCOUNT_LINKING_EXPLAIN'                   => 'ที่นี่คุณต้องใส่ข้อมูลประจําตัวของบัญชีผู้ใช้ที่คุณต้องการเชื่อมโยงถึง',
	'FIND_ACCOUNT'                              => 'ค้นหาบัญชี',
	'CURRENT_PASSWORD_EXPLAIN_LINKACCOUNTS'     => 'คุณต้องป้อนรหัสผ่านปัจจุบันของคุณหากคุณต้องการสร้างลิงก์ไปยังบัญชีก่อนหน้า',
	'EMPTY_FIELDS'                              => 'ชื่อผู้ใช้และรหัสผ่านต้องไม่ว่างเปล่า',
	'INCORRECT_LINKED_ACCOUNT_CREDENTIALS'      => 'ข้อมูลประจําตัวที่ให้มาไม่ตรงกับบัญชีผู้ใช้ใดๆ',
	'SAME_ACCOUNT'                              => 'คุณไม่สามารถเชื่อมโยงบัญชีนี้กับตัวเองได้!',
	'INACTIVE_ACCOUNT'                          => 'บัญชีผู้ใช้ที่คุณกําลังพยายามเชื่อมโยงไปยังดูเหมือนจะไม่ได้ใช้งาน',
	'BANNED_ACCOUNT'                            => 'บัญชีที่คุณกําลังพยายามลิงก์ดูเหมือนจะถูกแบน',
	'ALREADY_LINKED'                            => 'คุณได้เชื่อมโยงไปยังบัญชีผู้ใช้นี้แล้ว',
	'MAX_LINKS_EXCEEDED'                        => 'คุณได้ใช้การเชื่อมโยงเกินจํานวนสูงสุดที่อนุญาต',

	// Switching process
	'ACCOUNTS_SWITCHED'                         => 'สลับบัญชีเสร็จเรียบร้อยแล้ว',
	'INVALID_LINKED_ACCOUNT'                    => 'คุณไม่สามารถสลับไปยังบัญชีนี้',

	// ACP Overview Module
	'ADM_LINKED_ACCOUNTS_OVERVIEW'              => 'ภาพรวม',
	'ADM_LINKED_ACCOUNTS_OVERVIEW_EXPLAIN'      => 'ในส่วนนี้คุณจะพบสถิติการใช้งานบางอย่างพร้อมกับรายการที่มีผู้ใช้ที่มีลิงก์ไปยังบัญชีอื่น',
	'LINKED_ACCOUNTS_COUNT'                     => 'ผู้ใช้ที่มีลิงก์',
	'LINKED_ACCOUNTS_COUNT_EXPLAIN'             => 'จำนวนของบัญชีที่มีลิงค์อย่างน้อยหนึ่งลิงค์',
	'LINK_COUNT'                                => 'ลิงก์',
	'LINK_COUNT_EXPLAIN'                        => 'จํานวนรวมของการลิงก์ที่สร้างขึ้น',
	'NO_ACCOUNTS_LINKED'                        => 'ไม่มีบัญชีที่มีลิงก์',

	// ACP Management Module
	'ADM_LINKED_ACCOUNTS_MANAGEMENT'            => 'จัดการผู้ใช้',
	'SELECT_USER'                               => 'เลือกผู้ใช้',
	'MANAGING_USER'                             => 'การจัดการผู้ใช้ :: %s',
	'ACCOUNT_LINKS'                             => 'บัญชีที่เชื่อมโยง',
	'LINK_ACCOUNTS'                             => 'เชื่อมโยงบัญชี้',
	'LINK_ACCOUNTS_EXPLAIN'                     => 'ที่นี่คุณสามารถสร้างลิงก์สําหรับผู้ใช้นี้',
	'SUCCESSFUL_MULTI_LINK_CREATION'            => 'สร้างการเชื่อมโยงเสร็จเรียบร้อยแล้ว',

	// ACP Settings Module
	'ADM_LINKED_ACCOUNTS_SETTINGS'              => 'การตั้งค่า',
	'ADM_LINKED_ACCOUNTS_SETTINGS_EXPLAIN'      => 'ที่นี่คุณสามารถปรับแต่งคุณสมบัติบางอย่างของส่วนขยาย',
	'CONF_AJAX'                                 => 'ใช้ AJAX เมื่อสลับบัญชี',
	'CONF_AJAX_EXPLAIN'                         => 'การเปิดใช้งานตัวเลือกนี้จะเปลี่ยนเส้นทางคุณโดยอัตโนมัติโดยไม่ต้องผ่านหน้า "ข้อมูล" ผู้ใช้ที่ไม่มีการสนับสนุน AJAX จะผ่านหน้านั้นต่อไป',
	'CONF_RETURN_TO_INDEX'                      => 'กลับไปที่หน้าเว็บเมื่อสลับบัญชี',
	'CONF_RETURN_TO_INDEX_EXPLAIN'              => 'ถ้าไม่ได้เปิดใช้งานการสลับบัญชีจะกลับไปยังหน้าเดียวกันตามค่าเริ่มต้น',
	'CONF_PRIVATE_LINKS'                        => 'ลิงก์ส่วนตัว',
	'CONF_PRIVATE_LINKS_EXPLAIN'                => 'การตั้งค่าตัวเลือกนี้เป็น "ใช่" จะซ่อนเมนูการสลับเมื่อผู้ใช้ไม่มีสิทธิ์ในการสลับแม้ว่าบัญชีจะลิงก์ นี่อาจเป็นอันตรายด้านความปลอดภัยและขอแนะนําให้ปิดการใช้งานทิ้งไว้',
	'CONF_PRESERVE_ADMIN_SESSION'               => 'รักษาเซสชันการดูแล',
	'CONF_PRESERVE_ADMIN_SESSION_EXPLAIN'       => 'เมื่อเปิดใช้งานตัวเลือกนี้ ขอแนะนําให้ปิดใช้งานการตั้งค่านี้',
	'CONF_PRESERVE_VIEW_ONLINE_SESSION'         => 'Preserve online status visibility',
	'CONF_PRESERVE_VIEW_ONLINE_SESSION_EXPLAIN' => 'When this option is enabled, if an account that is hidden switches to a linked account, the linked account will continue being hidden, regardless of its preference.',
	'CONF_MAX_LINKS'                            => 'การเชื่อมโยงสูงสุด',
	'CONF_MAX_LINKS_EXPLAIN'                    => 'ลิงก์สูงสุดที่อนุญาตต่อบัญชี การลดจํานวนนี้จะไม่เอาการเชื่อมโยงที่สร้างขึ้นออก ใช้ 0 เพื่ออนุญาตการเชื่อมโยงที่ไม่มีที่สิ้นสุด (ค่าเริ่มต้น)',

	// Posting as
	'POSTING_AS'                                => 'โพสต์เป็น',

));
