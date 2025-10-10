<?php
namespace App\Services;

use App\Models\RulesModel;
use Config\Validation;

class RulesService extends BaseService
{
    protected $validate;

    public function __construct($request)
    {
        parent::__construct($request);
        $this->validate = new Validation();
    }

    public static function getRoleByUser(?int $id = null) {
        $model = new RulesModel();

        $query = $model->find($id);
        return $query->role_name ?? null;
    }
}