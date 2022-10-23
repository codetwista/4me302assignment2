<?php

namespace App\Controllers;


class PhysicianController extends BaseController
{
    public function index()
    {
        // If user is not logged in, redirect to log in view
        if (! $this->session->has('username')) return redirect()->to(base_url('login'));
        
        // Render default physician view
        return view('physician/home', [
            'title' => 'Physician Dashboard',
            'patients' => $this->db->table('user, role')
                ->where('user.Role_IDrole = role.type')
                ->where('user.Role_IDrole', 1)
                ->get()
                ->getResult()
        ]);
    }
}
