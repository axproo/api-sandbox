<?php

namespace App\Filters;

use App\Services\AccessService;
use App\Services\TenantService;
use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class TenantFilter implements FilterInterface
{
    /**
     * Do whatever processing this filter needs to do.
     * By default it should not return anything during
     * normal execution. However, when an abnormal state
     * is found, it should return an instance of
     * CodeIgniter\HTTP\Response. If it does, script
     * execution will end and that Response will be
     * sent back to the client, allowing for error pages,
     * redirects, etc.
     *
     * @param RequestInterface $request
     * @param array|null       $arguments
     *
     * @return RequestInterface|ResponseInterface|string|void
     */
    public function before(RequestInterface $request, $arguments = null)
    {
        try {
            $user = AccessService::get();
            $role = AccessService::role();
            $tenantUuid = AccessService::uuid();

            if (!$user) {
                return apiResponse(401, 'Utilisateur non authentifié');
            }

            // Autorisation total si le role est superadmin
            if ($role === 'superadmin') return;

            // Vérifier que le tenant est fourni
            if (!$tenantUuid) {
                return apiResponse(403, 'Aucun tenant actif dans le token');
            }

            // Vérifier que l'utilisateur appartient à ce tenant
            $tenant = TenantService::checkTenant($tenantUuid);
            if (!$tenant) return apiResponse(403, lang('Message.access.denied', [
                'role' => lang('Message.access.tenant')
            ]));

            $userTenant = TenantService::verify($user->uid, $tenant->id);
            if (!$userTenant) return apiResponse(403, 'Access réfusé');

        } catch (\Exception $e) {
            return apiResponse(500, 'Erreur TenantFilter :' . $e->getMessage());
        }
    }

    /**
     * Allows After filters to inspect and modify the response
     * object as needed. This method does not allow any way
     * to stop execution of other after filters, short of
     * throwing an Exception or Error.
     *
     * @param RequestInterface  $request
     * @param ResponseInterface $response
     * @param array|null        $arguments
     *
     * @return ResponseInterface|void
     */
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        //
    }
}
