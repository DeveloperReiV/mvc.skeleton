<?php

class ControllerMain
{
	public function action_index()
	{
		$view = new View();
		$view->item = "Hello";
		$view->display('base/base.php');
	}

}