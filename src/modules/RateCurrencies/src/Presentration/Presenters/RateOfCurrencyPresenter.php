<?php
namespace Rosatom\RateCurrencies\Presentation\Presentations;

use Rosatom\RateCurrencies\Domain\Entities\RateOfCurrency;

class RateOfCurrencyPresenter implements \JsonSerializable
{
    /** @var RateOfCurrency */
    private $rateOfCurrency;

    /**
     * RateOfCurrencyPresentation constructor.
     * @param RateOfCurrency $rateOfCurrency
     */
    public function __construct(RateOfCurrency $rateOfCurrency)
    {
        $this->rateOfCurrency = $rateOfCurrency;
    }

    /**
     * @return RateOfCurrency
     */
    private function getRateOfCurrency(): RateOfCurrency
    {
        return $this->rateOfCurrency;
    }

    /**
     * Specify data which should be serialized to JSON
     * @link https://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     * @since 5.4.0
     */
    public function jsonSerialize()
    {
        return [
            'id' => $this->getRateOfCurrency()->getId(),
            'name' => $this->getRateOfCurrency()->getName(),
            'code' => $this->getRateOfCurrency()->getCode(),
            'chcde' => $this->getRateOfCurrency()->getChcde(),
            'nom' => $this->getRateOfCurrency()->getNom(),
            'curs' => $this->getRateOfCurrency()->getCurs(),
            'date' => $this->getRateOfCurrency()->getDate()->format('Y-m-d')
        ];
    }
}
