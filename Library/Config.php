<?php

namespace Library;

class Config
{
    /**
     * Get a configuration variable.
     *
     * $path is in the format: 'file_name.array_key'
     *
     * @param  string  $path
     * @return mixed
     */
    public static function get($path)
    {
        $parts = explode('.', $path);

        $file = array_shift($parts);
        $key = array_shift($parts);

        $config = require __DIR__ . "/../config/{$file}.php";

        return $config[$key];
    }
}
