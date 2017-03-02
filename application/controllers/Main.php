<?php

namespace application\controllers;

use application\core;
use application\core\lib;


class Main extends core\Controller
{
	public function action_index()
	{
		$db = new lib\DataBase();
		$sql='SELECT * FROM Users';
		$res = $db->query( $sql );
		var_dump($res);

		/*$view = new core\View();
		$view->item = "Hello";
		$view->display('base/base.php');*/
	}

}