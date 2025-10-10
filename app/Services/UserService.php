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

    // Vérification du mot de passe de l'utilisateur
    public static function checkUserPassword($password, $hash) {
        if (!password_verify($password, $hash)) {
            throw new \Exception(lang('Auth.failed.password.incorrect'));
        }
        return true;
    }

    // Vérification de l'e-mail utilisateur
    public static function getUserByEmail($email) {
        $data = self::getUser(['email' => $email]);

        if (!$data) {
            throw new \Exception(lang('Auth.failed.email.incorrect'));
        }
        return $data;
    }

    // Mise à jour de l'utilisateur
    public static function updateUserData($data) {
        $model = new UsersModel();
        $model->save($data);
    }

    // Récupération des données de l'utilisateur
    private static function getUser(array $where = []) {
        $model = new UsersModel();

        if ($where && is_array($where)) {
            foreach ($where as $key => $value) {
                $model->where($key, $value);
            }
        }
        $query = $model->first();
        if (isset($query->email_verified)) {
            $query->email_verified = filter_var($query->email_verified, FILTER_VALIDATE_BOOLEAN);
        }
        return $query;
    }

    // Récupération du compte utilisateur
    public static function getUserByAccount(object $user, array $overrides = []) : array {
        return array_merge([
            'uid'       => $user->id,
            'email'     => $user->email,
            'user_type' => $user->user_type,
            'fullname'  => trim("{$user->first_name} {$user->last_name}") ?? lang('Auth.failed.fullname')
        ], $overrides);
    }
}