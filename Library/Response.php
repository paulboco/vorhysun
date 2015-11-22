<?php

namespace Library;

use Closure;

class Response
{
    /**
     * The view instance.
     *
     * @var \Library\View
     */
    private $view;

    /**
     * Create a new response.
     *
     * @param \Library\View
     * @return void
     */
    public function __construct(View $view)
    {
        $this->view = $view;
    }

    /**
     * Send the response to the browser.
     *
     * @param  mixed  $response
     * @return void
     */
    public function send($response)
    {
        if ($response instanceof Closure) {
            call_user_func($response);
            return;
        }

        if (is_string($response)) {
            echo $response;
            return;
        }
    }

    /**
     * Redirect to another address.
     *
     * @param  string  $uri
     * @return Closure
     */
    public function redirect($uri = null)
    {
        $serverName = $this->getServerName();
        $location = "Location:http://{$serverName}/{$uri}";

        return function() use ($location) {
            header($location);
        };
    }

    /**
     * Send A 404 Response
     *
     * @return void
     */
    public function send404()
    {
        header("HTTP/1.0 404 Not Found");
        $this->view->render('errors/404');
        die;
    }

    /**
     * Get server name.
     *
     * @return string
     */
    private function getServerName()
    {
        $server = $_SERVER['SERVER_NAME'];
        $port = $_SERVER['SERVER_PORT'] == '80' ? '' : ':' . $_SERVER['SERVER_PORT'];

        return $server . $port;
    }
}
