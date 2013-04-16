<?php
/**
 * Created by JetBrains PhpStorm.
 * User: karmen.kukk
 * Date: 15.04.13
 * Time: 12:48
 * To change this template use File | Settings | File Templates.
 */

class Request
{

	public $controller;
	public $action = 'index';
	public $params = array();

	public function __construct()
	{
		if (isset($_SERVER['PATH_INFO'])) {
			if ($path_info = explode('/', $_SERVER['PATH_INFO'])) {
				array_shift($path_info);
				$this->controller = isset($path_info[0]) ? array_shift($path_info) : "welcome";
				$this->action = isset($path_info[0]) && ! empty($path_info[0]) ? array_shift($path_info) : "index";
				$this->params = isset($path_info[0]) ? $path_info : NULL;
			}
		}
	}
}

$request = new Request;
