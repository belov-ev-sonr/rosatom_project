<?php

use Dotenv\Dotenv;
use Rosatom\Common\DBConnect;
use Rosatom\Converters\App\Services\XMLConverter;
use Rosatom\FinReport\FinReportRoute;
use Rosatom\Reports\Presentation\ReportsRouter;
use Slim\App;
use Slim\Http\Request;
use Slim\Http\Response;

require_once $_SERVER['DOCUMENT_ROOT'] . '/src/vendor/autoload.php';
$dotenv = Dotenv::createImmutable($_SERVER['DOCUMENT_ROOT']);
$dotenv->load();
$config = ['settings' => ['displayErrorDetails' => true]];
$app = new App($config);
DBConnect::init();

$app->get('/help', function (Request $request, Response $response, $args) {
    return $response->getBody()->write('hello');
});

$app->get('/xml', function (Request $request, Response $response, $args) {
    $xmlConverter = new XMLConverter();
    print_r($xmlConverter->xmlConvert());
    return $response->withJson(1);
});

$app->group('/reports', function () {
    return new ReportsRouter($this);
});

$app->group('/finreport', function () {
    return new FinReportRoute($this);
});


$app->run();
