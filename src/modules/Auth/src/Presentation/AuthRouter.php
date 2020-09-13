<?php
namespace Rosatom\Auth\Presentation;

use Rosatom\Auth\Presentation\Controllers\AuthController;
use Slim\App;

class AuthRouter
{

    /**
     * AuthRouter constructor.
     * @param App $app
     */
    public function __construct(App $app)
    {
        $app->post("/login", [new AuthController(), 'login']);
        $app->post("/refresh", [new AuthController(), 'refresh']);
    }
}
