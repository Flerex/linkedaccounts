<?php
/**
 *
 * @package       phpBB Extension - Linked Accounts
 * @copyright (c) 2018 Flerex
 * @license       http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace flerex\linkedaccounts\service;

use flerex\linkedaccounts\constants\constants;
use phpbb\config\config;
use phpbb\db\driver\factory as db;
use phpbb\user;

class linking_service
{

	/** @var user */
	protected $user;

	/** @var config $config */
	protected $config;

	/** @var db */
	protected $db;

	/** @var string */
	protected $linkedaccounts_table;

	/**
	 * Constructor
	 *
	 * @param user   $user
	 * @param config $config
	 * @param db     $db
	 * @param string $linkedaccounts_table
	 */
	public function __construct(user $user, config $config, db $db, string $linkedaccounts_table)
	{
		$this->user = $user;
		$this->config = $config;
		$this->db = $db;
		$this->linkedaccounts_table = $linkedaccounts_table;
	}


	/**
	 * Unlinks the given accounts from the current user
	 *
	 * @param array $links   An array with the accounts IDs
	 * @param int   $account The id of the account whose links
	 *                       to accounts in $links will be removed
	 *
	 * @return void
	 */
	public function remove_links(array $links, int $account = null): void
	{

		if (!$account)
		{
			$account = $this->user->data['user_id'];
		}
		$sql_where = '';
		$len = count($links);
		foreach ($links as $key => $acc)
		{
			$sql_where .= '(user_id = ' . (int) $acc . ' OR linked_user_id = ' . (int) $acc . ')';

			if ($key != $len - 1)
			{
				$sql_where .= ' OR ';
			}
		}

		$sql = 'DELETE FROM ' . $this->linkedaccounts_table . '
			WHERE (user_id = ' . (int) $account . ' OR linked_user_id = ' . (int) $account . ')
			AND (' . $sql_where . ')';

		$this->db->sql_query($sql);

	}

	/**
	 * Checks whether the account is already linked to the account
	 * trying to be linked to
	 *
	 * @param int $linked_id The id of the account to be linked
	 * @return bool
	 *
	 */
	public function already_linked(int $linked_id): bool
	{

		$sql = 'SELECT COUNT(user_id) AS already_linked FROM ' . $this->linkedaccounts_table . '
			WHERE (user_id = ' . (int) $this->user->data['user_id'] . ' AND linked_user_id = ' . (int) $linked_id . ')
			OR (user_id = ' . (int) $linked_id . ' AND linked_user_id = ' . (int) $this->user->data['user_id'] . ')';

		$result = $this->db->sql_query($sql);
		$found_something = $this->db->sql_fetchfield('already_linked') != 0;

		$this->db->sql_freeresult($result);
		return $found_something;

	}

	/**
	 * Returns true if the passed account can be switched to
	 *
	 * @param int $account_id The id of the account
	 *
	 * @return bool
	 *
	 */
	public function can_switch_to(int $account_id): bool
	{

		$linked_accounts = $this->get_linked_accounts();
		$account = array_search($account_id, array_column($linked_accounts, 'user_id'));

		if ($account === false)
		{
			return false;
		}

		$account = $linked_accounts[$account];

		return ($account['user_type'] != USER_INACTIVE // cannot be inactive
			&& !$this->user->check_ban($account_id, false, $account['user_email'], true) !== false); // Cannot be banned
	}

	/**
	 * Return whether the user of the provided $id can create more accounts.
	 *
	 * @param int|null $id
	 * @return bool
	 */
	public function user_exceeds_max_links(int $id = null): bool
	{

		$max_links = (int) $this->config['flerex_linkedaccounts_max_links'];

		if ($max_links === constants::INFINITE_ACCOUNTS)
		{
			return false;
		}

		return count($this->get_linked_accounts($id)) >= $max_links;
	}

	/**
	 * Obtain a list of the accounts linked
	 * to the current user.
	 *
	 * @param int $id
	 * @return array An array of (int) IDs
	 */
	public function get_linked_accounts(int $id = null): array
	{
		if (!$id)
		{
			$id = $this->user->data['user_id'];
		}

		$sql = 'SELECT u.user_id, u.user_type, u.user_email, u.user_colour, u.username, u.user_avatar, u.user_avatar_type, u.user_avatar_height, u.user_avatar_width, u.user_posts, u.user_rank, l.created_at
			FROM ' . USERS_TABLE . ' u
			LEFT JOIN ' . $this->linkedaccounts_table . ' l
			ON u.user_id = l.linked_user_id
			WHERE l.user_id = ' . (int) $id . '
			UNION
			SELECT u.user_id, u.user_type, u.user_email, u.user_colour, u.username, u.user_avatar, u.user_avatar_type, u.user_avatar_height, u.user_avatar_width, u.user_posts, u.user_rank, l.created_at
			FROM ' . USERS_TABLE . ' u
			LEFT JOIN ' . $this->linkedaccounts_table . ' l
			ON u.user_id = l.user_id
			WHERE l.linked_user_id = ' . (int) $id;

		$result = $this->db->sql_query($sql);

		$output = array();
		while ($row = $this->db->sql_fetchrow($result))
		{
			$output[] = $row;
		}

		$this->db->sql_freeresult($result);

		return $output;
	}

	/**
	 * Returns the amount of links created throughout the forum.
	 *
	 * @return int
	 *
	 */
	public function get_link_count(): int
	{
		$sql = 'SELECT COUNT(user_id) AS count FROM ' . $this->linkedaccounts_table . ' ';
		$result = $this->db->sql_query($sql);
		$count = $this->db->sql_fetchfield('count');

		$this->db->sql_freeresult($result);
		return $count;
	}

	/**
	 * Returns the amount of accounts that are part of a link.
	 *
	 * For example, if there's one link in the forum (account A linked with account B) then this function would
	 * return 2, one for every account on each side of the link.
	 *
	 * @return int
	 *
	 */
	public function get_account_count(): int
	{
		$sql = 'SELECT count(*) AS count FROM (SELECT user_id FROM ' . $this->linkedaccounts_table . '
		UNION SELECT linked_user_id FROM ' . $this->linkedaccounts_table . ') AS t';

		$result = $this->db->sql_query($sql);
		$count = $this->db->sql_fetchfield('count');

		$this->db->sql_freeresult($result);
		return $count;
	}

	/**
	 * Returns an array with the accounts
	 * that are part of a link
	 *
	 * @param int $start
	 * @param int $limit
	 * @return array
	 */
	public function get_accounts(int $start, int $limit): array
	{
		$sql = 'SELECT u.user_id, u.user_colour, u.username, COUNT(u.user_id) AS link_count
			FROM ' . USERS_TABLE . ' AS u JOIN ' . $this->linkedaccounts_table . ' AS l
			ON u.user_id = l.user_id OR u.user_id = l.linked_user_id
			GROUP BY u.user_id';

		$result = $this->db->sql_query_limit($sql, $limit, $start);
		$output = array();

		while ($row = $this->db->sql_fetchrow($result))
		{
			$output[] = $row;
		}

		$this->db->sql_freeresult($result);

		return $output;
	}

	/**
	 * Creates a new link between
	 * account1 and account2
	 *
	 * @param int $account1 ID of account1
	 * @param int $account2 ID of account2
	 *
	 * @return void
	 */
	public function create_link(int $account1, int $account2): void
	{

		$sql_arr = array(
			'user_id'        => $account1,
			'linked_user_id' => $account2,
			'created_at'     => time(),
		);

		$sql = 'INSERT INTO ' . $this->linkedaccounts_table . ' ' . $this->db->sql_build_array('INSERT', $sql_arr);

		$this->db->sql_query($sql);
	}

	/**
	 * Creates new links between
	 * account and every account in the
	 * accounts array
	 *
	 * @param int   $account  ID of account
	 * @param array $accounts IDs of the accounts
	 *
	 * @return void
	 */

	public function create_links(int $account, array $accounts): void
	{

		$sql_ary = array();

		foreach ($accounts as $account_to_link)
		{
			$sql_ary[] = array(
				'user_id'        => (int) $account,
				'linked_user_id' => (int) $account_to_link,
				'created_at'     => (int) time(),
			);
		}

		$this->db->sql_multi_insert($this->linkedaccounts_table, $sql_ary);

	}

	/**
	 * Finds all existing accounts in “accounts” that
	 * account “account” is linked to.
	 *
	 * @param int   $account  ID of account
	 * @param array $accounts IDs of the accounts
	 *
	 * @return array all the found links
	 *
	 */

	public function get_linked_accounts_of_array(int $account, array $accounts): array
	{

		$sql = 'SELECT linked_user_id
			FROM ' . $this->linkedaccounts_table . ' 
			WHERE user_id = ' . (int) $account . ' AND ' . $this->db->sql_in_set('linked_user_id', $accounts) . '
			UNION
			SELECT user_id
			FROM ' . $this->linkedaccounts_table . ' 
			WHERE ' . $this->db->sql_in_set('user_id', $accounts) . ' AND linked_user_id = ' . (int) $account;

		$result = $this->db->sql_query($sql);

		$output = array();

		while ($row = $this->db->sql_fetchrow($result))
		{
			$output[] = $row;
		}

		$this->db->sql_freeresult($result);

		$output = array_map(function ($el) {
			return $el['linked_user_id'];
		}, $output);

		return $output;

	}

	/**
	 * Switches the current account to another
	 * that is linked to the current one.
	 *
	 * @param int $account_id The linked account id
	 *
	 * @return void
	 */
	public function switch_to_linked_account(int $account_id): void
	{

		$session_autologin = (bool) $this->user->data['session_autologin'];
		$session_viewonline = $this->config['flerex_linkedaccounts_preserve_view_online_session']
			? (bool) $this->user->data['session_viewonline']
			: true;
		$preserve_admin_login = $this->config['flerex_linkedaccounts_preserve_admin_session']
			? (bool) $this->user->data['session_admin']
			: false;

		$session_page = $this->user->data['session_page']; // We retrieve the current page before switching users

		$this->user->session_kill(false);
		$this->user->session_begin();
		$this->user->session_create($account_id, $preserve_admin_login, $session_autologin, $session_viewonline);
		$this->user->update_session(['session_page' => $session_page]);
		$this->user->data['session_page'] = $session_page;
	}

}