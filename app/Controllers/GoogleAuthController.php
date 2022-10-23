<?php

namespace App\Controllers;

// Require Google API Client
require_once APPPATH . 'Libraries/vendor/autoload.php';
use Google_Client;
use Google_Service_Oauth2;

class GoogleAuthController extends BaseController
{
    public function __construct()
    {
        define('CLIENT_ID', '880564247375-vp6aittsk15urblu3qqcinsrior0813f.apps.googleusercontent.com');
        define('CLIENT_SECRET', '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');
    
        // Instantiate Google Client
        $this->googleClient = new Google_Client();
    
        // Set authentication parameters
        $this->googleClient->setClientId(CLIENT_ID);
        $this->googleClient->setClientSecret(CLIENT_SECRET);
        $this->googleClient->setRedirectUri(base_url('google'));
    
        // Add request scope
        $this->googleClient->addScope('email');
        $this->googleClient->addScope('profile');
    }
    
    /**
     * @return bool|\CodeIgniter\HTTP\RedirectResponse
     */
    public function index()
    {
        // If user is logged in, return to profile page
        if ($this->session->has('googleAccessToken')) {
            // $this->session->remove('access_token');
            return redirect()->to(base_url($this->session->profile));
        }
        
        // Verify auth code
        $code = $this->request->getVar('code');

        if (isset($code)) {
            // Fetch and save access token to session if auth code is valid
            $token = $this->googleClient->fetchAccessTokenWithAuthCode($code);
    
            if (! isset($token['error'])) {
                $this->googleClient->setAccessToken($token['access_token']);
                $this->session->set('googleAccessToken', $token['access_token']);
        
                // Instantiate Google Oauth2 Service
                $this->googleService = new Google_Service_Oauth2($this->googleClient);
        
                // Get user data
                $googleProfile = $this->googleService->userinfo->get();
                // print_r($data);
                
                // Find user by GMail account
                if ($user = $this->db->table('user, role')->where('user.email', $googleProfile['email'])->where('user.Role_IDrole = role.type')->get()->getRow()) {
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
        }

        $this->session->remove('googleAccessToken');

        // User not found!
        $this->session->setFlashdata('status', '
            <div class="notification is-danger is-light">
              <h2>Invalid access token!</h2>
            </div>');
        
        return redirect()->to(base_url('login'));
    }
}
