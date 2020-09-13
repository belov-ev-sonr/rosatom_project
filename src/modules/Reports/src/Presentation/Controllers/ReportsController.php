<?php
namespace Rosatom\Reports\Presentation;

use GuzzleHttp\Psr7\LazyOpenStream;
use PhpOption\LazyOption;
use Rosatom\Converters\App\Factories\ConverterFactory;
use Rosatom\Reports\App\Factories\SchemeFactory;
use Rosatom\Reports\App\Factories\SourceDataForReportFactory;
use Rosatom\Reports\App\Services\ReportsWriter;
use Slim\Http\Request;
use Slim\Http\Response;
use Slim\Http\Stream;

class ReportsController
{
    public function getReportFile(Request $request, Response $response): Response
    {
        $typeFile = (string)$request->getQueryParam('typeFile');
        $typeReport = (string)$request->getQueryParam('typeReport');

        $converter = ConverterFactory::createConverter($typeFile);
        $schema = SchemeFactory::create($typeReport);
        $converter->setSchema($schema);

        $dataSourceService = SourceDataForReportFactory::createSourceData();
        $result = $converter->getFile($dataSourceService->getData());
        $fileWriterService = new ReportsWriter();
        $filePath = $fileWriterService->writeFile($result);

        $response = $response->withHeader('Content-Description', 'File Transfer')
            ->withHeader('Content-Type', 'application/octet-stream')
            ->withHeader('Content-Disposition', 'attachment;filename="'.basename($filePath).'"')
            ->withHeader('Expires', '0')
            ->withHeader('Cache-Control', 'must-revalidate')
            ->withHeader('Pragma', 'public')
            ->withHeader('Content-Length', filesize($filePath));
        readfile($filePath);
        return $response;
    }
}
