<?php
namespace Rosatom\User\Presentation\Controller;

use Rosatom\User\Infrastructure\Factories\UserRepositoryFactory;
use Rosatom\User\Presentation\Presenters\UserPresenter;
use Slim\Http\Request;
use Slim\Http\Response;

class UserController
{
    public function getUsersList(Request $request, Response $response): Response
    {
        $repository = UserRepositoryFactory::createRepository();
        $usersList = $repository->getUsersList();
        $presenters = [];
        foreach ($usersList as $user) {
            $presenters[] = new UserPresenter($user);
        }

        return $response->withJson($presenters);
    }

    public function getUsersById(Request $request, Response $response): Response
    {
        $userId = (int)$request->getAttributes('id');
        $repository = UserRepositoryFactory::createRepository();
        $user = $repository->getUserById($userId);

        return $response->withJson(new UserPresenter($user));
    }
}
