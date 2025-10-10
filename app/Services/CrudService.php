<?php
namespace App\Services;

use App\Libraries\FormCustomize;
use CodeIgniter\HTTP\IncomingRequest;
use Config\Validation;
use Config\Services;

class CrudService
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

    // Création de formulaire
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
        FormCustomize::setOverrides($overrides);

        return FormCustomize::render();
    }
}