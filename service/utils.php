<?php

namespace flerex\linkedaccounts\service;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class utils
{

	/** @var \phpbb\user */
	protected $user;

	/** @var \phpbb\db\driver\factory */
	protected $db;

	/** @var string */
	protected $linkedacconts_table;

	public function __construct(\phpbb\user $user, \phpbb\db\driver\factory $db, $linkedacconts_table)
	{
		$this->user					= $user;
		$this->db					= $db;
		$this->linkedacconts_table	= $linkedacconts_table;
	}

	/**
	 * Obtain a list of the accounts linked
	 * to the current user.
	 *
	 * @return array An array of (int) IDs
	 */
	public function get_linked_accounts()
	{

		$sql = 'SELECT u.user_id, u.user_type, u.user_email, u.user_colour, u.username, u.user_avatar, u.user_avatar_type, u.user_avatar_height, u.user_avatar_width, l.created_at
			FROM ' . USERS_TABLE . ' u
			LEFT JOIN ' . $this->db->sql_escape($this->linkedacconts_table) . ' l
			ON u.user_id = l.linked_user_id
			WHERE l.user_id = ' . (int) $this->user->data['user_id'] . '
			UNION
			SELECT u.user_id, u.user_type, u.user_email, u.user_colour, u.username, u.user_avatar, u.user_avatar_type, u.user_avatar_height, u.user_avatar_width, l.created_at
			FROM ' . USERS_TABLE . ' u
			LEFT JOIN ' . $this->db->sql_escape($this->linkedacconts_table) . ' l
			ON u.user_id = l.user_id
			WHERE l.linked_user_id = ' . (int) $this->user->data['user_id'];
		
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
	 * Unlinks the given accounts from the current user
	 *
	 * @param array $links An array with the accounts IDs
	 * @return array An array of (int) IDs
	 *
	 */
	public function remove_links($links)
	{

		$sql_where = '';
		$len = count($links);
		foreach($links as $key => $account)
		{
			$sql_where .= '(user_id = ' . (int) $this->db->sql_escape($account) . ' OR linked_user_id = ' . (int) $this->db->sql_escape($account) . ')';

			if($key != $len - 1)
			{
				$sql_where .= ' OR ';
			}
		}

		$sql = 'DELETE FROM ' . $this->db->sql_escape($this->linkedacconts_table) . '
			WHERE (user_id = ' . (int) $this->user->data['user_id'] . ' OR linked_user_id = ' . (int) $this->user->data['user_id'] . ')
			AND (' . $this->db->sql_escape($sql_where) . ')';

		$this->db->sql_query($sql);

	}
	
	/**
	 * Checks whether the account is already linked to the account
	 * trying to be linking to
	 *
	 * @param int $linked_id The id of the account to be linked
	 * @return bool
	 *
	 */
	public function already_linked($linked_id)
	{

		$sql = 'SELECT COUNT(user_id) AS already_linked FROM ' . $this->linkedacconts_table . '
			WHERE (user_id = ' . (int) $this->user->data['user_id'] . ' AND linked_user_id = ' . (int) $this->db->sql_escape($linked_id) . ')
			OR (user_id = ' . (int) $this->db->sql_escape($linked_id) . ' AND linked_user_id = ' . (int) $this->user->data['user_id'] . ')';

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

		$is_linked = false;
		$saved_account;
		foreach($this->get_linked_accounts() as $account)
		{
			if($account['user_id'] == $account_id)
			{
				$saved_account = $account;
				break;
			}
		}
		
		if($saved_account && ($saved_account['user_type'] == 1 || $this->user->check_ban($account_id, false, $saved_account['user_email'], true) !== false))
		{
			return false;
		}	

		return true;

	}
}