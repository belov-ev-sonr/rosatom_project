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
                * 
                FROM 
                deposited_money 
                WHERE 
                `inn_of_organization` = '$inn'
                ";
        $listDepositedMoney = $this->getDbCon()->select($sql)[0];
        return $listDepositedMoney;
    }

}