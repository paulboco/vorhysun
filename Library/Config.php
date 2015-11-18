<?php

namespace Library;

/**
 * A class to manage configuration.
 */
class Config
{
    private static $loadedConfig;

    public static function get($key)
    {
        $parts = explode('.', $key);

        $file = array_shift($parts);
        $key = array_shift($parts);

        self::$loadedConfig = require __DIR__ . "/../config/{$file}.php";

        return self::$loadedConfig[$key];
    }
}
