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
                  phone
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
                  phone
                FROM `user` 
                WHERE `id` = '{$id}'
                LIMIT 1";

        $result = $this->getAdapter()->select($sql)[0];
        return $result ? User::fromArray($result) : null;
    }

}
