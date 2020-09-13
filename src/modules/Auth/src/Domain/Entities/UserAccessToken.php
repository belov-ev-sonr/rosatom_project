<?php
namespace Rosatom\Auth\Domain\Entities;

class UserAccessToken
{
    /** @var int */
    private $id;
    /** @var int */
    private $userId;
    /** @var int */
    private $expired;
    /** @var \DateTime */
    private $time;
    /** @var string */
    private $refreshToken;

    /**
     * UserAccessToken constructor.
     */
    private function __construct()
    {
    }

    public static function fromArray(array $tokenData): self
    {
        $token = new self();
        $token->id = (int)$tokenData['id'];
        $token->userId = (int)$tokenData['userId'];
        $token->time = new \DateTime($tokenData['time']);
        $token->expired = (int)$tokenData['expired'];
        $token->refreshToken = (string)$tokenData['refreshToken'];

        return $token;
    }

    public static function from(int $id, int $userId, \DateTime $time, int $expired, string $refreshToken): self
    {
        $token = new self();
        $token->id = $id;
        $token->userId = $userId;
        $token->time = $time;
        $token->expired = $expired;
        $token->refreshToken = $refreshToken;

        return $token;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getUserId(): int
    {
        return $this->userId;
    }

    /**
     * @return int
     */
    public function getExpired(): int
    {
        return $this->expired;
    }

    /**
     * @return \DateTime
     */
    public function getTime(): \DateTime
    {
        return $this->time;
    }

    /**
     * @return string
     */
    public function getRefreshToken(): string
    {
        return $this->refreshToken;
    }
}
