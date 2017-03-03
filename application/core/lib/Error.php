<?php

namespace application\core\lib;

use application\core;


class Error extends \ErrorException
{
	public $code;
	public $file;
	public $line;
	public $message;

	public function __construct( $message = null, $code = null )
	{
		$this->message = $message;
		$this->code    = $code;
	}

	/**
	 * Формирует информацию об ошибке
	 * @access private
	 *
	 * @return array - информацию об ошибке
	 */
	private function getInfo()
	{
		return 'Message: ' . $this->message . '  ' .
		'Code: ' . $this->code . '  ' .
		'File: ' . $this->file . '  ' .
		'Line: ' . $this->line . '  ' .
		'DataTime: ' . date( 'd-m-Y G:i:s' );
	}

	/**
	 * Записывает данные об ошибке в журнал
	 *
	 * @access public
	 *
	 * @return int - колличество байт данных записанных в журнал
	 */
	public function writeLog()
	{
		$path = 'application/error.log';
		$info = $this->getInfo() . "\n";
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
	 * @access public
	 */
	public function show()
	{
		$this->writeLog();
		$view = new core\View();
		$view->display( 'error/error404.php' );
	}


	/*public static function ErrorPage404()
	{
		$host = 'http://' . $_SERVER['HTTP_HOST'] . '/';
		header( 'HTTP/1.1 404 Not Found' );
		header( "Status: 404 Not Found" );
		header( 'Location:' . $host . '404' );
	}*/
}