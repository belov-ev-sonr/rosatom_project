<?php

namespace Rosatom\FinReport\Application\Service\FinReportCRUD;

use Rosatom\FinReport\Infrastructure\Repositories\FinReportSqlRepositories\FinReportSqlRepositories;

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
       $readOrganization =  $this->readOrganization($inn);

       $readDepositedMoney = $this->readDepositedMoney($inn);

       $readAccountBalance = $this->readAccountBalance($inn);

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

}