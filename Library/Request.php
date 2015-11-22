<?php

namespace Library;

class Request
{
    /**
     * Get a request variable by key.
     *
     * @param  string  $key
     * @param  mixed  $default
     * @return mixed
     */
    public function get($key, $default = null)
    {
        if (is_null($key)) {
            return $_REQUEST;
        }

        if (!isset($_REQUEST[$key])) {
            return $default;
        }

        return $_REQUEST[$key];
    }

    /**
     * Get all request variables.
     *
     * @return array
     */
    public function all()
    {
        return $this->get(null);
    }
}