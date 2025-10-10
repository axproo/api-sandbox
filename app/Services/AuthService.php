<?php 
namespace App\Services;

use App\Libraries\TokenSecure;
use App\Models\UsersModel;
use Config\Validation\AuthConfig;

class AuthService extends BaseService
{
    protected $model;
    protected $validate;
    protected $token;

    protected $secure = (ENVIRONMENT === 'production') ? true : false;

    public function __construct($request) {
        parent::__construct($request);
        $this->model = new UsersModel();
        $this->validate = new AuthConfig();
        $this->token = new TokenSecure();
    }

    public function me() {
        $jwt = $this->request->getCookie('jwt');

        if (empty($jwt)) {
            throw new \Exception(lang('Message.token.failed.format'));
        }
        return $this->respondSuccess('me', [
            'user' => $this->token->me($jwt)?->data
        ]);
    }

    public function signin() {
        $data = $this->get_data_from_post();

        // Validation du formulaire
        if (!$this->validate($this->validate->auth)) {
            return $this->respondError($this->validation->getErrors());
        }

        // Vérification du status
        $user = UserService::getUserByEmail($data['email']);
        $statusCheck = self::getStatus($user->status);

        if (is_array($statusCheck)) {
            return $this->respondError(lang('Auth.failed.account.verify', $statusCheck));
        }

        // Vérification du mot de passe
        UserService::checkUserPassword($data['password'], $user->password);

        // Récupération du role utilisateur
        $role = RulesService::getRoleByUser($user->role_id);

        $overrides = [];
        if (!empty($user->totp_secret)) $overrides['twofa_pending'] = true;

        // Génération du token
        $userData = array_merge([
            'tenant_id' => TenantService::getTenantByUser($user->id),
            'role' => $role,
            'twofa_pending' => false,
        ], UserService::getUserByAccount($user, $overrides));
        $token = $this->token->generate($userData);

        // Authentification à 2 facteurs 2FA
        if ($userData['twofa_pending'] === true) {
            return $this->respondError(lang('Auth.failed.twofactor_need'), 401, [
                'redirect' => '/2FA-verify',
                'token' => $token
            ]);
        }
        $this->setcookie($token);
        return $this->respondSuccess(lang('Auth.success.login'), [
            'redirect' => '/dashboard'
        ]);
    }

    protected static function getStatus($status) {
        switch ($status) {
            case 'active': return true;
            case 'pending': return ['key' => 'account-verify'];
            case 'inactive': throw new \Exception(lang('Auth.failed.account.inactivated'));
            case 'blocked': throw new \Exception(lang('Auth.failed.account.blocked'));
            default: throw new \Exception(lang('Auth.failed.account.unknown', ['status' => $status]));
        }
    }

    public function setcookie($token, $expire = 86400) {
        $response = service('response');

        $response->setCookie([
            'name'      => 'jwt',
            'value'     => $token,
            'expire'    => $expire, // 24h par défaut
            'httponly'  => true,
            'secure'    => $this->secure, // Mettre à true en production avec HTTPS
            'path'      => '/',
            'samesite'  => 'lax' // Lax ou Strict pour plus de sécurité
        ]);
    }
}