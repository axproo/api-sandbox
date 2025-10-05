<?php
namespace App\Services;

use App\Models\UsersModel;
use CodeIgniter\HTTP\IncomingRequest;
use Config\Validation;
use Config\Services;

class UserService
{
    protected IncomingRequest $request;
    protected $validate;
    protected $validation;

    public function __construct(IncomingRequest $request)
    {
        $this->request = $request;
        $this->validate = new Validation();
        $this->validation = Services::validation();
    }

    // Vérification de l'e-mail utilisateur
    public static function getUserByEmail($email) {
        $data = self::getUser(['email' => $email]);

        if (!$data) {
            throw new \Exception(lang('Auth.failed.email.incorrect'));
        }
        return $data;
    }

    private static function getUser(array $where = []) {
        $model = new UsersModel();

        if ($where && is_array($where)) {
            foreach ($where as $key => $value) {
                $model->where($key, $value);
            }
        }
        return $model->first();
    }
}