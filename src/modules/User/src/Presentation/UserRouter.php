<?php
namespace Rosatom\User\Presentation;

use Rosatom\User\Presentation\Controller\UserController;
use Slim\App;

class UserRouter
{

    /**
     * UserRouter constructor.
     * @param App $app
     */
    public function __construct(App $app)
    {
        $app->post('/list', [new UserController(), 'getUsersList']);
        $app->get('/{id}', [new UserController(), 'getUsersById']);
        $app->put('/edit', [new UserController(), 'updateUser']);
        $app->post('/create', [new UserController(), 'createUser']);
        $app->put('/deactivate/{id}', [new UserController(), 'deactivateUser']);
    }
}
