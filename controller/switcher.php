<?php

use \Symfony\Component\HttpFoundation\Response;

namespace flerex\linkedaccounts\controller;

class switcher
{
	/** @var \phpbb\user */
	protected $user;

	/** @var \phpbb\auth\auth $auth, */
	protected $auth;

	/** @var \phpbb\controller\helper */
	protected $helper;

	/**
	 * Constructor
	 *
	 * @param \flerex\linkedaccounts\service\utils $utils
	 */
	public function __construct(\phpbb\user $user, \phpbb\auth\auth $auth, \flerex\linkedaccounts\service\utils $utils)
	{
		$this->user		= $user;
		$this->auth		= $auth;
		$this->utils	= $utils;
	}

	/**
	 * Demo controller for route /demo/{name}
	 *
	 * @param string $name
	 * @throws \phpbb\exception\http_exception
	 * @return \Symfony\Component\HttpFoundation\Response A Symfony Response object
	 */
	public function handle($account_id)
	{

		if (!$this->auth->acl_get('u_link_accounts'))
		{
			throw new \phpbb\exception\http_exception(403, 'NO_AUTH_OPERATION');
		}

		if (!$this->utils->can_switch_to($account_id))
		{
			throw new \phpbb\exception\http_exception(403, 'INVALID_LINKED_ACCOUNT', array($account_id));
		}

		$this->user->session_kill(false);
		$this->user->session_begin();
		$this->user->session_create($account_id);
		
		throw new \phpbb\exception\http_exception(200, 'ACCOUNTS_SWITCHED');

	}
}