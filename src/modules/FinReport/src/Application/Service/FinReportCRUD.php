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

    public function readOrganization(int $id){
        return $this->sqlRepositories->readOrganization($id);
    }

    public function readDepositedMoney(int $id){
        return $this->sqlRepositories->readDepositedMoney($id);
    }

    public function readAccountBalance(int $id)
    {
        return $this->sqlRepositories->readAccountBalance($id);
    }

    public function deleteFinReport(int $id)
    {

        $this->deleteOrganization($id);

        $this->deleteDepositedMoney($id);

        $this->deleteAccountBalance($id);
    }

    public function deleteOrganization(int $id)
    {
        $this->sqlRepositories->deleteOrganization($id);

    }

    public function deleteDepositedMoney(int $id){
        return $this->sqlRepositories->deleteDepositedMoney($id);
    }

    public function deleteAccountBalance(int $id)
    {
        return $this->sqlRepositories->deleteAccountBalance($id);
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
        $lastId = $this->sqlRepositories->insertOrganization($dataInsertOrganization);
        $this->sqlRepositories->insertDepositedMoney($dataInsertOrganization, $lastId);
        $this->sqlRepositories->insertAccountBalance($dataInsertOrganization, $lastId);

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
            $readDepositedMoney = $this->readDepositedMoney($org['id']);

            $readAccountBalance = $this->readAccountBalance($org['id']);

            $organizationsForParams[$id] = array_merge($org, $readDepositedMoney, $readAccountBalance);

        }

        return $organizationsForParams;
    }
}