<?php

namespace flerex\linkedaccounts\service;

use phpbb\auth\auth;
use phpbb\config\config;
use phpbb\db\driver\factory as db;
use phpbb\user;
use \phpbb\captcha\factory as captcha;

class auth_service
{
	/** @var auth */
	protected $auth;

	/** @var db */
	protected $db;

	/** @var config $config */
	protected $config;

	/** @var user */
	protected $user;


	/**
	 * auth_service constructor.
	 *
	 * @param auth   $auth
	 * @param db     $db
	 * @param config $config
	 * @param user   $user
	 */
	public function __construct(auth $auth, db $db, config $config, user $user)
	{
		$this->auth = $auth;
		$this->db = $db;
		$this->config = $config;
		$this->user = $user;
	}

	/**
	 * Get a user's ID by their cleaned username or user id
	 *
	 * @param int $key The cleaned username or user's id
	 *
	 * @return array|null user
	 */

	public function get_user($key) : ?array
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

		return $user ?: null;
	}

	/**
	 * Obtain auth information about the given user by its username.
	 * ID, username, password, email and type
	 *
	 * @param string $username The user's name
	 *
	 * @return array|null
	 */
	public function get_user_auth_info(string $username): ?array
	{

		$sql = 'SELECT user_id, user_password, user_email, user_type, user_login_attempts FROM ' . USERS_TABLE . "
			WHERE username_clean = '" . $this->db->sql_escape(utf8_clean_string($username)) . "'";

		$result = $this->db->sql_query($sql);
		$output = $this->db->sql_fetchrow($result);

		$this->db->sql_freeresult($result);

		return $output ?: null;
	}

	/**
	 * Checks whether the given user can post or reply on a forum.
	 *
	 * @param int    $user_id        The id of the user
	 * @param int    $forum_id       The id of the forum
	 * @param string $mode           The posting mode
	 * @param bool   $is_first_post  Whether we're
	 *                               creating a new topic
	 *
	 * @return bool
	 */
	public function user_can_post_on_forum(int $user_id, int $forum_id, string $mode, bool $is_first_post): bool
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


	/**
	 * Returns the number of failed login attempts for the current session.
	 *
	 * @return int
	 */
	public function get_ip_login_attempts(): int
	{

		if (!($this->user->ip && !$this->config['ip_login_limit_use_forwarded']) &&
			!($this->user->forwarded_for && $this->config['ip_login_limit_use_forwarded']))
		{
			return 0;
		}

		$sql = 'SELECT COUNT(*) AS attempts FROM ' . LOGIN_ATTEMPT_TABLE
			. ' WHERE attempt_time > ' . (time() - (int) $this->config['ip_login_limit_time']);

		if ($this->config['ip_login_limit_use_forwarded'])
		{
			$sql .= " AND attempt_forwarded_for = '" . $this->db->sql_escape($this->user->forwarded_for) . "'";
		}
		else
		{
			$sql .= " AND attempt_ip = '" . $this->db->sql_escape($this->user->ip) . "' ";
		}

		$result = $this->db->sql_query($sql);
		$attempts = (int) $this->db->sql_fetchfield('attempts');
		$this->db->sql_freeresult($result);

		return $attempts;
	}

	/**
	 * Adds a new login attempt to the given user.
	 *
	 * @param int $user_id
	 */
	public function add_login_attempt_for_user(int $user_id): void
	{
		$sql = 'UPDATE ' . USERS_TABLE . ' SET user_login_attempts = user_login_attempts + 1 WHERE user_id = ' . $user_id;
		$this->db->sql_query($sql);
	}

	/**
	 * Restores the user attemps for a user.
	 *
	 * @param int $user_id
	 */
	public function restore_login_attempt_for_user(int $user_id): void
	{
		$sql = 'UPDATE ' . USERS_TABLE . ' SET user_login_attempts = 0 WHERE user_id = ' . $user_id;
		$this->db->sql_query($sql);
	}

	/**
	 * Adds a new login attempt from a given IP to a specific user.
	 *
	 * If no user is provided, we are assuming an unexistent user (0).
	 *
	 * @param string $username
	 * @param int    $user_id
	 */
	public function add_ip_login_attempt(string $username, int $user_id = 0): void
	{
		$attempt_data = array(
			'attempt_ip'            => $this->user->ip,
			'attempt_browser'       => trim(substr($this->user->browser, 0, 149)),
			'attempt_forwarded_for' => $this->user->forwarded_for,
			'attempt_time'          => time(),
			'user_id'               => $user_id,
			'username'              => $username,
			'username_clean'        => utf8_clean_string($username),
		);

		$sql = 'INSERT INTO ' . LOGIN_ATTEMPT_TABLE . $this->db->sql_build_array('INSERT', $attempt_data);
		$this->db->sql_query($sql);
	}

	/**
	 * Removes all IP login attempts for a given user.
	 *
	 * @param int $user_id
	 */
	public function remove_ip_login_attempt_for_user(int $user_id = 0): void
	{
		$sql = 'DELETE FROM ' . LOGIN_ATTEMPT_TABLE . ' WHERE user_id = ' . $user_id;
		$this->db->sql_query($sql);
	}

}