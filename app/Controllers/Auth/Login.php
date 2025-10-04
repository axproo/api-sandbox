<?php

namespace App\Controllers\Auth;

use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;

class Login extends ResourceController
{
    protected $auth;

    public function __construct() {
        $this->auth = service('authService');
    }

    /**
     * Return an array of resource objects, themselves in array format.
     *
     * @return ResponseInterface
     */
    public function index()
    {
        return apiResponse(200, 'Login page', []);
    }
    
    public function signin() {
        return $this->auth->signin();
    }
}