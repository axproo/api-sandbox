<?php
namespace App\Services;

use App\Libraries\FormCustomize;
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

        // Vérifier l'utilisateur et recupérer ces données
        $user = UserService::getUserByEmail($data->email);

        // Vérifier le status de l'utilisateur
        if ($user->status !== 'active') {
            $message = $user->status === 'pending' ? 'Auth.failed.account.verify' : 'Auth.failed.account.inactivated';

            return apiResponse(401, lang($message), [
                'redirect'  => '/account-verify',
                'url'       => '/account/verify'
            ]);
        }

        return apiResponse(200, 'Auth signin', [
            'data' => $data,
            'email' => $user->status
        ]);
    }

    public function new(array $fields = [], array $overrides = []) {
        $items = [];
        foreach ($fields as $key) {
            $items[$key] = $this->request->getVar($key);
        }
        if (!$items) {
            throw new \Exception(lang('Message.forms.failed.field', [
                'form' => uri_string()
            ]));
        }
        FormCustomize::setItems($items);
        return FormCustomize::render();
    }

    protected function get_data_from_post() {
        return (array) $this->request->getVar();
    }
}