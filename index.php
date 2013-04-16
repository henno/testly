<?php

require 'config.php';
require 'classes/Request.php';
require 'classes/user.php';
require 'classes/database.php';

if (file_exists('controllers/'.$request->controller.'.php')){
	require 'controllers/'.$request->controller.'.php';
	$controller = new $request->controller;
		if (isset($controller->requires_auth)){
			$_user->require_auth();
		}
	$controller->{$request->action}();
} else {
	//var_dump($request->controller);
	echo "The page'{$request->controller}'does not exist";
}

