<?php

namespace App\Controllers\Auth;

use App\Libraries\FormStatic;
use Axproo\Auth\Services\AuthService;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;

class Login extends ResourceController
{
    protected $auth;
    protected $crud;

    public function __construct() {
        $this->auth = service('authService');
        $this->crud = service('crudService');
    }

    /**
     * Return an array of resource objects, themselves in array format.
     *
     * @return ResponseInterface
     */
    public function index()
    {
        FormStatic::$url = '/login';
        return $this->crud->new(['email','password']);
    }
    
    public function signin() {
        // $auth = new AuthService();
        // return $auth->login($this->get_data_from_post());
        return $this->auth->signin();
    }

    public function verify() {
        FormStatic::$url = '/generate';
        return $this->crud->new(['email']);
    }

    public function me() {
        return $this->auth->me();
    }

    public function logout() {
        $this->auth->setcookie('', -3000);
        $this->response->setHeader('Clear-Site-Data', '"cookies"');
        return apiResponse(200, lang('Auth.success.logout'));
    }

    protected function get_data_from_post() {
        return (array) $this->request->getVar();
    }
}