<?php if ( ! defined('BASEPATH')) exit('Not allowed');

class Controller {

	private static $instance;

	public function __construct()
	{
		self::$instance =& $this;

		foreach (loaded() as $var => $class) {
			$this->$var =& load_class($class);
		}

		$this->load = load_class('loader');
	}

	public static function &get_instance()
	{
		if( ! isset(self::$instance)) {
			self::$instance = new Controller;
		}
		return self::$instance;
	}

	public function alert()
	{
		echo 'alert();';
	}

}