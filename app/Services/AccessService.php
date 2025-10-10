<?php
namespace App\Services;

use CodeIgniter\HTTP\IncomingRequest;
use Config\Validation;
use Config\Services;

class AccessService
{
    protected IncomingRequest $request;
    protected $validate;
    protected $validation;

    private static $user;

    public function __construct(IncomingRequest $request)
    {
        $this->request = $request;
        $this->validate = new Validation();
        $this->validation = Services::validation();
    }

    public static function set($data) {
        if (!empty($data->role)) {
            $data->permissions = '';
        }
        self::$user = $data;
    }

    public static function get() {
        return self::$user;
    }

    public static function id() {
        return self::$user->uid;
    }

    public static function uuid() {
        return self::$user->tenant_id ?? null;
    }

    public static function role() {
        return self::$user->role ?? null;
    }

    public static function role_id() {
        return self::$user->role_id ?? null;
    }

    public static function fullname() {
        return self::$user->fullname ?? null;
    }

    public static function user_type() {
        return self::$user->user_type ?? null;
    }

    public static function permissions() {
        return self::$user->permissions ?? null;
    }
}