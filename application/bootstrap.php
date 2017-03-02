<?php
/**
 * Файл начальной загрузки данных
 */

require __DIR__ . '/const.php';
require __DIR__ . '/autoload.php';    //файл автозагрузки


try
{
	Route::start();
}
catch( Exception $exp )
{
	$err = new Error( $exp->getMessage() );
	$err->writeLog();
}




