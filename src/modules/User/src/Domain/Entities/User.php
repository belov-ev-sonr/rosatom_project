<?php
namespace Rosatom\User\Domain\Entities;

class User
{
    /** @var int */
    private $id;
    /** @var string */
    private $name;
    /** @var string */
    private $password;
    /** @var string */
    private $email;

    /**
     * User constructor.
     */
    private function __construct()
    {
    }

    public static function from(int $id, string $name, string $password, string $email): self
    {
        $user = new self();
        $user->id = $id;
        $user->name = $name;
        $user->password = $password;
        $user->email = $email;

        return $user;
    }

    public static function fromArray(array $userData): self
    {
        $user = new self();
        $user->id = (int)$userData['id'];
        $user->name = (string)$userData['name'];
        $user->password = (string)$userData['password'];
        $user->email = (string)$userData['email'];

        return $user;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }
}
