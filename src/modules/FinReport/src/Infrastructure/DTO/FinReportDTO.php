<?php

namespace Rosatom\FinReport\Infrastructure\DTO\FinReportDTO;

class FinReportDTO
{
    /**
     * @var int
     */
    private $inn;

    /**
     * @var int
     */
    private $kpp;

    /**
     * @var string
     */
    private $nameOrganization;

    /**
     * @var string
     */
    private $is_filial;

    /**
     * @var string
     */
    private $type_of_contract;

    /**
     * @var string
     */
    private $date_of_signing;

    /**
     * @var string
     */
    private $date_start;

    /**
     * @var string
     */
    private $date_end;

    /**
     * @var float
     */
    private $interest_rate;

    /**
     * @var string
     */
    private $currency;

    /**
     * @var float
     */
    private $amount;

    /**
     * @var int
     */
    private $bic_of_bank;

    /**
     * @var string
     */
    private $name_of_bank;

    /**
     * @var string
     */
    private $comment;

    /**
     * @var string
     */
    private $AccountBalanceCurrency;

    /**
     * @var float
     */
    private $balance;

    /**
     * @var int
     */
    private $id_bank_account;

    /**
     * @var int
     */
    private $id;


    public function __construct($dataFinReport)
    {
        $this->inn = $dataFinReport['inn'];
        $this->kpp = $dataFinReport['kpp'];
        $this->nameOrganization = $dataFinReport['name'];
        $this->is_filial = $dataFinReport['is_filial'];
        $this->type_of_contract = $dataFinReport['type_of_contract'];
        $this->date_of_signing = $dataFinReport['date_of_signing'];
        $this->date_start = $dataFinReport['date_start'];
        $this->date_end = $dataFinReport['date_end'];
        $this->interest_rate = $dataFinReport['interest_rate'];
        $this->currency = $dataFinReport['currency'];
        $this->amount = $dataFinReport['amount'];
        $this->bic_of_bank = $dataFinReport['bic_of_bank'];
        $this->name_of_bank = $dataFinReport['name_of_bank'];
        $this->comment = $dataFinReport['comment'];
        $this->AccountBalanceCurrency = $dataFinReport['AccountBalanceCurrency'];
        $this->balance = $dataFinReport['balance'];
        $this->id_bank_account = $dataFinReport['id_bank_account'];
        $this->id = $dataFinReport['id'];
    }

    /**
     * @return int
     */
    public function getInn(): int
    {
        return $this->inn;
    }

    /**
     * @return int
     */
    public function getKpp(): int
    {
        return $this->kpp;
    }

    /**
     * @return string
     */
    public function getNameOrganization(): ?string
    {
        return $this->nameOrganization;
    }

    /**
     * @return string
     */
    public function getIsFilial(): ?string
    {
        return $this->is_filial;
    }

    /**
     * @return string
     */
    public function getTypeOfContract(): ?string
    {
        return $this->type_of_contract;
    }

    /**
     * @return string
     */
    public function getDateOfSigning(): ?string
    {
        return $this->date_of_signing;
    }

    /**
     * @return string
     */
    public function getDateStart(): ?string
    {
        return $this->date_start;
    }

    /**
     * @return string
     */
    public function getDateEnd(): ?string
    {
        return $this->date_end;
    }

    /**
     * @return float
     */
    public function getInterestRate(): ?float
    {
        return $this->interest_rate;
    }

    /**
     * @return string
     */
    public function getCurrency(): ?string
    {
        return $this->currency;
    }

    /**
     * @return float
     */
    public function getAmount(): ?float
    {
        return $this->amount;
    }

    /**
     * @return int
     */
    public function getBicOfBank(): ?int
    {
        return $this->bic_of_bank;
    }

    /**
     * @return string
     */
    public function getNameOfBank(): ?string
    {
        return $this->name_of_bank;
    }

    /**
     * @return string
     */
    public function getComment(): ?string
    {
        return $this->comment;
    }

    /**
     * @return string
     */
    public function getAccountBalanceCurrency(): ?string
    {
        return $this->AccountBalanceCurrency;
    }

    /**
     * @return float
     */
    public function getBalance(): ?float
    {
        return $this->balance;
    }

    /**
     * @return int
     */
    public function getIdBankAccount(): ?int
    {
        return $this->id_bank_account;
    }

    /**
     * @return int
     */
    public function getId(): ?int
    {
        return $this->id;
    }





}