<?php
namespace App\Services;

use App\Models\ServicesModel;
use App\Models\UsersServicesModel;
use CodeIgniter\HTTP\IncomingRequest;
use Config\Validation;
use Config\Services;

class SolutionsService
{
    protected IncomingRequest $request;
    protected $validate;
    protected $validation;

    protected static array $columns = [];

    public function __construct(IncomingRequest $request)
    {
        $this->request = $request;
        $this->validate = new Validation();
        $this->validation = Services::validation();
    }

    protected static function init() {
        self::$columns = [
            'services.name',
            'services.description',
            'services.class',
            'services.image',
            'services.label',
            'services.url'
        ];
    }

    public static function getLists() {
        self::init();

        $model = new UsersServicesModel();
        $query = $model
            ->asArray()
            ->select(self::$columns)
            ->join('services', 'services.id = users_services.service_id','left')
            ->where('user_id', AccessService::id())
            ->findAll();
        
        return apiResponse(200, 'Solution lists', $query);
    }
}