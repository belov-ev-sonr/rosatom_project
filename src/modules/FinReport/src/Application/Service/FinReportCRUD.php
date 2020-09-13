<?php

namespace Rosatom\FinReport\Application\Service\FinReportCRUD;

use Rosatom\FinReport\Infrastructure\DTO\FinReportDTO\FinReportDTO;
use Rosatom\FinReport\Infrastructure\Repositories\FinReportSqlRepositories\FinReportSqlRepositories;
use Symfony\Component\Filesystem\Exception\FileNotFoundException;

class FinReportCRUD
{

    private $sqlRepositories;

    /**
     * FinReportCRUD constructor.
     * @param $sqlRepositories
     */
    public function __construct()
    {
        $this->sqlRepositories = new FinReportSqlRepositories();
    }

    public function getSqlRepositories(): FinReportSqlRepositories
    {
        return $this->sqlRepositories;
    }


    public function readFineReport(int $inn){
       $readOrganization['infoOrg'] =  $this->readOrganization($inn);

       $readDepositedMoney['depositedMoney'] = $this->readDepositedMoney($inn);

       $readAccountBalance['accountBalance'] = $this->readAccountBalance($inn);

       $readFineReport = $readOrganization + $readDepositedMoney + $readAccountBalance;

       return $readFineReport;
    }

    public function readOrganization(int $inn){
        return $this->sqlRepositories->readOrganization($inn);
    }

    public function readDepositedMoney(int $inn){
        return $this->sqlRepositories->readDepositedMoney($inn);
    }

    public function readAccountBalance(int $inn)
    {
        return $this->sqlRepositories->readAccountBalance($inn);
    }

    public function deleteFinReport(int $inn)
    {
        $this->deleteOrganization($inn);

        $this->deleteDepositedMoney($inn);

        $this->deleteAccountBalance($inn);
    }

    public function deleteOrganization(int $inn)
    {
        $this->sqlRepositories->deleteOrganization($inn);

    }

    public function deleteDepositedMoney(int $inn){
        return $this->sqlRepositories->deleteDepositedMoney($inn);
    }

    public function deleteAccountBalance(int $inn)
    {
        return $this->sqlRepositories->deleteAccountBalance($inn);
    }

    public function updateFinReport(FinReportDTO $dataUpdate){
        $this->sqlRepositories->updateOrganization($dataUpdate);
    }

    public function updateAccountBalance(FinReportDTO $dataUpdate){
        $this->sqlRepositories->updateAccountBalance($dataUpdate);
    }

    public function updateDepositedMoney(FinReportDTO $dataUpdate){
        return $this->sqlRepositories->updateDepositedMoney($dataUpdate);
    }

    public function insertOrganization(FinReportDTO $dataInsertOrganization){

        $this->sqlRepositories->insertOrganization($dataInsertOrganization);
        $this->sqlRepositories->insertDepositedMoney($dataInsertOrganization);
        $this->sqlRepositories->insertAccountBalance($dataInsertOrganization);
        /*
        $isEmptyOrg = $this->sqlRepositories->readOrganization($dataInsertOrganization->getInn());
        if(empty($isEmptyOrg)){
            $this->sqlRepositories->insertOrganization($dataInsertOrganization);
        }*/
    }

    public function insertDepositedMoney(FinReportDTO $dataDepositedMoney){
        $idRes =  $this->sqlRepositories->insertDepositedMoney($dataDepositedMoney);

        return $idRes;
    }

    public function insertAccountBalance(FinReportDTO $dataAccountBalance){
        $this->sqlRepositories->insertAccountBalance($dataAccountBalance);
    }


    public function readFinReports(){
        $orgs = $this->sqlRepositories->readOrganizations();



        $organizationsForParams = [];

        foreach ($orgs as $org){
            $id = $org['id'];
            $readDepositedMoney = $this->readDepositedMoney($org['inn']);

            $readAccountBalance = $this->readAccountBalance($org['inn']);

            $organizationsForParams[$id] = $org + $readDepositedMoney + $readAccountBalance;

        }

        return $organizationsForParams;
    }
}