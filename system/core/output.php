<?php if ( ! defined('BASEPATH')) exit('Not allowed');

class Output {

	public function display($output = '') {
		
		$CON =& get_instance();
		//echo get_class($CON);
		echo $output;
	}
}