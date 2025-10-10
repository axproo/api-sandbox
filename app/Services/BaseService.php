<?php
namespace App\Services;

use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\I18n\Time;
use Config\Services;

class BaseService
{
    protected IncomingRequest $request;
    protected $validation;
    protected $mailer;

    protected $title;
    protected $code;

    public function __construct(IncomingRequest $request)
    {
        $this->request = $request;
        $this->validation = Services::validation();
        $this->mailer = service('mailerService');
    }

    // Récupération des données POST / GET
    protected function get_data_from_post() : array {
        return (array) $this->request->getVar();
    }

    // Validation générique
    protected function validate(array $rules) : bool {

        if (!$this->validation->setRules($rules)->run($this->get_data_from_post())) {
            return false;
        }
        return true;
    }

    // Réponse API
    protected function respondSuccess(string $message, array $data = []) {
        return apiResponse(200, $message, $data);
    }

    protected function respondError(string|array $message, int $code = 403, array $data = []) {
        return apiResponse($code, $message, $data);
    }

    // Envoi de mail
    protected function sendEmail(string $to, string $view, array $data = []) {
        return $this->mailer->send($to, $this->title, $view, $data);
    }

    // OTP générique
    protected function generateOtp($model, $userId, int $code = 15) {
        $code = generateCode($code);

        $this->deleteOtp($model, $userId);
        $model->save([
            'user_id' => $userId,
            'otp_code' => $code,
            'expires_at' => generateTime()
        ]);
        return $code;
    }

    protected function checkOtp($model, $userId, string $code) {
        $otp = $model->where([
            'user_id' => $userId,
            'otp_code' => $code
        ])->first();

        if (!$otp) throw new \Exception(lang('Auth.failed.otp.not_found'));
        if (Time::now()->isAfter($otp->expires_at)) throw new \Exception(lang('Auth.failed.otp.invalid'));

        return $otp;
    }

    protected function deleteOtp($model, $userId) {
        $model->where('user_id', $userId)->delete();
    }

    protected function canResend($model, $userId) : bool {
        $RESEND_DELAY = 5 * 60; // 5 minutes

        // Récupérer le dernier OTP envoyé pour l'utilisateur
        $lastOtp = $model
            ->where('user_id', $userId)
            ->orderBy('created_at', 'DESC')
            ->first();
        
        // Si aucun OTP trouvé -> autoriser le renvoi
        if (!$lastOtp) return true;

        // Calculer la différence en secondes
        $elapsed = Time::now()->getTimestamp() - Time::parse($lastOtp->created_at)->getTimestamp();

        // Vérifier si le délai de 5 minutes est écoulé
        return $elapsed >= $RESEND_DELAY;
    }

    // Chargement des DATA pour envoi de mail
    protected function setDataForEmail($user, array $overrides = []) {
        return array_merge([
            'title' => $this->title,
            'name' => trim("{$user->first_name} {$user->last_name}"),
            'code' => $user->code,
            'copyright' => lang('Message.copyright.title'),
            'submessage' => 'Ce message a été envoyé automatiquement, veuillez ne pas y répondre',
            'link' => ''
        ], $overrides);
    }
}