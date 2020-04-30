<?php


namespace flerex\linkedaccounts\service;


class auth_service
{
	/** @var \phpbb\user */
	protected $user;

	/** @var \phpbb\auth\auth */
	protected $auth;

	/** @var \phpbb\db\driver\factory */
	protected $db;


	/**
	 * auth_service constructor.
	 *
	 * @param \phpbb\user              $user
	 * @param \phpbb\auth\auth         $auth
	 * @param \phpbb\db\driver\factory $db
	 */
	public function __construct(\phpbb\user $user, \phpbb\auth\auth $auth, \phpbb\db\driver\factory $db)
	{
		$this->user = $user;
		$this->auth = $auth;
		$this->db = $db;
	}

	/**
	 * Get a user's ID by their cleaned username or user id
	 *
	 * @param int $key The cleaned username or user's id
	 *
	 * @return array The user
	 */

	public function get_user($key): array
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
	 * Obtain auth information about the given user by its username.
	 * ID, username, password, email and type
	 *
	 * @param string $username The user's name
	 *
	 * @return array
	 */
	public function get_user_auth_info(string $username): array
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

}