<?php
namespace Rosatom\RateCurrencies\Infrastructure\Factories;

use Rosatom\RateCurrencies\Domain\Entities\RateOfCurrencyRepository;
use Rosatom\RateCurrencies\Domain\Interfaces\IRateOfCurrencyRepository;

class RateOfCurrencyRepositoryFactory
{
    public static function createRepository(): IRateOfCurrencyRepository
    {
        return new RateOfCurrencyRepository();
    }
}
