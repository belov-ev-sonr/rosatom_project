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
        $app->put('/{inn}', [$this, 'updateFinReport']);
        $app->delete('/{inn}', [$this, 'deleteFinReport']);
        $app->get('/', [$this, 'readFinReports']);
    }

    public function parseUTCDate($strDate)
    {
        $date = strtotime($strDate);
        $date = $date > 0 ? date("Y.m.d", $date) : null;
        return $date;
    }




    public function readFinReport(Request $request, Response $response){
        $inn = $request->getAttribute('inn');
        $readFinReport = new FinReportCRUD();
        $lineFineReport = $readFinReport->readFineReport($inn);
        return $response->withJson($lineFineReport);
    }

    public function insertFinReport(Request $request, Response $response){
        $insertFinReport = new FinReportCRUD();
        $dataInsert = $request->getParsedBody();

        if (count($dataInsert) > 1){
            foreach ($dataInsert as $itemInsert){
                $saverDTO = new FinReportDTO($itemInsert);
                $insertFinReport->insertOrganization($saverDTO);
            }
        }else{
            $saverDTO = new FinReportDTO($dataInsert);
            $insertFinReport->insertOrganization($saverDTO);
        }

    }

    public function updateFinReport(Request $request, Response $response){
        $updateFinReport = new FinReportCRUD();
        $dataUpdate = $request->getParsedBody();
        $dataUpdate['infoOrg']['inn'] = $request->getAttribute('inn');

        $datasDepositedMoney = $dataUpdate['depositedMoney'];
        foreach ($datasDepositedMoney as $dataDepositedMoney){

            $dataDepositedMoney['date_of_signing'] = $this->parseUTCDate($dataDepositedMoney['date_of_signing']);
            $dataDepositedMoney['date_start'] = $this->parseUTCDate($dataDepositedMoney['date_start']);
            $dataDepositedMoney['date_end'] = $this->parseUTCDate($dataDepositedMoney['date_end']);
            $dataDepositedMoney['inn'] = $request->getAttribute('inn');

            $updateDepositedMoneyDTO = new FinReportDTO($dataDepositedMoney);
            $updateId =  $updateFinReport->updateDepositedMoney($updateDepositedMoneyDTO);
        }

        $datasAccountBalance = $dataUpdate['accountBalance'];
        foreach ($datasAccountBalance as $dataAccountBalance){

            $dataAccountBalance['inn'] = $request->getAttribute('inn');

            $saveAccountBalanceDTO = new FinReportDTO($dataAccountBalance);
            $updateFinReport->updateAccountBalance($saveAccountBalanceDTO);
        }


        $saverDTO = new FinReportDTO($dataUpdate['infoOrg']);

        $updateFinReport->updateFinReport($saverDTO);

        return $response->withJson($updateId);
    }

    public function deleteFinReport(Request $request, Response $response){
        $inn = $request->getAttribute('inn');
        $deleteFinReport = new FinReportCRUD();
        $deleteId = $deleteFinReport->deleteFinReport($inn);
        return $response->withJson($deleteId);
    }

    public function readFinReports(Request $request, Response $response){
        $readFinReports = new FinReportCRUD();
        return $response->withJson($readFinReports->readFinReports());
    }

}