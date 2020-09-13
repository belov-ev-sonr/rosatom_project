<?php
namespace Rosatom\User\Domain\Interfaces;

use Rosatom\User\Domain\Entities\User;

interface IUserRepository
{
    public function getUserByEmail(string $email, string $password): ?User;

    public function getUserById(int $id): ?User;

    /**
     * @param int $id
     * @return User[]
     */
    public function getUsersList(): array;
}
