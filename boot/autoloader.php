<?php

/*
|--------------------------------------------------------------------------
| Require the helper functions and the PHP setup script.
|--------------------------------------------------------------------------
*/

require __DIR__ . '/../Library/helpers.php';
require __DIR__ . '/php.php';

/*
|--------------------------------------------------------------------------
| Register the autoloader.
|--------------------------------------------------------------------------
*/

spl_autoload_register(function($className)
{
    $basePath = realpath(__DIR__ . '/../');
    $classPath = str_replace('\\', '/', $className) . '.php';

    require $basePath . '/' . $classPath;
});
