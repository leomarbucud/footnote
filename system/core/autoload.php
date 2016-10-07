<?php if ( ! defined('BASEPATH')) exit('Not allowed');

if ( ! function_exists('__autoload'))
{
	function __autoload($_class_name)
	{
		$file = CONTPATH.$_class_name.'.php';

		if (file_exists($file)) {
			include_once $file;
		}
	}
}