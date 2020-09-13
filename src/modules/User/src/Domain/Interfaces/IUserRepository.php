<?php
namespace Rosatom\User\Domain\Interfaces;

use Rosatom\User\Domain\Entities\User;

interface IUserRepository
{
    public function getUserByEmail(string $email, string $password): ?User;
}
