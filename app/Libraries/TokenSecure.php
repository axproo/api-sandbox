<?php 
namespace App\Libraries;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class TokenSecure
{
    private $secretKey;
    private $secretRefresh;

    public function __construct() {
        $this->secretKey     = getenv('JWT_SECRET');
        $this->secretRefresh = getenv('JWT_REFRESH_SECRET');
    }

    public function generate(array $userData = []) {
        $iat = time();
        $exp = $iat + 86400; // 24h

        $payload = [
            'iat' => $iat,
            'exp' => $exp,
            'data' => $userData
        ];
        return JWT::encode($payload, $this->secretKey, 'HS256');
    }

    public function me($token, $type = 'access') {
        $key = $type === 'refresh' ? $this->secretRefresh : $this->secretKey;

        try {
            $decoded = JWT::decode($token, new Key($key, 'HS256'));

            if (!$decoded) {
                throw new \Exception(lang('Auth.failed.token'));
            }
            return $decoded;
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }
}