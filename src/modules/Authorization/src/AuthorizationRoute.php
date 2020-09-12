<?php

namespace Rosatom\Authorization;

use AuthorizationDTO;
use Rosatom\Authorization\Application\Service\AutorizationCRUD;
use Slim\App;
use Slim\Http\Request;
use Slim\Http\Response;

class AuthorizationRoute
{


    /**
     * AuthorizationRoute constructor.
     */
    public function __construct(App $app)
    {
        $app->post('/', [$this, 'login']);
    }

    public function login(Request $request, Response $response){
        var_dump('ssss');
        die();
        $dataLogin = $request->getParsedBody();
        $dataLoginDTO = new AuthorizationDTO($dataLogin);
        $loginIn = new AutorizationCRUD();
        $answerLogin = $loginIn->loginIn($dataLoginDTO);

        return $response->withJson($answerLogin);
    }

}