<?php
/**
 * Файл начальной загрузки данных
 */

use application\core;
use application\core\lib;

require __DIR__ . '/const.php';
require __DIR__ . '/autoload.php';    //файл автозагрузки


try
{
	core\Route::start();
}
catch( Exception $exp )
{
	$err = new lib\Error( $exp->getMessage() );
	$err->writeLog();
}




