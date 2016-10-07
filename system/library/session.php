<?php

class Session {

	public function __construct()
	{
		session_start();
	}

	public function _set($name, $value)
	{
		if ( ! isset($_SESSION[$name])) {
			$_SESSION[$name] = $value;
			return true;
		} else
			return false;
	}

	public function _get($name)
	{
		if (isset($_SESSION[$name])) {
			$value = $_SESSION[$name];
			return $value;
		} else
		return false;
	}

	public function _unset($name)
	{
		if (isset($_SESSION[$name]))
			session_unset($name);
		else
			return false;	
	}
}