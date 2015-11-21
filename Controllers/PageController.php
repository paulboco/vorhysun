<?php

namespace Controllers;

use Models\Optedin;

class PageController
{
    public function welcome()
    {
        echo 'welcome';
    }

    public function all($color = null)
    {
        // Instantiate new Optedin object
        $optedin = new Optedin;

        // Get all rows from model
        $allRows = $optedin->all();

        // Output response
        include __DIR__ . '/../views/content.tpl';
    }
}