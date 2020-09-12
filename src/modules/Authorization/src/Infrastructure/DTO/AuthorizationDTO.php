<?php


class AuthorizationDTO
{
    /**
     * @var string
     */
    private $nameLogin;

    /**
     * @var string
     */
    private $emailLogin;

    /**
     * @var string
     */
    private $passwordLogin;

    /**
     * AuthorizationDTO constructor.
     * @param string $name
     * @param string $password
     */
    public function __construct(array $data)
    {
        $this->nameLogin = $data['nameLogin'];
        $this->passwordLogin = $data['passwordLogin'];
        $this->emailLogin = $data['emailLogin'];
    }

    /**
     * @return string
     */
    public function getNameLogin(): string
    {
        return $this->nameLogin;
    }

    /**
     * @return string
     */
    public function getPasswordLogin(): string
    {
        return $this->passwordLogin;
    }

    /**
     * @return string
     */
    public function getEmailLogin(): string
    {
        return $this->emailLogin;
    }




}