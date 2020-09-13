<?php
namespace Rosatom\RateCurrencies\Domain\Entities;

use Rosatom\Common\MySqlAdapter;
use Rosatom\RateCurrencies\Domain\Interfaces\IRateOfCurrencyRepository;

class RateOfCurrencyRepository implements IRateOfCurrencyRepository
{
    /** @var MySqlAdapter */
    public $adapter;

    /**
     * RateOfCurrencyRepository constructor.
     * @param MySqlAdapter $adapter
     */
    public function __construct(MySqlAdapter $adapter = null)
    {
        if (is_null($adapter)) {
            $this->adapter = new MySqlAdapter();
        } else {
            $this->adapter = $adapter;
        }
    }

    /**
     * @return MySqlAdapter
     */
    private function getAdapter(): MySqlAdapter
    {
        return $this->adapter;
    }


    public function insertRateOfCurrency(RateOfCurrency $rate): bool
    {
        $date = $rate->getDate()->format('Y-m-d');
        $sql = "INSERT INTO `rate_currencies`
                SET `code` = '{$rate->getCode()}',
                `name` = '{$rate->getName()}',
                `chcde` = '{$rate->getChcde()}',
                `nom` = '{$rate->getNom()}',
                `curs` = '{$rate->getCurs()}',
                `date` = '{$date}'";
        return $this->getAdapter()->select($sql);
    }

    public function getRateOfCurrencyByDate(\DateTime $date): array
    {
        $dateFormat = $date->format('Y-m-d');
        $sql = "SELECT
                    id,
                    code,
                    name,
                    chcde,
                    nom,
                    curs,
                    `date`
                FROM `rate_currencies`
                WHERE DATE(`date`) = DATE('{$dateFormat}')";
        $result = $this->getAdapter()->select($sql);
        $ratesList = [];
        foreach ($result as $rate){
            $ratesList[] = RateOfCurrency::fromArray($rate);
        }

        return $ratesList;
    }
}
