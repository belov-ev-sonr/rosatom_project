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

    public function readOrganization(int $id){
        $sql = "
                SELECT 
                * 
                FROM 
                new_org 
                WHERE 
                `id` = '$id'
                ";
        $listOrganization = $this->getDbCon()->select($sql)[0];
        return $listOrganization;
    }

    public function readDepositedMoney(int $id){
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
                `id_organization` = $id
                ";
        $listDepositedMoney = $this->getDbCon()->select($sql)[0];
        return $listDepositedMoney;
    }

    public function readAccountBalance(int $id){
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
                `id_organization` = '$id'
                ";
        $listAccountBalance = $this->getDbCon()->select($sql)[0];
        return $listAccountBalance;
    }

    public function deleteOrganization(int $id){
        $sql = "
                DELETE  
                FROM 
                new_org 
                WHERE 
                `id` = '$id'
                ";
        $this->getDbCon()->delete($sql);
    }

    public function deleteDepositedMoney(int $id){
        $sql = "
                DELETE  
                FROM 
                deposited_money 
                WHERE 
                `id_organization` = '$id'
                ";
        $this->getDbCon()->delete($sql);
    }

    public function deleteAccountBalance(int $id){
        $sql = "
                DELETE  
                FROM 
                account_balance 
                WHERE 
                `id_organization` = '$id'
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
        //$idOrg = $dataInsert->getId();
        $kpp = $dataInsert->getKpp();
        $nameOrg = $dataInsert->getNameOrganization();
        $is_filial = $dataInsert->getIsFilial();
        $inn = $dataInsert->getInn();

        if (empty($dataInsert->getId())){

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
                    '$inn' )
                    ";
        }else{
            $idOrg = $dataInsert->getId();

            $sql = "
                    UPDATE 
                    new_org 
                    SET 
                    `kpp`= '$kpp', 
                    `name`='$nameOrg', 
                    `is_filial`='$is_filial', 
                    `inn`='$inn' 
                    WHERE 
                    `id`= '$idOrg'
                    ";
        }



        $this->getDbCon()->insert($sql);

        return $this->getDbCon()->getLastInsertId();
    }

    public function insertDepositedMoney(FinReportDTO $dataInsert, $lastId){

        $type_of_contract = $dataInsert->getTypeOfContract();
        $date_of_signing = $dataInsert->getDateOfSigning();
        $date_start = $dataInsert->getDateStart();
        $date_end =$dataInsert->getDateEnd();
        $interest_rate = $dataInsert->getInterestRate();
        $currency = $dataInsert->getCurrency();
        $amount = $dataInsert->getAmount();

        if (empty($dataInsert->getId())){
            $idOrg = $lastId;

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
                    `id_organization`) 
                    VALUES 
                    ('$type_of_contract', 
                    '$date_of_signing', 
                    '$date_start', 
                    '$date_end', 
                    '$interest_rate', 
                    '$currency', 
                    '$amount',
                    '$idOrg')
                    ";
        }else{
            $idOrg = $dataInsert->getId();

            $sql = "
                    UPDATE 
                    deposited_money 
                    SET 
                    `type_of_contract`= '$type_of_contract', 
                    `date_of_signing`='$date_of_signing', 
                    `date_start`='$date_start', 
                    `date_end`='$date_end', 
                    `interest_rate`='$interest_rate', 
                    `currency`='$currency', 
                    `amount`='$amount' 
                    WHERE 
                    `id_organization`= '$idOrg'
                    ";
        }

        $this->getDbCon()->insert($sql);
    }

    public function insertAccountBalance(FinReportDTO $dataInsert, $lastId){

        $bic_of_bank = $dataInsert->getBicOfBank();
        $name_of_bank = $dataInsert->getNameOfBank();
        $comment = $dataInsert->getComment();
        $currency = $dataInsert->getAccountBalanceCurrency();
        $balance = $dataInsert->getBalance();
        $id_bank_account = $dataInsert->getIdBankAccount();

        if (empty($dataInsert->getId())){
            $idOrg = $lastId;

            $sql = "
                    INSERT INTO 
                    account_balance 
                    (`bic_of_bank`, 
                `name_of_bank`, 
                `comment`, 
                `currency`, 
                `balance`, 
                `id_bank_account`,
                `id_organization`) 
                    VALUES 
                    ('$bic_of_bank', 
                    '$name_of_bank', 
                    '$comment', 
                    '$currency', 
                    '$balance', 
                    '$id_bank_account',
                     '$idOrg')
                    ";
        }else{
            $idOrg = $dataInsert->getId();

            $sql = "
                    UPDATE 
                    account_balance 
                    SET 
                    `bic_of_bank`= '$bic_of_bank', 
                    `name_of_bank`='$name_of_bank', 
                    `comment`='$comment', 
                    `currency`='$currency', 
                    `balance`='$balance', 
                    `id_bank_account`='$id_bank_account'
                    WHERE 
                    `id_organization`= '$idOrg'
                    ";
        }

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