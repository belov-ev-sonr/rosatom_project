<?php

namespace Rosatom\FinReport\Infrastructure\Repositories\FinReportSqlRepositories;

use Rosatom\Common\MySqlAdapter;
use Rosatom\FinReport\Infrastructure\DTO\FinReportDTO\FinReportDTO;

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
                new_org 
                WHERE 
                `inn` = '$inn'
                ";
        $listOrganization = $this->getDbCon()->select($sql)[0];
        return $listOrganization;
    }

    public function readDepositedMoney(int $inn){
        $sql = "
                SELECT 
                id,
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
                currency AccountBalanceCurrency,
                balance,
                id_bank_account
                FROM 
                account_balance 
                WHERE 
                `inn_of_organization` = '$inn'
                ";
        $listAccountBalance = $this->getDbCon()->select($sql)[0];
        return $listAccountBalance;
    }

    public function deleteOrganization(int $inn){
        $sql = "
                DELETE  
                FROM 
                new_org 
                WHERE 
                `inn` = '$inn'
                ";
        $this->getDbCon()->delete($sql);
    }

    public function deleteDepositedMoney(int $inn){
        $sql = "
                DELETE  
                FROM 
                deposited_money 
                WHERE 
                `inn_of_organization` = '$inn'
                ";
        $this->getDbCon()->delete($sql);
    }

    public function deleteAccountBalance(int $inn){
        $sql = "
                DELETE  
                FROM 
                account_balance 
                WHERE 
                `inn_of_organization` = '$inn'
                ";
        $this->getDbCon()->delete($sql);
    }

    public function updateAccountBalance(FinReportDTO $dataUpdate){
        $bic_of_bank = $dataUpdate->getBicOfBank();
        $name_of_bank = $dataUpdate->getNameOfBank();
        $comment = $dataUpdate->getComment();
        $currency = $dataUpdate->getAccountBalanceCurrency();
        $balance = $dataUpdate->getBalance();
        $id_bank_account = $dataUpdate->getIdBankAccount();
        $inn = $dataUpdate->getInn();

        $sql = "
                UPDATE
                account_balance
                SET 
                `bic_of_bank` = '$bic_of_bank',
                `name_of_bank` = '$name_of_bank',
                `comment` = '$comment',
                `currency` = '$currency',
                `balance` = '$balance',
                `id_bank_account` = '$id_bank_account',
                `inn_of_organization` = '$inn'
                WHERE 
                `bic_of_bank` = '$bic_of_bank'
                ";

        $this->getDbCon()->update($sql);
    }

    public function updateDepositedMoney(FinReportDTO $dataUpdate){

        $type_of_contract = $dataUpdate->getTypeOfContract();
        $date_of_signing = $dataUpdate->getDateOfSigning();
        $date_start = $dataUpdate->getDateStart();
        $date_end =$dataUpdate->getDateEnd();
        $interest_rate = $dataUpdate->getInterestRate();
        $currency = $dataUpdate->getCurrency();
        $amount = $dataUpdate->getAmount();
        $inn = $dataUpdate->getInn();
        $id = $dataUpdate->getId();

        $sql = "
                UPDATE
                deposited_money
                SET 
                `type_of_contract` = '$type_of_contract',
                `date_of_signing` = '$date_of_signing',
                `date_start` = '$date_start',
                `date_end` = '$date_end',
                `interest_rate` = '$interest_rate',
                `currency` = '$currency',
                `amount` = '$amount',
                `inn_of_organization` = '$inn'
                WHERE 
                `id` = '$id'
                ";

        $this->getDbCon()->update($sql);

        return $this->getDbCon()->select("
                                               SELECT
                                               id
                                               FROM
                                               deposited_money
                                               WHERE 
                                               inn_of_organization = '$inn'
                                                ")[0]['id'];
    }

    public function updateOrganization(FinReportDTO $dataUpdate){
        $kpp = $dataUpdate->getKpp();
        $nameOrg = $dataUpdate->getNameOrganization();
        $is_filial = $dataUpdate->getIsFilial();
        $inn = $dataUpdate->getInn();

        $sql = "
                UPDATE
                new_org
                SET 
                `kpp` = '$kpp',
                `name` = '$nameOrg',
                `is_filial` = '$is_filial'
                WHERE 
                `inn` = '$inn'
                ";

        $this->getDbCon()->update($sql);
    }

    public function insertOrganization(FinReportDTO $dataInsert){
        $kpp = $dataInsert->getKpp();
        $nameOrg = $dataInsert->getNameOrganization();
        $is_filial = $dataInsert->getIsFilial();
        $inn = $dataInsert->getInn();

        $sql = "
                INSERT INTO 
                new_org
                (`kpp`,
                `name`,
                `is_filial`,
                `inn`)
                VALUES 
                 ('$kpp',
                 '$nameOrg',
                 '$is_filial',
                 '$inn')
                ";

        $this->getDbCon()->insert($sql);
    }

    public function insertDepositedMoney(FinReportDTO $dataInsert){
        $type_of_contract = $dataInsert->getTypeOfContract();
        $date_of_signing = $dataInsert->getDateOfSigning();
        $date_start = $dataInsert->getDateStart();
        $date_end =$dataInsert->getDateEnd();
        $interest_rate = $dataInsert->getInterestRate();
        $currency = $dataInsert->getCurrency();
        $amount = $dataInsert->getAmount();
        $inn = $dataInsert->getInn();

        $sql = "
                INSERT INTO 
                deposited_money
                (`type_of_contract`,
                `date_of_signing`,
                `date_start`,
                `date_end`,
                `interest_rate`,
                `currency`,
                `amount`,
                `inn_of_organization`)
                VALUES 
                 ('$type_of_contract',
                 '$date_of_signing',
                 '$date_start',
                 '$date_end',
                 '$interest_rate',
                 '$currency',
                 '$amount',
                 '$inn')
                ";
        $this->getDbCon()->insert($sql);

        return $this->getDbCon()->getLastInsertId();
    }

    public function insertAccountBalance(FinReportDTO $dataInsert){
        $bic_of_bank = $dataInsert->getBicOfBank();
        $name_of_bank = $dataInsert->getNameOfBank();
        $comment = $dataInsert->getComment();
        $currency = $dataInsert->getAccountBalanceCurrency();
        $balance = $dataInsert->getBalance();
        $id_bank_account = $dataInsert->getIdBankAccount();
        $inn = $dataInsert->getInn();

        $sql = "
                INSERT INTO 
                account_balance
                (`bic_of_bank`,
                `name_of_bank`,
                `comment`,
                `currency`,
                `balance`,
                `id_bank_account`,
                `inn_of_organization`)
                VALUES
                 ('$bic_of_bank',
                 '$name_of_bank',
                 '$comment',
                 '$currency',
                 '$balance',
                 '$id_bank_account',
                 '$inn')
                ";

        $this->getDbCon()->insert($sql);
    }

    public function readOrganizations(){
        $sql = "
                SELECT
                id,
                inn,
                kpp,
                name,
                is_filial
                FROM
                new_org
                ";
        return $this->getDbCon()->select($sql);
    }

}