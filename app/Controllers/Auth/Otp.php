<?php

namespace App\Controllers\Auth;

use App\Libraries\FormStatic;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;

class Otp extends ResourceController
{
    protected $otp;
    protected $crud;

    public function __construct() {
        $this->otp = service('otpService');
        $this->crud = service('crudService');
    }

    /**
     * Return an array of resource objects, themselves in array format.
     *
     * @return ResponseInterface
     */
    public function generate()
    {
        return $this->otp->generate();
    }

    /**
     * Return an array of ressouce objects, themselves in array format.
     *
     * @return void
     */
    public function check() {
        return $this->otp->verified();
    }

    /**
     * Return an array of ressouce objects, themselves in array format.
     *
     * @return void
     */
    public function resend() {
        return $this->otp->resend();
    }

    /**
     * Return the properties of a resource object.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function code()
    {
        FormStatic::$url = '/otp-check';

        return $this->crud->new(['email','code'], [
            'email' => ['type' => 'hidden'],
            'code' => [
                'form_group' => 'row my-4 g-1 text-center'
            ]
        ]);
    }
}
