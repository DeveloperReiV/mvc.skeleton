<?php

namespace application\models;

use application\core;


class User extends core\Model
{
	/**
	 * @var string имя таблицы данных соответствующей данному классу
	 * @access protected
	 * @static
	 */
	protected static $table = 'Users';
}