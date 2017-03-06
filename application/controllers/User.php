<?php

namespace application\controllers;

use application\core;
use application\core\lib;
use application\models;


class User extends core\Controller
{
	public function action_index()
	{
		try
		{
			$views        = new core\View();
			$views->users = models\User::getAll( [ 'id', 'login', 'password', 'email', 'phone' ] );
			$views->display( 'user\user.php' );
		}
		catch( lib\Exception404 $exp )
		{
			$err = new lib\Error( $exp->getMessage(), 400 );
			$err->show();
		}
	}
}