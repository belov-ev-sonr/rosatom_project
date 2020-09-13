<?php
namespace Rosatom\Auth\App\Services;

use Rosatom\Auth\Domain\Entities\UserAccessToken;
use Rosatom\Auth\Domain\Interfaces\ITokenRepository;
use Rosatom\Common\MySqlAdapter;

class TokenRepository implements ITokenRepository
{
    /** @var MySqlAdapter */
    private $adapter;

    /**
     * TokenRepository constructor.
     * @param MySqlAdapter $adapter
     */
    public function __construct(MySqlAdapter $adapter = null)
    {
        if (is_null($adapter)) {
            $this->adapter = new MySqlAdapter();
        } else {
            $this->adapter = $adapter;
        }
    }

    /**
     * @return MySqlAdapter
     */
    private function getAdapter(): MySqlAdapter
    {
        return $this->adapter;
    }

    public function insertToken(UserAccessToken $token): bool
    {
        $time = $token->getTime()->format('Y-m-d');
        $sql = "INSERT INTO `auth_token`
                SET `user_id` = '{$token->getUserId()}',
                `expired` = '{$token->getExpired()}',
                `time` = '{$time}',
                `refresh_token` = '{$token->getRefreshToken()}'";

        return $this->getAdapter()->insert($sql);
    }


    public function getUserAccessTokenByRefreshToken(string $refreshToken): ?UserAccessToken
    {
        $sql = "SELECT
                  id,
                  user_id,
                  expired,
                  `time`,
                  refresh_token
                FROM `auth_token` 
                WHERE `refresh_token` = '{$refreshToken}'
                LIMIT 1";

        $result = $this->getAdapter()->select($sql)[0];
        return $result ? UserAccessToken::fromArray($result) : null;
    }
}
