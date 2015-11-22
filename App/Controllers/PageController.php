<?php

namespace App\Controllers;

use Library\Controller;

class PageController extends Controller
{
    /**
     * Show the welcome page.
     *
     * @return \Library\View
     */
    public function welcome()
    {
        return $this->view->make('page/welcome');
    }
}
