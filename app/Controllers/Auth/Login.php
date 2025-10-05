<?php

namespace App\Controllers\Auth;

use App\Libraries\FormStatic;
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
        FormStatic::$url = '/login';
        return $this->auth->new(['email','password']);
    }
    
    public function signin() {
        return $this->auth->signin();
    }

    public function verify() {
        FormStatic::$url = '/otp/generate';
        return $this->auth->new(['email']);
    }
}