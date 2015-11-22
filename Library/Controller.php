<?php

namespace Library;

abstract class Controller
{
    /**
     * The request instance.
     *
     * @var \Library\Request
     */
    protected $request;

    /**
     * The response instance.
     *
     * @var \Library\Response
     */
    protected $response;

    /**
     * The view instance.
     *
     * @var \Library\View
     */
    protected $view;

    /**
     * Create a new controller instance.
     *
     * @param  \Library\Request  $request
     * @param  \Library\Response  $response
     * @param  \Library\View  $view
     * @return void
     */
    function __construct(Request $request, Response $response, View $view)
    {
        $this->request = $request;
        $this->response = $response;
        $this->view = $view;
    }
}