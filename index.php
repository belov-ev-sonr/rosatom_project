<?php

use Dotenv\Dotenv;
use Rosatom\Common\DBConnect;
use Slim\App;
use Slim\Http\Request;
use Slim\Http\Response;

require_once $_SERVER['DOCUMENT_ROOT'] . '/src/vendor/autoload.php';
$dotenv = Dotenv::createImmutable($_SERVER['DOCUMENT_ROOT']);
$dotenv->load();

$app = new App();

$app->get('/help', function (Request $request, Response $response, $args) {
    return $response->getBody()->write('hello');
});

DBConnect::init();

$app->run();
