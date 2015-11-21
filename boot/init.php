<?php

/*
|--------------------------------------------------------------------------
| Setup PHP
|--------------------------------------------------------------------------
*/

error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();

/*
|--------------------------------------------------------------------------
| Require the helper functions.
|--------------------------------------------------------------------------
*/

require __DIR__ . '/../Library/helpers.php';

/*
|--------------------------------------------------------------------------
| Register the class autoloader.
|--------------------------------------------------------------------------
*/

spl_autoload_register(function($className)
{
    $basePath = realpath(__DIR__ . '/../');
    $classPath = str_replace('\\', '/', $className) . '.php';

    require $basePath . '/' . $classPath;
});

