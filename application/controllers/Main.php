<?php

namespace application\controllers;

use application\core;


class Main extends core\Controller
{
	public function action_index()
	{
		$view = new core\View();
		$view->item = "Hello";
		$view->display('base/base.php');
	}

}