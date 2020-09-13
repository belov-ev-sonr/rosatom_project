<?php
namespace Rosatom\Auth\Domain\Interfaces;

use Rosatom\Auth\Domain\Entities\UserAccessToken;

interface ITokenRepository
{
    public function insertToken(UserAccessToken $token): bool;

    public function getUserAccessTokenByRefreshToken(string $refreshToken): ?UserAccessToken;
}
