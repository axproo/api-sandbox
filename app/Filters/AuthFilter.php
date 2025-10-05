<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class AuthFilter implements FilterInterface
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
        $key = getenv('JWT_SECRET');

        // Véfifier et extraire le Bearer Token
        $header = $request->getHeaderLine('Authorization');
        $token = $this->extractToken($header);

        // Si le token est absent dans le header, on tente de le lire depuis le cookie 'jwt'
        if (!$token) {
            $cookieHeader = $request->getHeaderLine('Cookie');
            if (preg_match('/jwt=([^;]+)/', $cookieHeader, $matches)) {
                $token = $matches[1];
            }
        }

        // Si le token n'existe pas, on retourne une erreur (token missing)
        if (!$token) {
            return $this->unauthorizedResponse("Access denied! ".lang('Message.token.missing'));
        }

        // Si le token est mal formaté, on retourne une erreur (token format failed)
        if (!is_string($token)) {
            return apache_note(401, lang('Message.token.failed.format'));
        }

        // Décodage du JWT
        try {
            $decoded = JWT::decode($token, new Key($key, 'HS256'));
            $data = $decoded->data;

            // if (isset($data->)) {
            //     # code...
            // }
            return apiResponse(200, lang('Message.token.found'));
        } catch (\Throwable $th) {
            //throw $th;
        }

        return apiResponse(200, 'JWT', [
            'header' => $token
        ]);
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

    private function extractToken(?string $header) : ?string {
        if ($header && preg_match('/Bearer\s(\S+)/', $header, $matches)) {
            return $matches[1];
        }
        return null;
    }

    private function unauthorizedResponse(string $message) : ResponseInterface {
        return service('response')->setStatusCode(401)->setBody($message);
    }
}
