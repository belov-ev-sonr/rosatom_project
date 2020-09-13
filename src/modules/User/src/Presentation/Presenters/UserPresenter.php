<?php
namespace Rosatom\User\Presentation\Presenters;

use Rosatom\User\Domain\Entities\User;

class UserPresenter implements \JsonSerializable
{
    /** @var User */
    private $user;

    /**
     * UserPresenter constructor.
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * @return User
     */
    private function getUser(): User
    {
        return $this->user;
    }

    public function jsonSerialize()
    {
        return [
            'id' => $this->getUser()->getId(),
            'email' => $this->getUser()->getEmail(),
            'login' => $this->getUser()->getLogin(),
            'firstName' => $this->getUser()->getFirstName(),
            'secondName' => $this->getUser()->getSecondName(),
            'middleName' => $this->getUser()->getMiddleName(),
            'phone' => $this->getUser()->getPhone()
        ];
    }


}
