<?php
namespace Rosatom\Auth\App\Services;

use Firebase\JWT\JWT;
use Rosatom\Auth\Domain\Entities\UserAccessToken;
use Rosatom\Auth\Domain\Interfaces\ITokenRepository;

class TokenService
{
    /** @var ITokenRepository */
    private $repository;
    private const HASH_FUNC = 'HS256';
    private const SECRET_KEY = 'c8241897785c8e62f194d29aa7sd8a58';
    private const AUTHORIZATION_HEADER = 'Authorization';

    /**
     * TokenService constructor.
     * @param ITokenRepository $repository
     */
    public function __construct(ITokenRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @return ITokenRepository
     */
    private function getRepository(): ITokenRepository
    {
        return $this->repository;
    }

    public function generateRefreshToken(int $userId): string
    {
        $time = new \DateTime();
        $expired = $time->getTimestamp() + 3600 * 24 * 7;
        $token = hash_hmac('SHA256', ($userId . '-' . time() . uniqid()), self::SECRET_KEY);
        $userToken = UserAccessToken::from(0, $userId, $time, $expired, $token);
        $this->getRepository()->insertToken($userToken);
        return $token;
    }

    public function generateAccessToken(int $userId): string
    {
        $tokenArray = array(
            "iss" => "https://". $_SERVER['HTTP_HOST'],
            "exp" => time() + 3600,
            "iat" => time(),
            "userId" => $userId
        );
        $token = JWT::encode($tokenArray, self::SECRET_KEY, self::HASH_FUNC);
        return $token;
    }

    public function getAuthorizationHeader()
    {
        $headers = null;
        if (isset($_SERVER['' . self::AUTHORIZATION_HEADER . ''])) {
            $headers = trim($_SERVER[self::AUTHORIZATION_HEADER]);
        } elseif (isset($_SERVER['HTTP_AUTHORIZATION'])) { //Nginx or fast CGI
            $headers = trim($_SERVER["HTTP_AUTHORIZATION"]);
        } elseif (function_exists('apache_request_headers')) {
            $requestHeaders = apache_request_headers();
            $requestHeaders = array_combine(
                array_map(
                    'ucwords',
                    array_keys($requestHeaders)
                ),
                array_values($requestHeaders)
            );
            if (isset($requestHeaders[self::AUTHORIZATION_HEADER])) {
                $headers = trim($requestHeaders[self::AUTHORIZATION_HEADER]);
            }
        }
        return $headers;
    }

    public function getBearerToken()
    {
        $headers = $this->getAuthorizationHeader();
        // HEADER: Get the access token from the header
        if ((!empty($headers)) && preg_match('/Bearer\s+(\S+)/', $headers, $matches)) {
            return $matches[1];
        }
        return null;
    }

    public function checkRefreshToken($refreshToken): ?UserAccessToken
    {
        $userToken = $this->getRepository()->getUserAccessTokenByRefreshToken($refreshToken);
        if ((!$userToken ) || ($userToken ->getExpired() < time())) {
            return null;
        }
        return $userToken;
    }
}
