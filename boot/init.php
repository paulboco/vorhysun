<?php

/*
|--------------------------------------------------------------------------
| Setup PHP
|--------------------------------------------------------------------------
*/
error_reporting(E_ALL | E_WARNING | E_NOTICE);
ini_set('display_errors', TRUE);
session_start();

/*
|--------------------------------------------------------------------------
| Set the BASE_PATH constant.
|--------------------------------------------------------------------------
*/

define('BASE_PATH', realpath(__DIR__ . '/../'));

/*
|--------------------------------------------------------------------------
| Require the helper functions.
|--------------------------------------------------------------------------
*/

require BASE_PATH . '/Library/helpers.php';

/*
|--------------------------------------------------------------------------
| Register the class autoloader.
|--------------------------------------------------------------------------
*/

spl_autoload_register(function($className)
{
    $classPath = str_replace('\\', '/', $className) . '.php';

    if (file_exists(BASE_PATH . '/' . $classPath)) {
        require BASE_PATH . '/' . $classPath;
    }
});
