<?php
/**
 * Класс работы с базой данных
 * Class work with database
 */

namespace application\core\lib;


class DataBase
{
	private $dbh;
	private $className = 'stdClass';

	public function __construct( $host = DB_HOST, $dbname = DB_NAME, $user = DB_USER, $password = DB_PASSWORD )
	{
		try
		{
			$this->dbh = new \PDO( "mysql:host=$host;dbname=$dbname", $user, $password );
		}
		catch( \PDOException $exp )
		{
			$err = new Error( 'Ошибка поключения к базе данных ' . $exp->getMessage() );
			$err->writeLog();
		}
	}

	/**
	 * Задать имя класса объект которого необходимо вернуть как результат запроса
	 *
	 * @param $className - имя класса
	 */
	public function setClassName( $className )
	{
		$this->className = $className;
	}

	/**
	 * Выполняет запрос с параметрами
	 *
	 * @param $statement    - запрос для выполнения
	 * @param array $params - параметры запроса (необязательный параметр)
	 *
	 * @return mixed - результат запроса
	 */
	public function query( $statement, $params = [ ] )
	{
		$stmt = $this->dbh->prepare( $statement );        //подготавливаем запрос
		$stmt->execute( $params );                    //выполняем запрос с подстановкой параметров
		return $stmt->fetchAll( \PDO::FETCH_CLASS, $this->className );
	}


}