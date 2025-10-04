<?php
namespace App\Services;

use CodeIgniter\HTTP\IncomingRequest;
use Config\Validation;
use Config\Services;
use Config\Validation\AuthConfig;

class AuthService
{
    protected IncomingRequest $request;
    protected $validate;
    protected $validation;

    public function __construct(IncomingRequest $request)
    {
        $this->request = $request;
        $this->validate = new AuthConfig();
        $this->validation = Services::validation();
    }

    public function signin() {
        $data = $this->request->getVar();

        // Validation du formulaire
        if (!$this->validation->setRules($this->validate->auth)->run($this->get_data_from_post())) {
            return apiResponse(403, $this->validation->getErrors());
        }

        // $user = $this->users->getUserByEmail($data->email);

        return apiResponse(200, 'Auth signin', [
            'data' => $data,
            'validate' => $this->validate->auth
        ]);
    }

    protected function get_data_from_post() {
        return (array) $this->request->getVar();
    }
}