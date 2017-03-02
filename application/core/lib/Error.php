<?php

namespace application\core\lib;

class Error extends \ErrorException
{
	//получить информацию об ошибке
	private function getErrorInfo()
	{
		return [
			'message'  => str_pad( (string) $this->message, 100 ),
			'filename' => str_pad( (string) $this->file, 100 ),
			'line'     => str_pad( (string) $this->line, 5 ),
			'time'     => date( 'd-m-Y G:i:s' ),
		];
	}

	//запись ошибки в журнал
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


	/*public static function ErrorPage404()
	{
		$host = 'http://' . $_SERVER['HTTP_HOST'] . '/';
		header( 'HTTP/1.1 404 Not Found' );
		header( "Status: 404 Not Found" );
		header( 'Location:' . $host . '404' );
	}*/
}