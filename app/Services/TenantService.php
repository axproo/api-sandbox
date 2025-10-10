<?php
namespace App\Services;

use App\Models\TenantsModel;
use App\Models\UsersTenantsModel;
use CodeIgniter\HTTP\IncomingRequest;
use Config\Validation;
use Config\Services;

class TenantService
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

    // Récupération du tenant user
    public static function getTenantByUser($userId) {
        $model = new UsersTenantsModel();

        $tenant = $model
            ->join('tenants', 'tenants.id = users_tenants.tenant_id', 'left')
            ->where('user_id', $userId)
            ->first();
        return $tenant->uuid ?? null;
    }

    // Vérifier si l'utilisateur appartien à ce tenant
    public static function checkTenant($uuid) {
        $model = new TenantsModel();
        $tenant = $model
            ->where([
                'uuid' => $uuid,
                'status' => 'active' 
            ])
            ->first();
        return $tenant;
    }

    // Vérifier que les identifiants de l'utilasateur non pas changé pour ce tenant
    public static function verify($userId, $uuid) {
        $model = new UsersTenantsModel();
        $tenant = $model
            ->where([
                'user_id' => $userId,
                'tenant_id' => $uuid,
                'status' => 'active'
            ])->first();

        return ($tenant) ? true : false;
    }
}