<?php

namespace App\Filters;

use App\Services\AccessService;
use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class RoleFilter implements FilterInterface
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

            if (!$user) {
                return apiResponse(401, 'Utilisateur non authentifié');
            }

            // Nettoyage du chemin
            $path = trim($request->getUri()->getPath(), '/');
            $segments = explode('/', $path);
            $firstSegment = $segments[0] ?? '';

            // Autorisation total si le role est superadmin
            if ($role === 'superadmin') return;

            switch ($firstSegment) {
                case 'admin':
                    if ($role !== 'admin') return apiResponse(403, lang('Message.access.denied', [
                        'role' => lang('Message.access.role.admin')
                    ]));
                    break;
                    
                case 'msp':
                    if ($role !== 'msp') {
                        return apiResponse(403, lang('Message.access.denied', [
                            'role' => lang('Message.access.role.msp')
                        ]));
                    }
                    break;

                case 'client':
                    if (!in_array($role, ['client','admin','msp'])) {
                        return apiResponse(403, lang('Message.access.denied', [
                            'role' => lang('Message.access.role.client')
                        ]));
                    }
                    break;
            }
        } catch (\Exception $e) {
            return apiResponse(401, 'Erreur de filtre de role '. $e->getMessage());
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
