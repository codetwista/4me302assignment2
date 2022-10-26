<?php

namespace App\Controllers;


class UserController extends BaseController
{
    /**
     * @return string
     */
    public function index()
    {
        // If user has an active session, log user out
        if ($this->session->has('googleAccessToken') || $this->session->has('gitHubAccessToken') ||
            $this->session->has('twitterAccessToken')) return redirect()->to(base_url('logout'));
        
        return view('users', [
            'title' => 'Users',
            'users' => $this->db->table('user')
                ->join('role', 'role.roleID = user.Role_IDrole')
                ->join('organization', 'organization.organizationID = user.Organization')
                ->get()
                ->getResult()
        ]);
    }
    
    /**
     * @return \CodeIgniter\HTTP\RedirectResponse|string
     */
    public function register()
    {
        // If user has an active session, log user out
        if ($this->session->has('googleAccessToken') || $this->session->has('gitHubAccessToken') ||
            $this->session->has('twitterAccessToken')) return redirect()->to(base_url('logout'));
        
        // Initialize organization variable
        $organization = null;
    
        // Create form validation rules
        $rules = [
            'role' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '* Select your profile'
                ]
            ],
            'username' => [
                'rules' => 'required|alpha_space|is_unique[user.username]',
                'errors' => [
                    'required' => '* Enter your user name',
                    'alpha_space' => '* Only alphabets allowed for user name',
                    'is_unique' => '* User name chosen is already taken'
                ]
            ],
            'email' => [
                'rules' => 'required|valid_email|is_unique[user.email]',
                'errors' => [
                    'required' => '* Enter your email address',
                    'valid_email' => '* Email address must be in the correct format',
                    'is_unique' => '* Email address chosen is already taken'
                ]
            ]
        ];
        
        if ($this->request->getMethod() === 'post' && $this->validate($rules)) {
            // Get form input
            $username = $this->request->getPost('username');
            $email = $this->request->getPost('email');
            $role = $this->request->getPost('role');
            
            // Assign organization to user
            if ($role === "1" || $role === "2") {
                $organization = 1;
            }
    
            if ($role === "3") {
                $organization = 2;
            }
    
            $data = [
                'username' => $username,
                'email' => $email,
                'Role_IDrole' => intval($role),
                'Organization' => $organization,
            ];
    
            // User data saved to database
            if ($this->db->table('user')->insert($data) === true) {
                $this->session->setFlashdata('status', '
                <div class="notification is-success is-light">
                  <h2>Profile registration successful!</h2>
                </div>');
    
                return redirect()->to(base_url('register'));
            }
            
            // Data not saved to database
            $this->session->setFlashdata('status', '
                <div class="notification is-danger is-light">
                  <h2>Profile registration failed!</h2>
                </div>');
        }
        
        return view('register', [
            'title' => 'Register',
            'roles' => $this->db->table('role')->get()->getResult(),
            'validation' => $this->validator,
            'uri' => $this->uri
        ]);
    }
    
    /**
     * @return string
     * @throws \Exception
     */
    public function logIn()
    {
        // If user has an active session, log user out
        if ($this->session->has('googleAccessToken') || $this->session->has('gitHubAccessToken') ||
            $this->session->has('twitterAccessToken')) return redirect()->to(base_url('logout'));
        
        // Display Google login button only if user is not logged in
        if (! $this->session->googleAccessToken) {
            $this->session->remove('profile');
            
            $googleAuth = new GoogleAuthController();
            $data['googleAuthURL'] = $googleAuth->googleClient->createAuthUrl();
        } else {
            return redirect()->to(base_url($this->session->profile));
        }
        
        // Render login view
        return view('login', [
            'title' => 'Log in',
            'data' => $data,
            'uri' => $this->uri
        ]);
    }
    
    /**
     * Log user out
     * @return \CodeIgniter\HTTP\RedirectResponse
     */
    public function logOut()
    {
        if ($this->session->has('gitHubAccessToken')) $this->session->remove('gitHubAccessToken');
        if ($this->session->has('googleAccessToken')) $this->session->remove('googleAccessToken');
        if ($this->session->has('twitterAccessToken')) $this->session->remove('twitterAccessToken');
        
        return redirect()->to(base_url('login'));
    }
}
