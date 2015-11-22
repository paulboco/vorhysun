<?php

namespace App\Controllers;

use App\Models\Participant;
use Library\Controller;

class ParticipantController extends Controller
{
    /**
     * The participant index.
     *
     * @return \Library\View
     */
    public function index()
    {
        return $this->view->make('participant/index', array(
            'participants' => Participant::all(),
        ));
    }
}
