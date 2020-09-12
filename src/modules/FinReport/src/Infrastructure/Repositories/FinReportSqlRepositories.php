<?php

namespace Rosatom\FinReport\Infrastructure\Repositories\FinReportSqlRepositories;

use Rosatom\Common\MySqlAdapter;

class FinReportSqlRepositories
{

    private $dbCon;

    /**
     * FinReportSqlRepositories constructor.
     * @param $dbCon
     */
    public function __construct()
    {
        $this->dbCon = new MySqlAdapter();
    }

    function getDbCon(): MySqlAdapter
    {
       return $this->dbCon;
    }

    public function readOrganization(int $inn){
        $sql = "
                SELECT 
                * 
                FROM 
                organization 
                WHERE 
                `inn` = '$inn'
                ";
        $listOrganization = $this->getDbCon()->select($sql)[0];
        return $listOrganization;
    }

    public function readDepositedMoney(int $inn){
        $sql = "
                SELECT 
                type_of_contract,
                date_of_signing,
                date_start,
                date_end,
                interest_rate,
                currency,
                amount 
                FROM 
                deposited_money 
                WHERE 
                `inn_of_organization` = '$inn'
                ";
        $listDepositedMoney = $this->getDbCon()->select($sql)[0];
        return $listDepositedMoney;
    }

    public function readAccountBalance(int $inn){
        $sql = "
                SELECT 
                bic_of_bank,
                name_of_bank,
                comment,
                currency,
                balance
                FROM 
                account_balance 
                WHERE 
                `inn_of_organization` = '$inn'
                ";
        $listAccountBalance = $this->getDbCon()->select($sql)[0];
        return $listAccountBalance;
    }

}