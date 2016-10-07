<?php if ( ! defined('BASEPATH')) exit('Not allowed');

class Model {

	function __get($key) {
		
		$CON =& get_instance();
		return $CON->$key;
	}
}