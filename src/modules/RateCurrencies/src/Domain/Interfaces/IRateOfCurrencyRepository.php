<?php
namespace Rosatom\RateCurrencies\Domain\Interfaces;

use Rosatom\RateCurrencies\Domain\Entities\RateOfCurrency;

interface IRateOfCurrencyRepository
{
    public function insertRateOfCurrency(RateOfCurrency $rate): bool;

    public function getRateOfCurrencyByDate(\DateTime $date): array;
}
