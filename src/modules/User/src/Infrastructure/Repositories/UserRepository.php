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
                  name_login `name`,
                  password_login `password`,
                  email_login `email`
                FROM `user` 
                WHERE `email_login` = '{$email}'
                AND `password_login` = '{$password}'
                LIMIT 1";

        $result = $this->getAdapter()->select($sql)[0];
        return $result ? User::fromArray($result) : null;
    }


}
