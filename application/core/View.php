<?php

namespace application\core;

use application\core\lib;

class View
{
	/**
	 * @var array массив данных для отправки в шаблон
	 * @access protected
	 */
	protected $data = [ ];    //массив данных

	public function __set( $name, $value )
	{
		$this->data[ $name ] = $value;
	}

	public function __get( $name )
	{
		return $this->data[ $name ];
	}

	/**
	 * Подготовка данных для вывода в шаблон
	 *
	 * @param $template - имя шаблона
	 * @access public
	 * @throws \Exception
	 *
	 * @return string - фозвращает содержимое шаблона из буфера данных
	 */
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

	/**
	 * Отображаем шаблон
	 *
	 * @access public
	 * @param $template - шаблон данных
	 */
	public function display( $template )
	{
		try
		{
			echo $this->render( $template );
		}
		catch( \Exception $exp )
		{
			$err = new lib\Error( $exp->getMessage() );
			$err->showError();
		}
	}

}