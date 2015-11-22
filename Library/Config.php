<?php

namespace Library;

class Config
{
    /**
     * The path to the config directory.
     *
     * @var string
     */
    private static $path = '/App/config/';

    /**
     * Get a configuration item.
     *
     * @param  string  $path
     * @param  mixed  $default
     * @return mixed
     */
    public static function get($path, $default = null)
    {
        $keys = self::getKeys($path);
        $config = self::getConfig($path);

        $key = strtok($keys, '.');

        while ($key !== false) {
            if (!isset($config[$key])) {
                return $default;
            }
            $config = $config[$key];
            $key = strtok('.');
        }

        return $config;
    }

    /**
     * Get the configuration keys.
     *
     * @param  string  $path
     * @return string
     */
    private static function getKeys($path)
    {
        return substr($path, (strpos($path, '.') + 1));
    }

    /**
     * Get the configuration value.
     *
     * @param  string  $path
     * @return string
     */
    private static function getConfig($path)
    {
        $file = substr($path, 0, strpos($path, '.'));

        return require BASE_PATH . self::$path . $file . '.php';
    }
}
