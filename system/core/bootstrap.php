<?php if ( ! defined('BASEPATH')) exit('Not allowed');

$timezone = "Asia/Manila";
date_default_timezone_set ($timezone);

include BASEPATH.'core/common.php';

require APPPATH.'config/constants.php';

$OUT =& load_class('output');

//require BASEPATH.'core/autoload.php';

require BASEPATH.'core/controller.php';

function &get_instance()
{
	return Controller::get_instance();
}

//load router class in system/core directory and initialize routing
$URL =& load_class('router','core');
$URL->initialize_route();