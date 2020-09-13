<?php
namespace Rosatom\User\Infrastructure\Repositories;

use Rosatom\User\Domain\Entities\User;
use Rosatom\User\Domain\Interfaces\IUserRepository;
use Rosatom\Common\MySqlAdapter;

class UserRepository implements IUserRepository
{
    /** @var MySqlAdapter */
    private $adapter;

    /**
     * UserRepository constructor.
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

    public function getUserByEmail(string $email, string $password): ?User
    {
        $sql = "SELECT
                  id,
                  login,
                  password `password`,
                  email `email`,
                  first_name `firstName`,
                  second_name `secondName`,
                  middle_name `middleName`,
                  phone,
                  `active`
                  FROM `user` 
                WHERE `email` = '{$email}'
                AND `password` = '{$password}'
                LIMIT 1";

        $result = $this->getAdapter()->select($sql)[0];
        return $result ? User::fromArray($result) : null;
    }

    public function getUserById(int $id): ?User
    {
        $sql = "SELECT
                  id,
                  login,
                  password `password`,
                  email `email`,
                  first_name `firstName`,
                  second_name `secondName`,
                  middle_name `middleName`,
                  phone,
                  `active`
                FROM `user` 
                WHERE `id` = '{$id}'
                LIMIT 1";

        $result = $this->getAdapter()->select($sql)[0];
        if (!$result) {
            throw new \Exception('Not found user', 204);
        }
        return User::fromArray($result);
    }

    /**
     * @return User[]
     * @throws \Exception
     */
    public function getUsersList(): array
    {
        $sql = "SELECT
                  id,
                  login,
                  password `password`,
                  email `email`,
                  first_name `firstName`,
                  second_name `secondName`,
                  middle_name `middleName`,
                  phone,
                  `active`
                FROM `user`";

        $result = $this->getAdapter()->select($sql);
        $usersList = [];
        foreach ($result as $row) {
            $usersList[] = User::fromArray($row);
        }
        return $usersList;
    }

    public function insertUser(User $user): bool
    {
        $sql = "INSERT INTO `user`
                SET `login` = '{$user->getLogin()}',
                    `password` = '{$user->getPassword()}',
                    `email` = '{$user->getEmail()}',
                    `first_name` = '{$user->getFirstName()}',
                    `second_name` = '{$user->getSecondName()}',
                    `middle_name` = '{$user->getMiddleName()}',
                    `phone` = '{$user->getPhone()}',
                    `active` = '{$user->getActive()}'";
        return $this->getAdapter()->insert($sql);
    }

    public function updateUser(User $user): bool
    {
        $sql = "UPDATE `user`
                SET `login` = '{$user->getLogin()}',
                    `password` = '{$user->getPassword()}',
                    `email` = '{$user->getEmail()}',
                    `first_name` = '{$user->getFirstName()}',
                    `second_name` = '{$user->getSecondName()}',
                    `middle_name` = '{$user->getMiddleName()}',
                    `phone` = '{$user->getPhone()}',
                    `active` = '{$user->getActive()}'
                WHERE `id` = '{$user->getId()}'";
        return $this->getAdapter()->update($sql);
    }

    public function deactivateUser(User $user): bool
    {
        $sql = "UPDATE `user` 
                SET `active` = 0
                WHERE `id` = '{$user->getId()}'";
        return $this->getAdapter()->update($sql);
    }
}
