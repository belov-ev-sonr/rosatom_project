<?php
namespace Rosatom\User\Presentation\Controller;

use Rosatom\User\Domain\Entities\User;
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
        $userId = (int)$request->getAttribute('id');
        $repository = UserRepositoryFactory::createRepository();
        try {
            $user = $repository->getUserById($userId);
            $response = $response->withJson(new UserPresenter($user));
        } catch (\Exception $e) {
            $response->withStatus(204);
        }

        return $response;
    }

    public function createUser(Request $request, Response $response): Response
    {
        $userData = $request->getParsedBody();
        $user = User::fromArray($userData);
        $repository = UserRepositoryFactory::createRepository();
        $statusCreate = $repository->insertUser($user);

        return $response->withJson(['status' => $statusCreate]);
    }

    public function updateUser(Request $request, Response $response): Response
    {
        $userData = $request->getParsedBody();
        $user = User::fromArray($userData);
        $repository = UserRepositoryFactory::createRepository();
        $statusUpdate = $repository->updateUser($user);

        return $response->withJson(['status' => $statusUpdate]);
    }

    public function deactivateUser(Request $request, Response $response): Response
    {
        $userId = (int)$request->getAttribute('id');
        $repository = UserRepositoryFactory::createRepository();
        $user = $repository->getUserById($userId);
        if ($user && $user->getActive()) {
            $result = $repository->deactivateUser($user);
            $response = $response->withJson(['status' => $result]);
        } else {
            $response = $response
                ->withStatus(204)
                ->withJson(['status' => false]);
        }

        return $response;
    }
}
