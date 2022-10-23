<?php

namespace App\Controllers;


class ResearcherController extends BaseController
{
    public function index()
    {
        // If user is not logged in, redirect to log in view
       /* if (! $this->session->has('login') || $this->session->profile != 'researcher') return redirect()->to(base_url
        ('login'));*/
        
        // Render default researcher view
        /*return view('researcher/home', [
            'title' => 'Researcher Dashboard',
            'patients' => $this->db->table('user, role')
                ->where('user.Role_IDrole = role.type')
                ->where('user.Role_IDrole', 1)
                ->get()
                ->getResult()
        ]);*/
    }
}
