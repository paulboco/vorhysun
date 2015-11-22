<?php

namespace Library;

class Router
{
    /**
     * The Response Instance
     *
     * @var \Library\Response
     */
    protected $response;

    /**
     * The controller's namespace.
     *
     * @var string
     */
    protected $namespace = "App\\Controllers\\";

    /**
     * The current uri.
     *
     * @var string
     */
    protected $uri;

    /**
     * The uri segments.
     *
     * @var array
     */
    protected $segments;

    /**
     * The controller's name.
     *
     * @var string
     */
    protected $controller;

    /**
     * The controller method's name.
     *
     * @var string
     */
    protected $method;

    /**
     * The controller method's parameters.
     *
     * @var array
     */
    protected $params;

    /**
     * Create a new router instance.
     *
     * @param \Library\Response
     * @return void
     */
    public function __construct(Response $response)
    {
        $this->response = $response;
        $this->prepareUri();
        $this->extractSegments();
    }

    /**
     * Dispatch the route.
     *
     * @return void
     */
    public function dispatch()
    {
        $this->validateRoute();

        return $this->callControllerMethod();
    }

    /**
     * Get a URI segment by position.
     *
     * @param  integer  $position
     * @param  string  $default
     * @return string
     */
    public function getSegment($position, $default = '')
    {
        if (!isset($this->segments[$position - 1])) {
            return $default;
        }

        return $this->segments[$position - 1];
    }

    /**
     * Prepare the URI.
     *
     * @return void
     */
    private function prepareUri()
    {
        $uri = str_replace('?' . $_SERVER['QUERY_STRING'], '', $_SERVER['REQUEST_URI']);
        $uri = preg_replace('~/+~', '/', $uri);

        $this->uri = trim($uri, '/') ?: 'page/welcome';
    }

    /**
     * Extract URI segments to class properties.
     *
     * @return void
     */
    private function extractSegments()
    {
        $segments = explode('/', $this->uri);
        $this->segments = $segments;

        $this->controller = $this->formatController(array_shift($segments));
        $this->method = $this->formatMethod(array_shift($segments));
        $this->params = empty($segments) ? array() : $segments;
    }

    /**
     * Format the controller's name.
     *
     * @param  string  $controller
     * @return void
     */
    private function formatController($controller)
    {
        $controller = array_map(function($segment) {
            return ucfirst(strtolower($segment));
        }, explode('-', $controller));

        return $this->namespace . implode('\\', $controller) . 'Controller';
    }

    /**
     * Format the controller method's name.
     *
     * @param  string  $method
     * @return void
     */
    private function formatMethod($method)
    {
        $segments = array_map(function ($segment) {
            return ucfirst(strtolower($segment));
        }, explode('-', $method));

        return lcfirst(implode('', $segments));
    }

    /**
     * Validate the route.
     *
     * @return void
     */
    private function validateRoute()
    {
        // Send a 404 if the controller method doesn't exist
        if (!method_exists($this->controller, $this->method)) {
            $this->response->send404();
        }
    }

    /**
     * Call the controller's method.
     *
     * @return void
     */
    private function callControllerMethod()
    {
        return call_user_func_array(array(
            new $this->controller(new Request, new Response(new View), new View),
            $this->method,
        ), $this->params);
    }
}
