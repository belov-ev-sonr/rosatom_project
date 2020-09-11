<?php

use Slim\App;
use Slim\Http\Request;
use Slim\Http\Response;

require_once $_SERVER['DOCUMENT_ROOT'] . '/src/vendor/autoload.php';

$app = new App();

$app->get('/help', function (Request $request, Response $response, $args) {
    return $response->getBody()->write('hello');
});

$app->run();
