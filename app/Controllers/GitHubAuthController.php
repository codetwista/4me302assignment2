<?php

namespace App\Controllers;


class GitHubAuthController extends BaseController
{
    private $tokenURL;
    private $apiBaseURL;
    
    public function __construct()
    {
        define('OAUTH2_CLIENT_ID', 'b74c4d6bb751d8769bbe');
        define('OAUTH2_CLIENT_SECRET', 'baafced0261e100c63e04e874d904b1292f7d1f7');
    
        $this->authorizeURL = 'https://github.com/login/oauth/authorize';
        $this->tokenURL = 'https://github.com/login/oauth/access_token';
        $this->apiBaseURL = 'https://api.github.com/';
    }
    
    public function index()
    {
        // If user is logged in with GitHub, return to profile page
       /* if ($this->session->login) return redirect()->to(base_url($this->session->profile));*/
        
        if ($this->request->getVar('code')) {
            // Verify the state matches our stored state
            if ( ! $this->request->getVar('state') || $this->session->state != $this->request->getVar('state')) {
                return redirect()->to(base_url('login'));
            }
        
            $token = $this->apiRequest($this->tokenURL, [
                'client_id' => OAUTH2_CLIENT_ID,
                'client_secret' => OAUTH2_CLIENT_SECRET,
                'redirect_uri' => base_url('github'),
                'state' => $this->session->state,
                'code' => $this->request->getVar('code')
            ]);
        
            $this->session->set('gitHubAccessToken', $token->access_token);
    
            $gitHubProfile = $this->apiRequest($this->apiBaseURL . 'user');
            $this->session->set('login', $gitHubProfile->login);
            
            // Find user by GitHub account
            if ($user = $this->db->table('user, role')->where('user.username', $gitHubProfile->login)->where('user.Role_IDrole = role.type')->get()->getRow()) {
                // Save email to session
                $this->session->set('username', $user->username);
                $this->session->set('email', $user->email);
                $this->session->set('profile', $user->name);
        
                // Redirect user to profile page
                return redirect()->to(base_url($this->session->profile));
            }
            
            // User not found!
            $this->session->setFlashdata('status', '
                <div class="notification is-danger is-light">
                  <h2>User account not found! Register your profile.</h2>
                </div>');
    
            return redirect()->to(base_url('register'));
        }
    
        $this->session->setFlashdata('status', '
            <div class="notification is-danger is-light">
              <h2>User account not found! Register your profile.</h2>
            </div>');
        
        return redirect()->to(base_url('login'));
    }
    
    public function login()
    {
        // Display GitHub login button only if user in not logged in
//        if (! $this->session->gitHubAccessToken) {
//            return redirect()->to('login');
//        }
        
        // GitHub login
        if ($this->uri->getSegment(2) == 'login') {
            $this->session->set('state', bin2hex(random_bytes(20)));
            $this->session->remove('gitHubAccessToken');
        
            $params = [
                'client_id' => OAUTH2_CLIENT_ID,
                'redirect_uri' => base_url('github'),
                'scope' => 'user',
                'state' => $this->session->state
            ];
        
            return redirect()->to($this->authorizeURL . '?' . http_build_query($params));
        }
    }
    
    /**
     * GitHub API request
     * @param $url
     * @param  bool  $post
     * @param  array  $headers
     *
     * @return mixed
     */
    private function apiRequest($url, $post = false, $headers = []) {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Your User-Agent');
        
        if ($post) curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post));
        
        $headers[] = 'Accept: application/json';
        
        if ($this->session->has('gitHubAccessToken')) $headers[] = 'Authorization: Bearer ' . $this->session->gitHubAccessToken;
        
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        
        $response = curl_exec($ch);
        return json_decode($response);
    }
}
