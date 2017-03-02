<?php

class Route
{
	public static function start()
	{
		$routes = parse_url( $_SERVER['REQUEST_URI'], PHP_URL_PATH );       //получаем только путь из URL строки
		$routes = explode( '/', $routes );                                  //разбиваем строку запроса через '/'

		//получаем имя контроллера и экшена
		$controller_name = !empty( $routes[1] ) ? $routes[1] : 'Main';
		$action_name     = !empty( $routes[2] ) ? $routes[2] : 'index';

		if($controller_name!='favicon.ico')
		{
			// добавляем префиксы
			$model_name      = 'Model' . $controller_name;
			$controller_name = 'Controller' . $controller_name;
			$action_name     = 'action_' . $action_name;

			// подцепляем файл с классом модели (файла модели может и не быть)
			$model_path = MODEL_PATH . $model_name . '.php';
			if( file_exists( $model_path ) )
			{
				include "$model_path";
			}

			// подцепляем файл с классом контроллера
			$controller_path = CONTROLLER_PATH . $controller_name . '.php';
			if( file_exists( $controller_path ) )
			{
				include "$controller_path";
			}
			else
			{
				throw new Exception( "Контроллер $controller_name не найден" );
			}

			// создаем контроллер
			$controller = new $controller_name;
			$action     = $action_name;

			if( method_exists( $controller, $action ) )
			{
				// вызываем действие контроллера
				$controller->$action();
			}
			else
			{
				throw new Exception( "Экшен $action не найден в контроллере $controller_name" );
			}
		}
	}

}