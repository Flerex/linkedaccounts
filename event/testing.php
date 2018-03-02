<?php

namespace flerex\linkedaccounts\event;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class testing implements EventSubscriberInterface
{

	private $auth;
	private $user;

	/**
	 * Assign functions defined in this class to event listeners in the core
	 *
	 * @return array
	 */
	static public function getSubscribedEvents()
	{
		return array(
			'core.user_setup' => 'testing',
		);
	}

	public function __construct(\phpbb\auth\auth $auth, \phpbb\user $user)
	{
		$this->auth = $auth;
		$this->user = $user;
	}

	/**
	 * Load the Acme Demo language file
	 *	 acme/demo/language/en/demo.php
	 *
	 * @param \phpbb\event\data $event The event object
	 */
	public function testing($event)
	{

		// $this->user->session_kill(false);
		// $this->user->session_begin();
		// $this->user->session_create(2);
	}
}