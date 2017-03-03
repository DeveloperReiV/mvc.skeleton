<?php

namespace application\controllers;

use application\core;
use application\core\lib;


class Main extends core\Controller
{
	public function action_index()
	{
		$view = new core\View();
		$view->item = "Hello";
		$view->display('/base.php');
	}

}