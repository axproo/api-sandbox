<?php
namespace App\Services;

use App\Models\ConfigButtonsModel;
use CodeIgniter\HTTP\IncomingRequest;
use Config\Validation;
use Config\Services;

class ButtonService
{
    protected IncomingRequest $request;
    protected $validate;
    protected $validation;

    protected $model;

    protected $columns = [
        'type',
        'name',
        'class',
        'icon',
        'action',
        'lang',
        'value',
        'is_active',
        'is_auth'
    ];

    public function __construct(IncomingRequest $request)
    {
        $this->request = $request;
        $this->validate = new Validation();
        $this->validation = Services::validation();

        $this->model = new ConfigButtonsModel();
    }

    // Récupérer la liste des bouttons
    public function getListForApi() {
        $query = $this->model
            ->asArray()
            ->select($this->columns)
            ->where([
                'is_active' => true,
                'is_auth' => false
            ])
            ->findAll();
        
        foreach ($query as $key => $value) {
            $value['is_active'] = filter_var($value['is_active'], FILTER_VALIDATE_BOOLEAN);
            $value['is_auth'] = filter_var($value['is_auth'], FILTER_VALIDATE_BOOLEAN);

            $query[$key] = $value;
        }
        return apiResponse(200, 'Button Lists', $query);
    }
}