<?php
namespace Rosatom\RateCurrencies\Domain\Entities;

class RateOfCurrency
{
    /** @var int */
    private $id;
    /** @var string */
    private $code;
    /** @var string */
    private $name;
    /** @var string */
    private $chcde;
    /** @var int */
    private $nom;
    /** @var float */
    private $curs;
    /** @var \DateTime */
    private $date;

    /**
     * RateOfCurrency constructor.
     */
    private function __construct()
    {
    }

    public static function from(
        int $id,
        string $code,
        string $name,
        string $chcde,
        int $nom,
        float $curs,
        \DateTime $date
    ){
        $rateOfCurrency = new self();
        $rateOfCurrency->id = $id;
        $rateOfCurrency->code = $code;
        $rateOfCurrency->name = $name;
        $rateOfCurrency->chcde = $chcde;
        $rateOfCurrency->nom = $nom;
        $rateOfCurrency->curs = $curs;
        $rateOfCurrency->date = $date;

        return $rateOfCurrency;
    }

    public static function fromArray(array $rateOfCurrencyData = [])
    {
        $rateOfCurrency = new self();
        $rateOfCurrency->id = (int)$rateOfCurrencyData['id'];
        $rateOfCurrency->code = (string)$rateOfCurrencyData['code'];
        $rateOfCurrency->name = (string)$rateOfCurrencyData['name'];
        $rateOfCurrency->chcde = (string)$rateOfCurrencyData['chcde'];
        $rateOfCurrency->nom = (int)$rateOfCurrencyData['nom'];
        $rateOfCurrency->curs = (float)$rateOfCurrencyData['curs'];
        $rateOfCurrency->date = new \DateTime($rateOfCurrencyData['date']);

        return $rateOfCurrency;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getCode(): string
    {
        return $this->code;
    }

    /**
     * @param string $code
     */
    public function setCode(string $code): void
    {
        $this->code = $code;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getChcde(): string
    {
        return $this->chcde;
    }

    /**
     * @param string $chcde
     */
    public function setChcde(string $chcde): void
    {
        $this->chcde = $chcde;
    }

    /**
     * @return int
     */
    public function getNom(): int
    {
        return $this->nom;
    }

    /**
     * @param int $nom
     */
    public function setNom(int $nom): void
    {
        $this->nom = $nom;
    }

    /**
     * @return float
     */
    public function getCurs(): float
    {
        return $this->curs;
    }

    /**
     * @param float $curs
     */
    public function setCurs(float $curs): void
    {
        $this->curs = $curs;
    }

    /**
     * @return \DateTime
     */
    public function getDate(): \DateTime
    {
        return $this->date;
    }

}
