<?php

	$application_folder = 'application';

	$system_path = 'system';

	$system_path = rtrim($system_path, '/').'/';


	define('SITE_ROOT', realpath(dirname(__FILE__)).'/');

	//index.php
	define('SELF', pathinfo(__FILE__, PATHINFO_BASENAME));

	//.php
	define('EXT', '.php');

	//system
	define('BASEPATH', str_replace("\\", "/", $system_path));

	//C:\xampp\htdocs\mymvc\
	define('FCPATH', str_replace(SELF, '', __FILE__));

	define('SYSDIR', trim(strrchr(trim(BASEPATH, '/'), '/'), '/'));

	//application/
	define('APPPATH', $application_folder.'/');

	define('CONTPATH',APPPATH.'/controllers/');

	define('MODPATH',APPPATH.'/models/');

	define('VIEWPATH',APPPATH.'/views/');

	require_once BASEPATH.'core/bootstrap.php';