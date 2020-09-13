<?php
namespace Rosatom\User\Domain\Interfaces;

use Rosatom\User\Domain\Entities\User;

interface IUserRepository
{
    public function getUserByEmail(string $email, string $password): ?User;

    public function getUserById(int $id): ?User;

    /**
     * @return User[]
     */
    public function getUsersList(): array;

    public function insertUser(User $user): bool;

    public function updateUser(User $user): bool;

    public function deactivateUser(User $user): bool;
}
