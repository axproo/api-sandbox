<?php 
namespace App\Services;

use App\Models\OtpModel;
use CodeIgniter\I18n\Time;
use Config\Validation\AuthConfig;

class OtpService extends BaseService
{
    protected $model;
    protected $validate;

    public function __construct($request) {
        parent::__construct($request);
        $this->model = new OtpModel();

        $this->validate = new AuthConfig();
    }

    public function generate() {
        $data = $this->get_data_from_post();

        // Validation des données
        if (!$this->validate($this->validate->otp)) {
            return $this->respondError($this->validation->getErrors());
        }
        $user = UserService::getUserByEmail($data['email']);
        $user->code = $this->generateOtp($this->model, $user->id);

        $this->title = lang('Message.token.otp.verify');
        $this->sendEmail($user->email, 'emails/active_account', $this->setDataForEmail($user));

        return $this->respondSuccess(lang('Message.email.sent'), [
            'email' => $user->email,
            'redirect' => $data['redirect'] ?? '/verify/2FA'
        ]);
    }

    public function resend() {
        $data = $this->get_data_from_post();
        
        $user = UserService::getUserByEmail($data['email']);

        // Vérification du délai anti-abus
        if (!$this->canResend($this->model, $user->id)) {
            return $this->respondError(lang('Auth.failed.otp.wait_before_resend', ['min' => 5]), 429, [
                'retry_after' => 5
            ]);
        }

        if ($user->status === 'active') {
            return $this->respondError(lang('Auth.failed.account.active'), 401);
        }
        $user->code = $this->generateOtp($this->model, $user->id);

        $this->title = lang('Message.token.otp.verify');
        $this->sendEmail($user->email, 'emails/active_account', $this->setDataForEmail($user));

        return $this->respondSuccess(lang('Message.email.sent'), [
            'email' => $user->email,
            'redirect' => $data['redirect'] ?? '/verify/2FA'
        ]);
    }

    public function verified() {
        $data = $this->get_data_from_post();

        // Validation du formulaire
        if (!$this->validate($this->validate->code)) {
            return $this->respondError($this->validation->getErrors());
        }

        $user = UserService::getUserByEmail($data['email']);
        if ($user->status !== 'pending' && $user->email_verified === true) {
            return $this->respondError(lang('Auth.failed.account.active'), 401);
        }
        $this->checkOtp($this->model, $user->id, $data['code']);

        $user->status = 'active';
        $user->email_verified = true;
        $user->email_verified_at = Time::now();

        UserService::updateUserData($user);
        $this->deleteOtp($this->model, $user->id);

        $this->title = lang('Message.token.otp.active_account');
        $this->sendEmail($user->email, 'emails/verify', $this->setDataForEmail($user, ['link' => '/']));

        return $this->respondSuccess(lang('Message.email.active'), [
            'email' => $user->email,
            'redirect' => $data['redirect'] ?? '/'
        ]);
    }
}