<?php if ( ! defined('BASEPATH')) exit('Not allowed');

if ( ! function_exists('load_class'))
{
	function &load_class($_class_name,$_directory = 'core')
	{
		static $_classes = array();

		if (isset($_classes[$_class_name])) {
			return $_classes[$_class_name];
		}

		$name = '';
		$_directory .= '/';

		if (file_exists(BASEPATH.$_directory.$_class_name.'.php')) {
			$name = $_class_name;
			require(BASEPATH.$_directory.$_class_name.'.php');
		}

		if ($name == '') {
			exit('Unable to locate class '.$_class_name);
		}

		$_classes[$_class_name] = new $name;

		loaded($_class_name);

		return $_classes[$_class_name];
	}
}

if ( ! function_exists('loaded')) {
	function &loaded($_class_name = '') {
		static $_classes = array();

		if($_class_name != '')
		{
			$_classes[$_class_name] = $_class_name;
		}
		return $_classes;
	}
}

if ( ! function_exists('show_404')) {
	function show_404()
	{
		include BASEPATH.'errors/404.php';
		exit;
	}
}

if ( ! function_exists('show_error')) {
	function show_error($message)
	{
		echo $message;
	}
}

if ( ! function_exists('http_post')) {
	function http_post($name)
	{
		return isset($_POST[$name]) ? $_POST[$name] : false;
	}
}

if ( ! function_exists('http_getParam')) {
	function http_getParam($name)
	{
		return isset($_GET[$name]) ? $_GET[$name] : false;
	}
}

if ( ! function_exists('redirect')) {
	function redirect($location)
	{
		header('location:'.$location);
	}
}