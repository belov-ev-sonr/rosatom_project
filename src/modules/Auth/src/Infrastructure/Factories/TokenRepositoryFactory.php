<?php
namespace Rosatom\Auth\Infrastructure\Factories;

use Rosatom\Auth\App\Services\TokenRepository;
use Rosatom\Auth\Domain\Interfaces\ITokenRepository;

class TokenRepositoryFactory
{
    public static function createRepository(): ITokenRepository
    {
        return new TokenRepository();
    }
}
