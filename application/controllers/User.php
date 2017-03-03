<?php

namespace application\controllers;

use application\core;
use application\core\lib;
use application\models;


class User extends core\Controller
{
	public function action_index()
	{
		$views        = new core\View();
		$views->users = models\User::getAll();
		$views->display( 'user\user.php' );
	}
}