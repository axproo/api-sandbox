<?php
namespace App\Services;

use App\Models\ConfigAlertsModel;
use CodeIgniter\HTTP\IncomingRequest;
use Config\Validation;
use Config\Services;

class AlertService
{
    protected IncomingRequest $request;
    protected $validate;
    protected $validation;

    protected $model;

    protected $columns = ['title','alert','class','text','icon'];

    public function __construct(IncomingRequest $request)
    {
        $this->request = $request;
        $this->validate = new Validation();
        $this->validation = Services::validation();

        $this->model = new ConfigAlertsModel();
    }

    // Recupérer la liste des alertes
    public function getListForAlert() {
        $query = $this->model
            ->asArray()
            ->select($this->columns)
            ->findAll();
        return apiResponse(200, 'Alert Lists', $query);
    }
}