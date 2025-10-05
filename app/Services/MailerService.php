<?php
namespace App\Services;

use CodeIgniter\HTTP\IncomingRequest;
use Config\Validation;
use Config\Services;

class MailerService
{
    protected IncomingRequest $request;
    protected $validate;
    protected $validation;

    protected $email;
    protected $parser;

    public function __construct(IncomingRequest $request)
    {
        $this->request = $request;
        $this->validate = new Validation();
        $this->validation = Services::validation();

        $this->email = Services::email();
        $this->parser = service('parser');
    }

    public function send(string $to, string $subject, ?string $view = null, array $data = []) : bool {
        $this->email->clear();

        $this->email->setTo($to);
        $this->email->setSubject($subject);

        $path = FCPATH . "email_header.png";
        if (!is_file($path)) {
            throw new \Exception(lang('Images.invalidPath'));
        }
        $this->email->attach($path);
        $cid = $this->email->setAttachmentCID($path);

        if ($view) {
            $data['year'] = date('Y');
            $data['image'] = "cid:$cid";

            $message = $this->parser->setData($data)->render($view);
        } else {
            $message = $data['message'] ?? '';
        }
        $this->email->setMessage($message);
        $this->email->setMailType('html');

        if (!$this->email->send()) {
            $debug = $this->email->printDebugger(['header','subject','body']);

            if (preg_match('/Unable to send email.*$/mi', $debug, $matches)) {
                $error = trim($matches[0]);
            } else {
                $error = 'Aucune erreur SMTP détectée.';
            }
            
            log_message('error', 'Erreur mail : ' . $error);

            throw new \Exception(lang('Email.SMTPDataFailure', [$error]));
            return false;
        } else {
            return true;
        }
    }
}