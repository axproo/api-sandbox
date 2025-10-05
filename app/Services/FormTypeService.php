<?php
namespace App\Services;

use App\Models\FormTypesModel;
use CodeIgniter\HTTP\IncomingRequest;
use Config\Validation;
use Config\Services;

class FormTypeService
{
    protected IncomingRequest $request;
    protected $validate;
    protected $validation;

    protected static ?FormTypesModel $model;

    public function __construct(IncomingRequest $request)
    {
        $this->request = $request;
        $this->validate = new Validation();
        $this->validation = Services::validation();
    }

    private static function init() {
        self::$model = new FormTypesModel();
    }

    // Récuperer le nom du type de formulaire
    public static function getTypeByName($id) {
        self::init();

        $query = self::$model->where('id', $id)->first();
        return $query->name ?? null;
    }
}