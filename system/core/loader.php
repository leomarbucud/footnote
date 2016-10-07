<?php if ( ! defined('BASEPATH')) exit('Not allowed');

class Loader {

	protected $_ob_level;

	function __construct()
	{
		$this->_ob_level = ob_get_level();
		$this->autoload();
	}

	function autoload()
	{
		$CON =& get_instance();

		include APPPATH.'config/autoload.php';

		foreach ($autoload as $key => $value) {
			foreach ($value as $load) {
				$CON->$load =& load_class($load, $key);
			}
		}
	}

	public function view($file, $vars = array())
	{

		$CON =& get_instance();

		foreach (get_object_vars($CON) as $key => $var) {
			if ( ! isset($this->$key)) {
				$this->$key =& $CON->$key;
			}
		}
		//echo get_class($CON);
		if (count($vars) > 0) {
			extract($vars);
		}

		$file = (file_exists(VIEWPATH.$file)) ? $file : $file.'.php';

		if (file_exists(VIEWPATH.$file)) {
			ob_start();

			include(VIEWPATH.$file);

			if (ob_get_level() > $this->_ob_level + 1) {
				ob_end_flush();
			} else {
				$CON->output->display(ob_get_clean());
			}
		}
	}

	public function model($model, $name = '')
	{
		if ($name == '') {
			$name = $model;
		}

		$CON =& get_instance();

		if (isset($CON->$name)) {
			show_error('Model already in use: '.$name);
		}

		//$CON->mysql = load_class('mysql','database');

		$CON->db = load_class('db','database');

		load_class('Model');

		require_once MODPATH.$model.'.php';

		$CON->$name = new $model;
	}
}