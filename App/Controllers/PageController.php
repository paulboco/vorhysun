<?php

namespace App\Controllers;

use App\Models\Optedin;
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
        return $this->response->redirect('page/optedin');
        return $this->view->make('page/welcome');
    }

    /**
     * Show all optedin rows.
     *
     * @param  string  $color
     * @return \Library\View
     */
    public function optedin($color = null)
    {
        $optedin = new Optedin;
        $allRows = $optedin->all();

        return $this->view->make('page/optedin', array(
            'allRows' => $allRows,
            'color' => $color,
        ));
    }
}
