<?php
namespace Rosatom\FinReport;

use Rosatom\FinReport\Application\Service\FinReportCRUD\FinReportCRUD;
use Rosatom\FinReport\Infrastructure\DTO\FinReportDTO\FinReportDTO;
use Slim\App;
use Slim\Http\Request;
use Slim\Http\Response;

class FinReportRoute
{

    /**
     * FinReportRoute constructor.
     * @param App $app
     */
    public function __construct(App $app)
    {
        $app->get('/{inn}', [$this,'readFinReport']);
        $app->post('/', [$this, 'insertFinReport']);
        $app->put('/{inn}', [$this, 'updatFinReport']);
        $app->delete('/{inn}', [$this, 'deleteFinReport']);
    }

    public function readFinReport(Request $request, Response $response){
        $inn = $request->getAttribute('inn');
        $readFinReport = new FinReportCRUD();
        $lineFineReport = $readFinReport->readFineReport($inn);
        return $response->withJson($lineFineReport);
    }

    public function insertFinReport(Request $request, Response $response){
        return 'help';
    }

    public function updatFinReport(Request $request, Response $response){
        $dataInsert = $request->getParsedBody();
        $saverDTO = new FinReportDTO($dataInsert);

    }

    public function deleteFinReport(Request $request, Response $response){
        $inn = $request->getAttribute('inn');
        $deleteFinReport = new FinReportCRUD();
        $deleteId = $deleteFinReport->deleteFinReport($inn);
        return $response->withJson($deleteId);
    }

}