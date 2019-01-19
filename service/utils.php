<?php
/**
 *
 * @package       phpBB Extension - Linked Accounts
 * @copyright (c) 2018 Flerex
 * @license       http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace flerex\linkedaccounts\service;

class utils
{

	/** @var \phpbb\user */
	protected $user;

	/** @var \phpbb\auth\auth */
	protected $auth;

	/** @var \phpbb\db\driver\factory */
	protected $db;

	/** @var string */
	protected $linkedacconts_table;

	/**
	 * Constructor
	 *
	 * @param \phpbb\user              $user
	 * @param \phpbb\auth\auth         $auth
	 * @param \phpbb\db\driver\factory $db
	 * @param string                   $linkedacconts_table
	 */
	public function __construct(\phpbb\user $user, \phpbb\auth\auth $auth, \phpbb\db\driver\factory $db, $linkedacconts_table)
	{
		$this->user = $user;
		$this->auth = $auth;
		$this->db = $db;
		$this->linkedacconts_table = $linkedacconts_table;
	}


	/**
	 * Get a user's ID by their
	 * cleaned username or user id
	 *
	 * @param string|int $key The cleaned username
	 *                        or user's id
	 *
	 * @return array The user
	 */

	public function get_user($key)
	{

		$sql = 'SELECT user_id, username, username_clean, user_colour, user_permissions, user_type
			FROM ' . USERS_TABLE . ' ';

		if (is_numeric($key))
		{
			$sql .= 'WHERE user_id = ' . (int) $key;
		}
		else
		{
			$sql .= "WHERE username_clean = '" . $this->db->sql_escape(utf8_clean_string($key)) . "'";
		}

		$result = $this->db->sql_query($sql);
		$user = $this->db->sql_fetchrow();
		$this->db->sql_freeresult($result);

		return $user;
	}

	/**
	 * Unlinks the given accounts from the current user
	 *
	 * @param array $links   An array with the accounts IDs
	 * @param int   $account The id of the account whose links
	 *                       to accounts in $links will be removed
	 *
	 */
	public function remove_links($links, $account = null)
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

		$sql = 'DELETE FROM ' . $this->db->sql_escape($this->linkedacconts_table) . '
			WHERE (user_id = ' . (int) $account . ' OR linked_user_id = ' . (int) $account . ')
			AND (' . $this->db->sql_escape($sql_where) . ')';

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
	public function already_linked($linked_id)
	{

		$sql = 'SELECT COUNT(user_id) AS already_linked FROM ' . $this->linkedacconts_table . '
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
	public function can_switch_to($account_id)
	{

		$account = array_search($account_id, array_column($this->get_linked_accounts(), 'user_id'));

		if ($account === false // must be linked
			|| ($account['user_type'] == USER_INACTIVE // cannot be inactive
			|| $this->user->check_ban($account_id, false, $account['user_email'], true) !== false) // Cannot be banned
		)
		{
			return false;
		}

		return true;
	}

	/**
	 * Obtain a list of the accounts linked
	 * to the current user.
	 *
	 * @return array An array of (int) IDs
	 */
	public function get_linked_accounts($id = null)
	{
		if (!$id)
		{
			$id = $this->user->data['user_id'];
		}

		$sql = 'SELECT u.user_id, u.user_type, u.user_email, u.user_colour, u.username, u.user_avatar, u.user_avatar_type, u.user_avatar_height, u.user_avatar_width, u.user_posts, u.user_rank, l.created_at
			FROM ' . USERS_TABLE . ' u
			LEFT JOIN ' . $this->db->sql_escape($this->linkedacconts_table) . ' l
			ON u.user_id = l.linked_user_id
			WHERE l.user_id = ' . (int) $id . '
			UNION
			SELECT u.user_id, u.user_type, u.user_email, u.user_colour, u.username, u.user_avatar, u.user_avatar_type, u.user_avatar_height, u.user_avatar_width, u.user_posts, u.user_rank, l.created_at
			FROM ' . USERS_TABLE . ' u
			LEFT JOIN ' . $this->db->sql_escape($this->linkedacconts_table) . ' l
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
	 * Returns the amount of links created
	 *
	 * @return int
	 *
	 */
	public function get_link_count()
	{
		$sql = 'SELECT COUNT(user_id) AS count FROM ' . $this->linkedacconts_table . ';';
		$result = $this->db->sql_query($sql);
		$count = $this->db->sql_fetchfield('count');

		$this->db->sql_freeresult($result);
		return $count;
	}

	/**
	 * Returns the amount of accounts that
	 * are part of a link
	 *
	 * @return int
	 *
	 */
	public function get_account_count()
	{
		$sql = 'SELECT count(*) AS count FROM (SELECT user_id FROM ' . $this->linkedacconts_table . '
		UNION SELECT linked_user_id FROM ' . $this->linkedacconts_table . ') AS t;';

		$result = $this->db->sql_query($sql);
		$count = $this->db->sql_fetchfield('count');

		$this->db->sql_freeresult($result);
		return $count;
	}

	/**
	 * Returns an array with the accounts
	 * that are part of a link
	 *
	 * @return array
	 *
	 */
	public function get_accounts($start, $limit)
	{
		$sql = 'SELECT u.user_id, u.user_colour, u.username, COUNT(u.user_id) AS link_count
			FROM ' . USERS_TABLE . ' AS u JOIN ' . $this->linkedacconts_table . ' AS l
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
	 */
	public function create_link($account1, $account2)
	{

		$sql_arr = array(
			'user_id'        => (int) $account1,
			'linked_user_id' => (int) $account2,
			'created_at'     => (int) time(),
		);

		$sql = 'INSERT INTO '
			. $this->linkedacconts_table . ' '
			. $this->db->sql_build_array('INSERT', $sql_arr);

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
	 */

	public function create_links($account, $accounts)
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

		$this->db->sql_multi_insert($this->linkedacconts_table, $sql_ary);

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

	public function get_linked_accounts_of_array($account, $accounts)
	{

		$sql = 'SELECT linked_user_id
			FROM ' . $this->linkedacconts_table . ' 
			WHERE user_id = ' . (int) $account . ' AND ' . $this->db->sql_in_set('linked_user_id', $accounts) . '
			UNION
			SELECT user_id
			FROM ' . $this->linkedacconts_table . ' 
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
	 * Obtain auth information about
	 * the given user by its username.
	 * ID, username, password,
	 * email and type
	 *
	 * @param string $usename The user's name
	 *
	 * @return array
	 */
	public function get_user_auth_info($username)
	{

		$sql = 'SELECT user_id, user_password, user_email, user_type
			FROM ' . USERS_TABLE . "
			WHERE username_clean = '" . $this->db->sql_escape(utf8_clean_string($username)) . "'";

		$result = $this->db->sql_query($sql);
		$output = $this->db->sql_fetchrow($result);

		$this->db->sql_freeresult($result);

		return $output;
	}

	/**
	 * Switches the current account to another
	 * that is linked to the current one.
	 *
	 * @param int $account_id The linked account id
	 *
	 * @return array
	 */
	public function switch_to_linked_account($account_id)
	{

		$session_autologin = (bool) $this->user->data['session_autologin'];
		$session_viewonline = (bool) $this->user->data['session_viewonline'];

		$this->user->session_kill(false);
		$this->user->session_begin();
		$this->user->session_create(
			$account_id,
			false, // for security reasons we always set this to false (admin login)
			$session_autologin,
			$session_viewonline
		);
	}

	/**
	 * Checks whether the given user can post or reply
	 * on a forum.
	 *
	 * @param int     $user_id       The id of the user
	 * @param int     $forum_id      The id of the forum
	 * @param string  $mode          The posting mode
	 * @param boolean $is_first_post Whether we're
	 *                               creating a new topic
	 *
	 * @return boolean
	 */
	public function user_can_post_on_forum($user_id, $forum_id, $mode, $is_first_post)
	{


		$permissions = $this->auth->acl_get_list($user_id, false, $forum_id);

		if (empty($permissions))
		{
			return false;
		}

		$permissions = array_keys($permissions[$forum_id]);

		switch ($mode)
		{
			case 'post':
				return array_search('f_post', $permissions) !== false;

			case 'reply':
			case 'quote':
				return array_search('f_reply', $permissions) !== false;

			case 'edit':
				return $is_first_post
					? array_search('f_post', $permissions) !== false
					: array_search('f_reply', $permissions) !== false;
		}

		return false;

	}
}