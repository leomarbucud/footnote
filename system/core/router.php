<?php if ( ! defined('BASEPATH')) exit('Not allowed');

class Router {

	function initialize_route() {

		$url = isset($_GET['url']) ? $_GET['url'] : DEFAULT_ROUTE;

		//explode the url
		$url = explode('/', $url);
		//set controller
		$controller = $url[0];

		if ( ! file_exists(CONTPATH.$controller.'.php')) {
			show_404();
			exit;
		} else {
			require_once CONTPATH.$controller.'.php';
		}

		array_shift($url);
		//set method for the controller
		$action = @$url[0];

		if (empty($action)) {
			$action = 'index';
		}

		array_shift($url);

		$params = $url;

		$handler = array($controller,$action);

		if( is_callable($handler)) {
			$obj = new $controller;
			call_user_func_array(array($obj,$action),$params);
		} else {
			//echo 'Unable to call Class and Method';
			show_404();
		}
	}
}