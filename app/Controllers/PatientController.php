<?php

namespace App\Controllers;


class PatientController extends BaseController
{
    public function index()
    {
        // If user is not logged in, redirect to log in view
        if (! $this->session->has('username')) return redirect()->to(base_url('login'));
        
        // Render patient default view
        return view('patient/home', [
            'title' => 'Patient Dashboard',
        ]);
    }
}
