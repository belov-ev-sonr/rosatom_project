<?php
namespace Rosatom\User\Domain\Entities;

class User
{
    /** @var int */
    private $id;
    /** @var string */
    private $login;
    /** @var string */
    private $firstName;
    /** @var string */
    private $secondName;
    /** @var string */
    private $middleName;
    /** @var string */
    private $phone;
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

    public static function from(
        int $id,
        string $login,
        string $firstName,
        string $secondName,
        string $middleName,
        string $phone,
        string $password,
        string $email
    ): self {
        $user = new self();
        $user->id = $id;
        $user->login = $login;
        $user->firstName = $firstName;
        $user->secondName = $secondName;
        $user->middleName = $middleName;
        $user->phone = $phone;
        $user->password = $password;
        $user->email = $email;

        return $user;
    }

    public static function fromArray(array $userData): self
    {
        $user = new self();
        $user->id = (int)$userData['id'];
        $user->login = (string)$userData['login'];
        $user->firstName = (string)$userData['firstName'];
        $user->secondName = (string)$userData['secondName'];
        $user->middleName = (string)$userData['middleName'];
        $user->phone = (string)$userData['phone'];
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
    public function getLogin(): string
    {
        return $this->login;
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

    /**
     * @return string
     */
    public function getFirstName(): string
    {
        return $this->firstName;
    }

    /**
     * @return string
     */
    public function getSecondName(): string
    {
        return $this->secondName;
    }

    /**
     * @return string
     */
    public function getMiddleName(): string
    {
        return $this->middleName;
    }

    /**
     * @return string
     */
    public function getPhone(): string
    {
        return $this->phone;
    }
}
