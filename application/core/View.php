<?php

namespace application\core;

use application\core\lib;

class View
{
	protected $data = [ ];    //массив данных

	public function __set( $k, $v )
	{
		$this->data[ $k ] = $v;
	}

	public function __get( $k )
	{
		return $this->data[ $k ];
	}

	//подготовка данных для вывода в шаблон
	public function render( $template )
	{
		$path = __DIR__ . '/../views/' . $template;

		foreach( $this->data as $key => $value )
		{
			$$key = $value;
		}
		if( file_exists( $path ) )
		{
			ob_start();                                    //включаем буфер обмена
			include "$path";
			$content = ob_get_contents();                //получаем содержимое буфера
			ob_end_clean();                                //очищаем буфер
			return $content;
		}
		else
		{
			throw new \Exception( "Шаблон $template не найден" );
		}
	}

	//отображаем шаблон
	public function display( $template )
	{
		try
		{
			echo $this->render( $template );
		}
		catch(\Exception $exp)
		{
			$err = new lib\Error( $exp->getMessage() );
			$err->writeLog();
		}
	}

}