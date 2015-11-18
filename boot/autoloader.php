<?php

require __DIR__ . '/../Library/helpers.php';

spl_autoload_register(function($className)
{
    $basePath = realpath(__DIR__ . '/../');
    $classPath = str_replace('\\', '/', $className) . '.php';

    require $basePath . '/' . $classPath;
});
