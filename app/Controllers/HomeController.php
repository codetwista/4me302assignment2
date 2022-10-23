<?php

namespace App\Controllers;


class HomeController extends BaseController
{
    public function index()
    {
        // If user has an active session, log user out
        if ($this->session->has('googleAccessToken') || $this->session->has('gitHubAccessToken') ||
            $this->session->has('twitterAccessToken')) return redirect()->to(base_url('logout'));
        
        // Render default view
        return view('home', [
            'title' => 'Welcome'
            ]);
    }
}
