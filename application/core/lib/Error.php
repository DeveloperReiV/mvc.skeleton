<?php

namespace application\core\lib;

use application\core;


class Error extends \ErrorException
{
	/**
	 * Формирует информацию об ошибке
	 * @return array - информацию об ошибке
	 */
	private function getErrorInfo()
	{
		return [
			'message'  => str_pad( (string) $this->message, 100 ),
			'filename' => str_pad( (string) $this->file, 100 ),
			'line'     => str_pad( (string) $this->line, 5 ),
			'time'     => date( 'd-m-Y G:i:s' ),
		];
	}

	/**
	 * Записывает данные об ошибке в журнал
	 * @return int - колличество байт данных записанных в журнал
	 */
	public function writeLog()
	{
		$path = 'application/error.log';
		$info = implode( ' ', $this->getErrorInfo() ) . " \n";
		$info = ( count( file( $path ) ) + 1 ) . "  " . $info;
		$text = null;

		//если файл журнала существует
		if( file_exists( $path ) )
		{
			$text = file_get_contents( $path ) . $info;        //считываем данные и дописываем строку
		}
		$file = file_put_contents( $path, $text );            //записываем файл

		return $file;
	}

	/**
	 * Записывает данные об ошибке в журнал и отображает страницу ошибки
	 */
	public function showError()
	{
		$this->writeLog();
		$view = new core\View();
		$view->display('error/error404.php');
	}


	/*public static function ErrorPage404()
	{
		$host = 'http://' . $_SERVER['HTTP_HOST'] . '/';
		header( 'HTTP/1.1 404 Not Found' );
		header( "Status: 404 Not Found" );
		header( 'Location:' . $host . '404' );
	}*/
}