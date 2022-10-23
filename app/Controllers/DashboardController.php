<?php

namespace App\Controllers;


class DashboardController extends BaseController
{
    public function index($profile)
    {
        $userData = [];
        
        if ($profile === $this->session->profile) {
            if ($this->session->profile === 'physician' || $this->session->profile === 'researcher') {
                $userData = $this->db->table('user, therapy, therapy_list, test, test_session')
                    ->where('user.userID = therapy.User_IDpatient')
                    ->where('therapy.TherapyList_IDtherapylist = therapy_list.therapy_listID')
                    ->where('therapy.therapyID = test.Therapy_IDtherapy')
                    ->where('test.testID = test_session.Test_IDtest')
                    ->get()
                    ->getResult();
            }
            
            return view($profile . '/home', [
                'title' => ucwords($profile) . ' Dashboard',
                'patients' => $this->db->table('user, role')
                    ->where('user.Role_IDrole = role.type')
                    ->where('user.Role_IDrole', 1)
                    ->get()
                    ->getResult(),
                'userData' => $userData
            ]);
        }
    
        return redirect()->to(base_url('login'));
    }
}
