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
	 *
	 * @access public
	 * @static
	 *
	 * @return string - имя таблицы
	 */
	public static function getTableName()
	{
		return static::$table;
	}

	/**
	 * Получить все записи из таблицы
	 * Возвращает все записи или false
	 *
	 * @param array $fields массив полей базы данных, которые необходимо вернуть
	 *
	 * @access public
	 * @throws \Exception
	 *
	 * @return object - результат запроса как объект класса запрашиваемых данных
	 */
	public static function getAll( $fields = array() )
	{
		if( is_array( $fields ) )
		{
			$db = new lib\DataBase();
			$db->setClassName( get_called_class() );
			$fld    = implode( ',', $fields );
			$sql    = 'SELECT '.$fld.' FROM ' . static::$table . ' ORDER BY id DESC';
			$result = $db->query( $sql );

			if( empty( $result ) )
			{
				throw new lib\Exception404( 'Ошибка выполнения запроса', 400 );
			}
			else
			{
				return $result;
			}
		}

		return false;
	}


}