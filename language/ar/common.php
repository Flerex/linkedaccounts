<?php
/**
*
* Linked Accounts extension for phpBB 3.2
*
* @copyright (c) 2018 Flerex
* @author Flerex <flerex@icloud.com>
* @license GNU General Public License, version 2 (GPL-2.0)
*
* Translated By : Bassel Taha Alhitary <http://alhitary.net>
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
	'LINKED_ACCOUNTS'						=> 'ربط الحسابات',
	'ADM_LINKED_ACCOUNTS'					=> 'ربط الحسابات',
	
	// UCP Management Module
	'LINKED_ACCOUNTS_MANAGEMENT'			=> 'إدارة الحساب',
	'LINKED_ACCOUNTS_DESCRIPTION'			=> 'من هنا تستطيع ربط الحسابات الآخرى إلى حسابك الحالي. ربط الحسابات سوف يعطيك إمكانية الإنتقال بسهولة بين الحسابات المختلفة بدون الحاجة إلى كتابة كلمة السر الخاصة بك في كل مرة.',
	'LINK_ACCOUNT'							=> 'ربط الحسابات',
	'ACCOUNT'								=> 'الحساب',
	'LINKED_ON'								=> 'تاريخ الربط',
	'NO_LINKED_ACCOUNTS'					=> 'لا توجد حسابات مربوطة.',
	'UNLINK_ACCOUNT'						=> 'الغاء ربط الحساب',
	'SUCCESSFUL_UNLINKING' 					=> 'تم الغاء ربط الحسابات بنجاح.',

	// UCP Linking Module
	'LINKING_ACCOUNT'						=> 'ربط الحساب',
	'ACCOUNT_LINKING_EXPLAIN'				=> 'يجب عليك كتابة إسم المستخدم وكلمة السر الخاصة بالحساب الذي تريد الارتباط به.',
	'FIND_ACCOUNT'							=> 'البحث عن حساب',
	'CURRENT_PASSWORD_EXPLAIN_LINKACCOUNTS' => 'يجب عليك كتابة كلمة السر الخاصة بحسابك الحالي لكي تستطيع الإرتباط بحساب آخر.',
	'EMPTY_FIELDS'							=> 'يجب تعبئة حقول إسم المستخدم وكلمة السر.',
	'INCORRECT_LINKED_ACCOUNT_CREDENTIALS'	=> 'البيانات التي أدخلتها لا تتطابق مع أي حساب بالمنتدى.',
	'SAME_ACCOUNT'							=> 'لا تستطيع ربط هذا الحساب مع نفسه!',
	'INACTIVE_ACCOUNT'						=> 'يبدو أن الحساب الذي تحاول الربط به غير مفعل.',
	'BANNED_ACCOUNT'						=> 'يبدو أن الحساب الذي تحاول الربط به محظور.',
	'ALREADY_LINKED'						=> 'حسابك مرتبط مسبقاً بهذا الحساب.',

	// Switching process
	'ACCOUNTS_SWITCHED'						=> 'تم التحويل بين الحسابات بنجاح.',
	'INVALID_LINKED_ACCOUNT'				=> 'لا تستطيع التحويل إلى هذا الحساب.',

	// ACP Overview Module
	'ADM_LINKED_ACCOUNTS_OVERVIEW'			=> 'نظرة عامة',
	'ADM_LINKED_ACCOUNTS_OVERVIEW_EXPLAIN'	=> 'من هنا تستطيع مشاهدة الأحصائيات العامة وكذلك قائمة بالأعضاء الذين لديهم ربط بحسابات أخرى.',
	'LINKED_ACCOUNTS_COUNT'					=> 'الأعضاء الذين لديهم حسابات',
	'LINKED_ACCOUNTS_COUNT_EXPLAIN'			=> 'إجمالي عدد الأعضاء الذين لديهم حساب واحد على الأقل.',
	'LINK_COUNT'							=> 'الحسابات ',
	'LINK_COUNT_EXPLAIN'					=> 'إجمالي عدد الحسابات التي تم ربطها.',
	'NO_ACCOUNTS_LINKED'					=> 'لايوجد أعضاء لديهم ربط بحسابات أخرى.',

	// ACP Management Module
	'ADM_LINKED_ACCOUNTS_MANAGEMENT'		=> 'إدارة الأعضاء',
	'SELECT_USER'							=> 'تحديد عضو',
	'MANAGING_USER'							=> 'إدارة العضو :: %s',
	'ACCOUNT_LINKS'							=> 'الحسابات المربوطة',
	'LINK_ACCOUNTS'							=> 'ربط الحسابات',
	'LINK_ACCOUNTS_EXPLAIN'					=> 'من هنا تستطيع ربط الحسابات لهذا العضو.',
	'SUCCESSFUL_MULTI_LINK_CREATION'		=> 'تم الربط بنجاح.',

	// ACP Settings Module
	'ADM_LINKED_ACCOUNTS_SETTINGS'			=> 'الإعدادات',
	'ADM_LINKED_ACCOUNTS_SETTINGS_EXPLAIN'	=> 'من هنا تستطيع ضبط الإعدادات الخاصة بالإضافة.',
	'CONF_AJAX'								=> 'استخدم الأجاكس AJAX ',
	'CONF_AJAX_EXPLAIN'						=> 'اختيارك “نعم” يعني الإنتقال بين الحسابات تلقائياً, يدون الحاجة إلى توجيهك لصفحة “المعلومات” التي تخبرك بنجاح عملية التحويل. الأعضاء الذين لاتتوفر لديهم الأجاكس AJAX سيتم نقلهم إلى صفحة “المعلومات” على كل حال.',
	'CONF_RETURN_TO_INDEX'					=> 'العودة إلى الصفحة الرئيسية ',
	'CONF_RETURN_TO_INDEX_EXPLAIN'			=> 'اختيارك “نعم” يعني العودة إلى الصفحة الرئيسية للمنتدى عند الإنتقال بين الحسابات. اختيارك “لا” يعني العودة إلى نفس الصفحة بصورة افتراضية.',
	'CONF_PRIVATE_LINKS'					=> 'إخفاء الحسابات ',
	'CONF_PRIVATE_LINKS_EXPLAIN'			=> 'اختيارك “نعم” يعني اخفاء الحسابات المربوطة من القائمة المنسدلة عند عدم امتلاك العضو لصلاحيات ربط الحسابات. ننصح بتعطيل هذا الخيار لكي تتجنب أي مخاطر أمنية.',

	// Posting as
	'POSTING_AS'                            => 'Posting as',

));
