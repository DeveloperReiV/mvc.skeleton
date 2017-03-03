<?php

namespace application\core;

use application\core\lib;

abstract class Model
{
	static protected $table;
	protected        $data = [ ];

	public function __set( $name, $value )
	{
		$this->data[ $name ] = $value;
	}

	public function __get( $name )
	{
		return $this->data[ $name ];
	}

	public function __isset( $name )
	{
		return isset( $this->data[ $name ] );
	}

	/**
	 * Получить имя таблицы данных
	 * @return mixed - имя таблицы
	 */
	public static function getTableName()
	{
		return static::$table;
	}

	/**
	 * Получить все записи из таблицы
	 * @return mixed - результат запроса
	 */
	public static function getAll()
	{
		$db = new lib\DataBase();
		$db->setClassName( get_called_class() );
		$sql    = 'SELECT * FROM ' . static::$table . ' ORDER BY id DESC';
		$result = $db->query( $sql );

		return $result;
	}


}