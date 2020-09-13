<?php
namespace Rosatom\User\Infrastructure\Factories;

use Rosatom\User\Domain\Interfaces\IUserRepository;
use Rosatom\User\Infrastructure\Repositories\UserRepository;

class UserRepositoryFactory
{
    public static function createRepository(): IUserRepository
    {
        return new UserRepository();
    }
}
