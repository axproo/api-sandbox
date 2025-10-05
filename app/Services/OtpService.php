<?php
namespace App\Services;

use App\Models\OtpModel;
use CodeIgniter\HTTP\IncomingRequest;
use Config\Services;
use Config\Validation\AuthConfig;

class OtpService
{
    protected IncomingRequest $request;
    protected $validate;
    protected $validation;

    protected $model;
    protected $email;
    protected $code;
    protected $title;

    public function __construct(IncomingRequest $request)
    {
        $this->request = $request;
        $this->validate = new AuthConfig();
        $this->validation = Services::validation();

        $this->model = new OtpModel();
        $this->email = service('mailerService');
    }

    public function generate() {
        $data = $this->request->getVar();

        // Validation du formulaire
        if (!$this->validation->setRules($this->validate->otp)->run($this->get_data_from_post())) {
            return apiResponse(403, $this->validation->getErrors());
        }

        // Vérification de l'utilisateur
        $user = UserService::getUserByEmail($data->email);

        // Suppression des OTP existants + création d'un nouveau
        $this->model->where('user_id', $user->id)->delete();
        $this->save_otp($user);

        // Envoi de mail au user
        $this->title = lang('Message.token.otp.verify');
        $this->email->send(
            $user->email,
            $this->title,
            'emails/active_account',
            $this->setData($user)
        );
        $protocol = config('Email')->protocol;

        return apiResponse(200, lang('Email.sent', [$protocol]), [
            'email' => $user->email,
            'redirect' => $data->redirect ?? '/v1/oauth/verify'
        ]);
    }

    protected function save_otp($user) {
        $this->code = generateCode();

        $this->model->save([
            'user_id' => $user->id,
            'otp_code' => $this->code,
            'expires_at' => generateTime()
        ]);
    }

    protected function setData(object $user, array $overrides = []) : array {
        return array_merge([
            'title' => $this->title,
            'name' => trim("{$user->first_name} {$user->last_name}"),
            'code' => $this->code,
            'copyright' => lang('Message.copyright.title'),
            'submessage' => 'Ce message a été envoyé automatiquement, veuillez ne pas y répondre',
            'link' => ''
        ], $overrides);
    }

    protected function get_data_from_post() {
        return (array) $this->request->getVar();
    }
}