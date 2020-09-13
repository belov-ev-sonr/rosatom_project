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
    }
}
