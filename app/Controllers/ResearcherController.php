<?php

namespace App\Controllers;


class ResearcherController extends BaseController
{
    public function index()
    {
        //
        return view('researcher/map', [
            'title' => 'Map',
            'uri' => $this->uri
        ]);
    }
}
