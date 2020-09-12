<?php
namespace Rosatom\Reports\Presentation;

use Rosatom\Converters\App\Factories\ConverterFactory;
use Rosatom\Reports\App\Factories\SchemeFactory;
use Slim\Http\Request;
use Slim\Http\Response;

class ReportsController
{
    public function getReportFile(Request $request, Response $response): Response
    {
        $typeFile = (string)$request->getQueryParam('typeFile');
        $typeReport = (string)$request->getQueryParam('typeReport');

        $converter = ConverterFactory::createConverter($typeFile);
        $schema = SchemeFactory::create($typeReport);
        $converter->setSchema($schema);
        $result = $converter->getFile([]);

        return $response->withJson($result);
    }
}
